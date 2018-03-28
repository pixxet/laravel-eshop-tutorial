<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderItem;
use App\Http\Controllers\Controller;
use App\Cart;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\CartItem;
 
class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $token = $request->input('stripeToken');
 
        //Retriieve cart information
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        $items = $cart->cartItems;
        $total=0;
        foreach ($items as $item) {
            $total+= intval($item->product->price);
        }
        if (Auth::user()->charge($total*100, [
            'source' => $token,
            'receipt_email' => Auth::user()->email,
            ])) {
            $order = new Order();
            $order->total_paid= $total;
            $order->user_id=Auth::user()->id;
            $order->save();
 
            foreach ($items as $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id=$order->id;
                $orderItem->product_id=$item->product->id;
                $orderItem->file_id=$item->product->file->id;
                $orderItem->save();
 
                CartItem::destroy($item->id);
            }
            return redirect('/order/'.$order->id);
        } else {
            return redirect('/cart');
        }
    }
 
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
 
        return view('order.list', ['orders'=>$orders]);
    }
 
    public function viewOrder($orderId)
    {
        $order = Order::find($orderId);
        return view('order.view', ['order'=>$order]);
    }

    public function download($orderId, $filename)
    {
        $fileid=\App\File::where('filename', $filename)->first();
        $orderItem = OrderItem::where('order_id', '=', $orderId)->where('file_id', $fileid->id)->first();
 
        if (!$orderItem) {
            redirect('/failed');
        }
        $entry = \App\File::where('filename', $filename)->first();
        $file = Storage::disk('local')->get($entry->filename);

        return (new Response($file, 200))->header('Content-Type', $entry->mime);
    }
}
