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
         <!-- slider section -->
        @include('frontend.slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
        @include('frontend.why')
      <!-- end why section -->
      
      <!-- arrival section -->
       @include('frontend.arrival')
      <!-- end arrival section -->
      
      <!-- product section -->
      @include('frontend.product')
      <!-- end product section -->

      <!-- subscribe section -->
      @include('frontend.subcribe')
      <!-- end subscribe section -->
      <!-- client section -->
        @include('frontend.client')
      <!-- end client section -->
      <!-- footer start -->
         @include('frontend.footer')
      <!-- footer end -->
      
      <!-- jQery -->
      @include('frontend.script')
   </body>
</html>