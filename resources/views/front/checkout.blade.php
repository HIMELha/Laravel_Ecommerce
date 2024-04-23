@extends('front.layouts.app')

@section('contents')
    <!-- header categories -->
    <div class="max-w-[1200px] px-2 flex  justify-between gap-4 mx-auto">
        <div id="catNav" class="w-[240px] pt-2 bg-light shadow-md  top-0 bottom-0 left-0  z-50 hidden">
            <ul>
            <li class="text-right m-2">
                <buttton id="catclose" class="btn !w-full  cursor-pointer "><i class="fa-solid fa-close"></i></buttton>
            </li>
            @if(getCategories()->isNotEmpty())
            @foreach (getCategories() as $category)
                <li>
                <a href="{{ route('front.products', $category->slug) }}">
                <span class="category"><i class="fa-solid fa-{{$category->name}} text-red"></i>{{$category->name}}</span>
                </a>
            </li>
            @endforeach
            @endif
            <li>
                <a href="#"><span class="category border-none"><i class="fa-solid fa-dice-d6 text-red"></i>Find more</span></a>
            </li>
            </ul>
        </div>
    </div>
    <!-- header categories end -->
    <!-- main start -->
    <main class="max-w-[1200px] px-2 flex flex-col mx-auto ">
        <div class="flex items-center gap-2 my-4">
            <a href=""><i class="fa-solid fa-house text-red"></i></a> 
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="" class="text-hover">Carts</a> 
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="" class="link">Checkout</a> 
        </div>
        
        <form method="post" id="checkout_form">
        <div class="grid grid-cols-1 md:grid-cols-7 lg:grid-cols-3 items-start gap-4 mt-6">
         

            <div class="grid sm:col-span-1 md:col-span-5 lg:col-span-2 rounded-md">
                <div class="w-[400px] mx-auto md:w-full flex flex-col px-4 sm:px-6 py-8 shadow-md">
                    <h2 class="bigNunito font-medium">Billing Details</h2>

                        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                            <div class="w-full flex flex-col gap-1 mt-4">
                                <label for="name" class="text-[17px] font-medium text-black">First Name</label>
                                <input type="name" name="first_name" id="first_name" value="{{ (!empty($CustomerAddress) ? $CustomerAddress->first_name : '') }}" placeholder="First name"  class="input">   
                                <p></p>
                            </div>
                            <div class="w-full flex flex-col gap-1 mt-4">
                                <label for="name" class="text-[17px] font-medium text-black">Last Name</label>
                                <input type="name" name="last_name" id="last_name" placeholder="Last name"  value="{{ (!empty($CustomerAddress) ? $CustomerAddress->last_name : '') }}"  class="input">   
                                <p></p>
                            </div>

                        </div>
                        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                            <div class=" w-full flex flex-col gap-1 mt-4">
                                <label for="email" class="text-[17px] font-medium text-black">Email Address</label>
                                <input type="email" name="email" id="email" placeholder="example@mail.com"  value="{{ (!empty($CustomerAddress) ? $CustomerAddress->email : '') }}"  class="input">   
                                <p></p>
                            </div>
                            <div class=" w-full flex flex-col gap-1 mt-4">
                                <label for="phone" class="text-[17px] font-medium text-black">Phone</label>
                                <input type="number" id="phones" name="phones" placeholder="phone number" value="{{ (!empty($CustomerAddress) ? $CustomerAddress->phone : '') }}"    class="input">   
                                <p> </p>
                            </div>
                        </div>
                    
                        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                            <div class="w-full flex flex-col gap-1 mt-4">
                            <label for="country" class="text-[17px] font-medium text-black">Country</label>
                               <select name="country" class="selects"    
                               id="country" aria-placeholder="Select a country">
                               <option value="0" selected> Select a country </option>
                                @if ($countries->isNotEmpty())
                                    @foreach ($countries as $country)
                                        <option value="{{ (!empty($country) ? $country->id : '' ) }}" {{ (!empty($CustomerAddress && $CustomerAddress->country_id == $country->id) ? 'selected' : '') }} >{{ $country->name }}</option>
                                    @endforeach
                                @endif
                                 <option value="999">Rest of the world</option>
                               </select>
                               <p></p>
                            </div>

                            <div class="w-full flex flex-col gap-1 mt-4">
                                <label for="Address" class="text-[17px] font-medium text-black">Address</label>
                                <input type="name" name="address" id="address" value="{{ (!empty($CustomerAddress) ? $CustomerAddress->address : '') }}" placeholder="Home Address"  class="input">   
                                <p></p>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                            <div class="w-full flex flex-col gap-1 mt-4">
                                <label for="town" class="text-[17px] font-medium text-black">Town/City</label>
                                <input type="name" name="city" id="city" placeholder="Town OR  City"  
                                value="{{ (!empty($CustomerAddress) ? $CustomerAddress->city : '') }}" class="input">   
                                <p></p>
                            </div>
                            <div class=" w-full flex flex-col gap-1 mt-4">
                                <label for="code" class="text-[17px] font-medium text-black">Zip/Postal code</label>
                                <input type="number" name="zip" id="zip" placeholder="Zip/Postal code" 
                                value="{{ (!empty($CustomerAddress) ? $CustomerAddress->zip : '') }}" class="input">   
                                <p></p>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                            <div class="w-full flex flex-col gap-1 mt-4">
                                <label for="shipping" class="text-[17px] font-medium text-black">Shiping area or state</label>
                                <input type="text" name="state" id="state" value="{{ (!empty($CustomerAddress) ? $CustomerAddress->state : '') }}" placeholder="Shiping area"  class="input">   
                                <p></p>
                            </div> 
                            
                            <div class="w-full flex flex-col gap-1 mt-4">
                                <label for="shipping" class="text-[17px] font-medium text-black">Apartment</label>
                                <input type="text" name="apartment" id="apartment" placeholder="Appartment name" value="{{ (!empty($CustomerAddress) ? $CustomerAddress->apartment : '') }}"  class="input">   
                                <p></p>
                            </div> 
                        </div>

                        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                            <div class="w-full flex flex-col gap-1 mt-4">
                                <label for="shipping" class="text-[17px] font-medium text-black">Add a note</label>
                                <input type="text" name="notes" id="notes" placeholder="Add a notes"  class="input">   
                                <p></p>
                            </div> 
                        </div>
                </div>
            </div>


           <div class="grid sm:col-span-1 md:col-span-2 lg:col-span-1 mt-6">
                <div class="p-5 mb-2 flex flex-col gap-4 border border-lightest rounded-md">
                    <div class="flex items-center gap-4 border-b pb-3 border-lightest">
                    <h2 class="bigNunito font-medium">Product Lists</h2>
                    </div>

                    <div class="w-full flex flex-col gap-2">
                        @foreach (Cart::content() as $item)
                            <div class="flex justify-between items-center">
                                <h2 class="text-[18px] font-medium text-black">{{ $item->name }} <span class="text-blu font-medium">x{{ $item->qty }}</span></h2>
                                
                                <p class="text !text-[17px]">${{ $item->price * $item->qty }}</p>
                            </div>
                        @endforeach
                    </div>
                    

                    
                    <div class="flex flex-col gap-2">
                            <div class="flex justify-between items-center">
                                <h2 class="text-[19px] font-medium text-black">Shipping charge</h2>
                                
                                <b class="text !text-[17px]" id="ShippingCharge" >${{ number_format($ShippingCharge,2) }}</b>
                            </div>

                            <div class="flex justify-between items-center">
                                <h2 class="text-[19px] font-medium text-black" id="discountTexts" ></h2>
                                
                                <b class="text red !text-[17px]" id="discountAmount"></b>
                            </div>


                            <div class="flex justify-between items-center">
                                <h2 class="text-[19px] font-medium text-black">Subtotal + shipping</h2>
                                
                                <b class="text !text-[17px]" id="grandTotal">${{ number_format($grandTotal,2) }}</b>
                            </div>

                            
                    </div>

                    <div class="flex justify-center items-center">
                        <input type="text" name="text" id="Coupon" placeholder="8 Digit Coupon code" class="px-3 py-2 w-40 lg:w-full focus:outline-red border-2 border-blue rounded-l-sm">
                        <button id="ApplyDiscount" class="btn">Apply</button>
                    </div>

                    <div class="flex justify-center items-center gap-2 " id="tappers">
                        <b id="btbts"></b>
                    </div>

                </div>
                <br>
                <div class="p-5 flex flex-col gap-4 border border-lightest rounded-md">
                    <div class="flex items-center gap-4 border-b pb-3 border-lightest">
                    <h2 class="bigNunito font-medium">Payment Method</h2>
                    </div>

                    <div class="flex flex-col justify-between gap-1">
