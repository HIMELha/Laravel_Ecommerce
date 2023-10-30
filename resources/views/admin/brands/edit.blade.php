
@extends('admin.layouts.app')

@section('contents')
<div class="px-2 flex justify-center items-center fixed top-0 bottom-0 right-0 left-0 bg-[rgba(0,0,0,0.2)] ">
    <div class="px-6 py-8 w-[600px] flex flex-col justify-center items-center bg-white rounded-md relative">
        <a href="{{ route('admin.brands') }}"><button class="btn absolute top-3 right-3" id="close"><i class="fa-solid fa-close"></i></button></a>
        <h2 class="text-gray-600 text-[17px]">Update Brands</h2>

        <form  class="w-full flex flex-col justify-center gap-3 mt-5" id="editbrandForm" > 
            @csrf 
            <p class="errBtn hidden"></p>
            
            <div class="flex-input">
                <div class="w-full flex flex-col ">
                    <label for="name" class="label">name</label>
                    <input type="text" name="name" id="name" value="{{ $data->name }}" placeholder="Enter brand name" class="input">
                </div>
                <div class="w-full flex flex-col ">
                    <label for="slug" class="label">slug</label>
                    <input type="text" name="slug" id="slug" value="{{ $data->slug }}" placeholder="Enter slug" class="input" readonly>
                </div>
            </div>
            <div class="flex-input">
                <div class="w-full flex flex-col ">
                    <label for="name" class="label">status</label>
                    <select name="status" id="" class="select">
                        
                        <option value="1" @if($data->status == 1) selected @endif>Active</option>
                        <option value="0" @if($data->status == 0) selected @endif>Pending</option>
                    </select>
                </div>

            </div>


            <div class="flex items-center gap-2">
                <button type="submit" class="btn w-full">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('customJs')
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            } 
        });

        $('#editbrandForm').submit(function(e){
            e.preventDefault();
            var data = $(this);

            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: '{{ route("brands.update", $data->id ) }}',
                type: 'put', 
                data: data.serializeArray(),
                dataType: 'json',
                success: function(response){
                    $('button[type=submit]').prop('disabled', false);

                    if(response['status'] == true ){
                        $('.errBtn').hide();
                        window.location.href = '{{ route("admin.brands") }}';
                    } else {
                        
                        var errors = response['errors']; 
                        if(errors['name']){
                            $('.errBtn').show();
                            $('.errBtn').html(errors['name']);
                        }else{
                            $('.errBtn').hide();
                        }
                        if(errors['slug']){
                            $('.errBtn').show();
                            $('.errBtn').append(errors['slug']);
                        }else{
                            $('.errBtn').hide();
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('An error occurred:', error);
                    console.log(xhr.responseText);
                }
            });

        });
    
        $('#name').change( function() {
            var data = $(this);
            $('button[type=submit]').prop('disabled', true);
            $.ajax({
                url: '{{ route("getSlug") }}',
                type: 'get', 
                data: {title: data.val()} ,
                dataType: 'json',
                success: function(response){
                    $('button[type=submit]').prop('disabled', false);
                    if(response['status'] == true){
                        $('#slug').val(response['slug']);
                    }
                }
            })
        });


    });
</script>
@endsection