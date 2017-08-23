<div class="col-lg-8">
   <img src="{{asset('images/'.$detail->photo)}}" width="40%">
   <p>
     {{$detail->description}}
   </p>
</div>
<div class="col-lg-4">
    <div class="col-lg-12">
        <h1>map here</h1>
        <div id="map2">
        </div>
    </div>
    <div class="background_light deatail_field col-lg-12">
       <h5>Digital Bulletin</h5> <br>
       <h5>{{'Facing: '.$detail->label}}</h5> <br>
       <h5>{{'Size: '.$detail->width.' X '.$detail->height}}</h5> <br>
       <h5>{{'latitude: '.$detail->lat}}</h5> <br>
       <h5>{{'Longitude: '.$detail->lat}}</h5> <br>
       <h5>Iluminaned: {{($detail->is_iluminated = 1) ? 'YES' : 'NO'}}</h5> <br>
    </div>
</div>
