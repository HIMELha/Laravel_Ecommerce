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

<<<<<<< HEAD
    <!-- main start -->
    <main class="max-w-[1200px] px-2 flex flex-col mx-auto ">
        <div class="flex items-center gap-2 my-4">
            <a href=""><i class="fa-solid fa-house text-red"></i></a> 
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="" class="text-[15px] text-red">My Account</a> 
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="" class="link">Orders History</a> 
=======
     <main class="max-w-[1200px] px-2 flex flex-col mx-auto ">
        <div class="flex items-center gap-2 my-4">
            <a href=""><i class="fa-solid fa-house text-red"></i></a> 
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="" class="link">Order history</a> 
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
        </div>
        
        <div class="grid grid-cols-1  lg:grid-cols-4 items-start gap-4 mt-6 relative">
          
<<<<<<< HEAD
          <div class="flex items-center justify-between gap-4 px-4 py-3 shadow-md rounded-sm border border-light lg:hidden">
                      <div class="flex items-center gap-4">
                        <div class=" w-[80px] h-[80px] flex justify-center items-center border border-lightest rounded-full">
                            <img src="images/1683873836923.png" alt="" class="max-w-[60px]">
                        </div>
                        <h2 class="bigNunito">Alexander ||</h2>
                      </div>
                      <button id="Profilebtn" class="btn-hover"><i class="fa-solid fa-bars"></i></button>
          </div>
=======
            <div class="flex items-center justify-between gap-4 px-4 py-3 shadow-md rounded-sm border border-light lg:hidden">
                <div class="flex items-center gap-4">
                    <div class=" w-[80px] h-[80px] flex justify-center items-center border border-lightest rounded-full">
                        <img src="{{ asset('front-assets/dist/images/1683873836923.png') }}" alt="" class="max-w-[60px]">
                    </div>
                    <h2 class="bigNunito">{{ Auth::user()->name }}</h2>
                </div>
                <button id="Profilebtn" class="btn-hover"><i class="fa-solid fa-bars"></i></button>
            </div>
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9

            @include('front.layouts.profile-navbar')

          <div class="grid  sm:col-span-1 lg:col-span-3 gap-6 rounded-md">
            @if ($orders->isNotEmpty())
                @foreach ($orders as $order)
                    <div class="flex justify-between items-center px-4 py-4 shadow-md border">

                        <div class="flex flex-col gap-4">
                            <img src="images/894efb5ca153f54f35f30380849de8a5.png" alt="" class="max-w-[70px]">
                            <div>
                                <h2 class="text-min font-medium">Order Number</h2>
                                <p class="text !text-[17px] uppercase">{{ $order->id }}</p>
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

                        <div class="flex flex-col gap-4">
                            <div>
                                <h2 class="text-min font-medium">order status</h2>
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

                            <div>
                                <a href="{{ route('user.orderDetails', $order->id) }}"><button class="btn-hover">View Order</button></a>
                            </div>

                        </div>

                    </div>
                @endforeach
<<<<<<< HEAD
=======
            @else

                <div class="flex flex-col md:flex-row justify-center items-center px-6 py-6 gap-6 shadow-md border">
                    <h2 class="bigNunito">Your order page is empty</h2>
                </div>

>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
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

    </script>
@endsection