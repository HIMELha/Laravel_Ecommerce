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
            <a href="" class="link">Orders History</a> 
        </div>
        
        <div class="grid grid-cols-1  lg:grid-cols-4 items-start gap-4 mt-6 relative">
          
          <div class="flex items-center justify-between gap-4 px-4 py-3 shadow-md rounded-sm border border-light lg:hidden">
                      <div class="flex items-center gap-4">
                        <div class=" w-[80px] h-[80px] flex justify-center items-center border border-lightest rounded-full">
                            <img src="images/1683873836923.png" alt="" class="max-w-[60px]">
                        </div>
                        <h2 class="bigNunito">Alexander ||</h2>
                      </div>
                      <button id="Profilebtn" class="btn-hover"><i class="fa-solid fa-bars"></i></button>
          </div>

            @include('front.layouts.profile-navbar')

          <div class="grid  sm:col-span-1 lg:col-span-3 gap-6 rounded-md">
            <h2 class="bigNunito">Order details</h2>

            <div class="flex justify-between items-center px-4 py-4 shadow-md border">

                <div class="flex flex-col gap-4">
                    
                    <div>
                        <h2 class="text-min font-medium">Order Number :{{ $order->id }}</h2>
                        <div>
                        @if ($order->order_status == 'pending')
                            <p class="text-alert text-[17px] font-mono"><i class="fa-solid fa-circle"></i> Pending</p>
                        @elseif ($order->order_status == 'delivered')
                            <p class="text-blue text-[17px] font-mono"><i class="fa-solid fa-circle"></i> Delivered</p>
                        @elseif ($order->order_status == 'shiped')
                            <p class="text-green text-[17px] font-mono"><i class="fa-solid fa-circle"></i> Shipped</p>
                        @else
                            <p class="text-red text-[17px] font-mono"><i class="fa-solid fa-circle"></i> Cancelled</p>
                        @endif
                    </div>
                    </div>

                    
                </div>

                <div class="flex flex-col md:flex-row gap-2 md:gap-6">
                    <div>
                        <h2 class="text-min font-medium">Placed order on</h2>
                        <p class="text !text-[17px] uppercase">{{ date_format($order->created_at, 'd M, Y') }}</p>
                    </div>
                    <div>
                        <h2 class="text-min font-medium">Quantity</h2>
                        <p class="text !text-[17px] uppercase">             
                                    @php 
                                    $items = App\Models\OrderItem::where('order_id', $order->id)->count();
                                    @endphp
                                     {{ $items }}</p>
                    </div>
                    <div>
                        <h2 class="text-min font-medium">Total</h2>
                        <p class="text !text-[17px] uppercase">${{ number_format($order->grand_total,2) }}</p>
                    </div>
                </div>

                <div class="flex gap-2">
                    <div>
                        <h2 class="text-min font-medium">Discount</h2>
                        
                        <p class="text-red text-[17px] font-mono">${{ $order->discount }}</p>
                    </div>

                    <div>
                        <h2 class="text-min font-medium">Shipping charge</h2>
                        
                        <p class="text-green text-[17px] font-mono">${{ $order->shipping }}</p>
                    </div>

                </div>

            </div>

            @if ($order->admin_notes != '')
            <div class="flex flex-col border p-4">
                <h2 class="bigNunito">Order Feedback   <span>    <i class="fa-regular fa-clock"></i> {{ date_format($order->updated_at, 'd M, Y H:i A') }}</i></span></h2>
                <p>{{ $order->admin_notes }}</p>
            </div>
            @endif
  
            <h2 class="bigNunito p-2">Ordered Products</h2>

            <div class="flex flex-wrap justify-start items-end">
                @foreach ($products as $product)
                    <div class="w-full mt-3  sm:w-1/2   lg:w-1/3 p-4 flex-col items-center gap-2 border rounded-md relative group">
                        <div class="w-full h-[220px] flex justify-center items-center bg-[#F3F3F3] relative group-hover:bg-[rgba(0,0,0,0.2)] group-hover:z-10">
                            
                            @php 
                                $productImage = $product->product_images->first();
                            @endphp

                            @if (!empty($productImage->image))
                                <img src="{{ asset('uploads/product/'.$productImage->image.'') }}" alt="" srcset="" class=" max-h-[200px] sm:max-h-[145px] ">
                            @else
                                <img src="https://dummyimage.com/250/ffffff/000000" alt="" srcset="" class="max-h-[145px]">
                            @endif

                            
                            <div class="absolute flex gap-4 items-center hidden group-hover:flex transition">
                                <a href="{{ route('front.items', $product->slug) }}">
                                    <div class="w-10 h-10 flex justify-center items-center bg-blue hover:bg-hover rounded-full">
                                        <i class="fa-solid fa-box-open text-light text-xl"></i>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" onclick="addToWishlist({{ $product->id }})">
                                    <div class="w-10 h-10 flex justify-center items-center bg-blue hover:bg-hover  rounded-full">
                                        <i class="fa-regular fa-heart text-light text-xl"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="px-5 py-2 pb-5">
                            <a href="{{ route('front.items', $product->slug) }}" class="text-[19px] text-black font-medium text-ellipsis hover:text-hover">{{ $product->title }}</a>
                            <p class="text font-bold !text-red">${{ $product->price }}
                                @if($product->compare_price != null)
                                <span class="ml-2 text font-light line-through">${{ $product->compare_price }}</span>
                                @endif
                            </p>
                                
                            {{-- <p class="text-black font-medium">
                                <i class="fa-solid fa-star text-gold"></i>
                                <i class="fa-solid fa-star text-gold"></i>
                                <i class="fa-solid fa-star text-gold"></i>
                                <i class="fa-regular fa-star-half-stroke text-gold"></i>
                                <i class="fa-solid fa-star text-gold"></i>
                            </p> --}}
                            <a href="{{ route('front.items', $product->slug) }}">
                                <button class="btn absolute  hidden group-hover:block group-hover:bottom-[20px] group-hover:transition">Give a feedback</button>
                            </a>
                        </div>
                    </div>
                @endforeach

                    
            </div>
              
            </div>
              
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

    </script>
@endsection