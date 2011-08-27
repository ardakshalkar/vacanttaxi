var map,marker,directionsService;
var markers = [];
var markersArray = [];
var cars =[];
var carIcons = [];
var hostpath='http://localhost/VacanTaxi/';
var infowindow;
var i=0;

carIcons[1] = new google.maps.MarkerImage(
	    hostpath+'style/images/car2.png', 
	    new google.maps.Size(32, 32),
	    new google.maps.Point(0, 0), 
	    new google.maps.Point(16, 30)
);

function initialize() {
	loadDrivers();	
  // Instantiate a directions service.
  directionsService = new google.maps.DirectionsService();
  
  var almaty = new google.maps.LatLng(43.255058,76.912628);
  var myOptions = {
    zoom: 12,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: almaty
  }
  map = new google.maps.Map(document.getElementById("map"), myOptions);
 
  google.maps.event.addListener(map, 'click', function(event) {
	  var start = event.latLng;
	  addMarker(start);
	  markers.push(start);
	  var len = markers.length;
	  if( len%2==0 ){
		  showDirection();
	  }
	   
 });
  
  //calcRoute('kazakhstan,almaty,kimep','kazakhstan,almaty,uib');
  //calcRoute('43.25061798095703,76.88825225830078','43.240293,76.915197');
  deleteOverlays();
  
}

function renderDirections(result) {
	var directionsRenderer = new google.maps.DirectionsRenderer;
    directionsRenderer.setMap(map);
    directionsRenderer.setDirections(result);
}

function calcRoute(start, end) {
  /*var start;
  google.maps.event.addListener(map, 'click', function(event) {
	   start = event.latLng;
	   alert("lasdjf");
  });
  alert(start);*/

   directionsService.route({
      origin: start,
      destination: end,
      optimizeWaypoints: true,
      provideRouteAlternatives: false,
      travelMode: google.maps.TravelMode.DRIVING
  },function(result){
	  renderDirections(result);
  });

}

function showDirection()
{
	if (markers) {
	    calcRoute(markers[i],markers[i+1]);
	    //alert('woow');
	    deleteMarkers(i,i+1);
	    i=i+2;
	 }

}
function deleteOverlays() {
	  if (markers) {
	    for (i in markers) {
	      markers[i].pop();
	    }
	    markers.length = 0;
	  }
}

function addMarker(coordinates)
{
	marker = new google.maps.Marker({
		position: coordinates,
		map: map
	});
	markersArray.push(marker);
}

//Deletes all markers in the array by removing references to them
function deleteMarkers(i,j) {
  if (markersArray) {
      markersArray[i].setMap(null);
      markersArray[j].setMap(null);
      //alert('done '+i);
  }
}

function loadDrivers(){
	if (cars) {
		for (i in cars) {
		cars[i].setMap(null);
		}
		cars.length = 0;
	}
	
	$.get(hostpath+"index.php/backend/get_list", {},
		function(data){
			//alert(data[]);
			for (var i = 0; i < data.length; i++) {
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(data[i].lat,data[i].lon), 
					map: map,
					icon: carIcons[1],
					title: data[i].displayname
				});
				cars.push(marker);
				//alert(data[0].id);
				(function(i, marker) {		
					google.maps.event.addListener(marker, 'click', 
					function() {
						if (!infowindow) {infowindow = new google.maps.InfoWindow();}
						$.post( "http://localhost/vacanttaxi/index.php/backend/get_driver2", {'id':data[i].id} ,
							function( data ) {
								infowindow.setContent(data);
							}
						);
						infowindow.open(map, marker);  
					});
				})(i, marker);
			}
		}, "json");
	//setTimeout(loadDrivers, 10*10000);  
}
