// $(function (e) {
//     //selectDefaultCases();
//     getOrganizationsByCountry();
// });
$(document).ready(function () {
    //$('a[href="#caseInitiation"]').click(function(e) {
    $('#map_case_initiation').fadeIn('slow');
    setTimeout(selectDefaultCases, 100);
    // selectDefaultCases();
    //});
    $('a[href="#caseInitiation"]').on('shown.bs.tab', function (e) {
        // getOrganizationsByCountry();
        // setTimeout(selectDefaultCases, 1000);
        // setTimeout(function () {
        //     $('#map_case_initiation').fadeOut('slow');
        $('#map_case_initiation').fadeOut('first');
        $('#map_case_initiation').fadeIn('slow');
        selectDefaultCases();

        // }, 500);
    });
    $('a[href="#organization"]').on('shown.bs.tab', function (e) {
        // getOrganizationsByCountry();
        // setTimeout(getOrganizationsByCountry, 1000);
        // setTimeout(function () {
        $('#map_organization').fadeOut('first');
        $('#map_organization').fadeIn('slow');
        getOrganizationsByCountry();
        // }, 500);
    });

    $('a[href="#rescue_location"]').on('shown.bs.tab', function (e) {
        // setTimeout(function () {
        $('#map_rescue_location').fadeOut('first');
        $('#map_rescue_location').fadeIn('slow');
        showRescuesByStateWithMapCluster();
        // }, 500);
        // setTimeout(showRescuesByStateWithMapCluster, 1000);
    });
});
function selectDefaultCases() {
    var url = '/dashboard/initiated-cases';
    // var map = initMap("map_case_initiation");
    // google.maps.event.trigger(map, 'resize');
    var map = new google.maps.Map(document.getElementById("map_case_initiation"), {
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
    // setMarkerForInitiatedCases(map, url);
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'GET',
        success: function (response, status, xhr) {
            // console.log('/dashboard/cases?'+'fid='+filterId+'&dateFrom='+dateFrom+'&dateTo='+dateTo);
            if (status == 'success') {
                // console.log(response);
                // console.log(response);
                generateMarkerForInitiatedCases(map, response);
            }
        },
        error: function (XHR, textStatus, errorThrown) {
            // console.log(XHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
}
function generateMarkerForInitiatedCases(map, response) {
    var infoWindow = new google.maps.InfoWindow({maxWidth: 350});
    // Looping through the JSON data

    $.each(response, function (key, item) {
        var data = key;
        latLng = new google.maps.LatLng(item.latitude, item.longitude);
        // console.log(item.latitude, item.longitude);
        iconSet = {Bangladesh: 'green-dot.png', India: 'red-dot.png', Nepal: 'blue-dot.png'};
        var icon = {
            url: 'http://maps.google.com/mapfiles/ms/icons/' + iconSet[key], // url
            scaledSize: new google.maps.Size(50, 50), // scaled size
            origin: new google.maps.Point(1, 1), // origin
            // anchor: new google.maps.Point(0, 0) // anchor
        };
        var marker = new google.maps.Marker({
            position: latLng,
            // label: "@",
            map: map,
            title: key,
            icon: icon
        });
        var infoWindow = new google.maps.InfoWindow({
            maxWidth: 450,
            content: '',
            closeBoxURL: ''
        });
        var country_Id = item.country_id == 2 ? 0 : item.country_id;
        var contentString = '<div class="infowindow-bd" xmlns="http://www.w3.org/1999/html">'
            + '<span class="infowindow-cases">'
            + '<table class="table-map">'
            + '<tr><td colspan="2"><a target="_blank" href="/organization/dashboard?status=open&country_of_origin=' + country_Id + '">Total Cases: ' + item.totalCases + '</a></td></tr>'
            + '<tr><td colspan="2"><a target="_blank" href="/organization/dashboard?status=open&country_of_origin=' +country_Id + '">Active Cases: ' + item.open + '</a></td></tr>'
            + '<tr><td colspan="2"><a target="_blank" href="/organization/dashboard?status=closed&country_of_origin=' + country_Id + '">Closed Cases: ' + item.closed + '</a></td></tr>'
            + '</table>'
            + '</span>'
            + '</div>';
        infoWindow.setContent(contentString);
        infoWindow.open(map, marker);

    });
    // for (var i = 0; i < response.length; i++) {
    //     var data = response[i],
    //         latLng = new google.maps.LatLng(data.latitude, data.longitude);
    //
    //     // Creating a marker and putting it on the map
    //     iconSet = ['green-dot.png', 'red-dot.png', 'blue-dot.png'];
    //     var icon = {
    //         url: 'http://maps.google.com/mapfiles/ms/icons/' + iconSet[i], // url
    //         scaledSize: new google.maps.Size(50, 50), // scaled size
    //         origin: new google.maps.Point(1, 1), // origin
    //         // anchor: new google.maps.Point(0, 0) // anchor
    //     };
    //     var marker = new google.maps.Marker({
    //         position: latLng,
    //         // label: "@",
    //         map: map,
    //         title: data.country,
    //         icon: icon
    //     });
    //     var infoWindow = new google.maps.InfoWindow({
    //         maxWidth: 350,
    //         content: '',
    //         closeBoxURL: '',
    //     });
    //     var contentString = '<div class="infowindow-bd">'
    //         + '<span class="infowindow-cases">'
    //         + data.initiatedCases
    //         + (function (initiatedCases) {
    //             return initiatedCases > 1 ? ' cases' : ' case';
    //         })(data.initiatedCases)
    //         + '</span>'
    //         + '</div>';
    //     infoWindow.setContent(contentString);
    //     infoWindow.open(map, marker);
    // }

}


function getOrganizationsByCountry() {
    var map = initMap("map_organization");
    google.maps.event.trigger(map, 'resize');
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
function initMap(elementId) {
    var map = new google.maps.Map(document.getElementById(elementId), {
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

function setMarkerForInitiatedCases(map, url) {
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'GET',
        success: function (response, status, xhr) {
            // console.log('/dashboard/cases?'+'fid='+filterId+'&dateFrom='+dateFrom+'&dateTo='+dateTo);
            if (status == 'success') {
                // console.log(response);
                console.log(response);
                // generateMarker(map, response);
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
            icon: icon
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
            icon: icon
        });
        var infoWindow = new google.maps.InfoWindow({
            maxWidth: 350,
            content: '',
            closeBoxURL: '',
        });
        var contentString = '<div class="infowindow-bd">'
            + '<span class="infowindow-cases"><a target="_blank" href="/organizations?country-id=' + data.countryId + '">'
            + data.totalOrganizations
            + (function (totalOrganizations) {
                return totalOrganizations > 1 ? ' Organizations' : ' Organization';
            })(data.totalOrganizations)
            + '</a></span>'
            + '</div>';
        infoWindow.setContent(contentString);
        infoWindow.open(map, marker);
    }
}

function showRescuesByStateWithMapCluster() {
    // function initMap() {
    var map = new google.maps.Map(document.getElementById("map_rescue_location"), {
        //center: new google.maps.LatLng(20.593684, 78.96288000000004),
        center: new google.maps.LatLng(20.593684, 78.96288000000004),
        zoom: 5,
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
                            } else if (status === google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
                                setTimeout(function () {
                                }, 1000);
                            } else {
                                setTimeout(function () {
                                }, 1000);
                                console.log("Geocode was not successful for the following reason: " + status);
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