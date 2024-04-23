<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('front-assets/style.css') }}" rel="stylesheet" />
    <!-- Include jQuery first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Then include jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- font awesome cdn -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- swiper js -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />

    @yield('styles')
  </head>
  <body class="overflow-x-hidden">
<<<<<<< HEAD
    @php
      $settings = \App\Models\Setting::first();
    @endphp
=======
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
    <!-- header start -->
    <header>
      <div class="max-w-[1200px] px-2 flex flex-col mx-auto">
        <div class="py-3 flex justify-between items-center gap-2 bg-white">
          <div class="flex justify-between items-center relative">
<<<<<<< HEAD
            <a href="{{ route('front.index') }}"
              class=" text-2xl font-medium text-black rounded-sm"
              >
              <img src="{{ asset('uploads/settings/'.$settings->logo) }}" class="h-10 " style="width: 100%" alt="">
            </a>
            
            <ul class="ml-4 gap-5 mdNav">
=======
            <a
              href="{{ route('front.index') }}"
              class="px-2 py-1 text-2xl font-medium text-black rounded-sm"
              ><img src="{{ asset('front-assets/public/images/download (1).png') }}" class="h-10 " style="width: 100px" alt=""></a>
            
            <ul class="ml-4 md:ml-16 gap-5 mdNav">
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
              <button id="btnClose" class="btn cursor-pointer md:hidden"><i class="fa-solid fa-close"></i></button>
              <li><a href="{{ route('front.index') }}" class="link">Home </a></li>
              <li>
                <a href="{{ route('front.product') }}" class="link">Shop</i></a>
              </li>
              <li class="group relative">
                <a href="#" class="link">Pages<i class="fa-solid fa-chevron-down icon"></i></a>
                <div class="dropdown w-[500px] hidden group-hover:block transition z-20">
                  <div class="flex justify-between items-start gap-6">
                    <ul>
                      <h2 class="text-[19px] font-medium text-dark py-2 underline">Others pages</h2>
                      <li><a href="{{ route('pages.details', 'About us') }}" class="link mt-3">About Us</a></li>
                      <li><a href="{{ route('pages.details', 'Contact us') }}" class="link mt-3">Contact Us</a></li>
                      <li><a href="{{ route('pages.details', 'FAQ') }}" class="link mt-3">Faq</a></li>
                    </ul>
                    <ul>
                      <h2 class="text-[19px] font-medium text-dark py-2 underline">Account pages</h2>
                      <li><a href="{{ route('user.account') }}" class="link mt-3">My account</a></li>
                      <li><a href="{{ route('front.login') }}" class="link mt-3">Login</a></li>
                      <li><a href="{{ route('front.register') }}" class="link mt-3">Register</a></li>
                      <li><a href="{{ route('front.login') }}" class="link mt-3">Forgot password</a></li>
                    </ul>

                    <ul>
                      <h2
                      class="text-[19px] font-medium text-dark py-2 underline">
                      checkout pages</h2>
                      <li><a href="{{ route('user.wishlist') }}" class="link mt-3">Wish List</a></li>
                      <li><a href="{{ route('user.orders') }}" class="link mt-3">Order completed</a></li>
                    </ul>
                  </div>
                </div>
              </li>
              <li><a href="{{ route('pages.details', 'Contact us') }}" class="link">Contact</a></li>
            </ul>
          </div>

          <div class="">
            <div class="flex items-center gap-3">
                <buttton id="mdNavBtn" class="btn md:hidden cursor-pointer "><i class="fa-solid fa-list"></i></buttton>
                <button id="smNavBtn" class="btn lg:hidden"><i class="fa-regular fa-circle-down"></i></button>
            </div>
<<<<<<< HEAD
            <ul id="smNav" class="w-[250px] absolute right-2 top-14 flex flex-col px-4 py-3 ml-16 gap-4 bg-slate-100 rounded-sm z-20 hidden largeNav">
              @guest
                <li><a href="{{ route('front.login') }}" class="link">Login</a></li>
                <li><a href="{{ route('front.register') }}" class="link">Register</a></li>
              @else
                <li><a href="{{ route('user.account') }}" class="link">Account</a></li>
                <li><a href="{{ route('user.orders') }}" class="link">Orders</a></li>
