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

        <!-- categories starts -->
        <div class="mt-12 px-2 py-4">
          <h2 class="headerText">Product categories</h2>
          <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5  gap-4 mt-6">

            @if($categories->isNotEmpty())
                @foreach ($categories as $category)
                     <div class="py-5 w-full flex flex-col justify-center items-center gap-3 shadow-md rounded-md border">
                        <div class="w-[100px] h-[100px] py-2 flex justify-center items-center rounded-full bg-slate-100">
                            <a href=""><img src="{{ asset('uploads/category/').'/'.$category->image }}" alt="" class="h-[50px]"></a>
                        </div>
                        <a href="{{ route('front.products', $category->slug) }}" class="text-xl font-medium hover:text-hover">{{ ucfirst($category->name) }}</a>
                    </div>
                @endforeach
            @endif
            
          </div>

          {{ $categories->links() }}
        </div>
        <!-- categories ends -->


        <!-- sub categories starts -->
        <div class="mt-12 px-2 py-4">
          <h2 class="headerText">sub categories</h2>
          
                <h2 class="bigNunito mt-3">Sub categories currently aren't available 😥</h2>
        </div>
        <!-- sub categories ends -->
    </main>
    
    <!-- main end -->

@endsection


@section('customJS')


@endsection