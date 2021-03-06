$(document).ready(function () {


    // initial position
    var position = {lat: 40.757994, lng: -111.970834};
    var latLng = new google.maps.LatLng(position);


    // my options
    var options = {
        zoom: 12,
        center: position
    };

    // isntance of map
    var map = new google.maps.Map(document.getElementById('map'), options);


    // marker
    var marker = new google.maps.Marker({
        position: position,
        map: map,
        draggable: true
    });


    // Geocoding
    var geocoder = new google.maps.Geocoder();


    // latitude and logitude
    google.maps.event.addListener(marker, 'position_changed', function () {

        var address = marker.getPosition();
        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();

        geocoder.geocode({'latLng': address}, function (results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    Bus.$emit('addressChanged', results[0].formatted_address);
                    Bus.$emit('markerChanged', {lat: lat, lng: lng});
                } else {
                    $('#address').val('No results found');
                }
            } else {
                var error = {
                    'ZERO_RESULTS': 'Kunde inte hitta adress'

                }
            }
        });
    });
});
