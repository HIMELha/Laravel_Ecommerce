@extends('front.layouts.app')

@section('contents')
    <div class="max-w-[1200px] px-2 flex  justify-between gap-4 mx-auto">
        <div id="catNav" class="w-[240px] pt-2 bg-light shadow-md  top-0 bottom-0 left-0  z-50 hidden">
            <ul>
                <li class="text-right m-2">
                    <buttton id="catclose" class="btn !w-full  cursor-pointer "><i class="fa-solid fa-close"></i></buttton>
                </li>
                @if (getCategories()->isNotEmpty())
                    @foreach (getCategories() as $category)
                        <li>
                            <a href="#">
                                <span class="category"><i
                                        class="fa-solid fa-{{ $category->name }} text-red"></i>{{ $category->name }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
                <li>
                    <a href="#"><span class="category border-none"><i class="fa-solid fa-dice-d6 text-red"></i>Find
                            more</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- main start -->
    <main class="max-w-[1200px] px-2 flex flex-col mx-auto ">
        <div class="flex items-center gap-2 my-4">
            <a href=""><i class="fa-solid fa-house text-red"></i></a>
            <i class="fa-solid fa-angle-right text-dark"></i>
            <a href="" class="link">Login</a>
        </div>

        <div class=" flex justify-center items-center mt-6">
            <form action="" method="get" class="px-6 py-8 w-[500px] shadow-sm rounded-sm border-2">
                <h2 class="headerText">Password Reset</h2>


                <div class="flex flex-col gap-1 mt-4">
                    <label for="email" class="text-[17px] font-medium text-black">Enter you email account</label>
                    <input type="text" id="email" name="email" placeholder="Example@mail.com" class="input"
                        required>
                    <p></p>
                </div>


                <div class="flex justify-between gap-1 mt-4">
                    <button type="submit" class="w-full btn">Sent request</button>

                </div>
                <br>
                <div class="flex justify-center items-center">
                    <a href="{{ route('front.login') }}" class="link text-center mt-2">Back to
                        login</a>
                </div>


        </div>
        </form>
        </div>
    </main>
    <!-- main end -->

@endsection
