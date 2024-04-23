<?php

namespace App\Http\Controllers;

use App\Models\TempImage;
use Illuminate\Http\Request;
<<<<<<< HEAD


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
=======
use Illuminate\Support\Facades\File; // Import the File facade

class TempImageController extends Controller
{
    public function create(Request $request)
    {
        $image = $request->file('image'); // Use $request->file('image') to get the uploaded file

        if ($image) {
            $ext = $image->getClientOriginalExtension();
            $newName = time() . '.' . $ext;

            // Create the TempImage record in the database
            $tempImage = new TempImage();
            $tempImage->name = $newName;
            $tempImage->save();

            $tempDirectory = base_path().'/temp'; // Specify the path relative to the project root
            File::makeDirectory($tempDirectory, 0755, true, true); // Ensure the 'temp' directory exists

            // Move the uploaded image to the 'temp' directory in the root folder
            $image->move($tempDirectory, $newName);
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9

            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
<<<<<<< HEAD
                'imagePath' => asset('temp/'.$newName.''),
                'message' => 'Image uploaded succesfully'
            ]);
        }
=======
                'imagePath' => asset('temp/' . $newName), // Generate the URL using 'asset'
                'message' => 'Image uploaded successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'No image provided',
        ]);
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
    }
}
