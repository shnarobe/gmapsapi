<!DOCTYPE html>
<html>
<head><meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
</head>
<body>

<h1>My First Google Map</h1>

<div id="floating-panel">
      <input id="address" type="textbox" value="Sydney, NSW">
      <input id="submit" type="button" value="Geocode">
    </div>
<div id="googleMap" style="width:100%;height:400px;">


</div>


<script>
//masterCoordinates=new google.maps.LatLng(12.1100, -61.6935);
//call back function to initialize map centered on coordinates given
function initMap() {
var mapProp= {//two properties specified in an options object
  center:new google.maps.LatLng(12.1100, -61.6935),//or {lat: -34.397, lng: 150.644}, note LatLng is an object with methods & properties
  zoom:11,
  gestureHandling:"cooperative"
};//store map properties in json object
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
//pass properties and html element as parameters to create map object

center=map.getCenter();//
console.log(center);
//marker overlay
var marker = new google.maps.Marker({position:center,map:map});//note the arguments to the marker, a position and a map object
//marker.setMap(map);

//polygon overlay
//A Polyline object consists of an array of LatLng locations, and creates a series of line segments that connect those locations in an ordered sequence.
var myTrip = [{lat:12.1100, lng:-61.6935}];
	/*[{lat: 37.772, lng: -122.214},
    {lat: 21.291, lng: -157.821},
    {lat: -18.142, lng: 178.431},
    {lat: -27.467, lng: 153.027}];*/
flightPath = new google.maps.Polyline({
  path:myTrip,//
  strokeColor:"#0000FF",
  strokeOpacity:0.8,
  strokeWeight:2,
  geodesic:true
 // fillColor:"#0000FF",
 // fillOpacity:0.4
});
flightPath.setMap(map);

/* *****EVENTS SECTION*/
//the addListener event takes an event name and a function to execute when the event occurs. The argument e is the 
//UI event passed an argument to the function 
map.addListener("click",function(e){
	pos=e.latLng;//get the latitude and longitude of clicked position on map
	//console.log(e);
	//map.setCenter(pos);
	//add marker where user clicked
	var marker = new google.maps.Marker({position:pos,map:map});
	addPoly(pos);
	//map.setZoom(6);
	//map.panTo(pos);
	
});
		//geocodeAddress
		var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });

/*map.addListener("center_changed",function(){
	
	 window.setTimeout(function() {
      map.panTo(marker.getPosition());
    }, 3000);
	
	
});*/
//An info window is like a little popup
var infowindow = new google.maps.InfoWindow({
    content: 'Change the zoom level',
    position: map.getCenter()
  });
  infowindow.open(map);//note the map argument to the open method on the InfoWindow object

  map.addListener('zoom_changed', function() {//this is an MVC event(concerning the controls on the map, unlike a UI an event object is not 
  //usually avaible to the function) and not a user event.
    infowindow.setContent('Zoom: ' + map.getZoom());
  });
  //remove event listener, but it must be assigned to a variable
  //var listener1 = marker.addListener('click', aFunction);

	//google.maps.event.removeListener(listener1);
	/* removes all listeners for the marker instance
	var listener1 = marker.addListener('click', aFunction);
var listener2 = marker.addListener('mouseover', bFunction);

// Remove listener1 and listener2 from marker instance.
google.maps.event.clearInstanceListeners(marker);
	*/
}
 function addPoly(posi){
	 //first get the existing path array
	 path=flightPath.getPath();
	 //add clicked point to array path
	// position=posi;
	 // ***Because path is an MVCArray, we can simply append a new coordinate
        // and it will automatically appear, no need to manually redraw.
	  path.push(posi);
	 
	 
	 
 }
 //geocoders convert between an address and latlng
 function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
		//the geocode methods
		/*geocode(request, callback)
Parameters: 
request:  GeocoderRequest
callback:  function(Array<GeocoderResult>, GeocoderStatus)
Return Value:  None*/
//request and call back function
        geocoder.geocode({'address': address}, function(results, status) {
			console.log(results);
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
	  
//Creates a new instance of a DistanceMatrixService that sends distance matrix queries to Google servers.
function distance(){
	new google.
	
	
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBX9Tk4Jnu2UbaSEOFy6GxOtYPbWOwwyAs&callback=initMap&language=en&region=GD&libraries=geometry,places">
//key and callback function parameters passed in url
//distancematrix api: AIzaSyBX9Tk4Jnu2UbaSEOFy6GxOtYPbWOwwyAs
</script>

</body>
</html>