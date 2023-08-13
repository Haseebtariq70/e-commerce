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
         <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Contact us</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end inner page section -->
      <!-- Contact Section-->
      <section class="why_section layout_padding">
         <div class="container">
         
            <div class="row">
               <div class="col-lg-8 offset-lg-2">
                  <div class="full">
                     <form action="{{url('/send_message')}}" method="POST">
                        @csrf 
                        <fieldset>
                           <input type="text" placeholder="Enter your full name" name="name"  />
                           <input type="email" placeholder="Enter your email address" name="email"  />
                        
                           <textarea placeholder="Enter your message" name="message" required></textarea>
                           <input type="submit" value="Submit" />
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--End Contact Section-->
      </div>
      <
      <!-- footer start -->
         @include('frontend.footer')
      <!-- footer end -->
      
      <!-- jQery -->
      @include('frontend.script')
   </body>
</html>