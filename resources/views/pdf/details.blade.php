<article class="col-xs-12 my_float">
    <div class="col-xs-1">
       <h1 class="painel_field background_light my_float">{{'# '.$detail->unique_id}}</h1>
    </div>
    <div class="col-xs-12">
       <h2>{{$detail->address}}</h2>
        <hr>
    </div>
</article>
<div class="my_clear"></div>
<div class="col-xs-12">
    <div class="col-xs-8">
       <img src="{{asset('images/'.$detail->photo)}}" width="80%">
        <br>
       <p>
         {{$detail->description}}
       </p>
    </div>
    <div class="col-xs-4 pull-right">
        <div class="col-xs-12">
            {{$img += 1}}
            <img
              src="{{asset('storage/map'.Auth::user()->id.'img'.$img.'.png')}}" width="100%"
            >
        </div>
        <div style="height: 280px"></div>
        <div class="col-xs-12 background_light deatail_field my_float">
           <p>
               <strong>Digital Bulletin</strong><br>
               {{'Facing: '.$detail->label}}<br>
               {{'Size: '.$detail->width.' X '.$detail->height}}<br>
               {{'Latitude: '.$detail->lat}}<br>
               {{'Longitude: '.$detail->lng}}<br>
               Iluminaned: {{($detail->is_iluminated = 1) ? 'YES' : 'NO'}}<br>
           </p>
        </div>
    </div>
</div>