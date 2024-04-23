<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        $user = Auth::guard('admin')->user();
        return view('admin.profile', compact('user'));
    }
    
    public function settings(){
        $admin = Auth::guard('admin')->user();
        $settings = Setting::first();
        
        return view('admin.setting.setting', ['user' => $admin, 'settings' => $settings]);
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

    public function updateSettings(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title' => 'required|max:255',
            'footer_desc' => 'required|max:800'
        ]);

        if($validator->fails()){
            session()->flash("error", $validator->errors()->first());
            return redirect()->back();
        }

        $setting = Setting::first();
        $setting->title = $request->title;
        $oldImage = base_path('uploads/settings/'.$setting->logo);

        if(file_exists($oldImage)){
            File::delete($oldImage);
        }

        $image = $request->image;

        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $newName = time().".".$ext;

        $image->move(base_path('uploads/settings'), $newName);
        
        $setting->logo = $newName;
        $setting->footer_short_desc = $request->footer_desc;
        $setting->save();


        session()->flash('success', "Settings updated successfully");
        return redirect()->back();
        
    }
}
