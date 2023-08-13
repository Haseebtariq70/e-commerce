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
        .h1_font
        {
            font-size: 40px;
            padding-bottom: 40px;
        }
        .input_color
        {
            color : black;
        }
        .center
        {
            margin:auto;
            width:50%;
            text-align: center;
            margin-top: 20px;
            border:3px solid gray;
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

                  <h1 class="h1_font">Add Catagory</h1>

                 <form action="{{url('/add_catagory')}}" method="POST">

                    @csrf

                 <input class="input_color" type="text" name="catagory_name" placeholder="Write Catagory name">

                 <input type="submit" class="btn btn-primary" name="submit" value="Add Catagory">
                 </form>

                  </div>
                  <table class="center">
                    <tr>
                        <td>Catagory Nmae</td>
                        <td>Action</td>
                    </tr>

                    @foreach($catagory as $data)

                    <tr>
                        <td>{{$data->catagory_name}}</td>
                        <td>
                            <a onclick="return confirm('Are you sure to delete this.')" href="{{url('/delete_catagory',$data->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                  </table>

                </div>
                
              
            </div>
             
                     <!-- content-wrapper ends -->
                  <!-- partial:partials/_footer.html -->
          
                  <!-- partial -->
        </div>
          <!-- main-panel ends -->
        
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>