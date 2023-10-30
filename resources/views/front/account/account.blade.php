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
            <a href="" class="link">My Account</a> 
        </div>
        
        <div class="grid grid-cols-1  lg:grid-cols-4 items-start gap-4 mt-6 relative">
          
            <div class="flex items-center justify-between gap-4 px-4 py-3 shadow-md rounded-sm border border-light lg:hidden">
                <div class="flex items-center gap-4">
                    <div class=" w-[80px] h-[80px] flex justify-center items-center border border-lightest rounded-full">
                        <img src="{{ asset('front-assets/dist/images/1683873836923.png') }}" alt="" class="max-w-[60px]">
                    </div>
                    <h2 class="bigNunito">{{ Auth::user()->name }}</h2>
                </div>
                <button id="Profilebtn" class="btn-hover"><i class="fa-solid fa-bars"></i></button>
            </div>

          @include('front.layouts.profile-navbar')


            <div class="grid sm:col-span-1 lg:col-span-3 rounded-md">
                <div class="w-[400px] mx-auto md:w-full flex flex-col px-4 sm:px-6 py-8 shadow-md">
                    <h2 class="bigNunito font-medium">Profile Information</h2>

                    <form id="ProfileInfo">
                        <div id="errs"></div>
                        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                            <div class="w-full flex flex-col gap-1 mt-4">
                                <label for="name" class="text-[17px] font-medium text-black">Full Name</label>
                                <input type="name" name="name" value="{{ Auth::user()->name }}" class="input">
                            </div>
                            <div class=" w-full flex flex-col gap-1 mt-4">
                                <label for="email" class="text-[17px] font-medium text-black">Email Address</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}" class="input">
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                            <div class=" w-full flex flex-col gap-1 mt-4">
                                <label for="phone" class="text-[17px] font-medium text-black">Phone</label>
                                <input type="number" name="phone" value="{{ Auth::user()->phone }}" class="input">
                            </div>

                            <div class=" w-full flex flex-col gap-1 mt-4">
                                <label for="password" class="text-[17px] font-medium text-black">Password</label>
                                <input type="password" name="password" class="input">
                            </div>
                        </div>

                        <h3 class="text-min mt-2">Be carefull while changing your password, if you lost your password it will be hard to reset</h3>
                        <div class="w-full flex flex-col gap-1 mt-6">
                               <button class="btn">Update Info</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>
    <!-- main end -->
    

@endsection


@section('customJS')
    <script>
        $('#ProfileInfo').submit(function(e){
            e.preventDefault();

            $.ajax({
            url: '{{ route('user.updateProfile') }}',
            type: 'post',
            data: $(this).serializeArray(),
            datatype: 'json',
            success: function(response){
                console.log(response)
                if(response.status == false){
                    $('#errs').html(response.errors);
                }else{
                    window.location.reload();
                }
            }
        });
        })
</script>
    <script>
        Profilebtn = document.querySelector('#Profilebtn');
        Profilenav = document.querySelector('#Profilenav');
        
        // show hide profilenav
        Profilebtn.addEventListener('click', () => {
            Profilenav.classList.toggle('hidden');
        });

    </script>
@endsection