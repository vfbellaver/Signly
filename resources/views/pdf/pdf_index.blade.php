<?php
$img = 0;
?>
<html>
<head>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/pdf.css')}}">

</head>
<body class="my_margin">
    <!-- first page -->
    <div class="container my_border">
        <div class="row">
            <article class="col-xs-12">
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
            <footer class="col-xs-12 my_float">
                @include('pdf.pdf_footer')
            </footer>
        </div>
    </div>

    <div style="page-break-after: always;"></div>

    <!-- second page -->
    <div class="container my_border">
        <div class="row">
            <!-- principal -->
            <article class="col-xs-12 my_float">
                @include('pdf.proposals_table')
            </article>

            <div class="my_clear"></div>

            <footer class="col-xs-12 my_float">
                @include('pdf.pdf_footer')
            </footer>
        </div>
    </div>

    <div style="page-break-after: always;"></div>


    <!-- 3rt page -->
    <div class="container my_border">
        <div class="row">
            <!-- principal -->
            <article class="col-xs-12 my_float">
                <img src="{{asset('storage/map.png')}}">
            </article>

            <div class="my_clear"></div>

            <!-- footer -->
            <footer class="col-xs-12 my_float">
                @include('pdf.pdf_footer')
            </footer>
        </div>
    </div>

    @foreach($details as $detail)
        <div style="page-break-after: always;"></div>
        <!-- Others pages -->
        <div class="container my_border">
            <div class="row">
                <!-- principal -->
                <article class="col-xs-12 my_float">
                    @include('pdf.details')
                </article>

                <div class="my_clear"></div>

                <!-- footer -->
                <footer class="col-xs-12 my_float">
                    @include('pdf.pdf_footer')
                </footer>
            </div>
        </div>
    @endforeach
</body>

</html>