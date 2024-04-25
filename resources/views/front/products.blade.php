@extends('front.layouts.app')

@section('styles')
    <style>
        .slider-container {
            width: 100%;
            margin-bottom: 20px;
        }

        #price-range-slider {
            width: 100%;
            margin-bottom: 10px !important;
            background: skyblue;
        }
        #price-range-label {
            margin-top: 10px;
            color: rgb(0, 0, 77);
            font-size: 16px
        }
    </style>

@endsection


@section('contents')
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

    <!-- main start -->
    <main class="max-w-[1200px] px-2 flex flex-col mx-auto ">
        <div class="flex items-center gap-2 my-4">
            <a href=""><i class="fa-solid fa-house text-red"></i></a> 
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="" class="link">Products</a> 
        </div>
       
        <div class="grid grid-cols-1 md:grid-cols-3  lg:grid-cols-4 items-start gap-4 mt-4 relative">
           <div  class="grid col-span-1 md:col-span-1 lg:col-span-1 mt-2 shadow-md rounded-md absolute top-12 bg-light md:relative md:top-0 md:block hidden" style="z-index:10" id="productNav">
                <div class="p-5 flex flex-col gap-4  rounded-md">
                    <a href="{{ route('front.product') }}" class=""><button class="btn"><i class="fa-solid fa-trash-can mr-2"></i>Clear Filters</button></a>
                    <h2 class="bigNunito font-bold">Categories</h2>
                    <div class="flex flex-col gap-2 pb-4 border-b border-lightest">
                        @if($categories->isNotEmpty())
                            @foreach ($categories as $category)
                            <div class="flex justify-between items-center">
                                <a href="{{ route('front.products',$category->slug) }}" class="link 
                                {{ ($categorySelected == $category->id) ? 'link-active' : '' }}
                                  uppercase" >{{ $category->name }}</a>
                                {{-- <span class="text">(20)</span> --}}
                            </div>
                            @endforeach
                        @else
                            <div class="flex justify-center items-center">
                                <h2 class="m-2">No categories Found</h2>
                            </div>
                        @endif
                    </div>

                    <h2 class="bigNunito font-bold">Brands</h2>
                    <div class="flex flex-col gap-2 pb-4 border-b border-lightest">
                        @if($brands->isNotEmpty())
                            @foreach ($brands as $brands)
                            <div class="flex justify-between items-center">
                                <label for="{{ $brands->id }}">
                                    <span class="link uppercase">{{ $brands->name }}</span>
                                </label>
                                <input type="checkbox" class="brand-box" name="brands[]" id="{{ $brands->id }}"value="{{ $brands->id }}" {{ (in_array($brands->id, $brandArray)) ? 'checked' : '' }} >
                            </div>
                            @endforeach
                        @else
                            <div class="flex justify-center items-center">
                                <h2 class="m-2">No brands Found</h2>
                            </div>
                        @endif
                    </div>

                    <h2 class="bigNunito font-bold">Price</h2>
                    <div class="flex min-w-full flex-wrap  gap-2 pb-4 border-b border-lightest">
                            <div class="slider-container">
                                <div id="price-range-slider"></div>
                                <label for="price-range-slider" id="price-range-label">Price Range: ${{$price_min}} - ${{$price_max}}</label>
                            </div>
                    </div>

                     <h2 class="bigNunito font-bold">Colors</h2>
                    <div class="flex flex-wrap gap-3 pb-4">
                      <a href="" class="link"><button class="w-6 h-6 bg-red rounded-sm hover:ring"></button></a>
                      <a href="" class="link"><button class="w-6 h-6 bg-blue rounded-sm hover:ring"></button></a>
                      <a href="" class="link"><button class="w-6 h-6 bg-orange rounded-sm hover:ring"></button></a>
                      <a href="" class="link"><button class="w-6 h-6 bg-black rounded-sm hover:ring"></button></a>
                      <a href="" class="link"><button class="w-6 h-6 bg-lightest rounded-sm hover:ring"></button></a>
                    </div>

                </div>

           </div>

           <div class="grid  col-span-1 md:col-span-2 lg:col-span-3 gap-6">
                <div class="px-6 py-3 flex justify-between md:flex-row items-center gap-4 shadow-md">
                   
                    <div class="flex justify-start gap-4 items-center">
                    <button class="btn md:hidden"  id="productBtn">Filter</button>
                    <select name="sorts" id="sorts" class="px-4 py-2 border border-black focus:outline-none rounded-md text cursor-pointer">
                        <option selected {{($sort) == 'lastest' ? 'selected' : ''  }} value="latest">Latest</option>
                        <option {{($sort) == 'oldest' ? 'selected' : ''  }} value="oldest">Oldest</option>
                        <option {{($sort) == 'price_desc' ? 'selected' : ''  }}  value="price_desc">Highest Price</option>
                        <option {{($sort) == 'price_asc' ? 'selected' : ''  }}  value="price_asc">Lowest Price</option>
                        {{-- <option value="price_desc">Higest Ratings</option> --}}
                    </select>
                    </div>

                    {{-- <h3 class="text !text-[17px] hidden md:block">Result for {{ @if() }} category</h3> --}}

                    <button class="btn"><i class="fa-solid fa-cube"></i></button>
                </div>
                    <div class="flex flex-wrap justify-start items-end">
                        @include('front.layouts.products')

                        
                    </div>
            </div>
        </div>
           
           <div class="w-full mx-auto flex justify-center gap-4 mt-10">
            {{ $products->withQueryString()->links() }} 
           </div>
        </div>

    </main>
     <div class="w-full"></div>
    <!-- main end -->

@endsection

@section('customJS')

    <script>
        $(document).ready(function () {
            $(function() {
                let minValue = 0, maxValue = 1000;

                const priceRangeSlider = $('#price-range-slider');
                const priceRangeLabel = $('#price-range-label');

                function handleSliderValues(values) {
                    minValue = values[0];
                    maxValue = values[1];
                    priceRangeLabel.text(`Price Range: $${minValue} - $${maxValue}`);
                    setTimeout(() => {
                        apply_filters(minValue,maxValue);
                    }, 500);
                }

                priceRangeSlider.slider({
                    range: true,
                    min: 0,
                    max: 1000,
                    values: [{{$price_min}}, {{$price_max}}],
                    step: 2,
                    slide: function(event, ui) {
                        handleSliderValues(ui.values);
                    }
                });
            });

            $('.brand-box').change(function () {
                apply_filters();
            });

            $('#sorts').change(function(){
                apply_filters();
            });


            function apply_filters(min,max) {
                var brands = [];
                var url = '{{ url()->current() }}?';

                $('.brand-box').each(function () {
                    if($(this).is(":checked") == true) {
                        brands.push($(this).val());
                    }
                });


                if(min > 0 || max < 1000){
                    url += '&price_min='+ min +'&price_max=' + max;
                }

                if(brands.length > 0){
                    url += '&brand='+brands.toString();
                }
                var keyword = $('#searchs').val();
                
                
                url += '&search='+keyword;
                

                // apply sorting 
                url += '&sort='+$('#sorts').val();

                window.location.href = url ;
                
            }

        });

</script>

<script>
   var docs = document.querySelector('body'); 
   
  docs.addEventListener('click', function() {
    var audio = document.getElementById('sound');
    if(audio){
        audio.play();
        audio.loop = true;
    }
    
  });
</script>

<script>
    const  CatSelectbtn = document.getElementById('productBtn');
            productNav = document.getElementById('productNav');

    CatSelectbtn.addEventListener('click', () => {
        productNav.classList.toggle('hidden');
    });

</script>



@endsection