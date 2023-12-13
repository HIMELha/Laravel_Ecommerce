<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders = Order::latest('orders.created_at')->select('orders.*','users.name', 'users.email');
        $orders = $orders->leftJoin('users', 'users.id', 'orders.user_id');

        if($request->get('key') != ''){
            $orders = $orders->where('users.name', 'like', '%' . $request->key . '%');
            $orders = $orders->orWhere('users.email', 'like', '%' . $request->key . '%');
            $orders = $orders->orWhere('orders.id', 'like', '%' . $request->key . '%');
        }

        $orders = $orders->paginate(12);
        return view('admin.orders.index', ['orders' => $orders]);
    }

    public function orderPage(Request $request, $id){
        $payments = Payment::where('order_id', $id)->first();

        $orders = Order::where('orders.id', $id)->select('orders.*','users.name', 'users.email');
        $orders = $orders->leftJoin('users', 'users.id', 'orders.user_id');
        $orders = $orders->first();
        if(!$orders){
            session()->flash('error', 'Order not found');
            return redirect()->route('admin.orders');
        }
        $products = OrderItem::where('order_id', $id)->get();
        $data['payments'] = $payments ;
        $data['orders'] = $orders;
        $data['products'] = $products;
        return view('admin.orders.orderPage', $data);
    }

    public function updateStatus(Request $request){
        $order = Order::find($request->id);

        if(!$order){
            session()->Flash('error', 'Order not found');
            return response()->json([
                'status' => false
            ]);
        }

        if($request->status == 'cancelled'){
            $OrderItem = OrderItem::where('order_id', $order->id)->get();

            foreach($OrderItem as $item){
                $productData = Product::find($item->product_id);
                $productQtyUpdated = $productData->qty + $item->qty;
                $productData->qty = $productQtyUpdated;
                $productData->update();
            }
        }

        $order->order_status = $request->status;
        $order->admin_notes = $request->notes;

        $order->update();

        session()->Flash('message', 'Order status updated successfully');
        return response()->json([
            'status' => true
        ]);
    }
}
 