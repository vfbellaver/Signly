<hr>
<!-- logo -->
<div class="col-lg-4 pull-left">
    <img src="{{asset('storage/'.$footer->path_image)}}" alt="Your Logo" height="80">
</div>

<!-- info -->
<div class="col-lg-8">

    <div class="col-lg-8">
        <label class="control-label my_strong">Address Street: </label>
        <label class="control-label">
            {{$footer->user_street.', '
            .$footer->user_city.' , '
            .$footer->user_state.'. '
            }}
        </label>
    </div>

    <div class="col-lg-4">
        <label class="control-label my_strong">Email : </label> <label
                class="control-label">{{Auth::user()->email}}</label>
    </div>

    <div class="col-lg-4">
        <label class="control-label">{{$footer->user_zipcode}}</label>

        <label class="control-label my_strong">Website : </label>
        <label class="control-label">{{$footer->website}}</label>
    </div>

</div>