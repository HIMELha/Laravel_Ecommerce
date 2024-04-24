<?php

namespace App\Http\Controllers\admin;

use App\Models\Shipping;
use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{   
    public function index(){
        $shipping = Shipping::paginate(10);
        $data['shipping'] = $shipping;
        $country = Shipping::select('countries.name','shipping_charges.*')->leftJoin('countries', 'countries.id', 'shipping_charges.country_id')->paginate(10);
        $data['country'] = $country;
        return view('admin.shipping.index', $data);
    }
    public function create(){
        $countries = Country::get();
        $data['country'] = $countries;
        return view('admin.shipping.create', $data);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'charge' => 'required'
        ]);

        if($validator->passes()){

            $count = Shipping::where('country_id', $request->country)->count();

            if($count > 0){
                $request->session()->flash('error', 'Shpping already created');
                return response()->json([
                    'status' => 'available',
                ]);
            }

            $shipping = Shipping::updateOrCreate([
                'country_id' => $request->country,
                'amount' => $request->charge
            ]);

            $request->session()->flash('message', 'Shpping created successfully');
            return response()->json([
                    'status' => true,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }


    }

    public function edit($id){
        $shipping = Shipping::find($id);
        if(!$shipping){
            session()->flash('error', 'Shipping not available');
            return redirect()->route('admin.shipping');
        }
        $countries = Country::get();
        $data['shipping'] = $shipping;
        $data['country'] = $countries;

        return view('admin.shipping.edit', $data);
    }

    public function update(Request $request, $id){

        $shipping = Shipping::find($id);

        if(!$shipping){
            session()->flash('error', 'Shipping not available');
            return response()->json([
                'status' => false,
                'error' => 'Shipping not available'
            ]);
        }


        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'charge' => 'required'
        ]);
        if($validator->passes()){

            $shipping->country_id = $request->country;
            $shipping->amount = $request->charge;
            $shipping->update();

            $request->session()->flash('message', 'Shpping updated successfully');
            return response()->json([
                'status' => true,
            ]);
        }else{

            
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id){
        $shipping = Shipping::find($id);   
        if(!$shipping){
            session()->flash('error', 'Shipping not available');
            return response()->json([
                'status' => 'available'
            ]);
        }

        $shipping->delete();
        session()->flash('message', 'Shipping removed succesfully');
        return response()->json([
            'status' => true,
            'message' => 'Shipping removed succesfully'
        ]);
    }
}

