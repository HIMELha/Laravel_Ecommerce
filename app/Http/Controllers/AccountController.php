<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index(){
        return view('front.account.account');
    }

    public function updateProfile(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'phone' => 'required|min:10',
        ]);

        if($validator->passes()){
            $user = User::find(Auth::user()->id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = $request->password;
            $user->update();

            session()->flash('message', 'Profile Updated Successfully');

            return response()->json([
                'status' => true
            ]);
        }else{
           return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]); 
        }
    }

    public function orders(){
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->latest()->paginate(12);

    
        return view('front.account.orders', ['orders' => $orders]);
    }

    public function orderDetails($id){
        $user = Auth::user();  
        $order = Order::where('user_id', $user->id)->find($id);
        if(!$order){
            session()->flash('message', 'Order details not found');
            return redirect()->route('user.orders');
        }
        
        $items = OrderItem::where('order_id', $id)->get();
        $products = [];
        foreach($items as $item){
            $products[] = Product::where('id', $item->product_id)->first();
        }

        $data['items'] = $items;
        $data['order'] = $order;
        $data['products'] = $products;
        return view('front.account.orderDetails', $data);
        
    }

    public function address(){
        $address = CustomerAddress::where('user_id', Auth::user()->id)->first();
        if($address == null){
            session()->flash('error', 'Please completed at least one order');
            return redirect()->back();
        }
        return view('front.account.address', ['address' => $address]);
    }
}
