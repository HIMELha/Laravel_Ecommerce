@extends('front.layouts.app')

@section('contents')
  @include('front.layouts.categories')

 <main class="max-w-[1200px] px-2 flex flex-col mx-auto ">
      
      <div class="flex items-center gap-2 my-4">
         <a href=""><i class="fa-solid fa-house text-red"></i></a> 
         <i class="fa-solid fa-angle-right text-dark"></i>
         <a href="" class="link">Payment status</a> 
      </div>
   
      
      
      <div class="flex flex-col justify-center items-center mx-auto py-8">
      <div>
         @if ($request->status == 'cancel')
         <p>You have cancelled your payment, Please go to payments history and try again</p>
         @elseif ($request->status == 'success')
         @isset($res['customerMsisdn'])
            <h2>Your payment was success</h2>
            <p>Pay from: {{ ($res != '' ) ?  $res['customerMsisdn'] : '' }}</p>
             <p>Pay amount: {{ ($res != '' ) ?  $res['amount'] : '' }}</p>
            <p>Pay transaction Id: {{ ($res != '' ) ? $res['trxID'] : '' }}</p>
         @endisset
         @else
         <p>Payment failure or something went wrong</p>
         @endif
      </div>

      <div class="flex flex-col sm:flex-row justify-between items-center gap-2 mt-4">
         {{-- <a href="{{ route('user.payments') }}"><button class="btn-hover p-3 mt-2">Payment history</button></a> --}}
         <a href="{{ route('front.product') }}"><button class="headBtn mt-2">Continue shopping</button></a>
      </div>
      </div>

      

 </main>


@endsection

@section('customJS')
    
@endsection