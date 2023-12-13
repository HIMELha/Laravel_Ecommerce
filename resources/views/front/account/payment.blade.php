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
            <a href="" class="link">Payments</a> 
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

            @if ($payments->isNotEmpty())

                @foreach ($payments as $pay)
                    <div class="flex justify-between items-center px-6 gap-2  py-6 shadow-md">

                    <div class="flex flex-col gap-4">
                        <div>
                            <h2 class="bigNunito font-medium">Bkash Payment</h2>
                            <h4 class="text font-medium">Invoice ID: #{{ $pay->refference }}</h4>
                        </div>
                        {{-- <img src="{{ asset('/public/images/bkash_payment_logo.png') }}" alt="" class="max-h-[40px]"> --}}
                        
                    </div>

                    <div class="flex flex-col gap-4">
                        <div>
                            <h2 class="bigNunito font-medium">Pay Number</h2>
                            <p class="text !text-[17px] uppercase">{{ $pay->customerMsisdn ? $pay->customerMsisdn : '*' }}</p>
                        </div>
                    </div>
                    @if($pay->trxID != null)
                    @php
                        $objs = new App\Http\Controllers\BkashTokenizePaymentController;
                        $trxID = $pay->trxID;
                        $pay_response = $objs->searchTnx($trxID);
    
                    @endphp
                    @endif
                     <div class="flex flex-col hidden md:block gap-4">
                        <div>
                            <h2 class="bigNunito font-medium">Pay amount</h2>
                            <p class="text !text-[17px] uppercase">
                                @if($pay->trxID != null)
                                {{ $pay_response['amount'] }}
                                @else
                                *
                                @endif
                            </p>
                        </div>
                    </div> 
                    
                    <div class="flex flex-col gap-4">
                        <div>
                            @if ($pay->status == 2)
                                <p class="text-[16px] text-green uppercase">Completed</p>
                            @elseif($pay->status == 1)
                                <p class="text-[16px] text-red uppercase">Pending</p>
                                @php
                                    $order = \App\Models\Order::where('id', $pay->order_id)->first();
                                    if($order->grand_total != 0){
                                        $responsef = json_encode([
                                            'grandTotal' => $order->grand_total,
                                            'reference' => $pay->refference
                                    ]);
                                    }
                                    
                                @endphp
                                <button class="btn-hover text-[14px]" onclick="paymentRedirect({{ $responsef }})">Checkout now</button>
                            @else
                                <p class="text-[16px] text-blue uppercase sucBtn">Refunded</p>
                            @endif
                        </div>
                    </div>
                    </div>
                @endforeach
            @else
                    <div class="flex justify-center items-center px-6 gap-2  py-6 shadow-md">
                        <h2 class="bigNunito font-medium">No payment records available</h2>
                    </div>
            @endif
            
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

    <script>
        function paymentRedirect(response){
            var responseJson = JSON.stringify(response);
            var url = "{{ route('bkash-create-payment') }}?data=" + encodeURIComponent(responseJson);
            window.location.href = url;
        }
    </script>
@endsection