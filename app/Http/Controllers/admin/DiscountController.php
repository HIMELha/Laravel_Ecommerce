<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCoupon;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
<<<<<<< HEAD
    public function index(){
        $discount = DiscountCoupon::orderBy("created_at","asc")->paginate(10);
=======
    public function index(Request $request){
        $discount = DiscountCoupon::orderBy("created_at","asc");
        if(!empty($request->get('key'))){
            $key = $request->get('key');
            $discount = DiscountCoupon::where('name', 'like', '%'.$key.'%');
        }
        $discount = $discount->paginate(12);
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
        return view('admin.coupons.index', ['brand' => $discount]);
    }

    public function create(){
        return view('admin.coupons.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required'
        ]);

        if($validator->passes()){

            $discountCode = new DiscountCoupon();

            // starting date must be greater than current date
            if(!empty($request->starts_at)){
                $now = Carbon::now();
                
                $startAt = Carbon::parse($request->starts_at);
                
                if($startAt->lte($now) == true){
                    return response()->json([
                        'status' => false,
                        'errors' => ['starts_at' => 'Start date can not be less than current time']
                    ]);
                }else{
                    $discountCode->starts_at = $startAt;
                }
                
            }
            // expiry date must be greaor than start date
            if(!empty($request->expires_at) && !empty($request->starts_at) ){

                $startAt = Carbon::parse($request->starts_at);
                $endAt = Carbon::parse($request->expires_at);

                if($endAt->gt($startAt) == false){
                    return response()->json([
                        'status' => false,
                        'errors' => ['expires_at' => 'Expiry date can not be less than or equal to Start date']
                    ]);
                }else{
                    $discountCode->expires_at = $request->expires_at;
                }

            }

            $discountCode->code = $request->code;
            $discountCode->name = $request->name;
            $discountCode->description = $request->description;
            $discountCode->max_uses = $request->max_uses;
            $discountCode->max_uses_user = $request->max_uses_user;
            $discountCode->type = $request->type;
            $discountCode->discount_amount = $request->discount_amount;
            $discountCode->min_amount = $request->min_amount;
            
            $discountCode->status = $request->status;
            $discountCode->save();

            session()->flash('message', 'Discount added successfully');
            return response()->json([
                'status' => true,
                'message' => "Discount coupon added successfully"
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit(Request $request,$id){
        $coupon = DiscountCoupon::find($id);

        if(!$coupon){
            session()->flash('error', 'Coupon not available');
            return redirect()->route('admin.coupons');
        }
        $data['coupon'] = $coupon;
        return view('admin.coupons.edit', $data);
    }

    public function update(Request $request, $id){
        $discountCode =  DiscountCoupon::find($id);

        if(!$discountCode){
            session()->flash('error', 'Coupon not available');
            return response()->json([
                'status' => true
            ]);
        }
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'name' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required'
        ]);

        if($validator->passes()){

            // expiry date must be greaor than start date
            if(!empty($request->expires_at) && !empty($request->starts_at) ){
                
                $startAt = Carbon::parse($request->starts_at);
                $endAt = Carbon::parse($request->expires_at);

                if($endAt->gt($startAt) == false){
                    return response()->json([
                        'status' => false,
                        'errors' => ['expires_at' => 'Expiry date can not be less than or equal to Start date']
                    ]);
                }

                $discountCode->starts_at = $startAt;
                $discountCode->expires_at = $request->expires_at;

            }

            $discountCode->code = $request->code;
            $discountCode->name = $request->name;
            $discountCode->description = $request->description;
            $discountCode->max_uses = $request->max_uses;
            $discountCode->max_uses_user = $request->max_uses_user;
            $discountCode->type = $request->type;
            $discountCode->discount_amount = $request->discount_amount;
            $discountCode->min_amount = $request->min_amount;
            $discountCode->status = $request->status;
            $discountCode->save();

            session()->flash('message', 'Discount added successfully');
            return response()->json([
                'status' => true,
                'message' => "Discount coupon added successfully"
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy(Request $request,$id){
        $coupon = DiscountCoupon::find($id);
        if(!$coupon){
            session()->flash('error', 'Coupon not available');
            return response()->json([
                'status' => false
            ]);
        }
        $coupon->destroy($id);
        session()->flash('message', 'Coupon removed successfully');
        return response()->json([
            'status' => true
        ]);

    }

    
}
