var App = (function () {
    'use strict';

    // dependencies
    var _dp = {};

    // reusable iterator
    var _i = 0;

    var _modes = {
        BROWSE: {
            id: 0
        },
        CREATE: {
            id: 1,
            class: 'js-app--is-creating'
        },
        UPDATE: {
            id: 2,
            class: 'js-app--is-editing'
        }
    };
    var _mode = {};

    var _$body;

    function init() {
        _dp.google = google;

        _$body = $('body');

        _setMode(_modes.BROWSE);

        Map.init();
        Search.init();
        Toolbox.init();
    }

    var Map = (function () {
        var _$map = $('.b-map__canvas');
        var _map = _$map.get(0);
        var _g_map;

        function init () {
            _g_map = new _dp.google.maps.Map(_map, {
                center: {
                    lat: 48.124104599999995,
                    lng: 11.587909699999999
                },
                zoom: 10
            });

            Search.getCurrentPosition(setCenter);
        }

        function fitBounds(bounds) {
            _g_map.fitBounds(bounds);
        }

        function getGMap() {
            var map = _g_map;

            return map;
        }

        function setCenter(position) {
            if (typeof position.coords === 'object' && typeof position.coords.latitude === 'number' && typeof position.coords.latitude === 'number') {
                _g_map.setCenter( {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                });

                return;
            }

            _g_map.setCenter(position);
        }

        return {
            init: init,
            fitBounds: fitBounds,
            getGMap: getGMap,
            setCenter: setCenter
        };
    }());

    var Search = (function () {
        var _$buttonCurrentPosition;
        var _$inputText;
        var _inputText;
        var _g_inputText;
        var _markers = [];

        function init() {
            _$buttonCurrentPosition = $('.js-b-search__button--currentPosition');
            _$inputText = $('.js-b-search__inputText');
            _inputText = _$inputText.get(0);
            _g_inputText = new _dp.google.maps.places.SearchBox(_inputText);

            _$buttonCurrentPosition.on('click', function () {
                getCurrentPosition(Map.setCenter);
            });

            _dp.google.maps.event.addListener(_g_inputText, 'places_changed', function () {
                var _places = _g_inputText.getPlaces();
                var _place;

                if (_places.length === 0) {
                    return;
                }

                _clearMarkers();

                _place = _places[0];

                Map.setCenter(_place.geometry.location);

                // POI
                if (typeof _place.geometry.viewport === 'undefined') {
                    _markers.push(new _dp.google.maps.Marker( {
                        position: _place.geometry.location,
                        map: Map.getGMap()
                    }));

                    // @TODO zoom to where POI is first visible

                    return;
                }

                Map.fitBounds(_place.geometry.viewport);
            });
        }

        function _clearMarkers() {
            for (_i = 0; _i < _markers.length; _i += 1) {
                _markers[_i].setMap(null);
            }

            _markers = [];
        }

        function getCurrentPosition(fn) {
            navigator.geolocation.getCurrentPosition(fn);
        }

        return {
            init: init,
            getCurrentPosition: getCurrentPosition
        };
    }());

    var Toolbox = (function () {
        var google_maps_InfoWindow_prototype_set;
        var _poiTypes = {
            ORIGIN: 0,
            WAYPOINT: 1,
            DESTINATION: 2
        };
        var _poiType = 0;
        var _poiOrigin = {};
        var _poiWaypoints = [];
        var _poiDestination = {};
        var _$buttonCreate;
        var _$buttonsPoi;
        var _$buttonCancel;
        var _$buttonSave;

        function init() {
            _poiType = _poiTypes.ORIGIN;
            _poiOrigin = new _Poi();
            _poiDestination = new _Poi();
            _$buttonCreate = $('.js-b-toolbox__button--create');
            _$buttonsPoi = $('.js-b-toolbox__buttons--poi');
            _$buttonCancel = $('.js-b-toolbox__button--cancel');
            _$buttonSave = $('.js-b-toolbox__button--save');

            _$buttonCreate.on('click', function () {
                _setMode(_modes.CREATE);
            });

            _$buttonsPoi.on('click', 'button', function () {
                var $this = $(this);
                var poiType = $this.data('poi-type');

                $.each(_poiTypes, function (key, val) {
                    if (val === poiType) {
                        _poiType = poiType;
                    }
                });

                _$buttonsPoi.find('button').removeClass('active');
                $this.addClass('active');
            });

            google_maps_InfoWindow_prototype_set = _dp.google.maps.InfoWindow.prototype.set;
            _dp.google.maps.InfoWindow.prototype.set = function (a, b) {
                if (a === 'content') {
                    //$('.b-steps').append(b);
                }

                if (a === 'position') {
                    _mapClickEventHandler( {
                        latLng: b
                    });
                }

                if (_mode === _modes.BROWSE) {
                    google_maps_InfoWindow_prototype_set.apply(this, arguments);
                }
            }

            _dp.google.maps.event.addListener(Map.getGMap(), 'click', _mapClickEventHandler);
            //_dp.google.maps.event.clearListeners(Map.getGMap(), 'click');

            _$buttonCancel.on('click', function () {
                _setMode(_modes.BROWSE);
            });

            _$buttonSave.on('click', function () {
                _setMode(_modes.BROWSE);
            });
        }

        function _Poi() {
            var _marker = new _dp.google.maps.Marker();

            this.getMarker = function () {
                var marker = _marker;

                return marker;
            };

            this.isSet = function () {
                return typeof _marker.getMap() === 'object';
            };

            this.setPosition = function (position) {
                _marker.setPosition(position);

                if (typeof _marker.getMap() === 'undefined') {
                    _marker.setMap(Map.getGMap());
                }
            };
        }

        function _mapClickEventHandler(event) {
            var directionsRenderer = new _dp.google.maps.DirectionsRenderer();
            directionsRenderer.setMap(Map.getGMap());
            var directionsService = new _dp.google.maps.DirectionsService();

            if (_mode === _modes.CREATE) {
                switch (_poiType) {
                    case _poiTypes.ORIGIN:
                        _poiOrigin.setPosition(event.latLng);

                        break;
                    case _poiTypes.DESTINATION:
                        _poiDestination.setPosition(event.latLng);

                        break;
                    default:
                }

                if (_poiOrigin.isSet() && _poiDestination.isSet()) {
                    directionsService.route( {
                        origin: _poiOrigin.getMarker().position,
                        destination: _poiDestination.getMarker().position,
                        travelMode: _dp.google.maps.TravelMode.WALKING
                    }, function (result, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                            directionsRenderer.setDirections(result);
                        }
                    });
                }
            }
        }

        return {
            init: init
        };
    }());

    function _setMode(mode) {
        var classesToRemove = [];
        var classToAdd = '';

        if (mode === _mode) {
            return;
        }

        $.each(_modes, function (key, val) {
            if (val !== mode && typeof val.class === 'string') {
                classesToRemove.push(val.class);
            }

            if (val === mode) {
                _mode = mode;

                if (typeof val.class === 'string') {
                    classToAdd = val.class;
                }
            }
        });

        _$body.removeClass(classesToRemove.join(' '));
        _$body.addClass(classToAdd);
    }

    return {
        init: init,
        Map: Map,
        Search: Search,
        Toolbox: Toolbox
    };
}());

$(function () {
    'use strict';

    google.maps.event.addDomListener(window, 'load', App.init);
});
