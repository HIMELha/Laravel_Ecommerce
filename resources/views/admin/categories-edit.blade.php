
@extends('admin.layouts.app')

@section('contents')
<div class="px-2 flex justify-center items-center fixed top-0 bottom-0 right-0 left-0 bg-[rgba(0,0,0,0.2)] ">
    <div class="px-6 py-8 w-[600px] flex flex-col justify-center items-center bg-white rounded-md relative">
        <a href="{{ route('admin.categories') }}"><button class="btn absolute top-3 right-3" id="close"><i class="fa-solid fa-close"></i></button></a>
        <h2 class="text-gray-600 text-[17px]">Update Category</h2>

        <form action="" class="w-full flex flex-col justify-center gap-3 mt-5" id="catForm"> 
            @csrf 
            <p class="errBtn hidden"></p>
            <p class="sucBtn hidden" ></p>
            <div class="flex-input">
                <div class="w-full flex flex-col ">
                    <label for="name" class="label">name</label>
                    <input type="text" name="name" id="name" placeholder="Enter category name" value="{{ $data->name }}" class="input">
                </div>
                <div class="w-full flex flex-col ">
                    <label for="slug" class="label">slug</label>
                    <input type="text" name="slug" id="slug" placeholder="Enter slug" value="{{ $data->slug }}" class="input" readonly>
                </div>
            </div>
            <div class="flex-input">
                <div class="w-full flex flex-col ">
                    <label for="name" class="label">status</label>
                    <select name="status" id="" class="select">
                        <option value="1" {{ ($data->status == 1 ) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ ($data->status == 0 ) ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <div class="w-full flex flex-col ">
                    <label for="showHome" class="label">Show Homepage</label>
                    <select name="showHome" id="" class="select">
                        <option value="No" {{ ($data->showHome == 'No' ) ? 'selected' : '' }}>No</option>
                        <option value="Yes" {{ ($data->showHome == 'Yes' ) ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
            </div>

            <div class="w-full flex flex-col ">
                    <input type="text" name="image_id" id="image_id" hidden>
                    <label for="image" class="label">upload Image</label>
                   <div id="image" class="dropzone dz-clickable">
                        
                        <div class="dz-message needsclick">    
                            <br>Drop files here or click to upload.<br><br>                                            
                        </div>

                    </div>
                        @if (!empty($data->image))
                            <div class="mt-2">
                                <img class="sortImage"  id="image" src="{{ asset('uploads/category/'.$data->image.'') }}" alt="">
                            </div>
                        @endif
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
        
        $('#catForm').submit(function(e){
            e.preventDefault();

            var data = $(this);
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: '{{ route("categories.update",$data->id) }}',
                type: 'put', 
                data: data.serializeArray(),
                dataType: 'json',
                success: function(response){
                    $('button[type=submit]').prop('disabled', false);

                    if(response['status'] == true ){
                        $('.errBtn').hide();
                        window.location.href = '{{ route("admin.categories") }}';
                    } else {
                        $('.sucBtn').hide();
                        var errors = response['errors']; 
                        if(errors['name']){
                            $('.errBtn').show();
                            $('.errBtn').html(errors['name']);
                        }
                        if(errors['slug']){
                            $('.errBtn').show();
                            $('.errBtn').html(errors['slug']);
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


<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

        Dropzone.autoDiscover = false;    
        const dropzone = $("#image").dropzone({ 
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            
            url:  "{{ route('temp-image.create') }}",
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                console.log(response.message);
                $("#image_id").val(response.image_id);
            },
            error: function(error){
                console.log(error);
            }
        });
</script>

@endsection