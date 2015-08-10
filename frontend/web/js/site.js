$(function () {
    'use strict';

    function initialize() {
        var map = new google.maps.Map($('.b-map__canvas').get(0), {
            center: {
                lat: 48.124104599999995,
                lng: 11.587909699999999
            },
            zoom: 10
        });

        getCurrentLocation(function (position) {
            map.setCenter( {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            });
        });

        $('.js-b-search__button--currentLocation').on('click', function () {
            getCurrentLocation(function (position) {
                map.setCenter( {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                });
            });
        });

        var markers = [];
        var $searchBox = $('.js-b-search__inputText');
        var searchBox = new google.maps.places.SearchBox($searchBox.get(0));

        google.maps.event.addListener(searchBox, 'places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length === 0) {
                return;
            }

            for (var i = 0; i < markers.length; i += 1) {
                markers[i].setMap(null);
            }
            markers = [];

            map.setCenter(places[0].geometry.location);

            if (typeof places[0].geometry.viewport === 'undefined') {

                markers.push(new google.maps.Marker( {
                    position: places[0].geometry.location,
                    map: map
                }));

                //@TODO zoom to where POI is first visible

                return;
            }

            map.fitBounds(places[0].geometry.viewport);
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
});

function getCurrentLocation(fn) {
    navigator.geolocation.getCurrentPosition(fn);
}
