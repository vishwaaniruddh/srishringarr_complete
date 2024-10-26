                                                   
<style>
    /* Optional: Makes the sample page fill the window. */
html,
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

#floating-panel {
  position: absolute;
  top: 10px;
  left: 25%;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
  text-align: center;
  font-family: "Roboto", "sans-serif";
  line-height: 30px;
  padding-left: 10px;
}

#floating-panel {
  background-color: #fff;
  border: 0;
  border-radius: 2px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  padding: 5px;
  font-size: 14px;
  text-align: center;
  line-height: 30px;
  height: auto;
}

#map {
  flex: auto;
}

#sidebar {
  flex: 0 1 auto;
  padding: 0;
}
#sidebar > div {
  padding: 0.5rem;
}
</style>

<html>
  <head>
    <title>Displaying Text Directions With setPanel()</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

    <!--<link rel="stylesheet" type="text/css" href="./style.css" />-->
    <!--<script type="module" src="./index.js"></script>-->
  </head>
  <body>
    <div id="floating-panel">
      <strong>Start:</strong>
      <select id="start">
              <option value="bhilai, ct">Bhilai</option>
          <option value="raipur, ct">Raipur</option>
          <option value="kolkata, wb">Kolkata</option>
          <option value="bardhaman, wb">Bardhaman</option>
          <option value="durgapur, wb">Durgapur</option>
      </select>
      <br />
      <strong>End:</strong>
      <select id="end">
          <option value="bhilai, ct">Bhilai</option>
          <option value="raipur, ct">Raipur</option>
          <option value="kolkata, wb">Kolkata</option>
          <option value="bardhaman, wb">Bardhaman</option>
          <option value="durgapur, wb">Durgapur</option>
      </select>
    </div>
    <div id="container">
      <div id="map"></div>
      <div id="sidebar"></div>
    </div>
    <div style="display: none">
      <div id="floating-panel">
        <strong>Start:</strong>
        <select id="start">
          <option value="bhilai, ct">Bhilai</option>
          <option value="raipur, ct">Raipur</option>
          <option value="kolkata, wb">Kolkata</option>
          
        </select>
        <br />
        <strong>End:</strong>
        <select id="end">
          <option value="bhilai, ct">Bhilai</option>
          <option value="raipur, ct">Raipur</option>
          <option value="kolkata, wb">Kolkata</option>
          
        </select>
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
    <script>
        function initMap() {
  const directionsRenderer = new google.maps.DirectionsRenderer();
  const directionsService = new google.maps.DirectionsService();
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 7,
    center: { lat: 21.152519712328164, lng: 81.32422654288021 },
    disableDefaultUI: true,
  });

  directionsRenderer.setMap(map);
  directionsRenderer.setPanel(document.getElementById("sidebar"));

  const control = document.getElementById("floating-panel");
  console.log(control);

  map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);

  const onChangeHandler = function () {
    calculateAndDisplayRoute(directionsService, directionsRenderer);
  };

  document.getElementById("start").addEventListener("change", onChangeHandler);
  document.getElementById("end").addEventListener("change", onChangeHandler);
}

function calculateAndDisplayRoute(directionsService, directionsRenderer) {
  const start = document.getElementById("start").value;
  const end = document.getElementById("end").value;

  directionsService
    .route({
      origin: start,
      destination: end,
      travelMode: google.maps.TravelMode.DRIVING,
    })
    .then((response) => {
      directionsRenderer.setDirections(response);
    })
    .catch((e) => window.alert("Directions request failed due to " + status));
}

window.initMap = initMap;
    </script>
  </body>
</html>