<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Wishlist;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

function getCategories(){
    return Category::orderBy('name', 'ASC')->where('status', '1')->paginate(8);
}

function TrendCategories(){
    return Category::orderBy('name', 'ASC')->limit('12')->where('status', '1')->where('showHome', 'Yes')->get();
}

function productCategory($categoryId){
    return Category::where('id', $categoryId)->first();
}

function productBrand($brandId){
    return Brand::where('id', $brandId)->first();
}

function wishlistCount(){
    if(!Auth::check()){
        return 0;
    }
    return Wishlist::where('user_id', Auth::user()->id)->count();
}

function reviewAverage($id){
    $reviews = Review::where('product_id', $id)->get();
    $ratings = 0;
    foreach ($reviews as $review) {
        $ratings += $review->ratings;
    }
    $totalReviews = $reviews->count();
    if ($totalReviews > 0) {
        $averageRating = $ratings / $totalReviews;
    } else {
        $averageRating = 0;
    }
    $avgReview = number_format($averageRating,0);

    $star = '';
    for ($i = 1; $i <= 5; $i++){
        $star .= '<i class="fa-solid fa-star';
        if($i <= $avgReview){
            $star .= ' text-gold';
        }
        $star .= '"></i>';
    }

    return $star;

}