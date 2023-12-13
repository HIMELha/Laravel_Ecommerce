<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class homeController extends Controller
{
    public function index(){
        $orders = Order::get();
        $Dorders = Order::whereNot('order_status', 'cancelled')->get();
        $users = User::all();
        $products = OrderItem::all();

        $productQty = []; // Initialize an empty array to store product quantities

        $products = OrderItem::all();

        foreach ($products as $item) {
            $productName = $item->name; // Replace with your actual column name
            $quantity = $item->qty; // Replace with your actual column name

            // Check if the product already exists in $productQty
            $key = array_search($item->product_id, array_column($productQty, 'product_id'));

            if ($key !== false) {
                // If the product already exists, add the quantity to the existing total
                $productQty[$key]['qtys'] += $quantity;
            } else {
                // If the product doesn't exist, create a new entry in $productQty
                $productQty[] = [
                    'qtys' => $quantity,
                    'product_id' => $item->product_id, // Replace with your actual column name
                ];
            }
        }


        $data['orders'] = $orders;
        $data['productQty'] = $productQty;
        $data['Dorders'] = $Dorders;
        $data['users'] = $users;
        return view('admin.dashboard', $data);
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function profile(){
<<<<<<< HEAD

        return view('admin.setting.setting');
=======
        $user = Auth::guard('admin')->user();
        return view('admin.profile', compact('user'));
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
    }
    
    public function settings(){
        $admin = Auth::guard('admin')->user();

        return view('admin.setting.setting', ['user' => $admin]);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'email|required',
            'phone' => 'required|numeric',
            'password' => 'required|min:6',
        ]);

        if($validator->passes()){
            $user = Auth::guard('admin')->user();
            $userU = User::find($user->id);
            $userU->name = $request->name;
            $userU->email = $request->email;
            $userU->phone = $request->phone;
            $userU->password = $request->password;
            $userU->update();
            session()->flash('message', 'Profile info updated');
            return response()->json([
                'status' => true,
            ]);
        }else{
            session()->flash('error', 'All field are required');
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
}
