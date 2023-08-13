<!DOCTYPE html>
<html>
   <head>
    
    @include('frontend.css')
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('frontend.header')
         <!-- end header section -->


         <div class="container">
         <div class="heading_container heading_center">
               <h2>
                  Product <span>Details</span>
               </h2>
            </div>
   <div class="row">
       <div class="col-sm-6">
       <img style="margin-top:20px; margin-left:50px;"src="/product/{{$product->image}}" alt="">
       </div>
       <div class="col-sm-6">
           
       <h1>{{$product->title}}</h1>
       
       <h4>Details: {{$product->description}}</h4>
       
       <h4>category: {{$product['category']}}</h4>
       

       @if($product->discount_price!=null)
                        <h2 style="color:red;">
                          Discount Price
                          <br>
                           ${{$product->discount_price}}
                        </h2>
                        <h2 style="text-decoration:line-through; color:blue;">
                        price
                        <br>

                           ${{$product->price}}
                        </h2>

                        @else

                        <h2 style="color:blue;">
                        price
                        <br>
                           ${{$product->price}}
                        </h2>

                        @endif


       
      
       <form action="{{url('/add_cart',$product->id)}}" method="POST">

@csrf


<input type="number" name="quantity" value="1" min="1" style="width:100px;">
<br>

               <input style="border-radius:20px;" type="submit" value="Add Cart">



               <a href="" class="btn btn-success">Buy Now</a>
               <a href="{{url('/')}}" class="btn btn-primary">Go Back</a>

       </form>
       <br>
        
       <br><br>
    </div>
   </div>
</div>
</div>
         

      <!-- footer start -->
         @include('frontend.footer')
      <!-- footer end -->
      
      <!-- jQery -->
      @include('frontend.script')
   </body>
</html>