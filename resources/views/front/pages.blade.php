@extends('front.layouts.app')

@section('contents')
        <div class="max-w-[1200px] px-2 flex  justify-between gap-4 mx-auto ">
        <div id="catNav" class="w-[240px] pt-2 bg-light shadow-md   top-0 bottom-0 left-0  z-50 hidden">
          <ul>
            <li class="text-right m-2">
                <buttton id="catclose" class="btn !w-full  cursor-pointer "><i class="fa-solid fa-close"></i></buttton>
            </li>
            @if(getCategories()->isNotEmpty())
            @foreach (getCategories() as $category)
              <li>
              <a href="#">
                <span class="category"><i class="fa-solid fa-{{$category->name}} text-red"></i>{{$category->name}}</span>
              </a>
            </li>
            @endforeach
            @endif
            <li>
              <a href="#"><span class="category border-none"><i class="fa-solid fa-dice-d6 text-red"></i>Find more</span></a>
            </li>
          </ul>
        </div>
        </div>


    <!-- main start -->
    <main class="max-w-[1200px] px-2 flex flex-col mx-auto ">
        <div class="flex items-center gap-2 my-4">
            <a href="{{ route('front.index')}}"><i class="fa-solid fa-house text-red"></i></a> 
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="{{ route('pages.details', $page->name ) }}" class="text-hover">{{ $page->name }}</a> 
        </div>
        
        <div class="flex flex-col items-start gap-4 mt-6">
            <h2 class="headerText">{{ $page->name }}</h2>
            {!! $page->description !!}
        </div>
    </main>
    <!-- main end -->

@endsection


@section('customJS')


@endsection