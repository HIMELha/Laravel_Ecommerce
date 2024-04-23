@extends('front.layouts.app')

@section('contents')

    <div class="max-w-[1200px] px-2 flex  justify-between gap-4 mx-auto">
        <div id="catNav" class="w-[240px] pt-2 bg-light shadow-md  top-0 bottom-0 left-0  z-50 hidden">
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
            <a href=""><i class="fa-solid fa-house text-red"></i></a> 
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="" class="text-[15px] text-red">My Account</a> 
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="" class="link">Wishlist</a> 
        </div>
        
        
        <div class="grid grid-cols-1  lg:grid-cols-4 items-start gap-4 mt-6 relative">
        
          <div class="flex items-center justify-between gap-4 px-4 py-3 shadow-md rounded-sm border border-light lg:hidden">
              <div class="flex items-center gap-4">
                  <div class=" w-[80px] h-[80px] flex justify-center items-center border border-lightest rounded-full">
                      <img src="{{ asset('front-assets/dist/images/1683873836923.png') }}" alt="" class="max-w-[60px]">
                  </div>
                  <h2 class="bigNunito">{{ Auth::user()->name }}</h2>
              </div>
              <button id="Profilebtn" class="btn-hover"><i class="fa-solid fa-bars"></i></button>
          </div>

        @include('front.layouts.profile-navbar')


          <div class="grid  sm:col-span-1 lg:col-span-3 gap-6 rounded-md">

            @if ($wishlist->isNotEmpty())
                @foreach ($wishlist as $w)
                <div class="flex flex-col md:flex-row justify-between items-center px-6 py-6 gap-6 shadow-md">
                  <div class="flex flex-col md:flex-row items-center  gap-4">
                        @php 
                            $productImage = $w->product->product_images->first();
                        @endphp

                        @if (!empty($productImage->image))
                            <img src="{{ asset('uploads/product/'.$productImage->image.'') }}" alt="" srcset=""  class="max-w-[70px]">
                        @else
                            <img src="https://dummyimage.com/250/ffffff/000000" alt="" srcset=""  class="max-w-[70px]">
                        @endif
                      
                      <div>
                          <a href="{{ route('front.items', $w->product->slug) }}" class="text-min font-medium ">
                            @php
                                $title = $w->product->title;
                                if(strlen($title) > 40){
                                    $title = substr($w->product->title, 0, 40).'...';
                                }
                            @endphp
                            {{ $title }}</a>
                          <p class="text !text-[17px]">Availability: 
                            @if ($w->product->qty == 0)
                                <span class="text-red font-medium">Out Of Stock</span></p>
                            @else
                                <span class="text-blue font-medium">In Stock</span></p>
                            @endif
                             
                      </div>
                  </div>


                  <div class="flex items-center gap-2 md:gap-4">
                      <p class="text-xl text-red font-bold">${{ number_format($w->product->price,2) }}</p>
                      <div>
                        <button class="btn" onclick="addToCart({{ $w->product->id }})"><i class="fa-solid fa-shopping-cart"></i> Add to Cart</button>
                      </div>
                      <div>
                          <button onclick="deleteWishlist({{ $w->product->id }})"  class="btn"><i class="fa-solid fa-trash-can"></i></button></a>
                      </div>
                  </div>

                </div>
                @endforeach
            @else
                <div class="flex flex-col md:flex-row justify-center items-center px-6 py-6 gap-6 shadow-md border">
                    <h2 class="bigNunito">Your wishlist is empty</h2>
                </div>
            @endif
              
          </div>

        </div>
    </main>
    <!-- main end -->

@endsection


@section('customJS')
    <script>
        Profilebtn = document.querySelector('#Profilebtn');
        Profilenav = document.querySelector('#Profilenav');
        
        // show hide profilenav
        Profilebtn.addEventListener('click', () => {
            Profilenav.classList.toggle('hidden');
        });

        function deleteWishlist(id){
            $.ajax({
                url: '{{ route('user.deleteWishlist') }}',
                type: 'post',
                data: {id:id},
                datatype: 'json',
                success: function(response){
                    if(response.status == true){
                    window.location.reload();
                    }
                }
            });
        }
    </script>
@endsection