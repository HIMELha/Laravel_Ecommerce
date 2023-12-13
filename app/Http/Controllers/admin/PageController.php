<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index(Page $page, Request $request){
        if(!empty($request->get('key'))){
            $key = $request->get('key');
            $page = Page::where('name', 'like', '%'.$key.'%')
                    ->orWhere('description', 'like', '%'.$key.'%');
        }
        $page = $page->paginate(12);
        return view('admin.pages.index', ['pages' => $page]);
    }

    public function create(){
        return view('admin.pages.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),([
            'name' => 'required|unique:pages',
            'description' => 'required|min:20'
        ]));

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $page = new Page;
        $page->name = $request->name;
        $page->description = $request->description;
        $page->save();

        session()->flash('message', 'Page created successfully');
        return response()->json([
            'status' => true,
        ]);
    }

    public function edit($id){
        $page = Page::find($id);
        if(!$page){
            session()->flash('error', 'Page not found');
            return redirect()->route('admin.pages');
        }
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id){
        $page = Page::find($id);
        if(!$page){
            session()->flash('error', 'Page already deleted');
            return response()->json([
                'status' => 'notFound'
            ]);
        }

        $validator = Validator::make($request->all(),([
            'name' => 'required|unique:pages,name,'.$page->id.',id',
            'description' => 'required|min:20'
        ]));

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $page->name = $request->name;
        $page->description = $request->description;
        $page->update();

        session()->flash('message', 'Page updated successfully');
        return response()->json([
            'status' => true
        ]);
    }

    public function destroy($id){
        $page = Page::find($id);
        if(!$page){
            session()->flash('error', 'Page already deleted');
            return response()->json([
                'status' => 'notFound'
            ]);
        }
        $page->destroy($page->id);
        session()->flash('message', 'Page deleted successfully');
        return response()->json([
            'status' => true
        ]);
    }
}