=======
            <ul id="smNav" class="w-[250px] absolute right-2 top-14 flex flex-col px-4 py-3 ml-16 gap-4 bg-lightest z-20 hidden largeNav">
              @guest
                <li><a href="{{ route('front.login') }}" class="link">Login</a></li>
                <li><a href="{{ route('front.register') }}" class="link">Register</a></li>
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
              @endguest
              <li>
                <select
                  name="lang"
                  id=""
                  class="text-dark border-none focus:outline-none link cursor-pointer"
                >
                  <option
                    value="Language"
                    disabled
                    class="font-semibold text-dark bg-slate-200 border-none"
                  >
                    Language
                  </option>
                  <option
                    value="Language"
                    class="text-dark bg-slate-200 border-none"
                  >
                    English
                  </option>
                  <option
                    value="Language"
                    class="text-dark bg-slate-200 border-none"
                  >
                    Bangla
                  </option>
                </select>
              </li>
              <li>
                <select
                  name="lang"
                  id=""
                  class="text-dark border-none focus:outline-none link cursor-pointer"
                >
                  <option
                    value="Currency"
                    disabled
                    class="font-semibold text-dark bg-slate-200 border-none"
                  >
                    Currency
                  </option>
                  <option
                    value="Language"
                    class="text-dark bg-slate-200 border-none"
                  >
                    USD
                  </option>
                  <option
                    value="Language"
                    class="text-dark bg-slate-200 border-none"
                  >
                    BDT
                  </option>
                </select>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="w-full py-2 bg-blu">
        <div
          class="max-w-[1200px] px-2 flex justify-between items-center mx-auto"
        >
          <div>
            <button id="catbtn" class="headBtn w-[200px]">
              <i class="fa-solid fa-bars-staggered mr-2"></i>All categories
            </button>
          </div>
          <form method="get" action="{{ route('front.product') }}" class="flex items-center hidden md:block">
            <input
              type="text"
              name="search"
              id="searchs"
              placeholder="Search products..."
              class="px-3 py-2 mr-[-4px] text-[16px] rounded-l-sm text-dark focus:outline-none"
            />
            <button class="headBtn">
              <i class="fa-solid fa-search mr-1"></i>search
            </button>
          </form>

<<<<<<< HEAD
          <div class="flex items-center justify-center gap-4 sm:gap-6 relative">
=======
          <div class="flex items-center justify-center gap-8 relative">
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
            <a href="{{ route('user.wishlist') }}">
              <button
                class="flex flex-col justify-center items-center relative"
              >
                <span
                  class="flex justify-center items-center absolute top-[-6px] right-0 w-5 h-5 text-[14px] bg-red text-light rounded-full"
                  >{{ (wishlistCount() > 0) ? wishlistCount() : 0 }}</span
                >
                <i class="fa-regular fa-heart text-light text-[25px]"></i>
                <p class="text-light text-[11px]">Wish List</p>
              </button>
            </a>

            <a href="{{ route('front.carts') }}">
              <button
                class="flex flex-col justify-center items-center relative"
              >
                <span
                  class="flex justify-center items-center absolute top-[-6px] right-0 w-5 h-5 text-[14px] bg-red text-light rounded-full"
                  >{{ (Cart::content()->count() > 0) ? Cart::content()->count() : 0  }}</span
                >
                <i class="fa-solid fa-cart-shopping text-light text-[25px]"></i>
                <p class="text-light text-[11px]">Carts</p>
              </button>
            </a>

              <button
               id="accBtn" class="flex flex-col justify-center items-center "
              >
                <i class="fa-regular fa-user text-light text-[25px]"></i>
                <p class="text-light text-[11px]">Account</p>
              </button>

