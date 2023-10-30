<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index(){
        return view('front.register');
    }

    public function create(Request $request){

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
            'phone' => 'required|min:10|unique:users'
        ]);

        if(!$validate->passes()){
            return response()->json([
                'status' => false,
                'errors' => $validate->errors()
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->save();

        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $request->session()->flash('message', 'Registration successful');
            return response()->json([
                'status' => true,
                'message' => 'Registration successful'
            ]);
        }

    }
}
