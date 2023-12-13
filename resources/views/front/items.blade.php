@extends('front.layouts.app')

@section('contents')
    <!-- header categories -->
    <div class="max-w-[1200px] px-2 flex  justify-between gap-4 mx-auto">
        <div id="catNav" class="w-[240px] pt-2 bg-light shadow-md  top-0 bottom-0 left-0  z-50 hidden">
            <ul>
            <li class="text-right m-2">
                <buttton id="catclose" class="btn !w-full  cursor-pointer "><i class="fa-solid fa-close"></i></buttton>
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
    </div>

    <!-- header categories end -->

    <!-- main start -->
    <main class="max-w-[1200px] px-2 flex flex-col mx-auto ">
        <div class="flex items-center gap-2 my-4">
            <a href="{{ route('front.index') }}"><i class="fa-solid fa-house text-red"></i></a> 
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="{{ route('front.products', productCategory($product->category_id)->slug) }}" class="text-[15px] text-red">{{productCategory($product->category_id)->name}}</a> 
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="{{ route('front.items', $product->slug) }}" class="link">{{$product->title}}</a> 
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 ">
            <div class="flex flex-col">
                <div class="w-full h-[500px] flex justify-center items-center border bg-slate-100 rounded-sm ">
                      
                  @php 
                      $productImage = $product->product_images->first();
                  @endphp
                  @if (!empty($productImage->image))
                      <img src="{{ asset('uploads/product/' . $productImage->image) }}" alt="" id="MainImg" class="max-w-[400px] h-[400px]">  
                  @else
                      <img src="https://dummyimage.com/250/ffffff/000000" alt="" srcset="" class="max-w-[400px]">
                  @endif

                </div>
                <div class="grid grid-cols-4 gap-3 mt-3" id="imagesList">
                    @if ($product->product_images)
                        @foreach ($product->product_images as $image)
                            <div class="w-full h-[100px] flex justify-center items-center bg-slate-100 border" id="imgdiv">
                                <img src="{{ asset('uploads/product/'.$image->image.'') }}" alt="" class="max-w-[70px] max-h-20">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="flex flex-col justify-start">
                <h2 class="text-2xl py-2 text-black font-medium uppercase">{{$product->title}}</h2>
                <div class="flex">
                    <p class="text-black font-medium">Ratings:
                    {!! reviewAverage($product->id) !!}
                    <span class="text">({{ $reviews->count() }})</span>
                </p>
                </div>

                <div class="flex flex-col mt-4 gap-2">
                    <h3 class="text-black font-medium">Available: 
                    @if($product->qty > 0)
                        <span class="font-medium text-green">In Stock</span>
                    @else
                        <span class="font-medium text-red">Out Of Stock</span>
                    @endif
                    </h3>
                  
                    <h3 class="text-black font-medium">Category: <span class="font-normal text-blu">{{productCategory($product->category_id)->name}}</span></h3>
                    
                    @if(!empty(productBrand($product->brand_id)))
                      <h3 class="text-black font-medium">Brand: <span class="font-normal text-blu">
                      {{productBrand($product->brand_id)->name}}</span></h3>
                      @endif
                    <h3 class="text-black font-medium">Items Price</h3>
                    <div class="flex items-center">
                        @if ($product->compare_price > 0)
                        <span class=" text-dark font-bold line-through">${{$product->compare_price}}</span>
                        @endif
                        <span class="text-xl text-red font-bold ml-2">${{$product->price}}</span>
                        
                    </div>
                    <p class="text mt-2">
                        {!!$product->short_description !!}
                    </p>

                    <div class="flex flex-col mt-2">
                        <h2 class="text-black font-medium">Color</h2>
                        <div class="flex mt-1 gap-2">
                            <div class="w-6 h-6 bg-red rounded-sm border border-light hover:outline hover:outline-red"></div>
                            <div class="w-6 h-6 bg-green rounded-sm border border-light hover:outline hover:outline-green"></div>
                            <div class="w-6 h-6 bg-blue rounded-sm border border-light hover:outline hover:outline-blue"></div>
                        </div>
                    </div>

                    <div class="flex flex-col mt-2">
                        <h2 class="text-black font-medium">Quantity</h2>
                        <div class="w-min shadow-md flex mt-1 gap-2 border ">
                           <div class="px-2 py-1 hover:bg-slate-100 border-r"><i class="fa-solid fa-minus"></i></div>
                           <div class="px-2 py-1">1</div>
                           <div class="px-2 py-1 hover:bg-slate-100 border-l"><i class="fa-solid fa-plus"></i></div>
                        </div>
                    </div>

                    <div class="flex justify-start gap-6 mt-4 pb-4  border-b">
                        <button  onclick="addToCart({{ $product->id }})" class="btn uppercase"><i class="fa-solid fa-circle-plus mr-2"></i>Add to cart</button>
                        <button class="btn-hover uppercase"  onclick="addToWishlist({{ $product->id }})"><i class="fa-regular fa-heart mr-2"></i>Add Wishlist</button>
                    </div>

                    <div class="flex justify-start gap-3">
                        <a href="#"><button class="w-10 h-10 flex justify-center items-center  rounded-full border hover:bg-slate-100"><i class="fa-brands fa-facebook-f"></i></button></a>
                        <a href="#"><button class="w-10 h-10 flex justify-center items-center rounded-full border hover:bg-slate-100"><i class="fa-brands fa-twitter"></i></button></a>
                        <a href="#"><button class="w-10 h-10 flex justify-center items-center rounded-full border hover:bg-slate-100"><i class="fa-brands fa-vk"></i></button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-10">
        <div class="container">
          <div class="border-b">
            <button onclick="showPage('page1')" class="btn-hover ">Product Info</button>
            <button onclick="showPage('page3')" class="btn-hover ">Shiping and Returns</button>
            <button onclick="showPage('page2')" class="btn-hover ">Reviews</button>
          </div>
    
          <div class="pages">
            <div class="page  mt-2" id="page1">
              <h2 class="bigNunito mb-2">More about This product</h2>
              <div class="flex flex-col justify-start">
                    {!! $product->description !!}
              </div>
            </div>

            <div class="page  hidden mt-2" id="page3">
              <h2 class="bigNunito mb-2">Shiping and Returns Policy</h2>
              <div class="flex flex-col justify-start">
                    {!! $product->shipping_returns !!}
              </div>
            </div>
            <div class="page hidden mt-2" id="page2">
              <h2 class="bigNunito mb-2">Customer Reviews</h2>
              <div class="flex flex-col max-w-[600px] justify-center mt-6 gap-6">

              @if($reviews->isNotEmpty())
                @foreach ($reviews as $review)
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between">
                            <a href="" class="link mr-2">
                                @php
                                    $user = \App\Models\User::where('id', $review->user_id)->first();
                                @endphp
                                {{ $user->name }}
                            </a>
                            <p class="text-black font-medium">Ratings:
                               @php
                                $rate = '';
                                $rating = $review->ratings;
                                for($i =1; $i <= $rating; $i++){
                                    $rate .= '<i class="fa-solid fa-star text-gold"></i>';
                                }
                               @endphp
                                {!! $rate !!}
                                on <span>{{ date_format($review->created_at, 'd/M/Y H:iA') }}</span>
                            </p> 
                        </div>
                        <p class="text">{{ $review->review }}</p>
                    </div>
                @endforeach
              @else
              <h2 class="bigNunito py-2">Write the first review for this product</h2>
              @endif

              @auth
                  <form id="ReviewForm" class="flex flex-col gap-2">
                  <h2 class="text-min">Rate this product</h2>
                  <div id="star-rating">
                    <!-- Star icons will be added here using JavaScript -->
                    </div>
                
                <div id="rating-value">Rating: <span id="selected-rating">0</span>/5 </div><b></b>
                  <label for="review" class="label">Say something about this product</label>
                  <textarea name="review" id="reviewe" placeholder="Write review here...." class="w-full h-[100px] px-3 py-2 border border-blue focus:outline-none"></textarea>
                    <p></p>
                  <button class="btn" type="submit">Submit Review</button>
                </form>
              @endauth

              @guest
                <h2 class="bigNunito">Please login to submit review</h2>
                <div>
                    <a href="{{ route('front.login') }}" class="btn">Login</a> OR <a href="{{ route('front.login') }}" class="btn-hover">Register</a>
                </div>
              @endguest
            </div>
            </div>

          </div>

        </div>
      </div>

      <div class="flex flex-col mt-16">
        <h2 class="headerText">Products May You like</h2>
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4  gap-4  mt-6">
      {{-- @if($relatedalt_product != null)
        @foreach ($related_product as $fproduct )
            <div class="w-[300px] mx-auto sm:w-[280px]   flex flex-col justify-between shadow-sm border rounded-sm group">
              <div class="py-2 px-6 w-full h-[160px] flex justify-center bg-slate-100 relative">
                <div class="absolute top-0 right-0 w-16 h-8 flex justify-center items-center bg-blue rounded-l-md group-hover:hidden">
                  <p class="text-light ml-1 ">
                      {{ $fproduct->is_featured == 'Yes' ? 'Hot' : 'New'}}
                  </p>
                </div>
                <div class="absolute top-0 right-0 bottom-0 w-full h-full flex justify-center items-center gap-4 bg-[rgba(0,0,0,0.4)] rounded-l-md group-hover:flex hidden">
                  <a href="{{ route('front.items', $fproduct->slug) }}" class="btn"><i class="fa-regular fa-eye"></i></a>
                  <a href="javascript:void(0)" onclick="addToWishlist({{ $fproduct->id }})" class="btn"><i class="fa-regular fa-heart"></i></a>
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
                    <i class="fa-solid fa-star text-gold"></i>
                    <i class="fa-solid fa-star text-gold"></i>
                    <i class="fa-solid fa-star text-gold"></i>
                    <i class="fa-regular fa-star-half-stroke text-gold"></i>
                    <i class="fa-solid fa-star text-gold"></i>
                </p>
              </div>
              <button onclick="addToCart({{ $fproduct->id }})" class="btn text-center uppercase"><i class="fa-solid fa-shopping-cart"></i> Add to cart</button>
            </div>
        @endforeach
      @endif --}}
      
        @if($related_product != null)
        @foreach ($relatedalt_product as $fproduct )
            <div class="w-[300px] mx-auto sm:w-[280px]   flex flex-col justify-between shadow-sm border rounded-sm group">
              <div class="py-2 px-6 w-full h-[160px] flex justify-center bg-slate-100 relative">
                <div class="absolute top-0 right-0 w-16 h-8 flex justify-center items-center bg-blue rounded-l-md group-hover:hidden">
                  <p class="text-light ml-1 ">
                      {{ $fproduct->is_featured == 'Yes' ? 'Hot' : 'New'}}
                  </p>
                </div>
                <div class="absolute top-0 right-0 bottom-0 w-full h-full flex justify-center items-center gap-4 bg-[rgba(0,0,0,0.4)] rounded-l-md group-hover:flex hidden">
                  <a href="{{ route('front.items', $fproduct->slug) }}" class="btn"><i class="fa-regular fa-eye"></i></a>
                  <a href="javascript:void(0)" onclick="addToWishlist({{ $fproduct->id }})" class="btn"><i class="fa-regular fa-heart"></i></a>
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

      
     
    </main>
    <!-- main start -->

