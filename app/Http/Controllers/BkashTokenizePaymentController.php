<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;

class BkashTokenizePaymentController extends Controller
{
    public function index()
    {
        return view('bkashT::bkash-payment');
    }
    public function createPayment(Request $request)
    {
        $jsonData = $request->query('data');
        $data = json_decode(urldecode($jsonData), true); // Use 'true' to decode it as an associative array
        
        // Now you can access the properties

        $grandTotal = $data['grandTotal'];
        $reference = $data['reference'];

        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $reference;
        $request['currency'] = 'BDT';
        $request['amount'] = $grandTotal;
        $request['merchantInvoiceNumber'] = $reference;
        $request['callbackURL'] = config("bkash.callbackURL");;

        $request_data_json = json_encode($request->all());

        $response =  BkashPaymentTokenize::cPayment($request_data_json);
        //$response =  BkashPaymentTokenize::cPayment($request_data_json,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

        //store paymentID and your account number for matching in callback request
        // dd($response) //if you are using sandbox and not submit info to bkash use it for 1 response

        if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
        else return redirect()->back()->with('error-alert2', $response['statusMessage']);
    }

    public function callBack(Request $request)
    {
        //callback request params
        // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta
        //using paymentID find the account number for sending params

        if ($request->status == 'success'){
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            if (!$response){ //if executePayment payment not found call queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                /*
                 * for refund need to store
                 * paymentID and trxID
                 * */
                $payment = Payment::where('refference', $response['payerReference'])->first();
                $payment->trxID = $response['trxID'];
                $payment->paymentID = $response['paymentID'];
                $payment->completedTime = $response['paymentExecuteTime'];
                $payment->customerMsisdn = $response['customerMsisdn'];
                $payment->status = 2;
                $payment->update();

                $order = Order::where('id', $payment->order_id)->first();
                $order->payment_status = 'paid';
                $order->update();
                $res = $response;
                return view('front.bkash',compact(['res', 'request']));
                // return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
            }
            $res = $response;
            return view('front.bkash',compact(['res', 'request']));
        }else if ($request->status == 'cancel'){
            return view('front.bkash',compact('request'));

            // return view('front.bkash',compact('res'));
            //  return BkashPaymentTokenize::cancel('Your payment is canceled');
        }else{
            return view('front.bkash',compact('request'));
            // return view('front.bkash',compact('res'));
            // return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }

    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

    public function refund(Request $request)
    {
        $paymentID=$request->paymentID;
        $trxID=$request->trxID;
        $amount=$request->amount;
        $reason='refund payment';
        $sku='12345';

        $payment = Payment::where('paymentID', $paymentID)->first();
        $payment->status = 3;
        $payment->update();
        //response
        BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku);
        session()->flash('message', 'Payment refunded');
        return redirect()->route('admin.orders');
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID='Your payment id';
        $trxID='your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID,$trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
}
