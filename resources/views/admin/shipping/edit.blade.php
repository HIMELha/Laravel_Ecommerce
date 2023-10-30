
@extends('admin.layouts.app')

@section('contents')
<div class="px-2 flex justify-center items-center fixed top-0 bottom-0 right-0 left-0 bg-[rgba(0,0,0,0.2)] ">
    <div class="px-6 py-8 w-[600px] flex flex-col justify-center items-center bg-white rounded-md relative">
        <a href="{{ route('admin.shipping') }}"><button class="btn absolute top-3 right-3" id="close"><i class="fa-solid fa-close"></i></button></a>
        <h2 class="text-gray-600 text-[17px]">Edit Shipping Charge</h2>

        <form action="" class="w-full flex flex-col justify-center gap-3 mt-5" id="shippingForm"> 
            @include('admin.message')
            <p class="errBtn hidden"></p>
            <p class="sucBtn hidden" ></p>

            <div class="flex-input">
                <div class="w-full flex flex-col ">
                    <label for="country" class="label">Country name</label>
                    <select name="country" id="country" class="select">
                        <option>Select country</option>
                        @if($shipping->country_id == '999')
                            <option value="999" selected>
                                Rest of the world
                            </option>
                        @else
                        <option value="999">
                            Rest of the world
                        </option>
                        @endif
                        @foreach ($country as $c)
                            <option value="{{ $c->id }}" {{ ($c->id == $shipping->country_id) ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach

                    </select>
                    

                </div>
                <div class="w-full flex flex-col ">
                    <label for="charge" class="label">Shipping charges</label>
                    <input type="text" class="input" name="charge"  value="{{ $shipping->amount }}" placeholder="Shipping charges">
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
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            } 
        });

        $('#shippingForm').submit(function(e){
            e.preventDefault();

            var data = $(this);
            $('button[type=submit]').prop('disabled', true);
            $.ajax({
                url: '{{ route("shipping.update", $shipping->id) }}',
                type: 'post', 
                data: data.serializeArray(),
                dataType: 'json',
                success: function(response){
                    $('button[type=submit]').prop('disabled', false);

                    if(response['status'] == true || response.status == 'available' ){
                        $('.errBtn').hide();
                        window.location.href = "{{ route('admin.shipping') }}";
                    }else if(response['status'] == 'invalid'){
                        window.location.href = "{{ route('admin.shipping') }}";
                    }else{
                        $('.sucBtn').hide();
                        var errors = response['errors']; 
                        if(errors['country']){
                            $('.errBtn').show();
                            $('.errBtn').html(errors['country']);
                        }
                        if(errors['charge']){
                            $('.errBtn').show();
                            $('.errBtn').html(errors['charge']);
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