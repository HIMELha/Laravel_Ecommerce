<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index(){
        $data = [];
        $slides = Product::where('is_featured', 'Yes')->whereNot('compare_price' , null)->limit(5)->get();
        $featured_product = Product::where('status', 1)->where('is_featured', 'Yes')->limit(12)->get();
        $recomended_product = Product::where('status', 1)->where('is_featured', 'No')->orderBy('title', 'ASC')->limit(12)->get();
        $data['featured_product'] = $featured_product;
        $data['slides'] = $slides;
        $data['recomended_product'] = $recomended_product;
        return view('front.index', $data );
    }


    public function wishlist(){
        $wishlist = Wishlist::where('user_id', Auth::user()->id)
                    ->latest()->get();

        return view('front.account.wishlist', ['wishlist' => $wishlist]);
    }

    public function addToWishlist(Request $request){
        $user = Auth::user();

        if(!$user){
            session(['url.intended' => url()->previous()]);
            
            return response()->json([
                'status' => false,
                'message' => 'Please login first'
            ]);
        }

        $product = Product::where('id', $request->id)->first();

        $wishlists = Wishlist::where(['product_id' => $request->id, 'user_id' => $user->id])->first();

        if($wishlists){
            session()->flash('error', 'Product already in wishlist');
            return response()->json([
                'status' => 'exists',
                'message' => 'Product already in wishlist'
            ]);
        }
        
        if(!$product){
            session()->flash('error', 'Product not found');
            return response()->json([
                'status' => 'notFound',
            ]);
        }

        $wishlist = new Wishlist;
        $wishlist->user_id = $user->id;
        $wishlist->product_id = $product->id;
        $wishlist->save();
        session()->forget('url.intended');
        session()->flash('message', 'Product added to wishlists');
        return response()->json([
            'status' => true,
            'message' => 'Product added to wishlists'
        ]);

    }

    public function deleteWishlist(Request $request){
        $user = Auth::user();
        $wishlist = Wishlist::where('user_id', $user->id)->where('product_id', $request->id)->first();

        if(!$wishlist){
            session()->flash('error','Wishlist already removed');
            return response()->json([
                'status' => false
            ]);
        }

        $wishlist->delete();
        session()->flash('message','Wishlist deleted successfully');
        return response()->json([
            'status' => true
        ]);
    }

    public function categories(){
        $categories = Category::latest()->paginate(12);
        return view('front.categories', ['categories' => $categories]);
    }

    
}
