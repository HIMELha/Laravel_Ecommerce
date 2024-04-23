
@extends('admin.layouts.app')

@section('contents')
<div class="px-2 flex justify-center items-center fixed top-0 bottom-0 right-0 left-0 bg-[rgba(0,0,0,0.2)] ">
    <div class="px-6 py-8 w-[600px] flex flex-col justify-center items-center bg-white rounded-md relative">
        <a href="{{ route('admin.coupons') }}"><button class="btn absolute top-3 right-3" id="close"><i class="fa-solid fa-close"></i></button></a>
        <h2 class="text-gray-600 text-[17px]">Update coupon code</h2>

        <form action="" class="w-full flex flex-col justify-center gap-3 mt-5" id="discountForm" > 
            <p class="errBtn hidden"></p>
            <p class="sucBtn hidden" ></p>
            
            <div class="flex-input">
                <div class="w-full flex flex-col ">
                    <label for="code" class="label">Coupon code</label>
                    <input type="text" name="code" id="code" value="{{ $coupon->code }}"  placeholder="Enter coupon code" class="input">
                    <p></p>
                </div>
                
                <div class="w-full flex flex-col ">
                    <label for="name" class="label">Coupon name</label>
                    <input type="text" name="name" id="name" value="{{ $coupon->name }}"  placeholder="Enter name" class="input" >
                   <p></p> 
                    
                </div>
            </div>

            <div class="flex-input">
                <div class="w-full flex flex-col ">
                    <label for="max_uses" class="label">Max uses</label>
                    <input type="number" name="max_uses" id="max_uses" value="{{ $coupon->max_uses }}"  placeholder="Max uses" class="input" >
                   <p></p> 
                </div>
            </div>

            <div class="flex-input">
                <div class="w-full flex flex-col ">
                    <label for="max_uses_user" class="label">Max uses for user</label>
                    <input type="number" name="max_uses_user" id="max_uses_user" value="{{ $coupon->max_uses_user }}"  placeholder="Max uses for user" class="input">
                    <p></p>
                </div>
                <div class="w-full flex flex-col ">
                    <label for="type" class="label">Coupon type</label>
                    <select name="type" id="type" class="select">
                        <option value="parcent"  {{ ($coupon->type == 'parcent') ? 'selected' : '' }}>Parcent</option>
                        <option value="fixed"  {{ ($coupon->type == 'fixed') ? 'selected' : '' }}>Fixed</option>
                    </select>
                </div>
            </div>
            <div class="w-full flex flex-col ">
                    <label for="description" class="label">Enter description</label>
                    <textarea type="text" name="description" id="description" value="{{ $coupon->description }}"  placeholder="Enter description" class="input"></textarea>
                    <p></p>
            </div>

            <div class="flex-input">
                <div class="w-full flex flex-col ">
                    <label for="discount_amount" class="label">Discount amount</label>
                    <input type="number" name="discount_amount" id="discount_amount" value="{{ $coupon->discount_amount }}"  placeholder="Enter discount amount" class="input">
                    <p></p>
                </div>
                <div class="w-full flex flex-col ">
                    <label for="min_amount" class="label">Min amount</label>
                    <input type="number" name="min_amount" id="min_amount" value="{{ $coupon->min_amount }}"  placeholder="Minimum amount" class="input" >
                   <p></p> 
                </div>
            </div>

            <div class="flex-input">
                <div class="w-full flex flex-col ">
                    <label for="starts_at" class="label">Starts at</label>
                    <input type="datetime-local" id="starts_at"  value="{{ $coupon->starts_at }}" name="starts_at"  class="input" >
                   <p></p> 
                </div>
                <div class="w-full flex flex-col ">
                    <label for="expires_at" class="label">Expires at</label>
                    <input type="datetime-local" name="expires_at" value="{{ $coupon->expires_at }}" id="expires_at" class="input">
                    <p></p>
                </div>
            </div>

            <div class="flex-input">
                <div class="w-full flex flex-col ">
                    <label for="name" class="label">status</label>
                    <select name="status" id="" class="select">
                        <option value="1" {{ ($coupon->status == 1) ? 'selected' : '' }} >Active</option>
                        <option value="0" {{ ($coupon->status == 0) ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
            </div>


            <div class="flex items-center gap-2">
                <button type="submit" class="btn w-full">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('customJs')

<script>
    const datetimePicker = document.getElementById("starts_at");

    // Create a JavaScript Date object with the desired date and time
    const defaultDate = new Date('2023-10-25 12:00:00');

    // Format the date as required (Y-m-d H:i:s)
    const formattedDate = defaultDate.toISOString().slice(0, 16);

</script>
<script>
    const datetimePicker2 = document.getElementById("expires_at");

    // Create a JavaScript Date object with the desired date and time
    const defaultDate2 = new Date('2023-10-25 12:00:00');

    // Format the date as required (Y-m-d H:i:s)
    const formattedDate2 = defaultDate2.toISOString().slice(0, 16);

</script>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            } 
        });

        $('#discountForm').submit(function(e){
            e.preventDefault();
            var data = $(this);

            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: '{{ route("coupons.update", $coupon->id) }}',
                type: 'post', 
                data: data.serializeArray(),
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    $('button[type=submit]').prop('disabled', false);

                    if(response['status'] == true){
                        window.location.href = '{{ route("admin.coupons") }}';
                    } else {
                        $('.sucBtn').hide();
                        var errors = response['errors']; 
                        if(errors['code']){
                           $('#code').addClass('invalid').siblings('p').addClass('errText').html(errors.code);
                        }else{
                            $('#code').removeClass('invalid').siblings('p').removeClass('errText').html('');
                        }
                        if(errors['name']){
                           $('#name').addClass('invalid').siblings('p').addClass('errText').html(errors.name);
                        }else{
                            $('#name').removeClass('invalid').siblings('p').removeClass('errText').html('');
                        }
                        if(errors['discount_amount']){
                            $('#discount_amount').addClass('invalid').siblings('p').addClass('errText').html(errors.discount_amount);
                        }else{
                             $('#discount_amount').removeClass('invalid').siblings('p').removeClass('errText').html('');
                        }
                        if(errors['status']){
                            $('#status').addClass('invalid').siblings('p').addClass('errText').html(errors.type);
                        }else{
                             $('#status').removeClass('invalid').siblings('p').removeClass('errText').html('');
                        }
                        if(errors['status']){
                             $('#status').addClass('invalid').siblings('p').addClass('errText').html(errors.status);
                        }else{
                             $('#status').removeClass('invalid').siblings('p').removeClass('errText').html('');
                        }
                        if(errors['starts_at']){
                             $('#starts_at').addClass('invalid').siblings('p').addClass('errText').html(errors.starts_at);
                        }else{
                             $('#starts_at').removeClass('invalid').siblings('p').removeClass('errText').html('');
                        }

                        if(errors['expires_at']){
                             $('#expires_at').addClass('invalid').siblings('p').addClass('errText').html(errors.expires_at);
                        }else{
                             $('#expires_at').removeClass('invalid').siblings('p').removeClass('errText').html('');
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