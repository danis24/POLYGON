<html>
<header>
     <title>Show Polygon</title>
     <script src="https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing"></script>
     <style>
     html,
     body,
     #map_canvas {
          height: 500px;
          width: 500px;
          margin: 0px;
          padding: 0px
     }
     </style>
     <script>

     var geocoder;
     var map;
     var polygonArray = [];

     function initialize() {
          map = new google.maps.Map(
               document.getElementById("map_canvas"), {
                    center: new google.maps.LatLng(37.4419, -122.1419),
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
               });
               var drawingManager = new google.maps.drawing.DrawingManager({
                    drawingMode: google.maps.drawing.OverlayType.POLYGON,
                    drawingControl: true,
                    drawingControlOptions: {
                         position: google.maps.ControlPosition.TOP_CENTER,
                         drawingModes: [
                              google.maps.drawing.OverlayType.MARKER,
                              google.maps.drawing.OverlayType.CIRCLE,
                              google.maps.drawing.OverlayType.POLYGON,
                              google.maps.drawing.OverlayType.POLYLINE,
                              google.maps.drawing.OverlayType.RECTANGLE
                         ]
                    },
                    /* not useful on jsfiddle
                    markerOptions: {
                    icon: 'images/car-icon.png'
               }, */
               circleOptions: {
                    fillColor: '#ffff00',
                    fillOpacity: 1,
                    strokeWeight: 5,
                    clickable: false,
                    editable: true,
                    zIndex: 1
               },
               polygonOptions: {
                    fillColor: '#BCDCF9',
                    fillOpacity: 0.5,
                    strokeWeight: 2,
                    strokeColor: '#57ACF9',
                    clickable: false,
                    editable: false,
                    zIndex: 1
               }
          });
          console.log(drawingManager)
          drawingManager.setMap(map)

          google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
               document.getElementById('info').innerHTML += "polygon points" + "<br>";
               document.getElementById('jumlah').innerHTML += "<input type='text' name='jumlah' value='" + polygon.getPath().getLength() + "'>";

               var dat;

               for (var i = 0; i < polygon.getPath().getLength(); i++) {
                    dat += polygon.getPath().getAt(i).toUrlValue(6) + ";";
               }
               document.getElementById('info').innerHTML += "<input type='text' name='polygon' value='" + dat + "'>";
               polygonArray.push(polygon);
          });

     }
     google.maps.event.addDomListener(window, "load", initialize);
     </script>
</header>
<body>
     <div id="map_canvas" style=" border: 2px solid #3872ac;"></div>
     <form method="POST" action="/show">
          {{ csrf_field() }}
          <div id="jumlah">
          </div>
          <div id="info">
          </div>
          <input type="submit" value="Submit">
     </form>
</body>
</html>
