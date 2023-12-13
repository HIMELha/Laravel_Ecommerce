<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\productImage;
use App\Models\TempImage;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use function Laravel\Prompts\error;

class productController extends Controller
{
    public function index(Request $request){

        $product = Product::latest('id')->with('product_images');
        if(!empty($request->get('key'))){
            $key = $request->get('key');
            $product = Product::where('title', 'like', '%'.$key.'%');
        }

        $product = $product->paginate(10);
        
        return view('admin.products.products', ['product' => $product]); 
    }
    public function create(){
        $data = [];
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        return view('admin.products.create', $data);
    }

    public function store(Request $request){

        // dd($request->image_array);
        // exit();

        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products',
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric',
            'description' => 'nullable|max:10000',
            'sku' => 'required|unique:products',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required',
            'is_featured' => 'required|in:Yes,No',
        ];

        if(!empty($request->track_qty) && $request->track_qty  == 'Yes'){
            $rules['qty'] = 'required|numeric';
        }

        $validator = Validator::make($request->all(), $rules);


        if($validator->passes()){

            $product = new Product();
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->brand_id = $request->brand; 
            $product->is_featured = $request->is_featured;
            $product->short_description = $request->short_description;
            $product->shipping_returns = $request->shipping_returns;
            $product->save();

            // save gallery pics
            if(!empty($request->image_array)){
                foreach($request->image_array as $temp_image_id){

                    $tempImageInfo = TempImage::find($temp_image_id);
                    $extArray = explode('.',$tempImageInfo->name);
                    $ext = last($extArray);

                    $productImage = new productImage();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'Null';
                    $productImage->save();

                    $imageName = $product->id . '-' . $productImage->id.'-'.time().'.'.$ext;

                    $productImage->image = $imageName;
                    $productImage->save();

                    // Generate Product Thumbnails
<<<<<<< HEAD
                    $sPath = public_path() . '/temp/' . $tempImageInfo->name;
                    $dPath = public_path() . '/uploads/product/' . $imageName;
=======
                    $sPath = base_path() . '/temp/' . $tempImageInfo->name;
                    $dPath = base_path() . '/uploads/product/' . $imageName;
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9

                    File::copy($sPath, $dPath);
                }
            }

<<<<<<< HEAD
            $request->session()->flash('message', 'Product added succesfully');
=======
            session()->flash('message', 'Product added succesfully');
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9

            return response()->json([
                'status' => true,
                'message' => 'Product added succesfully'
            ]);
            
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id, Request $request){
        $product = Product::find($id);

        if(empty($product)){
<<<<<<< HEAD
            $request->session()->flash('error', 'product not found');
=======
            session()->flash('error', 'product not found');
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
            return redirect()->route('admin.products');
        }
        
        // fetch images
        $productImage = productImage::where('product_id', $product->id)->get();

        $data = [];
        $data['productImage'] = $productImage;
        $data['product'] = $product;
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        return view('admin.products.edit', $data);
    }

    public function update($id, Request $request){

        $product = Product::find($id);

        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products,slug,'.$product->id.',id',
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric',
            'description' => 'nullable|max:10000',
            'sku' => 'required|unique:products,sku,'.$product->id.',id',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required',
            'is_featured' => 'required|in:Yes,No',
        ];

        if(!empty($request->track_qty) && $request->track_qty  == 'Yes'){
            $rules['qty'] = 'required|numeric';
        }

        $validator = Validator::make($request->all(), $rules);


        if($validator->passes()){

            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->brand_id = $request->brand; 
            $product->is_featured = $request->is_featured;
            $product->short_description = $request->short_description;
            $product->shipping_returns = $request->shipping_returns;
            $product->save();


<<<<<<< HEAD
            $request->session()->flash('message', 'Product updated succesfully');
=======
            session()->flash('message', 'Product updated succesfully');
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9

            return response()->json([
                'status' => true,
                'message' => 'Product updated succesfully'
            ]);
            
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id, Request $request){
        $product = Product::find($id);

        if(empty($product)){
<<<<<<< HEAD
            $request->session()->flash('error', 'Product not found');
=======
            session()->flash('error', 'Product not found');
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
            return redirect()->route('admin.products');
        }

        $productImage = productImage::where('product_id', $id)->get();
        if(!empty($productImage)){
            foreach($productImage as $productImage){
<<<<<<< HEAD
                File::delete(public_path('uploads/product/'.$productImage->image));
=======
                File::delete(base_path('uploads/product/'.$productImage->image));
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
            }
        }

        ProductImage::where('product_id', $id)->delete();
        $product->delete();

<<<<<<< HEAD
        $request->session()->flash('message', 'Product Deleted Succesfully');
=======
        session()->flash('message', 'Product Deleted Succesfully');
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9

        return response()->json([
            'status' => true,
            'error' => 'Product Deleted succesfully'
        ]);
    }
}
