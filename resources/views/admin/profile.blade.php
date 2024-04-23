
@extends('admin.layouts.app')

@section('contents')
    <!-- home start here-->
    <section id="home">
      <!-- main starts here -->
      <section id="main" class="min-h-[98vh] py-3 px-4 mt-12 bg-[#F1F5F9]">
        <div class="max-w-[1200px] mx-auto flex flex-col gap-4">
          <div class="flex justify-between items-center">
            <h2 class="py-2 text-slate-700 text-xl">
              Dashboard <span class="text-blue-600">v1.0</span>
            </h2>
            <h2 class="py-2 text-slate-700 text-sm">
              Home / <span class="text-blue-600">Profile</span>
            </h2>
          </div>
          <h2 class="text-[18px] text-[#1C2434]"><i class="fa-solid fa-gears mr-2"></i>Profile Settings</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 items-start gap-6 lg:gap-8">
                <div class="grid md:col-span-2 bg-white border border-gray-300">
                    <p class="px-4 py-3 text-gray-600 text-[15px] font-medium border-b border-gray-300">Personal Information</p>
                    <form action="" class="px-4 py-3 flex flex-col gap-4">
                        <div class="w-full flex justify-between gap-4 md:gap-10">
                            <div class="w-full flex flex-col gap-2">
                                <label for="name" class="label"><i class="fa-regular fa-user mr-1"></i> Full Name</label>
                                <input type="text" name="name" placeholder="Your full name" value="{{ $user->name }}" class="input">
                            </div>
                            <div class="w-full flex flex-col gap-2">
                                <label for="email" class="label"><i class="fa-regular fa-envelope mr-1"></i> Email</label>
                                <input type="text" name="name" placeholder="Email address" value="{{ $user->email }}" class="input">
                            </div>
                        </div>
                        <div class="w-full flex justify-between gap-4 md:gap-10">
                            <div class="w-full flex flex-col gap-2">
                                <label for="number" class="label"><i class="fa-solid fa-mobile-screen mr-1"></i>Phone number</label>
                                <input type="number" name="number" placeholder="Email address" value="{{ $user->phone }}" class="input">
                            </div>
                        </div>

                        <a href="{{ route('admin.settings') }}" class="btn text-center">Update</a>
                    </form>
                </div>

                <div class="grid md:col-span-1 bg-white border border-gray-300">
                    <p class="px-4 py-3 text-gray-600 text-[15px] font-medium border-b border-gray-300">Update Password</p>
                    <form action="" class="px-4 py-3">
                        <div class="w-full flex flex-col gap-4">
                            <div class="w-full flex flex-col gap-2">
                                <label for="password" class="label"><i class="fa-solid fa-lock mr-1"></i>New password</label>
                                <input type="password" name="name" placeholder="Email address" value="12345678" class="input">
                            </div>
                            <div class="w-full flex flex-col gap-2">
                                <label for="password" class="label"><i class="fa-solid fa-lock mr-1"></i>Confirm password</label>
                                <input type="password" name="name" placeholder="Email address" value="12345678" class="input">
                            </div>

                            <a href="{{ route('admin.settings') }}" class="btn text-center">Update</a>

                        </div>
                    </form>
                </div>
          </div>
        </div>
      </section>
    </section>
@endsection

@section('customJs')

@endsection