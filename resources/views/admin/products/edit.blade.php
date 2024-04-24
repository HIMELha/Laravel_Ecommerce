
@extends('admin.layouts.app')

@section('contents')


    <div  class="px-2 flex justify-center items-center fixed top-0 bottom-0 right-0 left-0 bg-[rgba(0,0,0,0.2)] ">
                <div id="scroll" class="w-[90%] md:w-[800px]   bg-white rounded-md relative">
                    <a href="{{ route('admin.products') }}"><button class="btn absolute top-3 right-3" id="close"><i class="fa-solid fa-close"></i></button></a>
                    <h2 class="text-gray-600 text-[17px]">Update Products</h2>

                    <form action="{{ route('products.store') }}"   id="productForm" class="w-full flex flex-col justify-center gap-3 mt-5">
                        @csrf
                        <div class="flex-input">
                            
                            <div class="w-full flex flex-col ">
                                <label for="title"  class="label">Title</label>
                                <input type="text" id="title" name="title" value="{{ $product->title }}" placeholder="Enter product title" class="input">
                                <p class="ierr"></p>
                            </div>
                            <div class="w-full flex flex-col ">
                                <label for="slug" class="label">Slug</label>
                                <input type="text" id="slug" value="{{ $product->slug }}" name="slug" placeholder="product slug" class="input" readonly>
                                <p class="ierr"></p>
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
                            
                            <div id="rowImg">
                                @if ($productImage->isNotEmpty())
                                    @foreach ( $productImage as $image)
                                    <div id="image-row-${{ $image->id }}">
                                        <input type="text" name="image_array[]" value="{{ $image->id }}" hidden>
                                        <div  id="border">
                                            <img src="{{ asset('uploads/product/'.$image->image) }}" class="sortImage">
                                             <a href="javascript:void(0)" onclick="deleteImage({{ $image->id }})" class="errBtn">Remove</a>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="flex-input">
                            <div class="w-full flex flex-col ">
                                <label for="description" class="label">Short Description</label>
                                <textarea type="text" name="short_description"  class="textarea">{{ $product->short_description }}</textarea>
                            </div>
                            <p class="ierr"></p>
                        </div>

                        <div class="flex-input">
                            <div class="w-full flex flex-col ">
                                <label for="description" class="label">Description</label>
                                <textarea type="text" name="description" id="editor" class="textarea">{{ $product->description }}</textarea>
                            </div>
                            <p class="ierr"></p>
                        </div>

                        <div class="flex-input">
                            <div class="w-full flex flex-col ">
                                <label for="description" class="label">Shipping & Returns</label>
                                <textarea type="text" name="shipping_returns" id="editor2" class="textarea">{{ $product->shipping_returns }}</textarea>
                            </div>
                            <p class="ierr"></p>
                        </div>    
                         
                        <div class="flex-input">
                            <div class="w-full flex flex-col ">
                                <label for="category" class="label">Select category</label>
                                <select name="category" id="category" class="input">
                                    @if ($categories->isNotEmpty())

                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ ($product->category_id == $category->id ? 'selected' : '') }} >{{ $category->name }}</option>

                                    @endforeach
                                    @endif 
                                </select>
                                <p class="ierr"></p>
                            </div>
                            <div class="w-full flex flex-col ">
                                <label for="brand" class="label">Select Brand (optional)</label>
                                <select name="brand" id="brand" class="input">
                                    @if ($brands->isNotEmpty())
                                    
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"  {{ ($product->brand_id == $brand->id ? 'selected' : '') }} >{{ $brand->name }}</option>

                                    @endforeach
                                    @endif 
                                </select>
                            </div>
                        </div>
                        <div class="flex-input">
                            <div class="w-full flex flex-col">
                                <label for="price" class="label">Price</label>
                                <input type="text" id="price" name="price" value="{{ $product->price }}" placeholder="Enter product Price" class="input">
                                <p class="ierr"></p>
                            </div>
                            <div class="w-full flex flex-col">
                                <label for="compare_price" class="label">Compare Price</label>
                                <input type="text" value="{{ $product->compare_price }}" name="compare_price" placeholder="Enter compare_price" class="input">
                            </div>
                        </div>
                        
                        <div class="flex-input">
                            <div class="w-full flex flex-col ">
                                <label for="sku" class="label">SKU (Stock Keeping units) </label>
                                <input type="text" id="sku" value="{{ $product->sku }}"  name="sku"  placeholder="Enter product SKU" class="input">
                                <p class="ierr"></p>
                            </div>
                            <div class="w-full flex flex-col ">
                                <label for="barcode" class="label">Barcode</label>
                                <input type="text" value="{{ $product->barcode }}"  name="barcode" 
                                id="barcode" placeholder="Enter Barcode" class="input">
                            </div>
                        </div>

                        <div class="flex-input">
                            <div class="w-full flex ">
                                <input type="hidden" name="track_qty" value="No">
                                <input type="checkbox" name="track_qty" value="Yes" id="track_qty" {{ $product->track_qty == 'Yes' ? 'checked' : '' }}>
                                <label for="track_qty" class="label">Track Quantity</label>
                                
                            </div>

                            <div class="w-full flex flex-col ">
                                <label for="qtycheck" class="label">Quantity</label>
                                <input type="number" value="{{ $product->qty }}"  name="qty" 
                                id="qty" placeholder="Enter Qty" class="input">
                                <p class="ierr"></p>
                            </div>
                            
                        </div>

                        <div class="flex-input">
                            <div class="w-full flex flex-col ">
                            <label for="is_featured" class="label">Featured?</label>
                                <select name="is_featured" id="is_featured" class="select">
                                    <option value="Yes" {{ $product->is_featured == 'Yes' ? 'selected' : ''  }} >Yes</option>
                                    <option value="No" {{ $product->is_featured == 'No' ? 'selected' : ''  }} >No</option>
                                </select>   
                            </div>
                            <div class="w-full flex flex-col">
                                <label for="status" class="label">status</label>
                                <select name="status" id="status" class="select">
                                    <option value="0" {{ $product->status == '0' ? 'selected' : ''  }}  >Pending</option>
                                    <option value="1" {{ $product->status == '1' ? 'selected' : '' }} >Published</option>
                                </select>  
                            </div>
                        </div>

                        
                        <div class="flex items-center gap-2 mt-2">
                            <button type="submit" class="btn w-full">Save</button>
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
    toolbar: 'undo redo | bold italic | bullist numlist | link image',
    height: 300, // Specify the height of the editor
  });

  tinymce.init({
    selector: '#editor2',
    plugins: 'lists link image',
    toolbar: 'undo redo | bold italic | bullist numlist | link image',
    height: 300, // Specify the height of the editor
  });
