@extends('front.layouts.app')

@section('contents')
        <div class="max-w-[1200px] px-2 flex  justify-between gap-4 mx-auto">
        <div id="catNav" class="w-[240px] pt-2 bg-light shadow-md  top-0 bottom-0 left-0  z-50 hidden">
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
            <a href="" class="link">Login</a> 
        </div>
        
        <div class=" flex justify-center items-center mt-6">
          <form id="LoginUser"  action="" method="post" class="px-6 py-8 w-[500px] shadow-sm rounded-sm border-2">
            <h2 class="headerText">LOGIN</h2>
            <p class="text !text-[16px] mb-2">Login if you a a returing customer</p>

            <div class="flex flex-col gap-1 mt-4">
              <label for="email"  class="text-[17px] font-medium text-black">Email Address</label>
              <input type="email" id="email" name="email" placeholder="example@mail.com" class="input">
              <p></p>
            </div>
            <div class="flex flex-col gap-1 mt-4">
              <label for="password" class="text-[17px] font-medium text-black">Password</label>
              <input type="password" id="password" name="password" placeholder="example1234" class="input">
              <p></p>
            </div>
            <div class="flex justify-between gap-1 mt-4">
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="checkbox" class="form-checkbox w-4 h-4 text-red bg-red border border-red">
                  <span class="text-[17px] font-medium text-black">Remember me</span>
               </label>

               <a href="forgot.html" class="link">Forgot Password?</a>
            </div>
            
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

               <span class="text !text[17px]">Dont have an Account? <a href="{{ route('front.register') }}" class="link">Create an account</a></span>
            </div>
              
            </div>
          </form>
        </div>
    </main>
    <!-- main end -->

@endsection


@section('customJS')
  <script>
    $('#LoginUser').on('submit', function(e){
      e.preventDefault();
        var formData = $(this).serializeArray();
        $('.checkboxError').hide()
        .html('');
        $.ajax({
          url: "{{ route('front.verifyLogin') }}",
          type: 'post',
          data: formData,
          dataType: 'json',
          success: function(response){
            if(response.status == false){
              var error = response.errors;
              if(error.email){
                $('#email').siblings('p').html(error.email).css('color', 'red');
              }else{
                $('#email').siblings('p').html('');
              }
              if(error.password){
                $('#password').siblings('p').html(error.password).css('color', 'red');
              }else{
                $('#password').siblings('p').html('');
              }
            }else if(response.status == true){
              window.location.href = "{{ route('user.account') }}";
            }else if(response.status == 'redirect'){
              window.location.href = `${response.url}`;
            }else if(response.status = 'invalid'){
              window.location.reload();
            }
          }
        })
    });

  </script>
@endsection