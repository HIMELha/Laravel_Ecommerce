<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class adminLoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->passes()){

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){

                $admin = Auth::guard('admin')->user();

                if($admin->role == 2){
                    $request->session()->flash('message', 'Your are Logged in! Welcome');
                    return redirect()->route('admin.dashboard');
                }else{
                    Auth::guard('admin')->logout();
                    return redirect()->back()->with('error', 'You are not authorized to access admin panel');
                }

                
            } else {
                return redirect()->route('admin.login')->with('error', 'Either email/password is incorrect');
            }
            
        } else {
            return redirect()->route('admin.login')->with('error', 'email or password mismatch');
        }
    }

 

    
}
