<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class brandController extends Controller
{
    public function index(Request $request){
        $brand = Brand::latest('id');

        if(!empty($request->get('key'))){
            $key = $request->get('key');
            $brand = $brand->where('name', 'like', '%'.$key.'%');
        }
       
        $brand = $brand->paginate(10);
        return view('admin.brands.brands' , ['brand' => $brand]);
    }

    public function create(){
        return view('admin.brands.create');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:brands'
        ]);

        if($validator->passes()){
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            $request->session()->flash('message', 'brand added succesfully');

            return response()->json([
                'status' => true,
                'message' => "Brands successfully saved"
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id, Request $request){

        $data = Brand::find($id);

        if(empty($data)){
            $request->session()->flash('error', 'Brand doesnot exist');
            return redirect()->route('admin.brands');
        }

        return view('admin.brands.edit', ['data' => $data]);
    }

    public function update($id, Request $request)
     {

        $brands = Brand::findOrFail($id);

        if(empty($brands)){
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'brands not found'
            ]);
        }

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$brands->id.',id',
        ]);


        if($validate->passes()){

            $brands->name = $request->name;
            $brands->slug = $request->slug;
            $brands->status = $request->status;
            $brands->save();

            $request->session()->flash('message', 'category updated succesfully');

            return response()->json([
                'status' => true,
                'message' => 'category updated succesfully'
            ]);

        } else {

            return response()->json([
                'status' =>  false,
                'errors' => $validate->errors()
            ]);
        }
    }

    // public function update($id , Request $request){

    //     $brand = Brand::find($id);

    //     if(empty($brand)){
    //         $request->session()->flash('error', 'Brand doesnot exist');
    //         return response()->json([
    //             'status' => false,
    //             'error' =>  'Brand not found'
    //         ]);
    //     }

    //     $data = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'slug' => 'required | unique:brands,slug, '.$brand->slug.',id'
    //     ]);

    //     if($data->passes()){

    //         $brand->name = $request->name;
    //         $brand->slug = $request->slug;
    //         $brand->status = $request->status;
    //         $brand->save();


    //         $request->session()->flash('message', 'brand updated succesfully');

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Brands updated successfull'
    //         ]);


    //     } else{
    //         return response()->json([
    //             'status' =>  false,
    //             'errors' => $validate->errors()
    //         ]);
    //     }
    // }


        public function destroy($id, Request $request){
        $Brand = Brand::findOrFail($id);

        if(empty($Brand)){
            return redirect()->route('admin.categories');
        }

        $Brand->delete();

        $request->session()->flash('message', 'category Deleted succesfully');
        
        return response()->json([
            'status' => true,
            'message' => 'category deleted succesfully'
        ]);
    }

}
