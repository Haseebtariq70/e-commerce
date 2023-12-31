<!DOCTYPE html>
<html>
   <head>
    @include('frontend.css')

    <style type="text/css">

        .center
        {
            margin:auto;
            width:100%;
            text-align:center;
            padding:30px;
        }
        .img_de
        {
            height:100px;
            width:100px;
        }
        .total_de
        {
            font-size:30px;
            padding:40px;
        }
    </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('frontend.header')
         <!-- end header section -->

         @if(session()->has('message'))
                 <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

                   {{session()->get('message')}}

                  </div>
 


                 @endif



         <div class="heading_container heading_center">
               <h2>
                  Cart <span>Products</span>
               </h2>
            </div>
         

                
         
		<div class="center">
			<table class="table">
				<tr>
                    <th>Id</th>
			
				<th>Product Title</th>
				<th>Quantity</th>
				<th>Price</th>
                <!--<th>Total Price</th>-->
				<th>Image</th>
				<th>Action</th>
                <th>Edit</th>
			</tr>

            <?php

            $totalprice=0;
            ?>

            @foreach( $cart as $cart)
			<form action="{{url('/cart_update',$cart->id)}}" method="POST">
				@csrf


	
			<tr>
            <td>{{$cart->id}}</td>                            
				
				<td>{{$cart->product_title}}</td>
				
				<td><input style="width:70px;" type="number" min="1" name="quantity" value="{{$cart->quantity}}"></td>
                <td>{{$cart->price}}</td>
               <!-- <td></td>-->
			    
				<td><img class="img_de" src="/product/{{$cart->image}}"></td>
				<td><a class="btn btn-danger" onclick="return confirm('Are you sure to remove this?')" href="{{url('/remove_cart',$cart->id)}}"> Remove</a></td>
				<td>
                <input type="submit" name="send" value="update" class="btn btn-outline-success">
                </td>
			</tr>
           
            <?php

            $totalprice=$totalprice + $cart->price

            ?>
		
          @endforeach
          
          
				
			
		</form>

			

			</table>

            <h2 class="total_de">Total Price: {{$totalprice}}</h2>

            <div>
                <h1 style="font-size:25px; padding-bottom:15px;">Proceed Order</h1>
        <a href="{{url('/cash_order')}}" class="btn btn-danger"> Cash On Delivery</a>
            <a href="{{url('/stripe',$totalprice)}}" class="btn btn-danger"> Pay Now</a>
        </div>
		</div>
        




        
      <!-- footer start -->
         @include('frontend.footer')
      <!-- footer end -->
      
      <!-- jQery -->
      @include('frontend.script')
   </body>
</html>