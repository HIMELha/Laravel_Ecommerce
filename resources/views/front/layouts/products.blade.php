                @if($products->isNotEmpty())
                    @foreach ($products as $product)
                        <div class="w-full mt-3  sm:w-1/2   lg:w-1/3 p-4 flex-col items-center gap-2 border rounded-md relative group">
                        <div class="w-full h-[220px] flex justify-center items-center bg-[#F3F3F3] relative group-hover:bg-[rgba(0,0,0,0.2)] group-hover:z-10">
                            
                            @php 
                                $productImage = $product->product_images->first();
                            @endphp

                            @if (!empty($productImage->image))
                                <img src="{{ asset('uploads/product/'.$productImage->image.'') }}" alt="" srcset="" class=" max-h-[200px] sm:max-h-[145px] ">
                            @else
                                <img src="https://dummyimage.com/250/ffffff/000000" alt="" srcset="" class="max-h-[145px]">
                            @endif

                            @if($product->is_featured == 'Yes')
                            <div class="absolute top-0 left-0">
                                <h2 class="px-4 py-2 text-light bg-red rounded-br-md">Featured</h2>
                            </div>
                            @endif
                            
                            <div class="absolute flex gap-4 items-center hidden group-hover:flex transition">
                                <a href="{{ route('front.items', $product->slug) }}">
                                    <div class="w-10 h-10 flex justify-center items-center bg-blue hover:bg-hover rounded-full">
                                        <i class="fa-solid fa-box-open text-light text-xl"></i>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" onclick="addToWishlist({{ $product->id }})">
                                    <div class="w-10 h-10 flex justify-center items-center bg-blue hover:bg-hover  rounded-full">
                                        <i class="fa-regular fa-heart text-light text-xl"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="px-5 py-2 pb-5">
                            <a href="{{ route('front.items', $product->slug) }}" class="text-[19px] text-black font-medium text-ellipsis hover:text-hover">{{ $product->title }}</a>
                            <p class="text font-bold !text-red">${{ $product->price }}
                                @if($product->compare_price != null)
                                <span class="ml-2 text font-light line-through">${{ $product->compare_price }}</span>
                                @endif
                            </p>
                                
                            <p class="text-black font-medium">
                               {!! reviewAverage($product->id)  !!}
                            </p>
                            <button class="btn absolute  hidden group-hover:block group-hover:bottom-[20px] group-hover:transition" onclick="addToCart({{$product->id}})">Add to Cart</button>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="sm:w-1/1 flex flex-col justify-center items-center">
                        <img  style="width: 300px; margin: 30px 0;" src="https://i0.wp.com/www.memelate.com/wp-content/uploads/2023/02/toiob-ali-faruk-confused-meme-template.png?resize=600%2C465&ssl=1" alt="" class="rounded-full w-[200px] h-[200px]">
                        <h2 class="m-2 text-2xl text-center">The database is currently processing your search. <br> Thank you for your patience 🙂🙏</h2>
                    </div>
                @endif