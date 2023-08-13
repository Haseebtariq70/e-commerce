<!DOCTYPE html>
<html lang="en">
  <head>
     @include('admin.css')
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
            
                
                
              
            <h1 style="font-size:30px; text-align:center; font-weigth:bold; padding-bottom:15px;">All Orders</h1>

            <div style="padding-left:450px; padding-bottom:15px;">
              <form action="{{url('/search')}}" method="GET">
                @csrf
                <input style="color:black;" type="text" name="search" placeholder="Search For Something">
                <input type="submit" value="Search" class="btn btn-outline-primary">
              </form>
            </div>

            <table class="table" style="text-align:center;">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Address</th>
      <th scope="col">Product Title</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Payment Status</th>
      <th scope="col">Delivery Status</th>
      <th scope="col">Image</th>
      <th scope="col">Delivered</th>
      
    </tr>
  </thead>
  <tbody>
            

             @forelse($order as $order)
             <tr>
                <td>{{$order->name}}</td>
                <td>{{$order->email}}</td>
                <td>{{$order->phone}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->product_title}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{$order->price}}</td>
                <td>{{$order->payment_status}}</td>
                <td>{{$order->delivery_status}}</td>
                <td>
                    <img style="width:200px; height:80px;"src="/product/{{$order->image}}">
                </td>

                <td>
                    @if($order->delivery_status=='Processing')
                    <a onclick="return confirm('Are you to delivered this item.')" href="{{url('/delivered',$order->id)}}" class="btn btn-success">Delivered</a>

                  @else
                  <p style="color:blue;">delivered</p>

                    @endif 
                </td>

             </tr>

             @empty
             <tr>
              <td colspan="16">
                No data found
              </td>
             </tr>

             @endforelse
    
  </tbody>
</table>

             
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