<<<<<<< HEAD
            <div id="account" class="w-[240px] absolute top-16 right-0 px-4 py-3 bg-white shadow-md rounded-sm hidden z-50">
              @guest
                <h3 class="font-medium">Wellcome to, LotoBD</h3>
=======
            <div id="account" class="w-auto absolute top-16 px-4 py-3 bg-white shadow-md rounded-sm hidden z-50">
              @guest
                <h3 class="font-medium">Wellcome to, Shop</h3>
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
                <div class="flex justify-between gap-4 mt-3" >
                    <a href="{{ route('front.login') }}"><button class="btn">Login</button></a>
                    <a href="{{ route('front.register') }}"><button class="btn-hover">SignUp</button></a>
                </div>
              @endguest

              @auth
                <h3 class="font-medium">Hello {{ Auth::user()->name }}</h3>
                <div class="flex flex-col justify-start gap-2 mt-6">
                    <a href="{{ route('user.account') }}" class="link"><i class="fa-regular fa-address-card mr-2"></i>My Account</a>
                    <a href="{{ route('user.orders') }}" class="link"><i class="fa-solid fa-gift mr-2"></i>My Orders</a>
                    <a href="{{ route('user.payments') }}" class="link"><i class="fa-solid fa-gift mr-2"></i>My Payments</a>
                    <a href="{{ route('user.wishlist') }}" class="link"><i class="fa-regular fa-heart mr-2"></i>My Wish Lists</a>
                    <a href="{{ route('front.carts') }}" class="link"><i class="fa-solid fa-shopping-cart mr-2"></i>My Cart</a>
                    <a href="{{ route('user.logout') }}" class="link"><i class="fa-solid fa-power-off mr-2"></i>Logout</a>
                </div>  
              @endauth

              

            </div>
          </div>
        </div>
      </div>

    </header>
    <!-- header end -->

      @yield('contents')
    <!-- footer start -->

    <footer class="mt-12 px-2 py-4 bg-gray-200">
      <div class="max-w-[1200px] px-2 flex flex-col mx-auto">
        <div class="py-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

          <div class="grid">
            <div class="flex flex-col sm:flex-row lg:flex-col items-center gap-3">
              <div>
<<<<<<< HEAD
                <a href="{{ route("front.index") }}" class="px-2 py-1 text-2xl font-medium text-black rounded-sm">Loto<span class="text-red text-3xl">BD</span></a>
              <p class="text">Your premier destination for online lottery play. Experience the thrill of global lotteries, convenient ticket purchasing, and real-time results—all in one place. Join us for a chance to turn your dreams into reality!</p>
