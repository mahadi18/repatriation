$(function (e) {
    selectDefaultCases();
    // $('.group-hide').css('display', 'none');
    $('#options').on('change', function () {
        var self = $(this);
        var currentOption = self.val();
        if (currentOption == 1 || currentOption == 2 || currentOption == 3) {
            $('.group-hide').css('display', 'block');
        } else {
            $('.group-hide').css('display', 'none');
        }
        // console.log('changed');
    });

    $('#reset_filter').click(function (event) {
        selectDefaultCases();
        $('.group-hide').css('display', 'block');
        // event.preventDefault();
    });

    $('#filter_form').submit(function (event) {
        event.preventDefault();
        var dateFrom = $('#date_from');
        var dateTo = $('#date_to');
        var bunfilter = $('#filter');
        var filterId = $('#options');
        //total initiated cases
        if (filterId.val() == 1) {
            if (dateFrom.val() == '' || dateTo.val() == '') {
                selectDefaultCases();
                // console.log(dateFrom.val());
            } else {
                //called
                selectFromDateRange(filterId.val(), dateFrom.val(), dateTo.val());
                // console.log('date initiated');
            }
            // console.log(filterId.val());
        }
        //cases opened by country
        if (filterId.val() == 2) {

            if (dateFrom.val() == '' || dateTo.val() == '') {
                selectFromOpenCases();
                // console.log(dateFrom.val());
            } else {
                selectFromOpenCases(dateFrom.val(), dateTo.val());
                // console.log(dateTo.val());
            }
            // console.log(filterId.val());
        }
        //closedBycountry
        if (filterId.val() == 3) {
            if (dateFrom.val() == '' || dateTo.val() == '') {
                selectFromClosedCases();
                // console.log(dateFrom.val());
            } else {
                selectFromClosedCases(dateFrom.val(), dateTo.val());
                // console.log(dateTo.val());
            }
        }
        //total organization by country
        if (filterId.val() == 4) {
            getOrganizationsByCountry();
        }
        //frequent rescue location
        if (filterId.val() == 5) {
            showRescuesByStateWithMapCluster();
        }
        // console.log(filterId.val());
    });
    // e.preventDefault();
});

