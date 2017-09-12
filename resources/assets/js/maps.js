$(document).ready(function () {

    // initial position
    var position = {lat: 40.7579945, lng: -111.9708345};

    // my options
    var options = {
        zoom: 12,
        center: position
    }

    // search input
    //var search = new google.maps.places.SearchBox(document.getElementById('address'));

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

    // isntance of map
    var map = new google.maps.Map(document.getElementById('map'), options);

    // marker
    var marker = new google.maps.Marker({
        position: position,
        map: map,
        draggable: true
    });

    // latitude and logitude
    google.maps.event.addListener(marker, 'position_changed', function () {

        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();

        $('#lat').val(lat);
        $('#lng').val(lng);
    });

});
