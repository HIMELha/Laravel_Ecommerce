
@extends('admin.layouts.app')

@section('contents')
<<<<<<< HEAD
=======

    @include('admin.message')
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
       <!-- home start here-->
    <section id="home">
        <!-- main starts here -->
        <section id="main" class="min-h-[98vh] py-3 px-4 mt-12 bg-[#F1F5F9]">
            <div class="max-w-[1200px] mx-auto flex flex-col gap-4">
                    <div class="flex justify-between items-center">
                        <h2 class="py-2 text-slate-700 text-xl">Dashboard <span class="text-blue-600">v1.0</span></h2>
                        <h2 class="py-2 text-slate-700 text-sm">Home / <span class="text-blue-600">Settings</span></h2>
                    </div>

                    <div class="flex flex-col justify-start items-start">
                        <h1 class="text-[16px] text-gray-700 font-medium my-2 py-2"><i class="fa-solid fa-gears mr-2"></i>Manage settings</h1>
                        <div class="flex items-center justify-start">
                            <button id="button1" class="btnactive px-3 py-2 text-[15px] text-slate-700 border-b border-slate-600 ">Primary Settings</button>
                            <button id="button2" class="px-3 py-2 text-[15px] text-slate-700 border-b border-slate-600 ">Front End settings</button>
                            <button id="button3" class="px-3 py-2 text-[15px] text-slate-700 border-b border-slate-600">Profile Settings</button>
                        </div>
                        

<<<<<<< HEAD
                        <div id="page1" class="w-full px-4 py-3 content bg-white border">
=======
                        <div id="page1" class="w-full px-4 py-3 content bg-white border hidden">
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
                            <p>Manage Primary Settings</p>
                            <div class="px-4 mt-4 flex flex-col gap-2">
                                <div class="pb-2 flex justify-between items-center gap-2 border-b border-gray-300">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-gray-800 font-medium">Company News</h3>
                                        <p class="text-[13px] font-thin">Get Themesberg news, announcements, and product updates</p>
                                    </div>
                                    <div>
                                        <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-400 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 border-blue-300"></div>
                                        </label>
                                    </div>
                                </div>

                                <div class="pb-2 flex justify-between items-center gap-2 border-b border-gray-300">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-gray-800 font-medium">Account Activity</h3>
                                        <p class="text-[13px] font-thin">Get important notifications about you or activity you've missed</p>
                                    </div>
                                    <div>
                                        <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-400 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 border-blue-300"></div>
                                        </label>
                                    </div>
                                </div>

                                <div class="pb-2 flex justify-between items-center gap-2 border-b border-gray-300">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-gray-800 font-medium">Buyer review notifications</h3>
                                        <p class="text-[13px] font-thin">Send me an email when someone leaves a review with their rating</p>
                                    </div>
                                    <div>
                                        <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-400 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 border-blue-300"></div>
                                        </label>
                                    </div>
                                </div>

                                <div class="pb-2 flex justify-between items-center gap-2 border-b border-gray-300">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-gray-800 font-medium">Email Notifications</h3>
                                        <p class="text-[13px] font-thin">Send an email reminding me to rate an item a week after purchase</p>
                                    </div>
                                    <div>
                                        <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-400 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 border-blue-300"></div>
                                        </label>
                                    </div>
                                </div>

                                <div class="pb-2 flex justify-between items-center gap-2">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-gray-800 font-medium">New Messages</h3>
                                        <p class="text-[13px] font-thin">Get Themsberg news, announcements, and product updates</p>
                                    </div>
                                    <div>
                                        <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-400 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 border-blue-300"></div>
                                        </label>
                                    </div>
                                </div>
                                <button class="px-4 py-2 w-[200px] bg-blue-400 hover:bg-blue-500 rounded-md text-[15px] text-white">Save Changes</button>
                            </div>
                        </div>
<<<<<<< HEAD
                        <div id="page2" class="w-full px-4 py-3 content bg-white border content hidden">
