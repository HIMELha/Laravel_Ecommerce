@extends('front.layouts.app')

@section('contents')
    <!-- header categories -->
    <div class="max-w-[1200px] px-2 flex  justify-between gap-4 mx-auto">
        <div id="catNav" class="w-[240px] pt-2 bg-light shadow-md  top-0 bottom-0 left-0  z-50 hidden">
            <ul>
            <li class="text-right m-2">
                <buttton id="catclose" class="btn !w-full  cursor-pointer "><i class="fa-solid fa-close"></i></buttton>
            </li>
            @if(getCategories()->isNotEmpty())
            @foreach (getCategories() as $category)
                <li>
                <a href="{{ route('front.products', $category->slug) }}">
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
    <!-- header categories end -->

        <!-- main start -->
    <main class="max-w-[1200px] px-2 flex flex-col mx-auto ">
        <div class="flex items-center gap-2 my-4">
            <a href="{{ route('front.index') }}"><i class="fa-solid fa-house text-red"></i></a> 
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="{{ route('front.carts') }}" class="link">Carts</a> 
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3  lg:grid-cols-4 items-start gap-4 mt-6">

          <div class="grid  col-span-1 md:col-span-2 lg:col-span-3 gap-6 rounded-md">

            {{-- {{ dd($cartContent)}} --}}
           @if (Cart::count() > 0)
                @foreach ($cartContent as $cart)
                <div class="flex flex-col md:flex-row justify-between items-center px-6 py-6 gap-6 shadow-md">
                  <div class="flex flex-col md:flex-row items-center  gap-4">

                        @if (!empty($cart->options->productImage->image))
                            <img src="{{ asset('uploads/product/' . $cart->options->productImage->image) }}" alt="" class="max-w-[60px]">  
                        @else
                            <img src="https://dummyimage.com/250/ffffff/000000" alt="" srcset="" class="max-w-[60px]">
                        @endif
                    <div>
                        @php    
                        $product = \App\Models\Product::where('id', $cart->id)->first();
                        $slug = $product->slug;
                        $qty = $product->qty;
                        @endphp
                        <h2 class="text-lg font-medium"><a href="{{ route('front.items', $slug) }}">{{ $product->title }}</a></h2>
                        <p class="text !text-[17px]">Availability:
                            @if ($qty == 0)
                                <span class="text-red font-medium">Out Of Stock</span>
                            @else
                                <span class="text-blue font-medium">In Stock</span>
                            @endif
                        </p>
                    </div>
                  </div>
                  <div class="flex items-center gap-2 md:gap-4">
                      <div class="w-min shadow-md flex mt-1 gap-2 border ">
                           <button  class="sub px-2 py-1 hover:bg-slate-100 border-r" data-id={{ $cart->rowId }} ><i class="fa-solid fa-minus"></i></button>
                           <input type="text" class="text-center ml-2 w-6 focus:outline-none" value="{{ $cart->qty }}" readonly>
                           <button  class="add px-2 py-1 hover:bg-slate-100 border-l" data-id={{ $cart->rowId }} ><i class="fa-solid fa-plus"></i></button>
                        </div>

                      <p class="text-lg text-red font-bold"><span class="text uppercase">total:</span> ${{ $cart->price*$cart->qty }}  </p>
                      <div>
                          <button class="btn" id="rmvCart" data-id="{{$cart->rowId}}"><i class="fa-solid fa-trash-can"></i></button>
                      </div>
                  </div>
                </div>
                @endforeach

            @else
                <div class="flex flex-col md:flex-row justify-center items-center px-6 py-6 gap-6 shadow-md">
                    <h2 class="bigNunito">Your cart is empty</h2>
                </div>
            @endif

          </div>

           <div class="grid col-span-1 md:col-span-1 lg:col-span-1 mt-6">
                <div class="p-5 flex flex-col gap-4 border border-lightest rounded-md">
                    <div class="flex items-center gap-4">
                    <h2 class="bigNunito font-bold">ORDER SUMMARY</h2>
                    </div>

                    <div class="flex flex-col gap-2">
                        <div class="flex flex-col justify-between ">
                        @foreach (Cart::content() as $item)
                            <div class="flex justify-between ">
                                <h2 class="text-[18px] font-medium text-black">{{ $item->name }} <span class="text-blu font-medium">x{{ $item->qty }}</span></h2>
                                <p class="text !text-[17px]">${{ number_format($item->price * $item->qty, 2) }}</p>
                            </div>
                        @endforeach
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <h2 class="text-[20px] text-black font-medium">Subtotal</h2>
                            <p class="text !text-[17px]">${{ Cart::subtotal() }}</p>
                        </div>
                    </div>

                    
                    
                    <a href="{{ route('front.checkout') }}"><button class="btn-hover">Procced To Checkout</button></a>
                </div>

           </div>
        </div>
        
    </main>
    <!-- main end -->

@endsection

@section('customJS')
    <script>
        $('.add').click(function(){
            var qtyElement = $(this).prev(); // Qty Input
            var qtyValue = parseInt(qtyElement.val());
            if (qtyValue < 10) {
                var rowId = $(this).data('id');
                qtyElement.val(qtyValue+1);
                var newQty = qtyElement.val();
                updateCart(rowId, newQty);
            }            
        });

        $('.sub').click(function(){
            var qtyElement = $(this).next(); 
            var qtyValue = parseInt(qtyElement.val());
            if (qtyValue > 1) {
                var rowId = $(this).data('id');
                qtyElement.val(qtyValue-1);
                var newQty = qtyElement.val();
                updateCart(rowId, newQty)
            }        
        });

        function updateCart(rowId, qty){

            $.ajax({
                url: '{{ route('front.updateCart') }}',
                type: 'post',
                data: {rowId: rowId, qty:qty},
                dataType: 'json',
                success: function(response){
                    if(response.status == true){
                        window.location.reload();
                    }else{
                        console.log('Something wrong')
                    }
                }
            })

        }


        $('body').on('click', '#rmvCart', function(){
            var cart = $(this).data('id');
            $.ajax({
                url: '{{ route('front.deleteCart') }}',
                type: 'post',
                data: {rowId: cart},
                dataType: 'json',
                success: function(response){
                    if(response.status == true){
                        window.location.reload();
                    }
                }
            })
        });
            




    </script>
@endsection