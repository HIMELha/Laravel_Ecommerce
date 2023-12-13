<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;

class SlidesController extends Controller
{
    public function index(){
        $slides = Slide::latest()->paginate(12);
        return view('admin.slides.index', ['slides' => $slides]);
    }

    public function create(){
        
    }
}
