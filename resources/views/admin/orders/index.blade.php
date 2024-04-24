@extends('admin.layouts.app')

@section('contents')
    <section id="home">
        <!-- main starts here -->
        <section id="main" class="min-h-[98vh] py-3 px-4 mt-12 bg-[#F1F5F9]">
            <div class="max-w-[1200px] mx-auto flex flex-col gap-4">
                    <div class="flex justify-between items-center">
                        <h2 class="py-2 text-slate-700 text-xl">Dashboard <span class="text-blue-600">v1.0</span></h2>
                        <h2 class="py-2 text-slate-700 text-sm">Home / <span class="text-blue-600">Orders</span></h2>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex flex-col flex-wrap items-start md:flex-row md:items-center gap-2 sm:gap-4">
                            <h2 class="py-2 text-slate-700 text-[18px]">Find Orders</h2>
                            <div class="bg-blue-600 px-2 py-0 sm:py-1 rounded-sm">
                                <label for="time" class="text-[13px] text-white">Sort by time</label>
                                <select name="time" id="" class="px-2 py-1 text-xs text-white bg-blue-600 border-none outline-none">
                                    <option value="">last added</option>
                                    <option value="">oldest</option>
                                </select>
                            </div>
                            <div class="bg-blue-600 px-2 py-0 sm:py-1 rounded-sm">
                                <label for="time" class="text-[13px] text-white">Sort by spelling</label>
                                <select name="time" id="" class="px-2 py-1 text-xs text-white bg-blue-600 border-none outline-none">
                                    <option value="">a - z</option>
                                    <option value="">1-9</option>
                                </select>
                            </div>
                            <form action="" class="flex px-2 py-0 sm:py-1 rounded-sm">
                            <input type="text" name="key" placeholder="Search here"  autocomplete="off" class="input">
                            <button type="submit" class="btn">Search</button> 
                        </div>

                        <button class="btn" id="add">Add Custom order</button>
                    </div> 
                    <!-- table start -->
                    <div class="w-full overflow-x-auto mt-4">
                        <table class="min-w-[1000px] mx-auto">
                            <thead>
                                <tr class="bg-gradient-to-t from-gray-200 to-gray-300 shadow-sm shadow-slate-400 uppercase">
                                    <th class="px-3 py-2 text-[15px] text-slate-600">oid</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Customer</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">email</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Phone</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Amount</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Status</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @if($orders->isNotEmpty())
                                    @foreach ($orders as $order)
                                        <tr class="border-b border-gray-200 mb-2">
                                            <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">{{ $order->id }}</td>
                                            <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">{{ $order->first_name. ' ' .$order->last_name }}</td>
                                            <td class="px-3 py-3 text-[14px] text-zinc-600 text-center flex justify-center"> {{ $order->email }} </td>
                                            <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">{{ $order->phone }}</td>
                                            <td class="px-3 py-3 text-[14px] text-zinc-600 text-center"><span class="text-blue-500 text-[15px]">${{ $order->grand_total }}</span></td>

                                            <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">
                                                @if ($order->order_status == 'pending')
                                                    <button class="alertBtn"><i class="fa-solid fa-circle text-[13px] mr-1"></i>Pending</button>
                                                @elseif($order->order_status == 'shiped')
                                                    <button class="sucBtn"><i class="fa-regular fa-circle-check text-[13px] mr-1"></i>Shipped</button>
                                                @elseif($order->order_status == 'delivered')
                                                    <button class="editBtn"><i class="fa-regular fa-circle-check text-[13px] mr-1"></i>Delivered</button>
                                                @else
                                                    <button class="errBtn"><i class="fa-solid fa-xmark text-[13px] mr-1"></i>Cancelled</button>
                                                @endif
                                            </td>

                                            
                                            <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <a href="{{ route('orders.orderPage', $order->id) }}" class="editBtn" >Update status</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <!-- table end -->

                    <!-- pagination starst -->
                    <div class="max-w-[400px] mx-auto mt-2">
                        {{ $orders->links() }}
                    </div>
                    <!-- pagination starst -->
                </div>
        </section>
    </section>   
@endsection
 

@section('customJs')
    
@endsection