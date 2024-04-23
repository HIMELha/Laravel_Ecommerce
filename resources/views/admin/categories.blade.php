
@extends('admin.layouts.app')


@section('contents')

   <!-- home start here-->
    <section id="home">
        <!-- main starts here -->
        <section id="main" class="min-h-[98vh] py-3 px-4 mt-12 bg-[#F1F5F9]">
            <div class="max-w-[1200px] mx-auto flex flex-col gap-4">
                    <div class="flex justify-between items-center">
                        <h2 class="py-2 text-slate-700 text-xl">Dashboard <span class="text-blue-600">v1.0</span></h2>
                        <h2 class="py-2 text-slate-700 text-sm">Home / <span class="text-blue-600">Categories</span></h2>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex flex-col flex-wrap items-start md:flex-row md:items-center gap-2 sm:gap-4">
                            <h2 class="py-2 text-slate-700 text-[18px]">Find categories</h2>
                            <div class="bg-blue-600 px-2 py-0 sm:py-1 rounded-sm">
                                <label for="time" class="text-[13px] text-white">Sort by time</label>
                                <select name="time" id="" class="px-2 py-1 text-xs text-white bg-blue-600 border-none outline-none">
                                    <option value="">last added</option>
                                    <option value="">oldest</option>
                                </select>
                            </div>

                            <form action="" class="flex px-2 py-0 sm:py-1 rounded-sm">
                                <input type="text" name="key" placeholder="Search category"  autocomplete="off" class="input">
                                <button type="submit" class="btn">Search</button>             
                            </form>                      

                        </div>

                         @include('admin.message')

                        <a href="{{ route('categories.create') }}"><button class="btn" >Add Categories</button></a>
                    </div> 

                   

                    <div class="w-full overflow-x-auto mt-4">
                        <table class="min-w-[1000px] mx-auto">
                            <thead>
                                <tr class="bg-gradient-to-t from-gray-200 to-gray-300 shadow-sm shadow-slate-400 uppercase">
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Id</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">category name</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Slug</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Show Home</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Status</th>
                                    <th class="px-3 py-2 text-[15px] text-slate-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($category as $data)                                                      
                                <tr class="border-b border-gray-200 mb-2">
                                    
                                    <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">{{ $data->id }}</td>
                                    <td class="px-3 py-3 text-[14px] text-zinc-600 text-center flex items-center gap-2">
                                        <img class="w-[40px] h-[40px]" src="{{ asset('uploads/category/'.$data->image.'') }}" alt="">
                                        {{ $data->name }}
                                    </td>
                                    <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">{{ $data->slug }}</td>
                                    <td class="px-3 py-3 text-[14px] text-zinc-600 text-center">
                                        @if($data->showHome == 'Yes')
                                            <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                            <input type="checkbox" value="" class="sr-only peer" checked>
                                            <div class="w-11 h-6 bg-gray-400 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 border-blue-300"></div>
                                            </label>
                                        @endif
                                        @if($data->showHome == 'No')
                                            <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                            <input type="checkbox" value="" class="sr-only peer">
                                            <div class="w-11 h-6 bg-gray-400 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 border-blue-300"></div>
                                            </label>
                                        @endif
                                        
                                        
                                    </td>
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
                                        <a href="{{ route('categories.edit', $data->id ) }}"><button class="editBtn" id="edit" >Edit</button></a>
                                        <button class="delBtn" onclick="deleteCategory({{ $data->id }})">Delete</button>
                                       </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                       <div class="flex justify-center mt-4">
                         {{ $category->links() }}
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

    function deleteCategory(id) {
        var url = '{{ route("categories.destroy", "ID") }}';
        var Newurl = url.replace("ID", id);

        $.ajax({
            url: Newurl,
            type: 'delete',
            data: {},
            dataType: 'json',
            headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
            success: function(response) {
               if(response['status']){
                window.location.href = "{{ route('admin.categories') }}";
               }
            }
        });
    }

</script>
@endsection