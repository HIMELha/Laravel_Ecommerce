@extends('front.layouts.app')

@section('contents')
        <div class="max-w-[1200px] px-2  flex  justify-between gap-4 mx-auto">
        <div id="catNav" class="w-[240px] pt-2 bg-light shadow-md absolute md:relative top-0 bottom-0 left-0 hidden md:block z-50">
          <ul>
            <li class="text-right m-2">
                <buttton id="catclose" class="btn !w-full md:hidden cursor-pointer "><i class="fa-solid fa-close"></i></buttton>
            </li>
            @if(getCategories()->isNotEmpty())
            @foreach (getCategories() as $category)
            <li>
              <a href="{{ route('front.products', $category->slug) }}">
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

        <!-- Slider main container -->
        <div class="swiper">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper items-center">
            <!-- Slides -->
            @if($slides->isNotEmpty())
              @foreach ($slides as $item)
              <div class="swiper-slide" style="display: flex; align-items: center; justify-content: center;" >
                  <div class="pb-8 md:pb-0 flex flex-col md:flex-row items-center justify-center ">

                      @php 
                          $productImage = $item->product_images->first();
                      @endphp

                      @if (!empty($productImage->image))
                          <img src="{{ asset('uploads/product/'.$productImage->image.'') }}" alt="" srcset="" class="w-[320px] md:w-[400px]">
                      @else
                          <img src="https://dummyimage.com/250/ffffff/000000" alt="" srcset="" class="w-[320px] md:w-[400px]">
                      @endif

                      <div class="max-w-[300px] px-4 py-2 flex flex-col justify-center items-center md:justify-start md:items-start">
                          <a class="bigNunito" href="{{ route('front.items', $item->slug) }}">{{$item->title}}</a>
                          <span class="text-[15px] text-blu">
                          @php
                            $str = $item->short_description;
                            
                            if($str > 60){
                              $str = substr($str, 0, 60).'...';
                            }
                          @endphp
                          {!! $str !!}
                          </span>
                          <p class="text-green font-['Nunito'] mt-1"><span class="px-2 bg-blue text-light rounded-md"><i class="fa-solid fa-gift"></i></span> ${{ number_format($item->price,2) }}</p>
                          <button onclick="addToCart({{ $item->id }})" class="btn mt-3"><i class="fa-solid fa-circle-plus icon mr-2"></i>Add to Cart</button>
                      </div>
                  </div>
              </div>
              @endforeach
            @else

              <div class="swiper-slide" >
                <div class="pb-8 md:pb-0 flex flex-col md:flex-row items-center justify-center ">
                    <h2 class="bigNunito">No Slides available</h2>
                </div>
            </div>
              
            @endif
            

            {{-- <div class="swiper-slide" >
                <div class="pb-8 md:pb-0 flex flex-col md:flex-row items-center justify-center ">
                    <img src="{{ asset('front-assets/public/images/894efb5ca153f54f35f30380849de8a5.png') }}" alt="" class="w-[320px] md:w-[400px]" />
                    <div class="max-w-[300px] px-4 py-2 flex flex-col justify-center items-center md:justify-start md:items-start">
                        <h2 class="bigNunito">Vivo Note 12</h2>
                        <span class="text-[15px] text-blu">comes with 4GB ram, 129GB storage and powerfull 6000mah Battery</span>
                        <p class="text-green font-['Nunito'] mt-1"><span class="px-2 bg-blue text-light rounded-md">-4%</span> 189.00$</p>
                        <button class="btn mt-3"><i class="fa-solid fa-circle-plus icon mr-2"></i>Add to Cart</button>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="pb-8 md:pb-0 flex flex-col md:flex-row items-center justify-center ">
                    <img src="{{ asset('front-assets/public/images/sofa-1.png') }}" alt="" class="w-[320px] md:w-[400px]" />
                    <div class="max-w-[300px] px-4 py-2 flex flex-col justify-center items-center md:justify-start md:items-start">
                        <h2 class="bigNunito">Sofa for home</h2>
                        <span class="text-[15px] text-blu">comes with 4GB ram, 129GB storage and powerfull 6000mah Battery</span>
                         <p class="text-green font-['Nunito'] mt-1"><span class="px-2 bg-blue text-light rounded-md">-4%</span> 189.00$</p>
                        <button class="btn mt-3"><i class="fa-solid fa-circle-plus icon mr-2"></i>Add to Cart</button>
                    </div>
                </div>
            </div> --}}

          </div>
          <!-- If we need pagination -->
          <div class="swiper-pagination"></div>
        </div>
      </div>
    <!-- main start -->
    <main class="max-w-[1200px] px-2 flex flex-col mx-auto ">

        <div class="mt-12 px-[10%] grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 place-items-center gap-6">
            <div class="w-full md:max-w-[360px] px-5 py-6 flex justify-center gap-6 border border-red rounded-md">
                <img src="{{ asset('front-assets/public/images/delivery-van.svg') }}" alt="">
                <div>
                    <h3 class="text-xl font-medium text-slate-700">Free shipping</h3>
                    <p class="text">Orders over $200</p>
                </div>
            </div>
            <div class="w-full md:max-w-[360px] px-5 py-6 flex justify-center gap-6 border border-red rounded-md">
                <img src="{{ asset('front-assets/public/images/money-back.svg') }}" alt="">
                <div>
                    <h3 class="text-xl font-medium text-slate-700">Money Returns</h3>
                    <p class="text">30 Days money return</p>
                </div>
            </div>
            <div class="w-full md:max-w-[360px] px-5 py-6 flex justify-center gap-6 border border-red rounded-md">
                <img src="{{ asset('front-assets/public/images/service-hours.svg') }}" alt="">
                <div>
                    <h3 class="text-xl font-medium text-slate-700">24/7 Support</h3>
                    <p class="text">Customer support</p>
                </div>
            </div>
        </div>



                <!-- categories starts -->
        <div class="mt-12 px-2 py-4">
          <h2 class="headerText">Trending categories</h2>

          <div class="flex justify-between items-center mt-2">
            <div class="flex justify-center gap-4">
              <button class="px-6 py-[6px] rounded bg-black text-light font-medium border hover:bg-light hover:text-red hover:border-red"><i class="fa-solid fa-circle-left"></i></button>
              <button class="px-6 py-[6px] rounded bg-black text-light font-medium border hover:bg-light hover:text-red hover:border-red"><i class="fa-solid fa-circle-right"></i></button>
            </div>
            <div><a href="{{ route('front.categories') }}" class="link">See More<i class="fa-solid fa-circle-chevron-right ml-2"></i></a></div>
          </div>

          <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5  gap-4 mt-6">
            @if(TrendCategories()->isNotEmpty())
            @foreach (TrendCategories() as $category)
                <div class="py-5 w-full flex flex-col justify-center items-center gap-3 shadow-md rounded-md border">
              <div class="w-[100px] h-[100px] py-2 flex justify-center items-center rounded-full bg-slate-100">
                <a href="{{ route('front.products',$category->slug ) }}"><img src="{{asset('/uploads/category/'.$category->image.'')}}" alt="" class="h-[50px]"></a>
              </div>
              <a href="{{ route('front.products',$category->slug ) }}" class="text-xl font-medium hover:text-hover">{{$category->name}}</a>
            </div>

            @endforeach
            @endif

          </div>

          </div>
        <!-- categories ends -->


        <!-- Discount starts -->
        <div class="mt-12 px-2 py-4">
          <h2 class="headerText">flash sells</h2>
          <div class="flex justify-between items-center mt-2">
            <div class="flex justify-center gap-6">
              <div class="px-6 py-[6px] rounded bg-black text-light font-medium">Time left </div>
              <div class="flex gap-2">
                <div class="w-8 flex justify-center items-center rounded bg-red text-light font-bold">22</div>
                <div class="w-8 flex justify-center items-center rounded bg-red text-light font-bold">40</div>
                <div class="w-8 flex justify-center items-center rounded bg-red text-light font-bold">05</div>
              </div>
            </div>
            <div><a href="{{ route('front.product') }}" class="link">See More<i class="fa-solid fa-circle-chevron-right ml-2"></i></a></div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4  gap-4  mt-6">


            @if ( $featured_product->isNotEmpty())
              @foreach ($featured_product as $fproduct )
            <div class="w-[300px] mx-auto sm:w-[280px]   flex flex-col justify-between shadow-sm border rounded-sm group">
              <div class="py-2 px-6 w-full h-[160px] flex justify-center bg-slate-100 relative">
                <div class="absolute top-0 right-0 w-16 h-8 flex justify-center items-center bg-blue rounded-l-md group-hover:hidden">
                  <p class="text-light ml-1 ">
                      {{ $fproduct->is_featured == 'Yes' ? 'Hot' : 'New'}}
                  </p>
                </div>
                <div class="absolute top-0 right-0 bottom-0 w-full h-full flex justify-center items-center gap-4 bg-[rgba(0,0,0,0.4)] rounded-l-md group-hover:flex hidden">
                  <a href="{{ route('front.items', $fproduct->slug) }}" class="btn"><i class="fa-regular fa-eye"></i></a>
                  <a href="javascript:void(0)"  onclick="addToWishlist({{ $fproduct->id }})" class="btn"><i class="fa-regular fa-heart"></i></a>
                </div>
                @php 
                    $productImage = $fproduct->product_images->first();
                @endphp
                @if (!empty($productImage->image))
                    <img src="{{ asset('uploads/product/'.$productImage->image.'') }}" alt="" srcset="" class="max-h-[145px]">
                @else
                    <img src="https://dummyimage.com/250/ffffff/000000" alt="" srcset="" class="max-h-[145px]">
                @endif

              </div>
              <div class="p-4">
                <a href="{{ route('front.items', $fproduct->slug) }}" class="text-xl text-blu hover:text-hover">{{ $fproduct->title }}</a><br>
                @if($fproduct->compare_price != null)
                    <span class=" text-dark font-bold line-through">${{ $fproduct->compare_price }}</span>
                @endif
                <span class="text-xl text-red font-bold">${{ $fproduct->price }}</span>
                <p class="text-black font-medium">Ratings:
                    {!! reviewAverage($fproduct->id)  !!}
                </p>
              </div>
              <button onclick="addToCart({{ $fproduct->id }})" class="btn text-center uppercase"><i class="fa-solid fa-shopping-cart"></i> Add to cart</button>
            </div>
              @endforeach
            @endif 

          </div>
        </div>
        <!-- Discount end-->



        <!-- banner starts -->
          <div class="mt-12 px-2 py-4">
            <div class="border shadow-sm">
              <img src="{{ asset('front-assets/public/images/offer-3.jpg') }}" alt="">
            </div>
          </div>
        <!-- banner ends-->

        <!-- Recommended starts -->
        <div class="mt-12 px-2 py-4">
          <h2 class="headerText">Recommended PRoducts</h2>

          <div class="flex justify-between items-center mt-2">
            <div class="flex justify-center gap-4">
              <button class="px-6 py-[6px] rounded bg-black text-light font-medium border hover:bg-light hover:text-red hover:border-red"><i class="fa-solid fa-circle-left"></i></button>
              <button class="px-6 py-[6px] rounded bg-black text-light font-medium border hover:bg-light hover:text-red hover:border-red"><i class="fa-solid fa-circle-right"></i></button>
            </div>
            <div><a href="{{ route('front.product') }}" class="link">See More<i class="fa-solid fa-circle-chevron-right ml-2"></i></a></div>
          </div>


          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4  gap-4  mt-6">
           
           
         @if ( $recomended_product->isNotEmpty())
            @foreach ($recomended_product as $fproduct )
            <div class="w-[300px] mx-auto sm:w-[280px]   flex flex-col justify-between shadow-sm border rounded-sm group">
              <div class="py-2 px-6 w-full h-[160px] flex justify-center bg-slate-100 relative">
                <div class="absolute top-0 right-0 w-16 h-8 flex justify-center items-center bg-blue rounded-l-md group-hover:hidden">
                  <p class="text-light ml-1 ">
                      {{ $fproduct->is_featured == 'Yes' ? 'Hot' : 'New'}}
                  </p>
                </div>
                <div class="absolute top-0 right-0 bottom-0 w-full h-full flex justify-center items-center gap-4 bg-[rgba(0,0,0,0.4)] rounded-l-md group-hover:flex hidden">
                  <a href="{{ route('front.items', $fproduct->slug) }}" class="btn"><i class="fa-regular fa-eye"></i></a>
                  <a href="javascript:void(0)"  onclick="addToWishlist({{ $fproduct->id }})" class="btn"><i class="fa-regular fa-heart"></i></a>
                </div>
                @php 
                    $productImage = $fproduct->product_images->first();
                @endphp
                @if (!empty($productImage->image))
                    <img src="{{ asset('uploads/product/'.$productImage->image.'') }}" alt="" srcset="" class="max-h-[145px]">
                @else
                    <img src="https://dummyimage.com/250/ffffff/000000" alt="" srcset="" class="max-h-[145px]">
                @endif
              </div>
              <div class="p-4">
                <a href="{{ route('front.items', $fproduct->slug) }}" class="text-xl text-blu hover:text-hover">{{ $fproduct->title }}</a><br>
                @if($fproduct->compare_price != null)
                    <span class=" text-dark font-bold line-through">${{ $fproduct->compare_price }}</span>
                @endif
                <span class="text-xl text-red font-bold">${{ $fproduct->price }}</span>
                <p class="text-black font-medium">Ratings:
                    {!! reviewAverage($fproduct->id)  !!}
                </p>
              </div>
              <button onclick="addToCart({{ $fproduct->id }})" class="btn text-center uppercase"><i class="fa-solid fa-shopping-cart"></i> Add to cart</button>
            </div>
              @endforeach
          @endif 

          </div>
        </div>
        <!-- Recommended starts -->

        <!-- subscribe -->
        <div class="mt-12 px-2 py-4">
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 md:gap-8 px-4 py-8 bg-slate-100 rounded-md">
          <div class="max-w-[340px]">
            <img src="{{ asset('front-assets/public/images/mobile-view.png') }}" alt="">
          </div>
          <div class="max-w-[400px]">
            <form action="">
              <h2 class="text-2xl font-medium text-black">Download RAFCART App Now!</h2>
              <p class="text mt-2">Shopping fastly and easily more with our app. Get a link to
              download the app on your phone</p>

              <div class="w-full my-8 flex items-center justify-center">
                <input type="email" name="email" placeholder="Email Address" class="w-full py-[10px] px-4 text-black text-[13px] font-light border border-red focus:outline-none rounded-l-md"> <button class="btn !shadow-none">Subscribe</button>
              </div>

              <div class="flex items-start gap-6">
                <img src="images/play.png" alt="" class="w-32">
                <img src="images/play.png" alt="" class="w-32">
              </div>
            </form>
          </div>
        </div>
        </div>
        <!-- subscribe -->
    </main>
    
    <!-- main end -->

@endsection

@section('customJS')
        <script>
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

        });
    </script>
@endsection