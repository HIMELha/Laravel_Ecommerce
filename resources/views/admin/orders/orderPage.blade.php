@extends('admin.layouts.app')

@section('contents')
    @include('admin.message')
    <section id="home">
        <!-- main starts here -->
        <section id="main" class="min-h-[98vh] py-3 px-4 mt-12 bg-[#F1F5F9]">
            <div class="max-w-[1200px] mx-auto flex flex-col gap-4">
                    <div class="flex justify-between items-center">
                        <h2 class="py-2 text-slate-700 text-xl">Dashboard <span class="text-blue-600">v1.0</span></h2>
                        <h2 class="py-2 text-slate-700 text-sm">Home / <span class="text-blue-600">Orders</span></h2>
                    </div>
                    <div class="flex justify-between items-start">
                        <div class="flex flex-col flex-wrap items-start md:items-center gap-1 sm:gap-4">
                            <h2 class="p-1 text-slate-700 text-[18px]">Order Details</h2>

                            <div class="border p-2">
                                <p class="text-[17px] text-black"><i class="fa-solid fa-user sucBtn"></i>   {{$orders->name}}</p>
                                 <p class="text-[17px] text-black"><i class="fa-solid fa-envelope sucBtn"></i> {{$orders->email}}</p>
                                <p class="text-[17px] text-black"><i class="fa-solid fa-phone sucBtn"></i> {{$orders->phone}}</p>

                                <p class="text-[17px] text-black"><i class="fa-solid fa-location-dot sucBtn"></i> {{$orders->address}}</p>

                                <p class="text-[17px] text-black">{{$orders->city}}</p>
                                <p class="text-[17px] text-black">{{$orders->zip}}, {{  $orders->state }}</p>
                                <p class="text-[17px] text-black">{{$orders->aprtment}}</p>
                                <br>
                                
                            </div>
                        </div>
                        <div class="flex flex-col p-2">
                             <h1  class="py-2 text-slate-700 text-[18px]"> OrderNo: #{{$orders->id}} </h1>
                             <div class="mt-1 border p-2">
                                    <p class="text-[17px] text-black">Subtotal: <span class="alertBtn"> ${{$orders->subtotal}}</span></p>
                                    <p class="text-[17px] text-black">Shipping Charge: <span class="errBtn"> ${{$orders->shipping}}</span></p>
                                    <p class="text-[17px] text-black">Discount: <span class="sucBtn"> ${{$orders->discount}}</span></p>
                                    <p class="text-[17px] text-black">Total amount: <span class="sucBtn"> ${{$orders->grand_total}}</span></p>
                                    <p class="text-[17px] text-black">Order Status: <span class="sucBtn"> {{$orders->order_status}}</span></p>
                                    
                                    <p class="text-[17px] text-black">Payment Status:
                                        @if($payments->trxID != null)
                                        @php
                                        
                                            $objs = new App\Http\Controllers\BkashTokenizePaymentController;
                                            $trxID = $payments->trxID;
                                            $paymentID = $payments->paymentID;
                                            $pay_response = $objs->searchTnx($trxID);
                                            $amount = $pay_response['amount'];
                                            $datas = [
                                                'trxID' => $trxID,
                                                'paymentID' => $paymentID,
                                                'amount' => $amount
                                            ];
                                            // dd($datas);
                                            
                                        @endphp
                                        @endif 
                                    @if ($payments->status == 2)
                                        <span class="sucBtn">Completed</span> | <p>{{ ($amount != '') ? $amount : '' }}</p>
                                        <br>
                                        <a href="{{ route('bkash-refund', $datas ) }}"><button class="editBtn">Refund Payment</button></a>
                                    @elseif($payments->status == 1)
                                        <span class="alertBtn">Pending</span>
                                    @else
                                        <span class="alertBtn">Payment Refunded</span>
                                    @endif
                                    </p>

                            </div>
                        </div>
                        <div>

                        </div>
                    </div> 
                     <div class="flex justify-between items-start">
                        @if ($orders->notes != '')
                        <div class="flex flex-col">
                            <h2 class="text-[18px]">Customer notes</h2>
                                <p>{{$orders->notes}}</p>
                        </div>
                        @endif
                        <div class=" flex flex-col">
                            <h2>Update order status</h2>
                            <select name="status" id="status" class="input">
                                <option value="pending" {{ ($orders->order_status) == 'pending' ? 'selected' : '' }} >Pending</option>
                                <option value="delivered" {{ ($orders->order_status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="shiped" {{ ($orders->order_status) == 'shiped' ? 'selected' : '' }}>Shipped</option>
                                <option value="cancelled" {{ ($orders->order_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <textarea class="mt-2 border p-2" name="notes" id="notes" cols="30" rows="4" placeholder="Add notes here..">{{ ($orders->admin_notes != '') ?  $orders->admin_notes : ''  }}</textarea>
                            <button class="btn mt-2" id="updateStatus">Update status</button>
                        </div>

                        <div></div>

                    </div>

                    
                    <!-- table start -->
                    
                    <div class="mb-4 w-full overflow-x-auto mt-4">
                        <table class="min-w-[1000px] mx-auto">
                            <thead>
                                <h2 class="text-[18px] text-center">Product lists</h2>
                                <tr class="bg-gradient-to-t from-gray-200 to-gray-300 shadow-sm shadow-slate-400 uppercase">
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Pid</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">name</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">qty</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">price</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">total amount</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
    
                                @foreach ($products as $products)
                                    <tr class="border-b border-gray-200 mb-2">
                                        <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">{{ $products->id }}</td>
                                        <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">{{ $products->name }}</td>
                                        <td class="px-3 py-3 text-[14px] text-zinc-600 text-center flex justify-center"> {{ $products->qty }} </td>
                                        <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">{{ $products->price }}</td>
                                        <td class="px-3 py-3 text-[14px] text-zinc-600 text-center"><span class="text-blue-500 text-[15px]">${{ $products->total }}</span></td>
                                        
                                        <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">
                                            <button class="errBtn"><i class="fa-solid fa-xmark text-[13px] mr-1"></i>Delete</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody> 
                            
                              </table>
                    </div>
                      <br><br><br>
                    <!-- table end -->

                </div>
        </section>
    </section>   
@endsection
 

@section('customJs')
    <script>

        $('#updateStatus').click(function(e){
            e.preventDefault();
            
            $.ajax({
                url: '{{ route('orders.updateStatus') }}',
                type: 'post',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {status: $('#status').val(), id: {{ $orders->id }}, notes: $('#notes').val() },
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    if(response.status == true){
                        window.location.href = '{{ route('admin.orders') }}';
                    }else{
                        window.location.href = '{{ route('admin.orders') }}';
                    }
                }
            });
        })
    </script>

    <script>
        function refundPayment(){

        }
    </script>
@endsection