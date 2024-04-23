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
   <!-- header starts here -->
    <header class="bg-gray-600">
        <div class="mx-auto flex justify-between items-center sm:px-4">
            <div class="p-2 flex items-center gap-2 sm:gap-4">
                <i id="navToggler" class="fa-solid fa-bars text-[16px] text-white cursor-pointer"></i>
<<<<<<< HEAD
                <h2 class="text-[18px] text-white font-bold">LotoBD</h2>
=======
                <h2 class="text-[18px] text-white font-bold">Laravel Shop</h2>
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
                <a href="{{ route('admin.dashboard') }}" class="text-[14px] text-white font-thin">Home</a>
            </div>
            <div id="headerIcons" class="p-2 flex items-center">
                <p class="text-white font-light mr-2">Hello, </p>
                <div class="flex items-center sm:gap-2 relative">
                    
                    <button id="profileBtn" class="flex items-center gap-2 py-2">
                        <div class="flex-col hidden sm:block sm:flex"><p class="text-white text-[12px]">{{ $admin->name }}</p></div>
                        {{-- <span class="text-[10px] text-white font-light">Web Developer</span> --}}
                        {{-- <img src="images/profile.jpg" alt="" class="profile"> --}}
                        <i id="arrow" class="fa-solid fa-angle-down text-white text-[14px] mr-4"></i>
                    </button>
                    <div class="profileMenu">
                        <ul>
                            <li class="mt-2 mb-1"><a href="{{ route('admin.profile') }}" class="menu text-[14px]"><i class="fa-solid fa-user-shield mr-2"></i>My Profile</a></li>
                            <li class="mb-2"><a href="{{ route('admin.settings') }}" class="menu text-[14px]"><i class="fa-solid fa-gear mr-2"></i>Account Settings</a></li>
                            <hr>
                            <li class="mt-2"><a href="{{ route('admin.logout') }}" class="menu text-[14px]"><i class="fa-solid fa-right-from-bracket mr-2"></i>Sign out</a></li>
                        </ul>
                    </div>
                </div>

                <div class="relative">
                    <i id="notifyBtn" class="fa-solid fa-bell text-[16px] text-white cursor-pointer"></i><div id="notify"><span>4</span></div>
                </div>
                <!-- notfications -->
                    <div id="notifyNav" class="w-[200px] px-2 pt-3 pb-1 bg-[#24303F] absolute top-[48px] right-0">
                        <p class="text px-4">Notfications</p>
                        <ul class="mt-2 flex flex-col gap-1">
                            <li class="p-2 border border-orange-600 rounded-sm">
                                <p class="text-xs text-white"><i class="fa-solid fa-circle-exclamation mr-1 text-red-300"></i>Payment gatway reached to limit <span class="text-[10px] text-slate-300 text-right">12:11PM on 16/8/2023 </span></p>   
                            </li>
                            <li class="p-2 border border-green-600 rounded-sm">
                                <p class="text-xs text-white"><i class="fa-regular fa-circle-check mr-1 text-green-300"></i>last 2hour 4,900+ page views <span class="text-[10px] text-slate-300 text-right">12:11PM on 16/8/2023 </span></p>   
                            </li>

                            <li class="p-2 border border-blue-600 rounded-sm">
                                <p class="text-xs text-white"><i class="fa-solid fa-clipboard-check mr-1 text-sky-300"></i>Your site has reached to 1 million views <span class="text-[10px] text-slate-300 text-right">12:11PM on 16/8/2023 </span></p>   
                            </li>

                            <li class="p-2 border border-yellow-600 rounded-sm">
                                <p class="text-xs text-white"><i class="fa-solid fa-skull-crossbones mr-1 text-red-400"></i>87 spam user detected in last 2hour<span class="text-[10px] text-slate-300 text-right">12:11PM on 16/8/2023 </span></p>   
                            </li>
                            <a href="notifications.html" class="text-[13px] text-sky-300 text-center hover:underline">All notfication</a>
                        </ul>
                    </div>
                <!-- !notfications -->
                <div class="relative">
                    <i id="msgBtn" class="fa-solid fa-envelope ml-6 text-[16px] text-white cursor-pointer"></i><div id="notify"><span>6</span></div>
                </div>
                    <!-- messages -->
                    <div id="msgNav" class="w-[200px] px-2 pt-3 pb-1 bg-[#24303F] absolute top-[48px] right-0">
                        <div class="px-4 flex justify-between items-center">
                            <p class="text !px-0">Messages</p>
                            <i class="fa-solid fa-gear text-gray-100 cursor-pointer"></i>
                        </div>
                        <ul class="mt-2 flex flex-col gap-1">

                        <li class="p-2 border border-blue-600 rounded-sm">
                            <div class="flex justify-start items-center gap-2">
                                <img src="{{ asset('admin-assets/src/images/php.png')}}" alt="" class="profile">
                                <div class="flex flex-col">
                                    <p class="text-xs text-white">Have 1 new message</p>
                                    <span class="text-[10px] text-slate-300 text-right">2 min ago</span>   
                                </div>
                            </div>
                        </li>
                        <a href="messages.html" class="text-[13px] text-sky-300 text-center hover:underline">All message</a>
                        </ul>
                    </div>
                <!-- !messages -->
                <i id="fullscreenBtn" class="fa-solid fa-expand mx-2 sm:ml-6 text-[16px] text-white cursor-pointer"></i>
            </div>
        </div>
    </header>
   <!-- header !starts here d -->

    @include('admin.layouts.nav') 

    @yield('contents')

    <!-- scripts -->
    <script src="{{ asset('admin-assets/src/js/script.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    

    <script>

        const notifications = document.querySelector(".notifications"),
        buttons = document.querySelectorAll(".buttons .btn");

        const toastDetails = {
            timer: 5000,
            success: {
                icon: 'fa-circle-check',
                text: `{{ Session::get('message') }} `,
            },
            error: {
                icon: 'fa-circle-xmark',
                text: `{{ Session::get('error') }}`,
            }
        }

        const removeToast = (toast) => {
            toast.classList.add("hide");
            if(toast.timeoutId) clearTimeout(toast.timeoutId);
            setTimeout(() => toast.remove(), 500); 
        }

        const createToast = (id) => {
            const { icon, text } = toastDetails[id];
            const toast = document.createElement("li");
            toast.className = `toast ${id}`; 
            toast.innerHTML = `<div class="column">
                                <i class="fa-solid ${icon}"></i>
                                <span>${text}</span>
                            </div>
                            <i class="fa-solid fa-xmark" onclick="removeToast(this.parentElement)"></i>`;
            notifications.appendChild(toast);
            toast.timeoutId = setTimeout(() => removeToast(toast), toastDetails.timer);
        }
        buttons.forEach(btn => {
            createToast(btn.id);
        });
    </script>

    
    @yield('customJs')
</body>
</html>
