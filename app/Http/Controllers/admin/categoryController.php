<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
<<<<<<< HEAD
use Illuminate\support\facades\File;
=======
use Illuminate\Support\Facades\File;
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9


class categoryController extends Controller
{
    public function index(Request $request)
    {
         $category = Category::latest();

        if(!empty($request->get('key'))){
            $key = $request->get('key');
            $category = Category::where('name', 'like', '%'.$key.'%');
        }
       
        $category = $category->paginate(10);

        return view('admin.categories', ['category' => $category]);
    }

    public function create()
    {
        return view('admin.categories-create');
    }

    public function store(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:25',
            'slug' => 'required|unique:categories',
        ]);


        if($validate->passes()){

            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->added = $admin->name;
            $category->save();

            if(!empty($request->image_id)){

                $tempImage = TempImage::find($request->image_id);

                $extArray = explode('.', $tempImage->name);

                $ext = last($extArray);

                $newImageName = $category->id.'.'.$ext;

<<<<<<< HEAD
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/category/'.$newImageName;
=======
                $sPath = base_path().'/temp/'.$tempImage->name;
                $dPath = base_path().'/uploads/category/'.$newImageName;
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
                File::copy($sPath, $dPath);

                $category->image = $newImageName;
                $category->save();
            }

            
            return response()->json([
                'status' => true,
                'message' => 'category added succesfully'
            ]);

        } else {
            return response()->json([
                'status' =>  false,
                'errors' => $validate->errors()
            ]);
        }
    }

    public function edit($id, Request $request)
    {
        $data = Category::find($id);
        if(empty($data)){
<<<<<<< HEAD
            $request->session()->flash('error', 'category not found');
=======
            session()->flash('error', 'category not found');
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
            return redirect()->route('admin.categories');
        }
        return view('admin.categories-edit', ['data' => $data]);
    }

    public function update($id, Request $request)
     {

        $category = Category::find($id);

        if(empty($category)){
<<<<<<< HEAD
            $request->session()->flash('error', 'category not found');
=======
            session()->flash('error', 'category not found');
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'category not found'
            ]);
        }

        $admin = Auth::guard('admin')->user();

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$category->id.',id',
        ]);


        if($validate->passes()){

            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->added = $admin->name;
            $category->save();

            $oldImage = $category->image;

            if(!empty($request->image_id)){

                $tempImage = TempImage::find($request->image_id);

                $extArray = explode('.', $tempImage->name);

                $ext = last($extArray);

                $newImageName = $category->id.'-'.time().'.'.$ext;

<<<<<<< HEAD
                $sPath = public_path().'/temp/'.$tempImage->name;
                $dPath = public_path().'/uploads/category/'.$newImageName;
=======
                $sPath = base_path().'/temp/'.$tempImage->name;
                $dPath = base_path().'/uploads/category/'.$newImageName;
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
                File::copy($sPath, $dPath);

                $category->image = $newImageName;
                $category->save();

<<<<<<< HEAD
                File::delete(public_path('uploads/category/' . $oldImage));

            }

            $request->session()->flash('message', 'category updated succesfully');
=======
                File::delete(base_path('uploads/category/' . $oldImage));

            }

            session()->flash('message', 'category updated succesfully');
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9

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

    public function destroy($id, Request $request){
        $category = Category::find($id);

        if(empty($category)){
            return redirect()->route('admin.categories');
        }

<<<<<<< HEAD
        File::delete(public_path('uploads/category/' . $category->image));

        $category->delete();

        $request->session()->flash('message', 'category Deleted succesfully');
=======
        File::delete(base_path('uploads/category/' . $category->image));

        $category->delete();

        session()->flash('message', 'category Deleted succesfully');
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
        
        return response()->json([
            'status' => true,
            'message' => 'category deleted succesfully'
        ]);
    }
}