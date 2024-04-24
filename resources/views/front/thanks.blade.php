@extends('front.layouts.app')

@section('contents')
<<<<<<< HEAD
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
=======

  @include('front.layouts.categories')
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9


    <!-- main start -->
    <main class="max-w-[1200px] px-2 flex flex-col mx-auto ">
        <div class="flex items-center gap-2 my-4">
            <a href=""><i class="fa-solid fa-house text-red"></i></a> 
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="" class="link">Thanks</a> 
        </div>
        
        <div class=" flex flex-col justify-center items-center mt-6">
         <img src="https://static-00.iconduck.com/assets.00/success-icon-512x512-qdg1isa0.png" alt="" class="w-[100px] m-2" >
        <h1 class="bigNunito" style="margin-top:20px">Thanks for your order</h1>
        <span class="text-blu text-[17px]">Order id: {{ $id }}</span>
        <p class="text-[18px] m-2 ">You're product on the way </p>
        <div class="flex justify-between items-center gap-4">
<<<<<<< HEAD
          <a href="{{ route('front.product') }}"><button class="btn mt-2">Continue shopping</button></a>
          <a href="{{ route('user.orders') }}"><button class="btn-hover p-3 mt-2">Order history</button></a>
        </div>
=======
          
          {{-- <a href="{{ route('bkash-create-payment') }}"><button class="btn mt-2">Checkout With Bkash</button></a> --}}

          <a href="{{ route('user.orders') }}"><button class="btn-hover p-3 mt-2">Order history</button></a>
          
        </div>
        <br>
        <a href="{{ route('front.product') }}"><button class="headBtn mt-2">Continue shopping</button></a>
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
        </div>
    </main>
    <!-- main end -->

@endsection


@section('customJS')


@endsection