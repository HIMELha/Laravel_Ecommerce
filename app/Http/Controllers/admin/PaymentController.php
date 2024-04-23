<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        $user = Auth::user();
        $payments = Payment::where('user_id', $user->id);
        $payments = $payments->latest()->paginate(12);
        return view('front.account.payment', compact('payments'));
    }
}
