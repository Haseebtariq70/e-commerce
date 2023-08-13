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
            
                
                
              
            <h1 style="font-size:30px; text-align:center; font-weigth:bold; padding-bottom:15px;">All Messages</h1>

            <table class="table" style="text-align:center; width:100%; margin:auto;">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Message</th>
      
    </tr>
  </thead>
  <tbody>
    @forelse($message as $message)
    <tr>
        <td>{{$message->name}}</td>
        <td>{{$message->email}}</td>
        <td>{{$message->message}}</td>

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