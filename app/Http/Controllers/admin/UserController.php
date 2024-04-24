<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
<<<<<<< HEAD
    public function index(){
        $users = User::latest()->paginate(12);
=======
    public function index(Request $request){
        $users = User::latest();
        if(!empty($request->get('key'))){
            $key = $request->get('key');
            $users = User::where('name', 'like', '%'.$key.'%')
                    ->orWhere('email', 'like', '%'.$key.'%');
        }
        $users = $users->paginate(12);
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
        return view('admin.users.index', ['users' => $users]);
    }

    public function destroy($id){
        $users = User::find($id);
        if(!$users){
           session()->flash('error', 'User not found');
            return response()->json([
                'status' => false
            ]); 
        }
        $users->destroy($users->id);

        session()->flash('message', 'User deleted');
        return response()->json([
            'status' => true
        ]);
    }
}
