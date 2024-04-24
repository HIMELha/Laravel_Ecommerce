<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\productImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    public function update(Request $request){
        
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $tempImageLocation = $image->getPathName();
        

        $productImage = new productImage();
        $productImage->product_id = $request->product_id;
        $productImage->image = 'Null';
        $productImage->save();

        $imageName = $request->product_id . '-' . $productImage->id.'-'.time().'.'.$ext;
        $productImage->image = $imageName;
        $productImage->save();
<<<<<<< HEAD
        $image->move(public_path('uploads/product'), $imageName);   
=======
        $image->move(base_path('uploads/product'), $imageName);   
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9


        return response()->json([
            'status' => true,
            'image_id' => $productImage->id,
            'imagePath' => asset('uploads/product/'.$productImage->image),
            'message' => 'Image saved successfully'
        ]);
    }

    public function destroy(Request $request){
        $productImage = productImage::find($request->id);

        if(empty($productImage)){

            return response()->json([
                'status' => false,
                'message' => 'Image not Found'
            ]);

        }

        // delete images from folder
<<<<<<< HEAD
        File::delete(public_path('uploads/product/'.$productImage->image));
=======
        File::delete(base_path('uploads/product/'.$productImage->image));
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9

        $productImage->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image Deleted successfully'
        ]);

    }
}
