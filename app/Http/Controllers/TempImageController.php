<?php

namespace App\Http\Controllers;

use App\Models\TempImage;
use Illuminate\Http\Request;


class TempImageController extends Controller
{
    public function create(Request $request){
        $image = $request->image;

        if(!empty($image)){
            $ext = $image->getClientOriginalExtension();
            $newName = time() . '.' . $ext;
            $tempImage = new TempImage();

            $tempImage->name = $newName;
            $tempImage->save();

            $image->move(public_path().'/temp', $newName);

            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'imagePath' => asset('temp/'.$newName.''),
                'message' => 'Image uploaded succesfully'
            ]);
        }
    }
}
