


<h1 class="text-center color_dark"> Proposed Locations </h1>
<table class="text-center table table-striped">
    <thead>
      <tr class="background_light background_table my_strong">
          <td>Panel</td>
          <td>City</td>
          <td>Facing</td>
          <td>Address</td>
          <td>Type</td>
          <td>4 Week </td>
      </tr>
    </thead>
    <tbody>
    @foreach($details as $detail)
      <tr>
          <td>{{$detail->unique_id}}</td>
          <td>{{$detail->city}}</td>
          <td>{{$detail->label}}</td>
          <td>{{$detail->address}}</td>
          <td>{{$detail->digital_driveby}}</td>
          <td>{{$detail->rate}}</td>
      </tr>
    @endforeach
    </tbody>
</table>