<<<<<<< HEAD
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" checked name="cod" class="form-checkbox w-4 h-4 text-red bg-red border border-red" id="pay_one">
                            <span class="text-[17px] font-medium text-black">Cash on delivery</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="stripe" class="form-checkbox w-4 h-4 text-red bg-red border border-red" id="pay_two">
                            <span class="text-[17px] font-medium text-black">Stripe</span>
                        </label>

                        
                        <div class="flex flex-col justify-between gap-2 mt-2 hidden"  id="card_box" >
=======
                        {{-- <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="homeDel" class="form-checkbox w-4 h-4 text-red bg-red border border-red" id="pay_one">
                            <span class="text-[17px] font-medium text-black">Cash on delivery</span>
                        </label> --}}
                        {{-- <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="stripe" class="form-checkbox w-4 h-4 text-red bg-red border border-red" id="pay_two">
                            <span class="text-[17px] font-medium text-black">Stripe</span>
                        </label> --}}

                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" checked name="payment_method" value="bkash" class="form-checkbox w-4 h-4 text-red bg-red border border-red" id="pay_one">
                            <span class="text-[17px] font-medium text-black">Bkash Payment</span>
                        </label>
                        
                        {{-- <div class="flex flex-col justify-between gap-2 mt-2 hidden"  id="card_box" >
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
                            <label for="card_number" class="text-[18px] font-medium text-black">Card number</label>
                            <input type="text" class="input"    
                            name="card_number" placeholder="Valid Card Number">
                            <div class="flex justify-between gap-2">
                    
                                <input type="text" style="width: 45%" class="input"    
                                name="card_number" placeholder="exp date">

                                <input type="text" style="width: 45%" class="input"    
                                name="card_number" placeholder="CCV Date">

                            </div>
<<<<<<< HEAD
                        </div>
=======
                        </div> --}}
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
                    </div>
                    
                    <div class="flex justify-between  mt-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="password" placeholder="example1234" class="form-checkbox w-4 h-4 text-red bg-red border border-red">
                            <span class="text-[17px] font-medium text-black">I agree with <a href="" class="link !text-red">terms and conditions</a></span>
                        </label>
                    </div>
                    
