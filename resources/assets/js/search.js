$(document).ready(function () {
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
});
