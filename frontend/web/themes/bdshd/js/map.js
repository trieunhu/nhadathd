var geocoder;
var map;
var marker;
var infowindow ;
function showProjectLocation(n, t, i) {
    marker.setMap(null);
    map.setCenter(new google.maps.LatLng(n, t));
    document.getElementById("txtPositionX").value = n;
    document.getElementById("txtPositionY").value = t;
    marker = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(n, t),
        draggable: !0
    });
    n != "" && t != "" && n != 0 && t != 0 ? geocoder.geocode({
        latLng: new google.maps.LatLng(n, t)
    }, function(n, t) {
        t == google.maps.GeocoderStatus.OK && n != null && n[0] != null && (addressReturn = n[0].formatted_address, infowindow != null && (infowindow.setContent("<span id='address'><b>Địa chỉ : <\/b>" + i + "<\/span>"), infowindow.open(map, marker)))
    }) : showLocation(i);
    google.maps.event.addListener(marker, "dragstart", function() {
        infowindow != null && infowindow.close()
    });
    google.maps.event.addListener(marker, "dragend", getAddress)
}

function showLocation(n) {
    if (n != null && n != "") {
        var t = n.split(",");
        t.length >= 3 && $.trim(t[t.length - 3]).toLowerCase() == "thanh xuân" && (t[t.length - 3] = "Thanh Xuân Bắc");
        n = t.join(",");
        marker != null && marker.setMap(null);
        geocoder.geocode({
            address: n
        }, function(t, i) {
            i == google.maps.GeocoderStatus.OK && (map.setCenter(t[0].geometry.location), marker = new google.maps.Marker({
                map: map,
                position: t[0].geometry.location,
                draggable: !0
            }), document.getElementById("txtPositionX").value = t[0].geometry.location.lat(), document.getElementById("txtPositionY").value = t[0].geometry.location.lng(), addressReturn = t[0].formatted_address, infowindow != null && (infowindow.setContent("<span id='address'><b>Địa chỉ : <\/b>" + n + "<\/span>"), infowindow.open(map, marker)));
            google.maps.event.addListener(marker, "dragstart", function() {
                infowindow != null && infowindow.close()
            });
            google.maps.event.addListener(marker, "dragend", getAddress)
        })
    } else alert("Địa chỉ không hợp lệ")
}

function getAddress() {
    var r;
    console.log('get d');
    try {
        var n = marker.getPosition(),
            t = n.lat(),
            i = n.lng();
        document.getElementById("txtPositionX").value = t;
        document.getElementById("txtPositionY").value = i;
        r = new google.maps.LatLng(t, i);
        geocoder.geocode({
            latLng: r
        }, function(n, t) {
            t == google.maps.GeocoderStatus.OK && n != null && n[0] != null && (addressReturn = n[0].formatted_address, infowindow != null && (infowindow.setContent("<span id='address'><b>Địa chỉ : <\/b>" + n[0].formatted_address + "<\/span>"), infowindow.open(map, marker)))
        });
        map.setCenter(n)
    } catch (u) {
        console.log(u)
    }
}

function showAdd(n) {

    var u;
    try {
        var t = marker.getPosition(),
            i = t.lat(),
            r = t.lng();
        document.getElementById("txtPositionX").value = i;
        document.getElementById("txtPositionY").value = r;
        u = new google.maps.LatLng(i, r);
        geocoder.geocode({
            latLng: u
        }, function(t, i) {
            if (n == undefined){
                n = "Hà Nội";
            }
            i == google.maps.GeocoderStatus.OK && t[0] && (infowindow != null && (n != "" ? infowindow.setContent("<span id='address'><b>Địa chỉ : <\/b>" + n + "<\/span>") : infowindow.setContent("<span id='address'><b>Địa chỉ : <\/b>" + t[0].formatted_address + " abc<\/span>"), infowindow.open(map, marker)), addressReturn = t[0].formatted_address)
        });
        map.setCenter(t)
    } catch (f) {
        console.log(f)
    }
}

