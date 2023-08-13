<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\Order;
use App\Models\Message;

class admincontroller extends Controller
{
    //
    public function view_catagory()
    {
        if(Auth::id())
        {
            $catagory = catagory::all();
        return view('admin.catagory',compact('catagory'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function add_catagory(Request $request)
    {
        $data = new catagory;
        $data->catagory_name = $request->catagory_name;

        $data->save();
        return redirect()->back()->with('message','Catagory Added Successfully');


    }

    public function delete_catagory($id)
    {
        $data = catagory::find($id);
        $data->delete();
        return redirect()->back()->with('message','Delete Successfully');
    }


    public function view_product()
    { 
        $catagory =catagory::all();
        return view('admin.addproduct',compact('catagory'));
    }

    public function add_product(Request $request)
    {
        $product=new product;
        $product->title=$request->title;
        $product->description=$request->description;
        $product->catagory=$request->catagory;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->discount_price=$request->disprice;

        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image=$imagename;


       // $data=$request->input();
      //  $file=time()."product.".$request->file('image')->getClientOriginalExtention();
       // $img=$request->file('image')->storaAs('public/uploads',$file);

        $product->save();

        return redirect()->back()->with('message','Product Added Successfully');

        


    }

    public function show_product()
    {
        $product=product::all();
        return view('admin.showproduct',compact('product'));
    }

    public function delete_product($id)
    {
        $product=product::find($id);
        $product->delete();
        return redirect()->back()->with('message','Product Deleted Successfully');
    }


    public function update_product($id)
    {
        $product=product::find($id);
        $catagory=catagory::all();
        return view('admin.update_product',compact('product','catagory'));
    }

    public function all_product_update(Request $request,$id)
    {
        $product=product::find($id);
        $product->title=$request->title;
        $product->description=$request->description;
        $product->catagory=$request->catagory;
        $product->quantity=$request->quantity;
        $product->price=$request->price;
        $product->discount_price=$request->disprice;

        $image=$request->image;
        if($image)
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $product->image=$imagename;
        }


       // $data=$request->input();
      //  $file=time()."product.".$request->file('image')->getClientOriginalExtention();
       // $img=$request->file('image')->storaAs('public/uploads',$file);

        $product->save();

        return redirect()->back()->with('message','Product Update Successfully');
    }

    public function order()
    {
        $order=order::all();
        return view('admin.order',compact('order'));
    }

    public function searchdata(Request $req)
    {
        $searchtext=$req->search;
        $order=order::where('name','LIKE',"%$searchtext%")->orwhere('phone','LIKE',"%$searchtext%")->orwhere('address','LIKE',"%$searchtext%")
        ->orwhere('product_title','LIKE',"%$searchtext%")->get();
        return view('admin.order',compact('order'));
    }

    public function delivered($id)
    {
        $order=order::find($id);
        $order->delivery_status='delivered';
        $order->payment_status='Paid';
        $order->save();
        return redirect()->back();
    }

    public function message()
    {
        $message=message::all();
        return view('admin.message',compact('message'));
    }
}
