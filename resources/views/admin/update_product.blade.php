<!DOCTYPE html>
<html lang="en">
  <head>

  
     @include('admin.css')

     <style type="text/css">
        .div_center
        {
            text-align: center;
            padding-top: 40px;
        }
        .h1_size
        {
            font-size: 40px;
            padding-bottom: 40px;
        }
        .text_color
        {
            color:black;
            padding-bottom: 20px;
        }
        lable 
        {
          display:inline-block;
          width:200px;
        }

     </style>
  </head>
  <body>
    <div class="container-scroller">
        @include('admin.sidebar')
      <!-- partial -->
        <div class="container-fluid page-body-wrapper">
           <!-- partial:partials/_navbar.html -->
            @include('admin.navbar')
         <!-- partial -->
            <div class="main-panel">
             <div class="content-wrapper">

             @if(session()->has('message'))
                 <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

                   {{session()->get('message')}}

                  </div>
 


                 @endif

               <div class="div_center">

               <h1 class="h1_size">Update Products</h1>

               <form action="{{url('/all_product_update',$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf

               <div>
               <label> Product Title:</label>
                <input class="text_color" type="text" name="title" placeholder="Write Title" required="" value="{{$product->title}}">
               </div>

               <br>


               <div>
               <label> Product Description:</label>
                <input class="text_color" type="text" name="description" placeholder="Write description" required="" value="{{$product->description}}">
               </div>

               <br>

               <div>
               <label> Product Price:</label>
                <input class="text_color" type="number" name="price" placeholder="Write Price" required="" value="{{$product->price}}">
               </div>

               <br>

               <div>
               <label> Product Quantity:</label>
                <input class="text_color" type="number" name="quantity" min="0" placeholder="Write Quantity" required="" value="{{$product->quantity}}">
               </div>

               <br>

               <div>
               <label> Product Discount Price:</label>
                <input class="text_color" type="number" name="disprice" placeholder="Write Disct Price" value="{{$product->discount_price}}">
               </div>

               <br>

               <div>
               <label> Product Catagory:</label>
                <select class="text_color" name="catagory" required="" >
                  <option value="{{$product->catagory}}" selected="">{{$product->catagory}} </option>

                  @foreach($catagory as $catagory)
                    <option value="{{$catagory->catagory_name}}"> {{$catagory->catagory_name}}</option>

                    @endforeach

                  
                </select>
               </div>

               <br>

               <div>
               <label> Current Product Image:</label>
                <img style="margin:auto" height="100" width="100" src="/product/{{$product->image}}">
               </div>
               <br>

               <div>
               <label> Change Product Image:</label>
                <input type="file" name="image" >
               </div>

               <br>

               <div>
                <input type="submit" value="Update Product" class="btn btn-primary">
               </div>

      </form>


               </div>

             </div>
            
                
                
              
            
             
              <!-- content-wrapper ends -->
             <!-- partial:partials/_footer.html -->
          
             <!-- partial -->

             </div>
          
          <!-- main-panel ends -->
        </div>
       <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>