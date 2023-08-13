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

         <div>
          
            <div class="center">
               <table class="table">
                        <tr>
                          <th>Product Title</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Image</th>
                          <th>Payment Status</th>
                          <th>Delivery Status</th>
                          <th>Order cancel</th>
                        </tr>
                        @foreach ($order as $order)
                           <tr>
                              <td>{{$order->product_title}}</td>  
                              <td>{{$order->quantity}}</td>
                              <td>{{$order->price}}</td>            
                              <td class="img_de"> <img src="/product/{{$order->image}}" alt=""> </td> 
                              <td>{{$order->payment_status}}</td> 
                              <td>{{$order->delivery_status}}</td>
                              <td>
                                 @if($order->delivery_status=='Processing')
                              <a onclick="return confirm('Are you sure you want to cancel this order !!!')" 
                               class="btn btn-danger" href="{{url('/cancel_order',$order->id)}}" >Order Cancel</a>
                              
                              @else
                              <p style="color:blueviolet;">Not Allowed</p>
                                  
                              @endif
                              </td>
                           </tr>
                        @endforeach
               </table>
            </div>
      
      <!-- footer start -->
         @include('frontend.footer')
      <!-- footer end -->
      
      <!-- jQery -->
      @include('frontend.script')
   </body>
</html>