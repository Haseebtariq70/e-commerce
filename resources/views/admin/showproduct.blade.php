<!DOCTYPE html>
<html lang="en">
  <head>
     @include('admin.css')


     <style class="text/css">
        .img_size
        {
            width:200px;
            height:200px:
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

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                x
              </button>

                {{session()->get('message')}}
                
              </div>




              @endif

              <div class="text-center text-success">
                <h1>All Products</h1>
                
              </div>

              <table class="table mt-4">
                <tr>

                <th> Title</th>
                <th> Price </th>
                <th> Quantity</th>
                <th> Discription</th>
                <th> Category</th>
                <th>Discount Price</th>
                <th> Image</th>
                <th>Delete</th>
                <th>Update</th>

</tr>

@foreach($product as $product)

<tr>
  <td>{{$product->title}}</td>
  <td>{{$product->price}}</td>
  <td>{{$product->quantity}}</td>
  <td>{{$product->description}}</td>
  <td>{{$product->catagory}}</td>
  <td>{{$product->discount_price}}</td>
  <td>
    <img class="img_size" src="/product/{{$product->image}}">
  </td>
  
  <td>
    <a onclick="return confirm('Are You Sure To Delete This Product')" href="{{url('delete_product',$product->id)}}" class="btn btn-danger">
      Delete
    </a>                  
  </td>
  <td>
    <a href="{{url('update_product',$product->id)}}" class="btn btn-primary">Update</a>
  </td>

</tr>
@endforeach


                                

              
                
              </table>
             
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
</div>
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