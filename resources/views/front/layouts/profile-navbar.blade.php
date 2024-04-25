
    <div id="Profilenav" class="grid sm:col-span-1 lg:col-span-1 rounded-md absolute top-28 bg-white z-10 hidden largePNav">
        <div  class="flex flex-col gap-4 ">
            <div class="flex items-center justify-between gap-4 px-4 py-3 shadow-md rounded-sm border border-light hidden lg:block">
                <div class="flex items-center gap-4">
                    <div class=" w-[80px] h-[80px] flex justify-center items-center border border-lightest rounded-full">
                        <img src="{{ asset('front-assets/dist/images/1683873836923.png') }}" alt="" class="max-w-[60px]">
                    </div>
                    <h2 class="bigNunito">{{ Auth::user()->name }}</h2>
                </div>
                <button class="btn-hover lg:hidden"><i class="fa-solid fa-bars"></i></button>
            </div>
            
            <div class="flex flex-col  gap-4 px-4 py-3 shadow-md rounded-sm border border-light">
                <h2 class="!text-xl font-medium text-hover"><i class="fa-regular fa-address-card mr-2"></i>Manage account</h2>

                <ul class="flex flex-col gap-2 ml-6">
                    <li><a href="{{ route('user.account') }}" class="link"><i class="fa-solid fa-caret-right mr-1"></i>Profile Information</a></li>
                    <li><a href="{{ route('user.address') }}" class="link"><i class="fa-solid fa-caret-right mr-1"></i>Manage address</a></li>
                </ul>
            </div>

            <div class="flex flex-col  gap-4 px-4 py-3 shadow-md rounded-sm border border-light">
                <h2 class="!text-xl font-medium text-hover"><i class="fa-regular fa-address-card mr-2"></i>Orders & Payments</h2>

                <ul class="flex flex-col gap-2 ml-6">
                    <li><a href="{{ route('user.orders') }}" class="link"><i class="fa-solid fa-caret-right mr-1"></i>Order History</a></li>
                    {{-- <li><a href="payments.html" class="link"><i class="fa-solid fa-caret-right mr-1"></i>Payments</a></li> --}}
                    {{-- <li><a href="my-reviews.html" class="link"><i class="fa-solid fa-caret-right mr-1"></i>Items Reviews</a></li> --}}
                </ul>
            </div>

            <div class="flex flex-col  gap-4 px-4 py-3 shadow-md rounded-sm border border-light">
                <a href="{{ route('user.wishlist') }}" class="!text-xl font-medium hover:text-red"><i class="fa-regular fa-heart mr-2"></i>My Wishlist</a>
            </div>

            <div class="flex flex-col  gap-4 px-4 py-3 shadow-md rounded-sm border border-light">
                <a href="{{ route('user.logout') }}" class="!text-xl font-medium hover:text-red"><i class="fa-solid fa-power-off mr-2"></i>Log Out</a>
            </div>
        </div>
    </div>