@endsection

@section('customJS')

    <script>
        $('#ReviewForm').submit(function(e){
            e.preventDefault();
            const stars = document.querySelector('#selected-rating').innerHTML;

            $.ajax({
                url: '{{ route('front.storeReview') }}',
                type: 'post',
                data: {review: $('#reviewe').val(), stars: stars, product_id: {{$product->id}}},
                dataType: 'json',
                success: function(response){
                    if(response.status == false){
                        var err = response.errors;
                        if(err.review){
                            $('#reviewe').siblings('p').addClass('text-red font-bold').html(err.review);
                        }else{
                            $('#reviewe').siblings('p').removeClass('text-red').html('');
                        }
                        if(err.stars){
                            $('#rating-value').siblings('b').addClass('text-red').html(err.stars);
                        }else{
                            $('#rating-value').siblings('b').removeClass('text-red').html('');
                        }
                    }else{
                        window.location.reload();
                    }
                }
            })
        })
    </script>

    <script>
        // Number of stars
        const maxRating = 5;
        
        // Initialize the selected rating
        let selectedRating = 0;
        
        const starRating = document.getElementById('star-rating');
        const ratingValue = document.getElementById('rating-value');
        const stars = [];

        // Create star elements and add them to the page
        for (let i = 1; i <= maxRating; i++) {
            const star = document.createElement('span');
            star.classList.add('star');
            star.setAttribute('data-rating', i);
            star.innerHTML = '★';
            
            star.addEventListener('click', () => {
            selectedRating = i;
            updateRating();
            });

            stars.push(star);
            starRating.appendChild(star);
        }

        // Update the rating display
        function updateRating() {
            for (let i = 0; i < maxRating; i++) {
            if (i < selectedRating) {
                stars[i].classList.add('selected');
            } else {
                stars[i].classList.remove('selected');
            }
            }
            ratingValue.innerHTML = `Rating: <span id="selected-rating">${selectedRating}</span>/5`;
        }
    </script>


    <script>

        var mainImage = document.getElementById('MainImg');
        const imagesDiv = document.querySelectorAll('#imagesList #imgdiv');
            console.log(imagesDiv)

            imagesDiv.forEach((div) =>{
                div.addEventListener('click', function(){

                    imagesDiv.forEach((othersDiv) => {
                        othersDiv.classList.remove('border-red');
                    })

                    div.classList.add('border-red');
                    const img = div.querySelector('img');
                    mainImage.src = img.src;
                });
            });

    </script>
@endsection