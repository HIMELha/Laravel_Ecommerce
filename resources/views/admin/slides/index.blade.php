
@extends('admin.layouts.app')


@section('contents')
    @include('admin.message')
   <!-- home start here-->
    <section id="home">
        <!-- main starts here -->
        <section id="main" class="min-h-[98vh] py-3 px-4 mt-12 bg-[#F1F5F9]">
            <div class="max-w-[1200px] mx-auto flex flex-col gap-4">
                    <div class="flex justify-between items-center">
                        <h2 class="py-2 text-slate-700 text-xl">Dashboard <span class="text-blue-600">v1.0</span></h2>
                        <h2 class="py-2 text-slate-700 text-sm">Home / <span class="text-blue-600">Brands</span></h2>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex flex-col flex-wrap items-start md:flex-row md:items-center gap-2 sm:gap-4">
                            <h2 class="py-2 text-slate-700 text-[18px]">Find Brands</h2>
                            <div class="bg-blue-600 px-2 py-0 sm:py-1 rounded-sm">
                                <label for="time" class="text-[13px] text-white">Sort by time</label>
                                <select name="time" id="" class="px-2 py-1 text-xs text-white bg-blue-600 border-none outline-none">
                                    <option value="">last added</option>
                                    <option value="">oldest</option>
                                </select>
                            </div>

                            <form action="" class="flex px-2 py-0 sm:py-1 rounded-sm">
                                <input type="text" name="key" placeholder="Search Coupons"  autocomplete="off" class="input">
                                <button type="submit" class="btn">Search</button>             
                            </form>                      

                        </div>


                        <a href="{{ route('coupons.create') }}"><button class="btn" >Add Coupon</button></a>
                    </div> 
                  
                    

                    <div class="w-full overflow-x-auto mt-4">
                        <table class="min-w-[1000px] mx-auto">
                            <thead>
                                <tr class="bg-gradient-to-t from-gray-200 to-gray-300 shadow-sm shadow-slate-400 uppercase">
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Id</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Code</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Max uses</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Discount amount</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Start date</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Status</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @if(!empty($slides))
                                @foreach ($slides as $data)                                                      
                                <tr class="border-b border-gray-200 mb-2">
                                    <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">{{ $data->id }}</td>
                                    <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">{{ $data->code }}</td>
                                    <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">{{ $data->max_uses }}</td>
                                    <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">{{ ($data->type == 'fixed') ? '$' : '%'}}{{ $data->discount_amount }}</td>
                                    <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">{{ $data->starts_at }}</td>
                                    <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">
                                        @if($data->status == 1)
                                            <p class="sucBtn">Published</p>
                                        @endif
                                        @if($data->status == 0)
                                            <p class="alertBtn">Pending</p>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">
                                       <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('coupons.edit', $data->id ) }}"><button class="editBtn" id="edit" >Edit</button></a>
                                        <button class="delBtn" onclick="deleteCoupon({{ $data->id }})">Delete</button>
                                       </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif


                            </tbody>
                        </table>
                       <div class="flex justify-center mt-4">
                         {{ $slides->links() }}
                       </div>
                    </div>
                    <!-- table end -->
                    
                </div>
        </section>
    </section>    
    

    <!-- scripts -->

@endsection

@section('customJs')
<script>
    function deleteCoupon(id) {
        var url = '{{ route("coupons.destroy", "ID") }}';
        var url = url.replace("ID", id);

        $.ajax({
            url: url,
            type: 'delete',
            data: {},
            dataType: 'json',
            headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
            success: function(response) {
                if(response['status'] == true){
                    window.location.href = "{{ route('admin.coupons') }}";
                }else{
                    window.location.href = "{{ route('admin.coupons') }}";
                }
            }
        });
    }

</script>
@endsection