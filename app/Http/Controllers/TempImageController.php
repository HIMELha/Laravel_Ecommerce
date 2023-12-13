<?php

namespace App\Http\Controllers;

use App\Models\TempImage;
use Illuminate\Http\Request;
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

            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'imagePath' => asset('temp/' . $newName), // Generate the URL using 'asset'
                'message' => 'Image uploaded successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'No image provided',
        ]);
    }
}
