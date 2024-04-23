@extends('admin.layouts.app')

@section('contents')

   <!-- home start here-->
    <section id="home">
        <!-- main starts here -->
        
        <section id="main" class="min-h-[98vh] py-3 px-4 mt-12 bg-[#F1F5F9]">
            <div class="max-w-[1200px] mx-auto flex flex-col gap-4">
                <div class="flex justify-between items-center">
                    <h2 class="py-2 text-slate-700 text-xl">Dashboard <span class="text-blue-600">v1.0</span></h2>
                    <h2 class="py-2 text-slate-700 text-sm">Home / <span class="text-blue-600">Dashboard</span></h2>
                </div>
                @include('admin.message')
                <!-- home grids start -->
                <div class="grid xs:grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 md:gap-6 ">
                    
                       <div class="homeGrid">
                        <div class="w-[50px] h-[50px] flex justify-center items-center bg-[#EFF2F7] rounded-full"><i class="fa-regular fa-eye text-[#3C50E0]"></i></div>
                        <div class="flex justify-between items-end">
                                <div>
                                    <h3 class="text-[25px] text-gray-800">
                                    @php
                                        $sells = 0 ;
                                        foreach($Dorders as $item) {
                                            $sells = $sells + $item->grand_total;
                                        }
                                    @endphp
                                    ${{ number_format($sells,2) }}
                                    </h3>
                                    <p class="text-[15px] text-slate-600">Total Sells</p>
                                </div>
                                <div>
                                    <p class="text-[16px] text-green-600 font-thin"> 0.98 % <i class="fa-solid fa-arrow-up"></i></p>
                                </div>
                        </div>
                       </div>

                        <div class="homeGrid">
                        <div class="w-[50px] h-[50px] flex justify-center items-center bg-[#EFF2F7] rounded-full"><i class="fa-solid fa-cart-shopping text-[#3C50E0]"></i></div>
                        <div class="flex justify-between items-end">
                                <div>
                                    <h3 class="text-[25px] text-gray-800">{{ $orders->count() }}</h3>
                                    <p class="text-[15px] text-slate-600">Total Orders</p>
                                </div>
                                <div>
                                    <p class="text-[16px] text-green-600 font-thin"> 2.38 % <i class="fa-solid fa-arrow-up"></i></p>
                                </div>
                        </div>
                       </div>

                        <div class="homeGrid">
                        <div class="w-[50px] h-[50px] flex justify-center items-center bg-[#EFF2F7] rounded-full"><i class="fa-solid fa-plane-circle-check text-[#3C50E0]"></i></div>
                        <div class="flex justify-between items-end">
                                <div>
                                    <h3 class="text-[25px] text-gray-800">{{ $Dorders->count() }}</h3>
                                    <p class="text-[15px] text-slate-600">Delivery</p>
                                </div>
                                <div>
                                    <p class="text-[16px] text-green-600 font-thin"> 0.88 % <i class="fa-solid fa-arrow-up"></i></p>
                                </div>
                        </div>
                       </div>

                       <div class="homeGrid">
                        <div class="w-[50px] h-[50px] flex justify-center items-center bg-[#EFF2F7] rounded-full"><i class="fa-solid fa-user-group text-[#3C50E0]"></i></div>
                        <div class="flex justify-between items-end">
                                <div>
                                    <h3 class="text-[25px] text-gray-800">{{ $users->count() }}</h3>
                                    <p class="text-[15px] text-slate-600">Total User</p>
                                </div>
                                <div>
                                    <p class="text-[16px] text-green-600 font-thin"> 12.98 % <i class="fa-solid fa-arrow-up"></i></p>
                                </div>
                        </div>
                       </div>
                </div>
                <!-- home  grids !start-->

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 items-start  gap-4 mt-4 sm:gap-5 md:gap-6">
                    <!-- home  tables start-->
                    <div class="grid md:col-span-1 lg:col-span-4  px-6 py-3 bg-white border border-gray-200 shadow-md shadow-slate-200">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl py-2 text-gray-600"><i class="fas fa-shopping-cart mr-2 text-blue-500 text-xl"></i>Popular <span class="text-xl text-pink-600">Products</span></h2>
                            <a href="#" class="link">View all<i class="fa-solid fa-arrow-right ml-2 text-blue-500 text-[14px] "></i></a>
                        </div>

                        <div class="mt-4 overflow-x-auto scrollbar-thin scrollbar-thumb-blue-500 scrollbar-track-blue-200">
                            <table class="min-w-[700px] mx-auto">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-3 py-2 text-slate-600 text-[13px] uppercase">Product Name</th>
                                        <th class="px-3 py-2 text-slate-600 text-[13px] uppercase">Price</th>
                                        <th class="px-3 py-2 text-slate-600 text-[13px] uppercase">Sells</th>
                                        <th class="px-3 py-2 text-slate-600 text-[13px] uppercase">Revenue</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($productQty as $qty)
                                        @php
                                            $product = \App\Models\Product::where('id', $qty['product_id'])->first();
                                        @endphp
                                        <tr class="border-b border-gray-300 mb-2">
                                            <td class="px-3 py-3 text-slate-600 text-[13px] text-center">
                                            @php
                                                $title = $product->title;
                                                if(strlen($title) > 40){
                                                    $title = substr($title, 0, 40).'...';
                                                }
                                            @endphp    
                                            {{ $title }}</td>
                                            <td class="px-3 py-3 text-slate-600 text-[13px] text-center">${{$product->price}}</td>
                                            <td class="px-3 py-3 text-slate-600 text-[13px] text-center">{{ $qty['qtys'] }}</td>
                                            <td class="px-3 py-3 text-blue-600 text-[13px] text-center">${{$product->price*$qty['qtys']}} </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- home  tables !start-->

 
                    <!-- home  tables start-->
                    <div class="grid md:col-span-1 lg:col-span-2 px-6 py-3 gap-4">
                        <div class="homeGrid">
                            <div class="w-[50px] h-[50px] flex justify-center items-center bg-[#EFF2F7] rounded-full"><i class="fa-solid fa-chart-simple text-[#3C50E0]"></i></div>
                            <div class="flex justify-between items-end">
                                    <div>
                                        <h3 class="text-[25px] text-gray-800">52K</h3>
                                        <p class="text-[15px] text-slate-600">Total Impressions</p>
                                    </div>
                                    <div>
                                        <p class="text-[16px] text-green-600 font-thin"> 2.38 % <i class="fa-solid fa-chart-simple"></i></p>
                                    </div>
                            </div>
                        </div>

                       <div class="homeGrid">
                            <div class="w-[50px] h-[50px] flex justify-center items-center bg-[#EFF2F7] rounded-full"><i class="fa-regular fa-eye text-[#3C50E0]"></i></div>
                            <div class="flex justify-between items-end">
                                    <div>
                                        <h3 class="text-[25px] text-gray-800">4.56K</h3>
                                        <p class="text-[15px] text-slate-600">Total Views</p>
                                    </div>
                                    <div>
                                        <p class="text-[16px] text-green-600 font-thin"> 0.98 % <i class="fa-solid fa-arrow-up"></i></p>
                                    </div>
                            </div>
                        </div>

                       <div class="homeGrid">
                            <div class="w-[50px] h-[50px] flex justify-center items-center bg-[#EFF2F7] rounded-full"><i class="fa-solid fa-comment-dots text-[#3C50E0]"></i></div>
                            <div class="flex justify-between items-end">
                                    <div>
                                        <h3 class="text-[25px] text-gray-800">1,309</h3>
                                        <p class="text-[15px] text-slate-600">Reviews</p>
                                    </div>
                                    <div>
                                        <p class="text-[16px] text-green-600 font-thin"> 2.38 % <i class="fa-solid fa-chart-simple"></i></p>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <!-- home  tables !start-->
                <div>
                </div>
            </div>
        </section>
        <!-- main starts here -->
    </section>
   <!-- home !start here-->
    
@endsection


@section('customJs')
@endsection