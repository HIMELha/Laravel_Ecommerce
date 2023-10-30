<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::latest()->paginate(12);
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