function strAddress() {
    return addressReturn
}

function strLatLng() {
    try {
        var n = $("#txtPositionX").val(),
            t = $("#txtPositionY").val();
        return n + "," + t
    } catch (i) {
        console.log(i)
    }
}
function placeMarker(n) {
    try {
        marker.setMap(null);
        marker = new google.maps.Marker({
            position: n,
            map: map,
            draggable: !0
        });
        google.maps.event.addListener(marker, "dragstart", function() {
            infowindow != null && infowindow.close()
        });
        google.maps.event.addListener(marker, "dragend", getAddress);
        map.setCenter(n);
        getAddress()
    } catch (t) {
        console.log(t)
    }
}
function initializeAddress(n, t, i) {
    var e, u, r, o, f;
    // console.log(n);
    try {
        n != "0" && t != "0" ? (infowindow = new google.maps.InfoWindow, e = {
            scrollwheel: !1,
            zoom: 14,
            center: new google.maps.LatLng(n, t),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }, map = new google.maps.Map(document.getElementById("map-canvas"), e), (n == "" || t == "" || n == null || t == null) && (n = 21.0287974, t = 105.8523542), u = new google.maps.LatLng(n, t), marker = new google.maps.Marker({
            map: map,
            position: u,
            draggable: !0
        }), map.setCenter(u), google.maps.event.addListener(map, "click", function(n) {
            placeMarker(n.latLng)
        }), google.maps.event.addListener(marker, "dragstart", function() {
            infowindow != null && infowindow.close()
        }), google.maps.event.addListener(marker, "dragend", getAddress), r = new google.maps.Marker({
            icon: {
                path: "M -3,0 0,-3 3,0 0,3 z",
                strokeColor: "#cec9c1",
                scale: 3
            },
            map: map,
            position: new google.maps.LatLng(10.871692, 106.535366)
        }), google.maps.event.addListener(map, "zoom_changed", function() {
            var n = map.getZoom();
            n <= 17 ? n == 15 ? r.setMap(map) : r.setMap(null) : r.setMap(map)
        }), o = '<style>a{text-decoration: none; color: blue}<\/style><div id="content"><\/div>', f = new google.maps.InfoWindow({
            content: o
        }), google.maps.event.addListener(r, "click", function() {
            f != null && f.open(map, r)
        }), geocoder = new google.maps.Geocoder, showAdd(i)) : $("#map-canvas").css("display", "none")
    } catch (s) {
        console.log(s)
    }
}

function clone(obj){
    if(obj == null || typeof(obj) != 'object') return obj;
    var temp = new obj.constructor();
    for(var key in obj) temp[key] = clone(obj[key]);
    return temp;
}


function geocodePosition(pos) {
    geocoder.geocode({
        latLng: pos
    }, function(responses) {
        if (responses && responses.length > 0) {
            marker.formatted_address = responses[0].formatted_address;
        } else {
            marker.formatted_address = 'Cannot determine address at this location.';
        }
        infowindow.setContent(marker.formatted_address+"<br>coordinates: "+marker.getPosition().toUrlValue(6));
        infowindow.open(map, marker);
    });
}

function codeAddress() {
    var address = document.getElementById('address').value;
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            if (marker) {
                marker.setMap(null);
                if (infowindow) infowindow.close();
            }
            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: results[0].geometry.location
            });
            google.maps.event.addListener(marker, 'dragend', function() {
                // updateMarkerStatus('Drag ended');
                geocodePosition(marker.getPosition());
            });
            google.maps.event.addListener(marker, 'click', function() {
                if (marker.formatted_address) {
                    infowindow.setContent(marker.formatted_address+"<br>coordinates: "+marker.getPosition().toUrlValue(6));
                } else  {
                    infowindow.setContent(address+"<br>coordinates: "+marker.getPosition().toUrlValue(6));
                }
                infowindow.open(map, marker);
            });
            google.maps.event.trigger(marker, 'click');
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}
window.onload = initializeAddress;