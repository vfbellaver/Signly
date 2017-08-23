<?php
?>
<html>
<head>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/pdf.css')}}">
    <script type="text/javascript" src="{{asset('js/js/pdf_maps/principal.js')}}"></script>



</head>
    <body>
         <!-- first page -->
         <div class="container my_border">
            <div class="row">
                <article class="col-lg-12">
                    @include('pdf.first_page')
                </article>
                <!-- description cliente description -->
                  <h3 class="text_first_page text-center">
                      This Proposal Presented to: <br>
                    <br>
                          {{$details[0]->company}}<br>
                          {{$details[0]->city}}<br>
                          {{$details[0]->start_date}}<br>
                  </h3>
                <!-- footer -->
                <footer class="col-lg-12">
                   @include('pdf.pdf_footer')
                </footer>
            </div>
         </div>

         <div style="page-break-after: always;"></div>

         <!-- second page -->
         <div class="container my_border">
             <div class="row">
                 <!-- principal -->
                 <article class="col-lg-12">
                   @include('pdf.proposals_table')
                 </article>
                 <!-- description -->

                 <!-- footer -->
                 <footer class="col-lg-12">
                     @include('pdf.pdf_footer')
                 </footer>
             </div>
         </div>

         <div style="page-break-after: always;"></div>


         <!-- 3rt page -->
         <div class="container my_border">
             <div class="row">
                 <!-- principal -->
                 <article class="col-lg-12">
                     <h3>My Google Maps Demo</h3>
                     <div id="map">
                     </div>
                 </article>
                 <!-- description -->

                 <!-- footer -->
                 <footer class="col-lg-12">
                     @include('pdf.pdf_footer')
                 </footer>
             </div>
         </div>

         @foreach($details as $detail)
             <div style="page-break-after: always;"></div>
         <!-- Others pages -->
         <div class="container my_border">
             <div class="row">
                 <article class="col-lg-12">
                     <h1 class="painel_field background_light">{{'# '.$detail->unique_id}}</h1> <h1>{{$detail->address}}</h1>
                     <hr>
                 </article>
                 <!-- principal -->
                 <article class="col-lg-12">
                    @include('pdf.details')
                 </article>
                 <!-- footer -->
                 <footer class="col-lg-12">
                     @include('pdf.pdf_footer')
                 </footer>
             </div>
         </div>
         @endforeach
         <script type="text/javascript" async defer
                 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAECe-JaASIc4HpIae-cFuFDtyX3K2GI_Q&callback=initMap">
         </script>

    </body>

</html>