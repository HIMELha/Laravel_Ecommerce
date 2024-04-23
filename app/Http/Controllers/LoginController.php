<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('front.login');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
        'email'=> 'required|email',
        'password'=> 'required|min:6'
        ]);
    
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
           
            $request->session()->flash('message', 'Login successful');
            

            if(!session()->has('url.intended')) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login successful'
                ]);
            }else{
                return response()->json([
                    'status' => 'redirect',
                    'url' => session()->get('url.intended')
                ]);
            }

        }else{
            $request->session()->flash('error', 'Invalid login information');
            return response()->json([
                'status' => 'invalid',
                'error' => 'Invalid login information'
            ]);
        }
    }

    public function forget(){
        session()->flash('error', "You can't reset your password right now!");
        return view('front.forget');
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('front.index');
    }
}
