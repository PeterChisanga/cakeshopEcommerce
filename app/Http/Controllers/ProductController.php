<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

use Exception;
use Mail;
use App\Mail\MailNotify;
use Session;

use Illuminate\support\Facades\DB;

class ProductController extends Controller
{
    function index(){
        $data = Product::all();
        return view('product',['products' => $data]);
    }

    function detail($id){
        $data = Product::find($id);
        $products = Product::all();
        return view('detail',['product' => $data],['products' => $products]);
    }

    function search(Request $req){
        if($req->input('query') == ""){
            $data = Product::all();
            return view('product',['products' => $data]);
        }

        $data = Product::where('name','like','%'.$req->input('query').'%')->get();
        return view('search',['products' => $data]);
    }

    function addToCart(Request $req){
        if($req->session()->has('user'))
        {
            $cart = new Cart();
            $cart->user_id = $req->session()->get('user')['id'];
            $cart->product_id = $req->product_id;
            $cart->weight = $req->weight;
            $cart->quantity = $req->quantity;
            $cart->price = $req->price;
            $cart->save();
            return redirect('/cartlist');

        }else{
            return redirect('/login');
        }
    }

    static function cartItem(){
        $userId = Session::get('user')['id'];
        return Cart::where('user_id',$userId)->count();
    }

    function cartList() {
        if (!session()->get('user')) {
            return redirect('/login');
        }
        $userId = Session::get('user')['id'];
        $products = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->select('products.*','cart.id as cart_id','quantity','weight','cart.price as cart_price')
        ->get();

        $total = DB::table('cart')
        ->where('cart.user_id',$userId)
        ->sum('price');

        return view('cartlist',['products'=>$products],['total'=>$total]);
    }

    function removeCart($id) {
        Cart::destroy($id);
        return redirect('cartlist');
    }

    function orderNow() {
        $userId = Session::get('user')['id'];
        $total = $products = DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
        ->sum('cart.price');

        return view('ordernow',['total'=>$total]);
    }

    function orderPlace(Request $req){
        $userId = Session::get('user')['id'];
        $userEmail = Session::get('user')['email'];
        $allCart = Cart::where('user_id',$userId)->get();
        foreach($allCart as $cart){
            $order = new Order;
            $order->product_id = $cart['product_id'];
            $order->user_id = $cart['user_id'];
            $order->quantity = $cart['quantity'];
            $order->price = $cart['price'];
            $order->weight = $cart['weight'];
            $order->status = "pending";
            $order->payment_method = $req->payment;
            $order->payment_status = "pending";
            $order->address = $req->address;
            $order->save();
            Cart::where('user_id',$userId)->delete();
        }

        $orders = DB::table('orders')
        ->join('products','orders.product_id','=','products.id')
        ->select('products.*','quantity','weight','status','address','payment_method','payment_status','orders.price as cart_price')
        ->where('orders.user_id',$userId)
        ->get();
            
        try {
            Mail::to($userEmail)->send(new MailNotify($orders));
            return redirect('myorders')->with('success', 'You have successfully made an order. Please check your email.');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Sorry, something went wrong while placing your order.');
        }

        $req->input();
        return redirect('/');
    }

    function myOrders() {
        if (!session()->get('user')) {
            return redirect('/login');
        }

        $userId = Session::get('user')['id'];
        $orders = DB::table('orders')
        ->join('products','orders.product_id','=','products.id')
        ->select('products.*','quantity','weight','status','address','payment_method','payment_status','orders.price as cart_price')
        ->where('orders.user_id',$userId)
        ->get();

        return view('myorders',['orders'=>$orders]);
    }
}
