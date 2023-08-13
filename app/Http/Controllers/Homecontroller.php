<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Message;
use Session;
use Stripe;

class Homecontroller extends Controller
{
    //

    public function index()
    {
        $product=product::paginate(6);
        return view('frontend.index',compact('product'));
    }
    public function redirect()
    {
        $usertype=Auth::user()->usertype;

        if($usertype=='1')
        {
            $total_product=product::all()->count();
            $total_message=message::all()->count();
            $total_order=order::all()->count();
            $total_user=user::all()->count();
            $order=order::all();
            $total_revenue=0;
            foreach($order as $order)
            {
                $total_revenue=$total_revenue + $order->price;
            }

            $total_delivered=order::where('delivery_status','=','delivered')->get()->count();
            $total_processing=order::where('delivery_status','=','Processing')->get()->count();
            return view('admin.index',compact('total_product','total_message','total_order','total_user',
            'total_revenue','total_delivered','total_processing'));
        }
        else
        {
            $product=product::paginate(3);
        return view('frontend.index',compact('product'));
        }
    }

    public function shop_now()
    {
        $product=product::paginate(20);
        return view('frontend.allproduct',compact('product'));
    }

    public function product_detail($id)
    { 
        $product=product::find($id);
        return view('frontend.detail',compact('product'));
    }


    public function all_product()
    {
        $product=product::paginate(16);
        return view('frontend.allproduct',compact('product'));
    }


    public function contact()
    {
        return view('frontend.contact');
    }


    public function send_message(Request $req)
    {
        $mess=new message;
        $mess->name=$req->name;
        $mess->email=$req->email;
        $mess->message=$req->message;
        $mess->save();
        return redirect()->back();
    }

    public function add_cart(Request $request,$id)
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $userid=$user->id;
            $product=product::find($id);
            $product_exist_id=cart::where('product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();

            if($product_exist_id)
            {
                $cart=cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;

                if($cart->price=$product->discount_price!=null)
                {
                    $cart->price=$product->discount_price * $cart->quantity ;
                }
                else
                { 
                $cart->price=$product->price  * $cart->quantity ;
                }

                $cart->save();
                return redirect()->back()->with('message','Product Added Successfully.');

            }
            else
            {
                
            $cart=new cart;
            $cart->user_id=$user->id;
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->product_id=$product->id;
            $cart->product_title=$product->title;        
            $cart->image=$product->image;

            if($cart->price=$product->discount_price!=null)
            {
                $cart->price=$product->discount_price ;
            }
            else
            { 
            $cart->price=$product->price;
            }
            $cart->quantity=$request->quantity;
            $cart->total=$cart->price * $cart->quantity;

            $cart->save();
            return redirect()->back();

            }
        }
        else{
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if(Auth::id())
        {
            $id=Auth::user()->id;
        $cart=cart::where('user_id','=',$id)->get();
        return view('frontend.showcart',compact('cart'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {
        $cart=cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    
    public function cart_update(Request $request,$id)
    {
        $cart=cart::find($id);        
        if('send')
        {
            $cart->quantity=$request->quantity;            
            $cart->total=$cart->price * $cart->quantity;
            $cart->save();
            return redirect()->back();
        }
    }       
    
     public function cash_order()
     {
        $user=Auth::user();
        $userid=$user->id;
        $data=cart::where('user_id','=',$userid)->get();
        foreach($data as $data)
        {
            $order=new order;
            $order->user_id=$data->user_id;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->product_id=$data->product_id;
            $order->product_title=$data->product_title;
            $order->quantity=$data->quantity;
            $order->price=$data->price;
            $order->image=$data->image;
            $order->payment_status='Cash on delivery';
            $order->delivery_status='Processing';
            $order->save();


            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();
        }

        return redirect()->back()->with('message','We have  recived your order.');
     }

     public function stripe($totalprice)
     {
        return view('frontend.stripe',compact('totalprice'));
     }

     public function stripePost(Request $request,$totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "pkr",
                "source" => $request->stripeToken,
                "description" => "Thanks For Payment." 
        ]);

        $user=Auth::user();
        $userid=$user->id;
        $data=cart::where('user_id','=',$userid)->get();
        foreach($data as $data)
        {
            $order=new order;
            $order->user_id=$data->user_id;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;
            $order->product_id=$data->product_id;
            $order->product_title=$data->product_title;
            $order->quantity=$data->quantity;
            $order->price=$data->price;
            $order->image=$data->image;
            $order->payment_status='Paid';
            $order->delivery_status='Processing';
            $order->save();


            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();
        }
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }

    public function show_order()
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $userid=$user->id;
            $order=order::where('user_id','=',$userid)->get();

            return view('frontend.show_order',compact('order'));
        }

        else
        {
            return redirect('login');
        }
    }

    public function cancel_order($id)
    {
        $order=order::find($id);
        $order->delivery_status='Order canceled';
        $order->save();
        return redirect()->back();

    }

   
}