=======
                        <div id="page2" class="w-full px-4 py-3 content bg-white border  hidden">
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
                            <p>Manage Front Settings</p>
                            <div class="px-4 mt-4 flex flex-col gap-2">
                                <div class="pb-2 flex justify-between items-center gap-2 border-b border-gray-300">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-gray-800 font-medium">User Authentication</h3>
                                        <p class="text-[13px] font-thin">Turn off or on user login Registration</p>
                                    </div>
                                    <div>
                                        <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-400 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 border-blue-300"></div>
                                        </label>
                                    </div>
                                </div>

                                <div class="pb-2 flex justify-between items-center gap-2 border-b border-gray-300">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-gray-800 font-medium">Payment Channel</h3>
                                        <p class="text-[13px] font-thin">Turn off or toggle payment channel</p>
                                    </div>
                                    <div>
                                        <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-400 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 border-blue-300"></div>
                                        </label>
                                    </div>
                                </div>

                                <div class="pb-2 flex justify-between items-center gap-2 border-b border-gray-300">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-gray-800 font-medium">Customer Review</h3>
                                        <p class="text-[13px] font-thin">Recieve Customer Review and Ratings</p>
                                    </div>
                                    <div>
                                        <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-400 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 border-blue-300"></div>
                                        </label>
                                    </div>
                                </div>

                                <div class="pb-2 flex justify-between items-center gap-2 border-b border-gray-300">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-gray-800 font-medium">Notification</h3>
                                        <p class="text-[13px] font-thin">Get notifications from front end and users activities</p>
                                    </div>
                                    <div>
                                        <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-400 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 border-blue-300"></div>
                                        </label>
                                    </div>
                                </div>

                                <div class="pb-2 flex justify-between items-center gap-2">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="text-gray-800 font-medium">Messaging</h3>
                                        <p class="text-[13px] font-thin">Get message notification directly to header bar</p>
                                    </div>
                                    <div>
                                        <label class="relative inline-flex items-center mr-5 cursor-pointer">
                                        <input type="checkbox" value="" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-400 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 border-blue-300"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="pb-2 mb-4 flex justify-start items-center gap-2">
                                    <div class="w-[90%] flex flex-wrap gap-2">
                                        <label for="number" class="label"><i class="fa-solid fa-envelope mr-1"></i>Change Email</label>
                                        <input type="email" name="email" placeholder="Email address" value="example@mail.com" class="input">
                                    </div>
                                </div>
                                <button class="px-4 py-2 w-[200px] bg-blue-400 hover:bg-blue-500 rounded-md text-[15px] text-white">Save Changes</button>
                                </div>
                        </div>
                        
<<<<<<< HEAD
                        <form  id="page3" class="w-full px-4 py-3 content bg-white border content hidden">
=======
                        <form  id="page3" class="w-full px-4 py-3 content bg-white border ">
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
                            <p>Manage Profile  Settings</p>
                            <form action="" class="px-4 py-3 flex flex-col gap-4">
                                <div class="w-full flex justify-between gap-4 md:gap-10">
                                    <div class="w-full flex flex-col gap-2">
                                        <label for="name" class="label"><i class="fa-regular fa-user mr-1"></i>Full Name</label>
                                        <input type="text" name="name" placeholder="Your full name" value="{{ $user->name }}" class="input">
                                    </div>
                                    <div class="w-full flex flex-col gap-2">
                                        <label for="email" class="label"><i class="fa-regular fa-envelope mr-1"></i> Email</label>
                                        <input type="email" name="email" placeholder="Email address" value="{{ $user->email }}" class="input">
                                    </div>
                                </div>
<<<<<<< HEAD
                                <div class="w-full flex justify-between gap-4 md:gap-10">
                                    
=======
                                <div class="w-full flex justify-between gap-4 md:gap-10 mt-4">
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
                                    <div class="w-full flex flex-col gap-2">
                                        <label for="number" class="label"><i class="fa-solid fa-mobile-screen mr-1"></i>Phone number</label>
                                        <input type="number" name="phone" placeholder="Phone " value="{{ $user->phone }}" class="input">
                                    </div>
                                    <div class="w-full flex flex-col gap-2">
                                        <label for="Password" class="label"><i class="fa-solid fa-location-dot mr-1"></i>Password</label>
                                        <input type="password" name="password" placeholder="User Password" value="{{ $user->password }}" class="input">
                                    </div>
                                </div>


                                <button class="px-4 mt-2 py-2 w-[200px] bg-blue-400 hover:bg-blue-500 rounded-md text-[15px] text-white">Save Changes</button>
                            </form>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
        </section>
    </section>  
@endsection

@section('customJs')

    <script>
        $('#page3').submit(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                } 
            });
            $.ajax({
                url: '{{ route('admin.updateProfile') }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response){
                    console.log(response)
                    if(response.status == true){
                        window.location.reload();
                    }else{
                        window.location.reload();
                    }
                }
            })
        })
    </script>

   <script>
        const button1 = document.getElementById('button1');
        const button2 = document.getElementById('button2');
        const button3 = document.getElementById('button3');
        const page1 = document.getElementById('page1');
        const page2 = document.getElementById('page2');
        const page3 = document.getElementById('page3');

        button1.addEventListener('click', () => {
            button1.classList.add('btnactive');
            button2.classList.remove('btnactive');
            button3.classList.remove('btnactive');
            page1.classList.remove('hidden');
            page2.classList.add('hidden');
            page3.classList.add('hidden');
        });

        button2.addEventListener('click', () => {
            button1.classList.remove('btnactive');
            button2.classList.add('btnactive');
            button3.classList.remove('btnactive');
            page1.classList.add('hidden');
            page2.classList.remove('hidden');
            page3.classList.add('hidden');
        });

        button3.addEventListener('click', () => {
            button1.classList.remove('btnactive');
            button2.classList.remove('btnactive');
            button3.classList.add('btnactive');
            page1.classList.add('hidden');
            page2.classList.add('hidden');
            page3.classList.remove('hidden');
        });
   </script>
@endsection