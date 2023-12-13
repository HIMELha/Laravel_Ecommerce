
@extends('admin.layouts.app')

@section('contents')
<div class="px-2 flex justify-center items-center fixed top-0 bottom-0 right-0 left-0 bg-[rgba(0,0,0,0.2)] ">
    <div class="px-6 py-8 w-[600px] flex flex-col justify-center items-center bg-white rounded-md relative">
        <a href="{{ route('admin.pages') }}"><button class="btn absolute top-3 right-3" id="close"><i class="fa-solid fa-close"></i></button></a>
        <h2 class="text-gray-600 text-[17px]">update Page</h2>

        <form class="w-full flex flex-col justify-center gap-3 mt-5" id="pageForm" > 
            @csrf 
            <p class="errBtn "></p>
            <p class="sucBtn " ></p>
            
            <div class="flex-input">
                <div class="w-full flex flex-col ">
                    <label for="name" class="label">Page name</label>
                    <input type="text" name="name" id="name" value="{{ $page->name }}" placeholder="Enter page name" class="input">
                </div>
            </div>
            <div class="flex-input">
                
                <div class="flex-input w-full">
                    <div class="w-full flex flex-col ">
                        <label for="description" class="label">Description</label>
                        <textarea type="text" name="description"  id="editor" placeholder="enter description" class="textarea">{{ $page->description }}</textarea>
                    </div>
                    <p class="ierr"></p>
                </div>

            </div>


            <div class="flex items-center gap-2">
                <button type="submit" class="btnred w-full">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('customJs')

<script src="https://cdn.tiny.cloud/1/h2axwpnzfh7k1agff20oqbrdvqd0hpov0jv1oc3q8gb14mqi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: '#editor',
    plugins: 'lists link image',
    toolbar: "undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | outdent indent",
    height: 300, // Specify the height of the editor
  });
</script>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            } 
        });

        $('#pageForm').submit(function(e){
            e.preventDefault();
            var data = $(this);

            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: '{{ route("pages.update", $page->id) }}',
                type: 'post', 
                data: data.serializeArray(),
                dataType: 'json',
                success: function(response){
                    $('button[type=submit]').prop('disabled', false);

                    if(response['status'] == true ){
                        $('.errBtn').hide();
                        window.location.href = '{{ route("admin.pages") }}';
                    } else if(response.status == 'notFound'){
                        $('.errBtn').hide();
                        window.location.href = '{{ route("admin.pages") }}';
                    } else {
                        $('.sucBtn').hide();
                        var errors = response.errors; 
                        if(errors.name){
                            $('.errBtn').html(errors.name);
                        }
                        if(errors.description){
                            $('.errBtn').show();
                            $('.errBtn').html(errors.description);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('An error occurred:', error);
                    console.log(xhr.responseText);
                }
            });

        });
    
        

    });
</script>
@endsection