function initMap() {
    var map = new google.maps.Map(document.getElementById("map"), {
        //center: new google.maps.LatLng(20.593684, 78.96288000000004),
        center: new google.maps.LatLng(28.394857, 84.124008),
        zoom: 5,
        scrollwheel: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
        draggable: false,
        zoomControl: false,
        streetViewControl: false,
        disableDoubleClickZoom: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    return map;
}

function removeMarkerWhenClick() {
    google.maps.event.addListener(map, "click", function (e) {
        infoWindow.close();
    });
}

function selectDefaultCases() {
    var url = '/dashboard/initiated-cases';
    var map = initMap();
    makeAjaxRequestForCases(map, url);
}

function selectFromDateRange(filterId, dateFrom, dateTo) {
    var url = '/dashboard/initiated-cases?fid=' + filterId + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo;
    var map = initMap();
    // console.log(url);
    makeAjaxRequestForCases(map, url);
}

function selectFromOpenCases(dateFrom, dateTo) {
    var url = '/dashboard/initiated-cases?open=' + true;
    if (dateFrom != '' && dateTo != '') {
        url = '/dashboard/initiated-cases?open=' + true + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo;
    }
    var map = initMap();
    makeAjaxRequestForCases(map, url);
}

function selectFromClosedCases(dateFrom, dateTo) {
    var url = '/dashboard/initiated-cases?closed=' + true;
    if (dateFrom != '' && dateTo != '') {
        url = '/dashboard/initiated-cases?closed=' + true + '&dateFrom=' + dateFrom + '&dateTo=' + dateTo;
    }
    var map = initMap();
    makeAjaxRequestForCases(map, url);
}

function getOrganizationsByCountry() {
    var map = initMap();
    $.ajax({
        url: '/dashboard/totalOrganizations',
        dataType: 'json',
        type: 'GET',
        success: function (response, status, xhr) {
            // console.log('/dashboard/cases?'+'fid='+filterId+'&dateFrom='+dateFrom+'&dateTo='+dateTo);
            if (status == 'success') {
                // console.log(response);
                showMarkerWithOrganizations(map, response);
            }
        },
        error: function (XHR, textStatus, errorThrown) {
            // console.log(XHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
}

function makeAjaxRequestForCases(map, url) {
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'GET',
        success: function (response, status, xhr) {
            // console.log('/dashboard/cases?'+'fid='+filterId+'&dateFrom='+dateFrom+'&dateTo='+dateTo);
            if (status == 'success') {
                // console.log(response);
                generateMarker(map, response);
            }
        },
        error: function (XHR, textStatus, errorThrown) {
            // console.log(XHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
}

function generateMarker(map, response) {
    var infoWindow = new google.maps.InfoWindow({maxWidth: 350});
    // Looping through the JSON data
    for (var i = 0, length = response.length; i < length; i++) {
        var data = response[i],
            latLng = new google.maps.LatLng(data.latitude, data.longitude);

        // Creating a marker and putting it on the map
        iconSet = ['green-dot.png', 'red-dot.png', 'blue-dot.png'];
        var icon = {
            url: 'http://maps.google.com/mapfiles/ms/icons/' + iconSet[i], // url
            scaledSize: new google.maps.Size(50, 50), // scaled size
             origin: new google.maps.Point(1, 1), // origin
            // anchor: new google.maps.Point(0, 0) // anchor
        };
        var marker = new google.maps.Marker({
            position: latLng,
            // label: "@",
            map: map,
            title: data.country,
            icon:icon
        });
        var infoWindow = new google.maps.InfoWindow({
            maxWidth: 350,
            content: '',
            closeBoxURL: '',
        });
        // Creating a closure to retain the correct data, notice how I pass the current data in the loop into the closure (marker, data)
        //(function (marker, data) {
        // Attaching a click event to the current marker
        //google.maps.event.addListener(marker, "click", function (e) {
        var contentString = '<div class="infowindow-bd">'
            + '<span class="infowindow-cases">'
            + data.initiatedCases
            + (function (initiatedCases) {
                return initiatedCases > 1 ? ' cases' : ' case';
            })(data.initiatedCases)
            + '</span>'
            + '</div>';
        infoWindow.setContent(contentString);
        infoWindow.open(map, marker);
        //  });

        // })(marker, data);
    }
    // console.log(data);
}

function showMarkerWithOrganizations(map, response) {
    var infoWindow = new google.maps.InfoWindow({maxWidth: 350});
    // Looping through the JSON data
    for (var i = 0, length = response.length; i < length; i++) {
        var data = response[i],
            latLng = new google.maps.LatLng(data.latitude, data.longitude);
        iconSet = ['green-dot.png', 'red-dot.png', 'blue-dot.png'];
        var icon = {
            url: 'http://maps.google.com/mapfiles/ms/icons/' + iconSet[i], // url
            scaledSize: new google.maps.Size(50, 50), // scaled size
            origin: new google.maps.Point(1, 1), // origin
            // anchor: new google.maps.Point(0, 0) // anchor
        };
        // Creating a marker and putting it on the map
        var marker = new google.maps.Marker({
            position: latLng,
            // label: "@",
            map: map,
            title: data.country,
            icon:icon
        });
        var infoWindow = new google.maps.InfoWindow({
            maxWidth: 350,
            content: '',
            closeBoxURL: '',
        });
        var contentString = '<div class="infowindow-bd">'
            + '<span class="infowindow-cases">'
            + data.totalOrganizations
            + (function (totalOrganizations) {
                return totalOrganizations > 1 ? ' Organizations' : ' Organization';
            })(data.totalOrganizations)
            + '</span>'
            + '</div>';
        infoWindow.setContent(contentString);
        infoWindow.open(map, marker);
    }
}

function showRescuesByStateWithMapCluster() {
    // function initMap() {
        var map = new google.maps.Map(document.getElementById("map"), {
            //center: new google.maps.LatLng(20.593684, 78.96288000000004),
            center: new google.maps.LatLng(20.593684, 78.96288000000004),
            zoom:5,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var bounds = new google.maps.LatLngBounds();
        // Creating an array that will contain the addresses
        var places = [];
        var markerCluster = new MarkerClusterer(map);

        var geocoder = new google.maps.Geocoder();
        var markers = [];
        // Creating a global infoWindow object that will be reused by all markers
        var infoWindow = new google.maps.InfoWindow({maxWidth: 350});
        // Event that closes the Info Window with a click on the map
        var url = '/dashboard/rescues-by-state';
        jQuery.ajax({
//                url: '/dashboard/cases',
            url: url,
            dataType: 'json',
            success: function (response, status, xhr) {

                if (status == 'success') {
                    // Looping through the JSON data
                    // console.log(response);
                    for (var i = 0, length = response.length; i < length; i++) {
                        var data = response[i];
                        (function (data) {
                            geocoder.geocode({'address': data.state}, function (results, status) {
                                if (status == google.maps.GeocoderStatus.OK) {
                                    places[i] = results[0].geometry.location;
                                    // Adding the markers
                                    var marker = new google.maps.Marker({position: places[i]});
                                    markers.push(marker);
                                    //add the marker to the markerClusterer
                                    markerCluster.addMarker(marker);
                                    var infoWindow = new google.maps.InfoWindow({
//                                            maxWidth: 350,
                                        content: '',
                                        closeBoxURL: '',
                                    });
                                    // Creating the event listener. It now has access to the values of i and marker as they were during its creation
                                    //google.maps.event.addListener(marker, 'click', function () {
                                    // Check to see if we already have an InfoWindow
                                    if (!infoWindow) {
                                        infoWindow = new google.maps.InfoWindow();
                                    }
                                    // Setting the content of the InfoWindow
                                    // console.log(data.totalRescues);
                                    var contentString = '<div class="infowindow-bd">'
                                        + '<span class="state">'
                                        + data.state
                                        + '</span><br>'
                                        + '<span class="infowindow-cases">'
                                        + data.totalRescues
                                        + (function (totalRescues) {
                                            return totalRescues > 1 ? ' Rescued' : ' Rescued';
                                        })(data.totalRescues)
                                        + '</span>'
                                        + '</div>';
                                    infoWindow.setContent(contentString);
                                    // Tying the InfoWindow to the marker
                                    infoWindow.open(map, marker);
                                    //});
                                    // Extending the bounds object with each LatLng
                                    bounds.extend(places[i]);
                                    // Adjusting the map to new bounding box
                                    map.fitBounds(bounds)
                                } else {
                                    alert("Geocode was not successful for the following reason: " + status);
                                }
                            });
                            // console.log(data.state);
                        })(data);
                    }
                }
            },
            error: function (XHR, textStatus, errorThrown) {
                console.log(XHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
        google.maps.event.addListener(map, "click", function (e) {
            infoWindow.close();
        });
    // }
}