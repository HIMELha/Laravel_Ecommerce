@extends('front.layouts.app')

@section('contents')
        <div class="max-w-[1200px] px-2 flex  justify-between gap-4 mx-auto ">
        <div id="catNav" class="w-[240px] pt-2 bg-light shadow-md   top-0 bottom-0 left-0  z-50 hidden">
          <ul>
            <li class="text-right m-2">
                <buttton id="catclose" class="btn !w-full  cursor-pointer "><i class="fa-solid fa-close"></i></buttton>
            </li>
            @if(getCategories()->isNotEmpty())
            @foreach (getCategories() as $category)
              <li>
              <a href="#">
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


    <!-- main start -->
    <main class="max-w-[1200px] px-2 flex flex-col mx-auto ">
        <div class="flex items-center gap-2 my-4">
            <a href=""><i class="fa-solid fa-house text-red"></i></a> 
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="" class="link">Register</a> 
        </div>
        
        <div class=" flex justify-center items-center mt-6">
          <form id="RegisterUser" action="" method="post" class="px-6 py-8 w-[500px] shadow-sm rounded-sm border-2">
            <h2 class="headerText">Register</h2>
            <p class="text !text-[16px] mb-2">create an account to get all access</p>

             <div class="flex flex-col gap-1 mt-4">
              <label for="name" id="name" class="text-[17px] font-medium text-black">Full Name</label>
              <input type="name" name="name" placeholder="Enter your name" class="input">
              <p></p>
            </div>
            <div class="flex flex-col gap-1 mt-4">
              <label for="email" id="email" class="text-[17px] font-medium text-black">Email Address</label>
              <input type="email" name="email" placeholder="Enter your email" class="input">
              <p></p>
            </div>
            <div class="flex flex-col gap-1 mt-4">
              <label for="phone" id="phone" class="text-[17px] font-medium text-black">Phone Number</label>
              <input type="number" name="phone" placeholder="Enter your phone number" class="input">
              <p></p>
            </div>
            <div class="flex flex-col gap-1 mt-4">
              <label for="password" id="password" class="text-[17px] font-medium text-black">Password</label>
              <input type="password" name="password" placeholder="6 Digit strong password" class="input">
              <p></p>
            </div>
            <div class="flex flex-col gap-1 mt-4">
              <label for="cpassword" id="cpassword" class="text-[17px] font-medium text-black">Confirm Password</label>
              <input type="password" name="cpassword" placeholder="6 Digit strong password" class="input">
              <p></p>
            </div>
            <div class="flex justify-between gap-1 mt-4">
                <label class="flex items-center gap-2 cursor-pointer">
                  <input id="checkbox" type="checkbox" name="checkbox" class="form-checkbox w-4 h-4 text-red bg-red border border-red">
                  <span class="text-[17px] font-medium text-black">I have read & agree with all <a href="" class="link !text-red">terms and conditions</a></span>
                </label>
            </div>
            <b class="red checkboxError"></b>
            <div class="flex justify-between gap-1 mt-4">
              <button type="submit" class="w-full btn">Login</button>
            </div>

            <div class="flex flex-col gap-1 my-6 relative">
              <p class="w-[200px] mx-auto text !text-[16px] text-center  uppercase bg-light px-4 z-20">Or Continue With</p>
              <div class="absolute w-full border-b border-lightest bg-dark top-[10px]">
              </div>
            </div>
            
              <div class="w-full flex justify-around items-center gap-6 mt-4 ">
               <a href=""><button class="px-6 py-2 bg-blue border border-blue text-light rounded-sm hover:bg-white hover:text-blue"><i class="fa-brands fa-facebook-f mr-2"></i>Facebook</button></a>
               <a href=""><button class="px-6 py-2 bg-orange border border-orange text-light rounded-sm hover:bg-white hover:text-orange"><i class="fa-brands fa-google mr-2"></i>Google</button></a>
               <a href=""><button class="px-6 py-2 btn"><i class="fa-regular fa-envelope odd:mr-2"></i>Email</button></a>
              </div>

              <div class="flex justify-center gap-1 mt-6">

               <span class="text !text[17px]">ALready have an Account? <a href="{{ route('front.login') }}" class="link">Login here</a></span>
            </div>
              
            </div>
          </form>
        </div>
    </main>
    <!-- main end -->

@endsection


@section('customJS')

  <script>
    $('#RegisterUser').on('submit', function(e){
      e.preventDefault();
      
      var formData = $(this).serializeArray();
      var checkbox = $("#checkbox");
      
      if(checkbox.is(':checked')){
        $('.checkboxError').hide()
        .html('');
        $.ajax({
          url: "{{ route('front.registerCreate') }}",
          type: 'post',
          data: formData,
          dataType: 'json',
          success: function(response){
            console.log(response)
            if(response.status == false){
              var error = response.errors;
              if(error.name){
                $('#name').siblings('p').html(error.name).css('color', 'red');
              }else{
                $('#name').siblings('p').html('');
              }
              if(error.email){
                $('#email').siblings('p').html(error.email).css('color', 'red');
              }else{
                $('#email').siblings('p').html('');
              }
              if(error.phone){
                $('#phone').siblings('p').html(error.phone).css('color', 'red');
              }else{
                $('#phone').siblings('p').html('');
              }
              if(error.password){
                $('#password').siblings('p').html(error.password).css('color', 'red');
              }else{
                $('#password').siblings('p').html('');
              }
              if(error.cpassword){
                $('#cpassword').siblings('p').html(error.cpassword).css('color', 'red');
              }else{
                $('#cpassword').siblings('p').html('');
              }
            }else if(response.status == true){
              window.location.href = "{{ route('user.account') }}";
            }
          }
        })

      }else{
        $('.checkboxError').show()
        .html('Please read the terms and conditions first').css('color', 'red');
      }




    })
  </script>

@endsection