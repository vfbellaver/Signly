<article class="col-xs-12 my_float">
    <div class="col-xs-1">
        <img class="logo_header"
             src="{{asset('storage/clients_logo/'.$details[0]->client_id.'/'.$details[0]->logo)}}"
             width="150">
    </div>
    <div class="col-xs-12 my_float"  style="margin-left: 50px">
       <h2 class="main_map_text">{{$map->name}}</h2>
    </div>
</article>
<div class="my_clear"></div>
<article class="col-xs-12">
    <img class="main_map" src="{{asset('storage/'.$i.'map.jpg')}}">
</article>
