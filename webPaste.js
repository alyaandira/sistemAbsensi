
  var map;
  var marker;
  var polygon;
  var bounds;
  window.onload = initMap;
  function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
      center: center,
      zoom: 14,
      scaleControl: true,
    });
    bounds = new google.maps.LatLngBounds();
    google.maps.event.addListenerOnce(map, "tilesloaded", function (evt) {
      bounds = map.getBounds();
    });
    marker = new google.maps.Marker({
      position: center,
    });
    polygon = new google.maps.Polygon({
      path: area,
      geodesic: true,
      strokeColor: "#FFd000",
      strokeOpacity: 1.0,
      strokeWeight: 4,
      fillColor: "#FFd000",
      fillOpacity: 0.35,
    });

    var center = new google.maps.LatLng(3.5250312, 98.6646724);
    var area = [
      { lat: 3.529934, lng: 98.663746 },
      { lat: 3.5304629, lng: 98.6712846 },
      { lat: 3.5250587, lng: 98.670648 },
      { lat: 3.5244463, lng: 98.6629224 },
    ];

    polygon.setMap(map);

    var input = /** @type {!HTMLInputElement} */ (document.getElementById(
      "pac-input"
    ));
    var types = document.getElementById("type-selector");
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.addListener("place_changed", function () {
      marker.setMap(null);
      var place = autocomplete.getPlace();
      var newBounds = new google.maps.LatLngBounds();
      newBounds = bounds;
      if (!place.geometry) {
        window.alert("Autocomplete's returned place contains no geometry");
        return;
      }
      marker.setPosition(place.geometry.location);
      marker.setMap(map);
      newBounds.extend(place.geometry.location);
      map.fitBounds(newBounds);

      //function to checck whether within geometry or not
      if (
        google.maps.geometry.poly.containsLocation(
          place.geometry.location,
          polygon
        )
      ) {
        alert("The area contains the address");
      } else {
        alert("The address is outside of the area.");
      }
    });
  }


  
  var x = document.getElementById("demo");

  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.watchPosition(showPosition);
    } else {
      x.innerHTML = "Geolocation is not supported by this browser.";
    }
  }

  function showPosition(position) {
    x.innerHTML =
      "Latitude: " +
      position.coords.latitude +
      "<br>Longitude: " +
      position.coords.longitude;
  }

  var center = new google.maps.LatLng(3.5250312, 98.6646724);
  var area = [
    { lat: 3.529934, lng: 98.663746 },
    { lat: 3.5304629, lng: 98.6712846 },
    { lat: 3.5250587, lng: 98.670648 },
    { lat: 3.5244463, lng: 98.6629224 },
  ];
