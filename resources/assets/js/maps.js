$(document).ready(function () {

    // initial position
    var position = {lat: 40.7579945, lng: -111.9708345};

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


    // search input
    var search = new google.maps.places.SearchBox(document.getElementById('address'));

    google.maps.event.addListener(search, 'places_changed', function () {

        var places = search.getPlaces();
        var bounds = new google.maps.LatLngBounds();
        var i, place;

        for (i = 0; place = places [i]; i++) {
            bounds.extend(place.geometry.location);
            marker.setPosition(place.geometry.location());
        }

        map.fitBounds(bounds);
        map.setZoom(12);
    });

    // latitude and logitude
    google.maps.event.addListener(marker, 'position_changed', function () {

        var address =   marker.getPosition();
        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();


        var geocoder = new google.maps.Geocoder();

        geocoder.geocode({'latLng':address},function (results,status) {

            if(status == google.maps.GeocoderStatus.OK) {
                if(results[0]) {
                    $('#address').val(results[0].formatted_address);
                    $('#lat').val(lat);
                    $('#lng').val(lng);
                } else {
                    $('#address').val('No results found');
                }
            } else {
                var error = {
                    'ZERO_RESULTS': 'Kunde inte hitta adress'

                }
                console.log('Kunde inte hitta adress');
            }
        });
    });
});
