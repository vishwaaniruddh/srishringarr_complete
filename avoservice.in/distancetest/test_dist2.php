<html>
  <head>
    <title>Distance Matrix Service</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <link rel="stylesheet" type="text/css" href="./style.css" />

<style> html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#container {
  height: 100%;
  display: flex;
}

#sidebar {
  flex-basis: 15rem;
  flex-grow: 1;
  padding: 1rem;
  max-width: 30rem;
  height: 100%;
  box-sizing: border-box;
  overflow: auto;
}

#map {
  flex-basis: 0;
  flex-grow: 4;
  height: 100%;
}

#sidebar {
  flex-direction: column;
}
</style>

    <script type="module" src="./index.js"></script>
  </head>
  <body>
    <div id="container">
      <div id="map"></div>
      <div id="sidebar">
        <h3 style="flex-grow: 0">Request</h3>
        <pre style="flex-grow: 1" id="request"></pre>
        <h3 style="flex-grow: 0">Response</h3>
        <pre style="flex-grow: 1" id="response"></pre>
      </div>
    </div>

    <!-- 
      The `defer` attribute causes the callback to execute after the full HTML
      document has been parsed. For non-blocking uses, avoiding race conditions,
      and consistent behavior across browsers, consider loading using Promises.
      See https://developers.google.com/maps/documentation/javascript/load-maps-js-api
      for more information.
      -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPte3KtFoLYgBej7RuZUCg7PSFqV1ov-o&callback=initMap&v=weekly"
      defer
    ></script>
  </body>
</html>
<script>
function initMap() {
  const bounds = new google.maps.LatLngBounds();
  const markersArray = [];
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 23.24615, lng: 77.400 },
    zoom: 10,
  });
  // initialize services
  const geocoder = new google.maps.Geocoder();
  const service = new google.maps.DistanceMatrixService();
  // build request
  //12.910702478046977, 78.91678784251751 12.487604962774174, 78.56261523541379
  const origin1 = { lat: 12.928940, lng: 78.997572 };
  const origin2 = { lat: 12.9107, lng: 78.91678 };
  const destinationA = { lat: 12.6713363000, lng: 79.2817590000 };
  const destinationB = { lat: 12.48760, lng: 78.5626 };
  const request = {
    origins: [origin1, origin2],
    destinations: [destinationA, destinationB],
    travelMode: google.maps.TravelMode.DRIVING,
    unitSystem: google.maps.UnitSystem.METRIC,
    avoidHighways: false,
    avoidTolls: false,
  };

  // put request on page
  document.getElementById("request").innerText = JSON.stringify(
    request,
    null,
    2
  );
  // get distance matrix response
  service.getDistanceMatrix(request).then((response) => {
    // put response
    document.getElementById("response").innerText = JSON.stringify(
      response,
      null,
      2
    );

    // show on map
    const originList = response.originAddresses;
    const destinationList = response.destinationAddresses;

    deleteMarkers(markersArray);

    const showGeocodedAddressOnMap = (asDestination) => {
      const handler = ({ results }) => {
        map.fitBounds(bounds.extend(results[0].geometry.location));
        markersArray.push(
          new google.maps.Marker({
            map,
            position: results[0].geometry.location,
            label: asDestination ? "D" : "O",
          })
        );
      };
      return handler;
    };

    for (let i = 0; i < originList.length; i++) {
      const results = response.rows[i].elements;

      geocoder
        .geocode({ address: originList[i] })
        .then(showGeocodedAddressOnMap(false));

      for (let j = 0; j < results.length; j++) {
        geocoder
          .geocode({ address: destinationList[j] })
          .then(showGeocodedAddressOnMap(true));
      }
    }
  });
}

function deleteMarkers(markersArray) {
  for (let i = 0; i < markersArray.length; i++) {
    markersArray[i].setMap(null);
  }

  markersArray = [];
}

window.initMap = initMap;
</script>