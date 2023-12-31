<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('admin-assets/dist/output.css') }}" rel="stylesheet">
    <meta name="description" content="AdminLte is an open source admin dashboard">
    <meta property="og:title" content="AdminLte v1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminLte v1.0 dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('admin-assets/src/images/favicon1.png') }}">
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="overflow-x-hidden">

   <!-- home start here-->
    <section id="home">
        <!-- main starts here -->
        <section id="main" class="min-h-[98vh] py-3 px-4 bg-[#F1F5F9]">
            <div class="max-w-[1200px] mx-auto flex flex-col gap-4">

                        <div class="px-2 flex justify-center items-center fixed top-0 bottom-0 right-0 left-0 bg-[rgba(0,0,0,0.6)]">
                            <div class="px-6 py-8 w-[500px] flex flex-col justify-center items-center bg-white rounded-md relative">
                                <h2 class="text-gray-600 text-[17px]">Login to Admin</h2>

                                <form action="{{ route('admin.authenticate') }}" method="POST"  class="w-full flex flex-col justify-center gap-3 mt-5">
                                    @csrf
                                    
                                    @if(Session::has('error'))
                                    <p class="btnred">  {{  Session::get('error') }}</p>
                                    @endif
                                    <div class="flex-input">
                                        <div class="w-full flex flex-col ">
                                            <label for="Email" class="label">Email</label>
                                            <input type="text" name="email" placeholder="Enter Email" class="input">
                                        </div>
                                        <div class="w-full flex flex-col ">
                                            <label for="Password" class="label">Password</label>
                                            <input type="Password" name="password" placeholder="Enter Password" class="input">
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                       <button type="submit" class="btn w-full !py-3">Login</button>
                                    </div>

                                    <div class="flex-input">
                                        <div class="w-full flex flex-col relative">
                                            <p class="w-[180px] md:w-fit mx-auto text-[15px] text-slate-600  px-1 bg-white text-center z-10">Or Continue with</p>
                                            <div class="absolute top-3 border w-full border-gray-400 "></div>
                                        </div>
                                        <div class="w-full flex flex-col ">
                                            <button class="flex items-center justify-center gap-2 py-2 px-2 text-[15px] text-gray-600 font-medium bg-white rounded-sm border border-orange-500  hover:bg-orange-400 hover:text-white transition-all cursor-pointer" disabled>
                                                <img src="{{ asset('admin-assets/src/images/google.png') }}" alt="" srcset="" class="w-5 h-5">
                                                Google</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </section>   

