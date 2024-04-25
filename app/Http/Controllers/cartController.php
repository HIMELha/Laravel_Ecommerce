<?php

namespace App\Http\Controllers;

use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Country;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class cartController extends Controller
{
    public function addToCart(Request $request) {
        $product = Product::with('product_images')->find($request->id);

        if($product == null){
            session()->flash('error',  'Product Not Found');
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ]);
            
        }
        if($product->track_qty == 'Yes' && $product->qty == 0){
            session()->flash('error',  'Out of Stock');
            return response()->json([
                'status' => false,
                'message' => 'Out of Stock'
            ]);
        }

        
        $cartContent = Cart::content();
        $productAlreadyExist = false;

        foreach ($cartContent as $item) {
            if($item->id == $product->id){
                $productAlreadyExist = true;
            }
        }

        if($productAlreadyExist == false){
            
            Cart::add($product->id, $product->title, 1, $product->price, 
            ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']);

            session()->flash('message', '' . $product->title . ' added to cart');
            
            return response()->json([
            'status' => true,
            'message' => $product->title . ' added to cart'
            ]);
            
        }else{
            
            session()->flash('error', '' . $product->title . ' already in cart');

            return response()->json([
                'status' => false,
                'message' => $product->title . ' already in cart'
            ]);
        }
        
    }

    public function carts() {
        $cartContent = Cart::content();

        $data['cartContent'] = $cartContent;
        // dd(Cart::content());
        return view('front.carts', $data);
    }

    public function updateCart(Request  $request){
        $rowId = $request->rowId;
        $qty = $request->qty;
        
        
        $cart = Cart::get($rowId);
        $product = Product::findOrFail($cart->id);


        if($product->track_qty == 'Yes'){
            if($product->qty < $qty){
                session()->flash('error', 'Requested quantity unavailable');
                return response()->json([
                    'status' => true,
                    'message' => 'Requested quantity unavailable'
                ]);
            }else{
                Cart::update($rowId, $qty);
            }
        }

        
        session()->flash('message', 'Cart updated successfully');
        return response()->json([
            'status' => true,
            'message' => 'Cart updated successfully'
        ]);

    }

    public function deleteCart(Request $request){
        $rowId = $request->rowId;

        if($rowId == null){
            session()->flash('error', 'Item not found or something else');
            return response()->json([
                'status' => false,
                'message' => 'Item not found or something else'
            ]); 
        }
        Cart::remove($rowId);

        session()->flash('message', 'Item removed successfully');
        return response()->json([
            'status' => true,
            'message' => 'Item removed successfully'
        ]);
    }

    public function checkout(){
        if(Cart::count() == 0){
            return redirect()->route('front.carts');
        }

        if(!Auth::check()){

           if(!session()->has('url.intended')) {
            session(['url.intended' => url()->current()]);
           }
           return redirect()->route('front.login');
        }
        session()->forget('url.intended');
        $countries = Country::orderBy('name', 'ASC')->get();
        
        $CustomerAddress = CustomerAddress::where('user_id',Auth::user()->id)->first();
        $totalQty = 0;
        $ShippingCharge = 0;
        foreach(Cart::content() as $item){
            $totalQty += $item->qty;
        }

        if($CustomerAddress){
            $shippingInfo = Shipping::where('country_id', $CustomerAddress->country_id)->first();
        }else{
            $shippingInfo = Shipping::where('country_id', '999')->first();
        }
        
        if(!$shippingInfo){
            $shippingInfo = Shipping::where('country_id', '999')->first();
            $ShippingCharge = $totalQty*$shippingInfo->amount;
        }else{
            $ShippingCharge = $totalQty*$shippingInfo->amount;
        }
        
        
        

        
        $grandTotal = floatVal(Cart::subtotal(2,'/','')) + $ShippingCharge;

        return view('front.checkout', [
            'countries' =>  $countries,
            'CustomerAddress' => $CustomerAddress,
            'ShippingCharge' => $ShippingCharge,
            'grandTotal' => $grandTotal
        ]);
    }

    public function processCheckout(Request $request) {
        // step 1
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:4',
            'last_name' => 'required|min:4',
            'email' => 'required|email',
            'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phones' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Please fix the errors',
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
        
        // step 2
        $user = Auth::user(); 
        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phones,
                'address' => $request->address,
                'country_id' => $request->country,
                'apartment' => $request->apartment,
                'state' => $request->state,
                'city' => $request->city,
                'zip' => $request->zip,
            ]
        );

        // step 3

        // if($request->payment_method == 'cod'){
            $couponCodeId = '';
            $couponCode = '';
            $discount = 0;
            $subTotal = Cart::subtotal(2,'.','');
            $CustomerAddress = CustomerAddress::where('user_id',Auth::user()->id)->first();
            $shippingInfo = Shipping::where('country_id', $CustomerAddress->country_id)->first();
            if(!$shippingInfo){
                $shippingInfo = Shipping::where('country_id', '999')->first();
            }
            $totalQty = 0;
            $shipping = 0;
            foreach(Cart::content() as $item){
                $totalQty += $item->qty;
            }

            if(session()->has('code')){
                $code = session()->get('code');
                $couponCode = $code->code;
                if($code->type == 'parcent'){
                    $discount = ($code->discount_amount / 100) * $subTotal;
                }else{
                    $discount = $code->discount_amount;
                }

            }
        
            $shipping = $totalQty*$shippingInfo->amount;
            $grandTotal = ($subTotal - $discount) + $shipping;


            $order = new Order;
            $order->user_id = $user->id;
            $order->subtotal = $subTotal;
            $order->shipping = $shipping;
            $order->grand_total = $grandTotal;
            $order->discount = $discount;
            $order->coupon_code = $couponCode;
            $order->payment_status = 'not_paid';
            $order->order_status = 'pending';
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email = $request->email;
            $order->phone = $request->phones;
            $order->address = $request->address;
            $order->state = $request->state;
            $order->city = $request->city;
            $order->zip = $request->zip;
            $order->admin_notes = $request->notes ? $request->notes : 'No note added';
            $order->apartment = $request->apartment;
            $order->country_id = $request->country;
            $order->save();
            session()->forget('code');
            // step - 4 store order items in items table

            foreach(Cart::content() as $item){
                $orderItem = new OrderItem;
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price * $item->qty;
                $orderItem->save();
                
                //update product stock
                $productData = Product::find($item->id);
                if($productData->track_qty == 'Yes'){
                    $currentQty = $productData->qty;
                    $updatedQty = $currentQty-$item->qty;
                    $productData->qty = $updatedQty;
                    $productData->update();
                }
                
            }

            session()->flash('message', 'Order placed successfully');

            Cart::destroy();

            return response()->json([
                'message' =>  'Order saved Successfully',
                'orderId' => $order->id,
                'status' => true
            ]);

            
        // }else{

        // }
    }

    public function thankYou($id){
        $order = Order::find($id);
        if(!$order){
            session()->flash('error', 'Order was not found');
            return redirect()->route('front.index');
        }
        return view('front.thanks', ['id' => $id]);
    }

    public function getOrderSummery(Request $request){
        $subTotal = Cart::subtotal(2, '.', '');
        $discount = 0;
        $discountString = '';

        if(session()->has('code')){
            $code = session()->get('code');
            if($code->type == 'parcent'){
                $discount = ($code->discount_amount / 100) * $subTotal;
            }else{
                $discount = $code->discount_amount;
            }
            $discountString = '<button type="button" onclick="removeCoupon()" class=" btn p-2">'. Session()->get('code')->code.' <i  class="fa-solid fa-xmark text-[18px]"></button>';
        }

        

        if($request->country > 0){
            
            $totalQty = 0;
            foreach(Cart::content() as $item){
                $totalQty += $item->qty;
            }

            
            $shippingInfo = Shipping::where('country_id', $request->country)->first();
            if($shippingInfo != null){
                
                $shippingCharge = $shippingInfo->amount*$totalQty;
                $grandTotal = ($subTotal - $discount) + $shippingCharge;
                return response()->json([
                    'status' => true,
                    'shippingCharge' => number_format($shippingCharge,2),
                    'grandTotal' =>  number_format($grandTotal,2),
                    'discount' => $discount,
                    'discountString' => $discountString
                ]);
            }else{

                $shippingInfo2 = Shipping::where('country_id', '999')->first();

                $shippingCharge = $shippingInfo2->amount*$totalQty;

                $grandTotal = ($subTotal - $discount) + $shippingCharge;
                return response()->json([
                    'status' => true,
                    'shippingCharge' =>  number_format($shippingCharge,2),
                    'grandTotal' =>  number_format($grandTotal,2),
                    'discount' => $discount,
                    'discountString' => $discountString
                ]);
            }
            
        }else{
            return response()->json([
                'status' => true,
                'shippingCharge' => 0,
                'grandTotal' =>  number_format(Cart::subtotal(2, '.', ''),2),
                'discount' => $discount,
                'discountString' => $discountString
            ]);
        }   
    }

    public function applyDiscount(Request $request){
        $coupon = DiscountCoupon::where('code', $request->code)->first();

        $now = Carbon::now();

        if (!$coupon) {
            return response()->json([
                'status' => false,
                'errors' => 'Coupon not found'
            ]);
        }

        // if ($coupon->starts_at != "") {
        //     $startDate = Carbon::parse($coupon->starts_at);

        //     if ($now->lt($startDate)) {
        //         return response()->json([
        //             'status' => false,
        //             'errors' => 'Coupon code unavailable'
        //         ]);
        //     }
        // }

        // if ($coupon->expires_at != "") {
        //     $endDate = Carbon::parse($coupon->expires_at);
            
        //     if ($now->lt($endDate)) {
        //         return response()->json([
        //             'status' => false,
        //             'errors' => 'Coupon code expired'
        //         ]);
        //     }
        // }

        if($coupon->max_uses > 0){
            $couponUsed = Order::where('coupon_code', $coupon->code)->count();

            if($couponUsed >= $coupon->max_uses){
                return response()->json([
                    'status' => false,
                    'errors' => 'Coupon code limit is over'
                ]);
            }
        }
        if($coupon->max_uses_user > 0){
            $couponUsedUser = Order::where('coupon_code', $coupon->code)->where('user_id', Auth::user()->id )->count();

            if($couponUsedUser >= $coupon->max_uses_user){
                return response()->json([
                    'status' => false,
                    'errors' => 'Coupon code already used'
                ]);
            }
        }
        $subTotal = floatVal(Cart::subtotal(2,'.',''));
        $minAmount = $coupon->min_amount;
        if($minAmount > 0){
            if($minAmount >= $subTotal){
                return response()->json([
                    'status' => false,
                    'errors' => 'You need to spend more than $'.$minAmount.' to use this code'
                ]);
            }
        }

        session()->put('code', $coupon);
        return $this->getOrderSummery($request);

    }

    public function removeDiscount(Request $request){
        session()->forget('code');
        return $this->getOrderSummery($request);
    }
}
