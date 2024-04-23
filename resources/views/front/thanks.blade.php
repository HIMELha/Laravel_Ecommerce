@extends('front.layouts.app')

@section('contents')

  @include('front.layouts.categories')


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
          
          {{-- <a href="{{ route('bkash-create-payment') }}"><button class="btn mt-2">Checkout With Bkash</button></a> --}}

          <a href="{{ route('user.orders') }}"><button class="btn-hover p-3 mt-2">Order history</button></a>
          
        </div>
        <br>
        <a href="{{ route('front.product') }}"><button class="headBtn mt-2">Continue shopping</button></a>
        </div>
    </main>
    <!-- main end -->

@endsection


@section('customJS')


@endsection