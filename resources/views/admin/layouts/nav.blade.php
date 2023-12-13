<!-- navbar start here --> 
    <div id="navbar" class="w-[220px] min-h-screen px-4 py-3 bg-[#343A40] flex flex-col justify-start items-start">
                <div class="w-full flex pb-2 items-center justify-center border-b">
                    <img src="{{ asset('admin-assets/src/images/favicon1.png') }}" alt="" class="w-6 h-6"> 
                    <h2 class="w-full text-[18px] text-blue-400 text-center">Admin LTE v1.0</h2>
                    
                </div>
            
                <p class="text-[14px] text-white p-2 mb-2">Primary Menu</p>
                <ul class="w-full flex flex-col justify-center gap-2">
                    <li><a class="menu" href="{{ route('admin.dashboard') }}"><i class="fa-brands fa-laravel text-[15px] mr-2 "></i>Home</a></li>
                    <li><a class="menu" href="{{ route('admin.categories') }}"><i class="fa-solid fa-sitemap text-[15px] mr-2"></i>categories</a></li>
                    <li><a class="menu" href="{{ route('admin.brands') }}"><i class="fa-solid fa-ranking-star text-[15px] mr-2"></i>Brands</a></li>
                    <li><a class="menu" href="{{ route('admin.products') }}"><i class="fa-solid fa-bag-shopping text-[15px] mr-2"></i>products</a></li>
                    <li><a class="menu" href="{{ route('admin.shipping') }}"><i class="fa-solid fa-plane-arrival text-[15px] mr-2"></i>Shipping charge</a></li>
                    <li><a class="menu" href="{{ route('admin.coupons') }}"><i class="fa-solid fa-tags text-[15px] mr-2"></i>Coupon Codes</a></li>
                    <li><a class="menu" href="{{ route('admin.orders') }}"><i class="fa-solid fa-truck-fast text-[15px] mr-2"></i>Orders</a></li>
                    <li><a class="menu" href="{{ route('admin.users') }}"><i class="fa-solid fa-user text-[15px] mr-2"></i>Users</a></li>
                    <li><a class="menu" href="{{ route('admin.pages') }}"><i class="fa-solid fa-file-lines text-[15px] mr-2"></i>Static Pages</a></li>
                    {{--
                    
                    
                    <li><a class="menu" href="{{ route('admin.orders') }}"><i class="fa-solid fa-truck text-[15px] mr-2"></i>orders</a></li>
                    <li><a class="menu" href="{{ route('admin.users') }}"><i class="fa-solid fa-people-group text-[15px] mr-2"></i>users</a></li>
                    <li><a class="menu" href="{{ route('admin.sellers') }}"><i class="fa-solid fa-house-laptop text-[15px] mr-2"></i>manage seller</a></li>
                    <li><a class="menu" href="{{ route('admin.reviews') }}"><i class="fa-solid fa-comment-dots text-[15px] mr-2"></i>reviews</a></li> --}}
                </ul>

                <p class="text-[14px] text-white p-2 mb-2 mt-6">Settings</p>
                <ul class="w-full flex flex-col justify-center gap-1">
                    {{-- <li><a class="menu" href="{{ route('admin.coupons') }}"><i class="fa-solid fa-tags text-[15px] mr-2"></i>coupons</a></li>
                    <li><a class="menu" href="{{ route('admin.tickets') }}"><i class="fa-solid fa-clipboard-list text-[15px] mr-2"></i>tickets</a></li>
                    <li><a class="menu" href="{{ route('admin.profile') }}"><i class="fa-solid fa-address-card text-[15px] mr-2"></i>manage profile</a></li> --}}
                    <li><a class="menu" href="{{ route('admin.settings') }}"><i class="fa-solid fa-gears text-[15px] mr-2"></i>Settings</a></li>
                </ul>
    </div>
    <!-- navbar !start here --> 