</script>

<script>
    $(document).ready(function(){
        $('#title').change( function() {
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
    $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $('#productForm').submit(function (e) {
        e.preventDefault();

        var formArray = $(this).serializeArray();
        $('button[type=submit]').prop('disabled', true);

        $.ajax({
            url: '{{ route("products.update", $product->id ) }}',
            type: 'put',
            data: formArray,
            dataType: 'json',
            success: function (response) {
                console.log(response);

                $('button[type=submit]').prop('disabled', false);
                if (response.status == true) {
                    window.location.href = "{{ route('admin.products') }}";
                } else {
                    var errors = response.errors;
                    $('.errText').html('');
                    $('input, select').removeClass('invalid');
                    $.each(errors, function (key, value) {
                        $(`#${key}`).addClass('invalid')
                            .siblings('p')
                            .addClass('errText')
                            .html(value);
                    });
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
 });
</script>
<script>

    Dropzone.autoDiscover = false;    
    const dropzone = $("#image").dropzone({ 

        url:  "{{ route('product-images.update') }}",
        maxFiles: 10,
        paramName: 'image',
        params: {'product_id' : '{{ $product->id }}'},
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, success: function(file, response){
            // console.log(response.message);
            // $("#image_id").val(response.image_id);

            var html = `
            <div id="image-row-${response.image_id}">
                <input type="text" name="image_array[]" value="${response.image_id}" hidden>
                <div id="border">
                    <img src="${response.imagePath}" class="sortImage">
                    <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="errBtn">Remove</a>
                </div>
            </div>`;

            $('#rowImg').append(html);
        },
        complete: function(file){
            this.removeFile(file);
        },
        error: function(error){
            console.log(error);
        }
    });


    function deleteImage(id){
        
        $.ajax({
            url: '{{ route("product-images.destroy") }}',
            type: 'delete',
            data:{id: id},
            success: function(response){
                if(response.status == true){
                    $('#image-row-'+id).remove();
                }else{
                    alert(response.message);
                }
            }
        });
    }
    
</script>


@endsection