<<<<<<< HEAD
=======
                    <p id="payment_error"></p>

>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
                    <button class="btn-hover">Procced To Checkout</button>
                </div>
           </div>
        </div>
        </form> 
        
        
        
    </main>
    <!-- main end -->
@endsection

@section('customJS')

    <script>
        $('#ApplyDiscount').click(function(e){
            e.preventDefault();

            $.ajax({
                url: '{{ route('front.applyDiscount') }}',
                type: 'post',
                data: {code: $('#Coupon').val(), country: $('#country').val()},
                dataType: 'json',
                success: function(response){
                    if(response.status == true){
                        $('#ShippingCharge').html('$'+response.shippingCharge);
                        var rest = response.grandTotal;
                        $('#discountTexts').html('Coupon discount');
                        $('#discountAmount').html('$'+response.discount);
                        $('#tappers').html(response.discountString);
                        $('#grandTotal').html('$'+rest);
                        $('#Coupon').val = '';
                        
                    }else{
                        $('#tappers').addClass('red').html(response.errors);
                        $('#discountTexts').html('');
                        $('#discountAmount').html('');
                        
                    }
                }
            })
        })
    </script>

    <script>
        
        function removeCoupon(){

            $.ajax({
                url: '{{ route('front.removeDiscount') }}',
                type: 'post',
                data: {country: $('#country').val()},
                dataType: 'json',
                success: function(response){
                    if(response.status == true){
                        $('#ShippingCharge').html('$'+response.shippingCharge);
                        var rest = response.grandTotal;
                        $('#discountTexts').html('');
                        $('#discountAmount').html('');
                        $('#tappers').html('');
                        $('#grandTotal').html('$'+rest);
                    }
                }
            })
        }
        
    </script>

    <script>

        $('#pay_one').click(function(){
            if($(this).is(":checked") == true){
                $('#card_box').addClass('hidden');
            }
            $('#pay_two').prop("checked", false);
        })

        $('#pay_two').click(function(){
            if($(this).is(":checked") == true){
                $('#card_box').removeClass('hidden');
            }else{
                $('#card_box').addClass('hidden');
            }
            $('#pay_one').prop("checked", false);
        })

        $('#checkout_form').submit(function(e){
            e.preventDefault();

            var country = $('#country').val();

            if(country == 0){
                 $('#country').addClass('invalid').siblings('p').addClass('red').html('Please select your country');
            }

            $('button[type="submit"]').prop('disabled', true);
            $.ajax({
                url:'{{ route('front.processCheckout') }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response){

                $('button[type="submit"]').prop('disabled', false);

                var errors = response.errors;

                if(response.status == false){
                    if(errors.first_name){
                        $('#first_name').addClass('invalid').siblings('p').addClass('red').html(errors.first_name);
                    }else{
                        $('#first_name').removeClass('invalid').siblings('p').removeClass('red').html('');
                    }
                    if(errors.last_name){
                        $('#last_name').addClass('invalid').siblings('p').addClass('red').html(errors.last_name);
                    }else{
                        $('#last_name').removeClass('invalid').siblings('p').removeClass('red').html('');
                    }

                    if(errors.email){
                        $('#email').addClass('invalid').siblings('p').addClass('red').html(errors.email);
                    }else{
                        $('#email').removeClass('invalid').siblings('p').removeClass('red').html('');
                    }

                    if(errors.phones){
                        $('#phones').addClass('invalid').siblings('p').addClass('red').html(errors.phones);
                    }else{
                        $('#phones').removeClass('invalid').siblings('p').removeClass('red').html('');
                    }

                    if(errors.country){
                        $('#country').addClass('invalid').siblings('p').addClass('red').html(errors.country);
                    }else{
                        $('#country').removeClass('invalid').siblings('p').removeClass('red').html('');
                    }

                    if(errors.address){
                        $('#address').addClass('invalid').siblings('p').addClass('red').html(errors.address);
                    }else{
                        $('#address').removeClass('invalid').siblings('p').removeClass('red').html('');
                    }

                    if(errors.city){
                        $('#city').addClass('invalid').siblings('p').addClass('red').html(errors.city);
                    }else{
                        $('#city').removeClass('invalid').siblings('p').removeClass('red').html('');
                    }

                    if(errors.zip){
                        $('#zip').addClass('invalid').siblings('p').addClass('red').html(errors.zip);
                    }else{
                        $('#zip').removeClass('invalid').siblings('p').removeClass('red').html('');
                    }

                    if(errors.state){
                        $('#state').addClass('invalid').siblings('p').addClass('red').html(errors.state);
                    }else{
                        $('#state').removeClass('invalid').siblings('p').removeClass('red').html('');
                    }
<<<<<<< HEAD
                }else{
                    window.location.href = "{{ url('/thanks/') }}/"+response.orderId;
=======

                }else if(response.status == 'payment_error'){
                     $('#payment_error').addClass('red').html(response.payment_error);
                }else if(response.status == true){
                    
                    var responseJson = JSON.stringify(response);
                    var url = "{{ route('bkash-create-payment') }}?data=" + encodeURIComponent(responseJson);
                    window.location.href = url;
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
                }

                }
            })
        })

        $('#country').change(function(){
            $.ajax({
                url: '{{ route('front.getOrderSummery') }}',
                type: 'post',
                data: {country: $(this).val()},
                dataType: 'json',
                success: function(response){
                    if(response.status == true){
                        $('#ShippingCharge').html('$'+response.shippingCharge);
                        $('#grandTotal').html('$'+response.grandTotal);
                    }
                }
            })
        });
    </script>
@endsection