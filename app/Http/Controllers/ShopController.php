<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $brandSlug = null){
        $data = [];
        $categories  = Category::where('status', 1)->orderBy('name', 'ASC')->get();
        $brands  = Brand::where('status', 1)->orderBy('name', 'ASC')->get();
        $products = Product::where('status', 1);
        
        // Apply products filter 
        $min = 0;
        $max = 1000;
        $categorySelected  = ''; 
        $brandSelected  = ''; 
        $brandArray = [];
        if(!empty($request->get('brand'))){
            $brandArray = explode(',',$request->get('brand'));
            $products = Product::whereIn('brand_id', $brandArray);
        }

        if(!empty($categorySlug)){
            $category = Category::where('slug', $categorySlug)->first();
            if(empty($category)){
                $request->session()->flash('error', 'Category Not Found');
                return redirect()->route('front.product');
            }
            $products = $products->where('category_id', $category->id);
            $categorySelected = $category->id; 
        }

        if(!empty($request->get('search'))){
            $search = $request->get('search');
            $products = $products->where('title', 'like', '%' . $search . '%')
                        ->Orwhere('description', 'like', '%' . $search . '%')
                        ->Orwhere('short_description', 'like', '%' . $search . '%');
        }

        if(!empty($brandSlug)){
            $brand = Brand::where('slug', $brandSlug)->first();
            if(empty($brand)){
                $request->session()->flash('error', 'brand Not Found');
                return redirect()->route('front.product');
            }
            $products = $products->where('brand_id', $brand->id);
            $brandSelected  =$brand->id; 
        }


        if($request->get('price_min') != '' && $request->get('price_max') != '' ){
            $min = intval($request->get('price_min'));
            $max = intval($request->get('price_max'));

            $products = Product::whereBetween('price', [$min, $max]);
        }

        if($request->get('sort') != ''){
            if($request->get('sort') == 'latest'){
                $products = $products->orderBy('id', 'DESC');
            }else if($request->get('sort') == 'price_asc'){
               $products = $products->orderBy('price', 'ASC'); 
            }else if($request->get('sort') == 'price_desc'){
               $products = $products->orderBy('price', 'DESC'); 
            }else if($request->get('sort') == 'oldest'){
               $products = $products->orderBy('id', 'ASC'); 
            }else{ 
                $request->session()->flash('error', 'OMG, You hacked my website😰'); 
                return redirect()->route('front.product');
            }
        }else{
            $products = $products->orderBy('id', 'DESC');
        }
        $products = $products->paginate(12);
        $data['categorySelected'] = $categorySelected;
        $data['brandSelected'] = $brandSelected;
        $data['price_min'] = $min;
        $data['price_max'] = $max;
        $data['sort'] = $request->get('sort');
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['brandArray'] = $brandArray;
        $data['products'] = $products;
        
        return view('front.products', $data);
    }

    public function productView($slug){
        $product = Product::where('slug', $slug)->first();
        
        if($product === null){
            abort(404);
        }
        $reviews = Review::where('product_id', $product->id)->latest()->paginate(10);
 
        $related_product = product::whereNot('slug',$slug )->where('category_id', $product->category_id)->orderBy('id', 'ASC')->limit(6)->get();
        $relatedalt_product = product::whereNot('slug', $slug)->inRandomOrder()->limit(8)->get();
        
        $data['related_product'] = $related_product;
        $data['relatedalt_product'] = $relatedalt_product;
        $data['product'] = $product;
        $data['reviews'] = $reviews;
        return view('front.items',$data);
    }

    public function storeReview(Request $request){

        $validator = Validator::make($request->all(), [
            'stars' => 'required|integer|in:1, 2, 3, 4, 5',
            'review' => 'required|min:10'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $product = Product::find($request->product_id);
        if(!$product){
            session()->flash('error', 'Product not found');
            return response()->json([
                'status' => true
            ]);
        }

        $review = new Review;
        $review->user_id = Auth::user()->id;
        $review->product_id = $product->id;
        $review->review = $request->review;
        $review->ratings = $request->stars;
        $review->save();
        session()->flash('message', 'Review submitted successfully');
        return response()->json([
            'status' => true
        ]);
    }




}
