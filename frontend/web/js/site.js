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

        GFunctionOverrides.init();
        Map.init();
        Search.init();
        Toolbox.init();
    }

    var GFunctionOverrides = (function () {
        function init() {
            Maps_InfoWindow_prototype_set.init();
        }

        var Maps_InfoWindow_prototype_set = (function () {
            var _fn;
            var _onSetContent;
            var _onSetPosition;
            var _preventsDefault = false;

            function init () {
                _fn = _dp.google.maps.InfoWindow.prototype.set;

                _dp.google.maps.InfoWindow.prototype.set = function (a, b) {
                    if (a === 'content' && typeof _onSetContent === 'function') {
                        _onSetContent(b);
                    }

                    if (a === 'position' && typeof _onSetPosition === 'function') {
                        _onSetPosition(b);
                    }

                    if (!_preventsDefault) {
                        _fn.apply(this, arguments);
                    }
                }
            }

            function allowDefault() {
                _preventsDefault = false;
            }

            function onSetContent(fn) {
                if (typeof fn === 'function') {
                    _onSetContent = fn;
                }
            }

            function onSetPosition(fn) {
                if (typeof fn === 'function') {
                    _onSetPosition = fn;
                }
            }

            function preventDefault() {
                _preventsDefault = true;
            }

            function reset() {
                _onSetContent = undefined;
                _onSetPosition = undefined;
                _preventDefault = false;
            }

            return {
                init: init,
                allowDefault: allowDefault,
                onSetContent: onSetContent,
                onSetPosition: onSetPosition,
                preventDefault: preventDefault,
                reset: reset
            };
        }());

        return {
            init: init,
            Maps_InfoWindow_prototype_set: Maps_InfoWindow_prototype_set
        };
    }());

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
                _g_map.setCenter({
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
                    _markers.push(new _dp.google.maps.Marker({
                        position: _place.geometry.location,
                        map: Map.getGMap()
                    }));

                    // @TODO zoom to where POI is first visible

                    return;
                }

                Map.fitBounds(_place.geometry.viewport);
            });

            _dp.google.maps.event.addListener(Map.getGMap(), 'click', function () {
                _clearMarkers();
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
        var _$buttonCreate;
        var _$buttonsPoi;
        var _poiTypes = {
            ORIGIN: 0,
            WAYPOINT: 1,
            DESTINATION: 2
        };
        var _poiType = 0;
        var _poiOrigin = {};
        var _poiWaypoints = [];
        var _poiDestination = {};
        var _g_directionsService;
        var _trails = [];
        var _$buttonCancel;
        var _$buttonSave;

        function init() {
            _$buttonCreate = $('.js-b-toolbox__button--create');
            _$buttonsPoi = $('.js-b-toolbox__buttons--poi');
            _poiType = _poiTypes.ORIGIN;
            _poiOrigin = new _Poi();
            _poiDestination = new _Poi();
            _g_directionsService = new _dp.google.maps.DirectionsService();
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

            GFunctionOverrides.Maps_InfoWindow_prototype_set.preventDefault();
            GFunctionOverrides.Maps_InfoWindow_prototype_set.onSetPosition(function (b) {
                _mapClickEventHandler( {
                    latLng: b
                });
            });

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
                    _g_directionsService.route( {
                        origin: _poiOrigin.getMarker().position,
                        destination: _poiDestination.getMarker().position,
                        travelMode: _dp.google.maps.TravelMode.WALKING
                    }, function (result, status) {
                        if (status == google.maps.DirectionsStatus.OK) {
                            _trails = new _dp.google.maps.Polyline( {
                                path: result.routes[0].overview_path,
                                geodesic: true,
                                strokeColor: '#000000',
                                strokeOpacity: 1.0,
                                strokeWeight: 3
                            });
                            _trails.setMap(Map.getGMap());
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
        GFunctionOverrides: GFunctionOverrides,
        Map: Map,
        Search: Search,
        Toolbox: Toolbox
    };
}());

$(function () {
    'use strict';

    google.maps.event.addDomListener(window, 'load', App.init);
});