=======
                <a href="#" class="px-2 py-1 text-2xl font-medium text-black rounded-sm">LARABEL<span class="text-red text-3xl">SHOP</span></a>
              <p class="text">Lorem ipsum, or lipsum as it is sometimes kno wn, is dummy text used in laying out print, gra phic or web designs the passage.</p>
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
              </div>

              <div class="w-full">
              <h2 class="text-xl font-medium uppercase">Newslater</h2>
              <div class="flex items-center">
                <input type="email" name="email" placeholder="Email Address" class="py-[10px] px-4 mr-[-4px] text-black text-[13px] font-light border border-red focus:outline-none rounded-l-md"> <button class="btn !shadow-none">Subscribe</button>
              </div>
              </div>
            </div>
          </div>
          
          <div class="flex flex-row justify-between sm:justify-start gap-4">
            <div class="flex flex-col gap-2">
              <h2 class="text-xl font-medium uppercase mb-2">MY ACCOUNT</h2>
              <a href="{{ route('user.orders') }}" class="link"><i class="fa-solid fa-angle-right mr-1"></i>Orders</a>
              <a href="{{ route('user.wishlist') }}" class="link"><i class="fa-solid fa-angle-right mr-1"></i>Wishlist</a>
              <a href="{{ route('user.orders') }}" class="link"><i class="fa-solid fa-angle-right mr-1"></i>Track Orders</a>
              <a href="{{ route('user.account') }}" class="link"><i class="fa-solid fa-angle-right mr-1"></i>Manage Account</a>
              <a href="{{ route('user.orders') }}" class="link"><i class="fa-solid fa-angle-right mr-1"></i>Return Order</a>
            </div>

            <div class="flex flex-col gap-2">
              <h2 class="text-xl font-medium uppercase mb-2">INFORMATION</h2>
              <a href="{{ route('pages.details', 'About us') }}" class="link"><i class="fa-solid fa-angle-right mr-1"></i>About us</a> 
              <a href="{{ route('pages.details', 'Refund Policy') }}" class="link"><i class="fa-solid fa-angle-right mr-1"></i>Return Policy</a>
              <a href="{{ route('pages.details', 'Terms & Conditions') }}" class="link"><i class="fa-solid fa-angle-right mr-1"></i>Terms & Conditions</a>
              <a href="{{ route('pages.details', 'Privacy Policy') }}" class="link"><i class="fa-solid fa-angle-right mr-1"></i>Privacy Policy</a>
              <a href="{{ route('pages.details', 'FAQ') }}" class="link"><i class="fa-solid fa-angle-right mr-1"></i>FAQ</a>
            </div>
          </div>

          <div class="flex lg:justify-center">
            <div class="flex flex-col gap-2">
              <h2 class="text-xl font-medium uppercase mb-2">CONTACT</h2>
              <ul>
<<<<<<< HEAD
                <li class="mb-2"><i class="fa-solid fa-location-dot mr-3 text"></i> <span class="text">Rangpur, Kurigram</span></li>
                <li class="mb-2"><i class="fa-solid fa-phone mr-3 text"></i> <span class="text">+880 1747760521</span></li>
                <li class="mb-2"> <i class="fa-regular fa-envelope mr-3 text"></i> <span class="text">webhimel032@mail.com</span></li>
=======
                <li class="mb-2"><i class="fa-solid fa-location-dot mr-3 text"></i> <span class="text">11 Mirpur, Dhaka</span></li>
                <li class="mb-2"><i class="fa-solid fa-phone mr-3 text"></i> <span class="text">+880 183234034</span></li>
                <li class="mb-2"> <i class="fa-regular fa-envelope mr-3 text"></i> <span class="text">webhimel12@mail.com</span></li>
>>>>>>> 80d99c3af56bc02a7f1fa0fd0d577fa511db1ab9
              </ul>
            </div>
          </div>

        </div>

      </div>
    </footer>

    <div class="px-2 bg-blu">
    <div class="max-w-[1200px] mx-auto px-2 py-2 flex justify-between items-center ">
      <div class="py-2 flex justify-between bg-blu ">
         <p class="text-sm text-light font-medium font-['Nunito'] hover:text-hover uppercase">© All Rights Are Reserved</p> 
      </div>

      <div>
        <img src="{{ asset('front-assets/public/images/payment-method.png') }}" alt="" class="h-6">
      </div>
    </div>

    @include('admin.message')


    <!-- javascript files -->
    <script src="{{ asset('front-assets/public/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
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

    <script>
      function addToCart(id){
          $.ajax({
              url: '{{ route("front.addToCart") }}',
              type: 'post',
              data: {id: id},
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(response){
                console.log(response);
                  if(response.status == true){
                      window.location.reload();
                  }else{
                    window.location.reload();
                  }
              },
              error: function(error){
                console.log(error);
              }
          });
      }

      function addToWishlist(id){

        $.ajax({
            url: '{{ route('front.addToWishlist') }}',
            type: 'post',
            data: {id:id},
            datatype: 'json',
            success: function(response){
              if(response.status == true){
                window.location.reload();
              }else if(response.status == 'exists' || response.status == 'notFound'){
                window.location.reload();
              }else if(response.status == false){
                window.location.href = '{{ route('front.login') }}';
              }
            }
        });

      }
    </script>

    <script>
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    </script>
    @yield('customJS')
  </body>
</html>
