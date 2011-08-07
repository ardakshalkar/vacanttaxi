var map, geocoder,latlng,latLng_marker, markerWe, cnt;
var cars =[];
var infowindow, infowindow2;
var browserSupportFlag =  new Boolean();
var hostpath='http://localhost/VacanTaxi/';
var carIcons = [];
  
  carIcons[0] = new google.maps.MarkerImage(
    hostpath+'style/images/car.png', 
    new google.maps.Size(32, 32),
    new google.maps.Point(0, 0), 
    new google.maps.Point(16, 30)
  );
  
  carIcons[1] = new google.maps.MarkerImage(
    hostpath+'style/images/car2.png', 
    new google.maps.Size(32, 32),
    new google.maps.Point(0, 0), 
    new google.maps.Point(16, 30)
  );

function initialize() {
  latlng = new google.maps.LatLng(43.255058, 76.91262800000004);
  var options = {
      center:latlng,
      zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map =  new google.maps.Map(document.getElementById("map"), options);

  markerWe = new google.maps.Marker({
  position: latlng,
  title: 'We',
  map: map,
  draggable: true
  });
  latLng_marker= markerWe.getPosition();

  infowindow2 = new google.maps.InfoWindow();
  var content = '<strong>' + 'Address:' +latLng_marker.formatted_address +'</strong><br />';
  content += 'Lat:' + latLng_marker.lat()+'<br/>';
  content += 'Lng: ' + latLng_marker.lng();
  infowindow2.setContent(content);
  infowindow2.open(map, markerWe);
  
  google.maps.event.addListener(markerWe, 'dragend', function(event) {
  var location = event.latLng;
  markerWe.setPosition(event.latLng);
  var c = '<strong>' + 'Address:' + location.formatted_address +'</strong><br />';
  c += 'Lat:' + location.lat()+'<br/>';
  c += 'Lng: ' + location.lng();
  infowindow2.setContent(c);
  infowindow2.open(map, markerWe);});	
  loadMarkers();
}

function loadMarkers(){
// we load cars and their positions from db
  if (cars) {
    for (i in cars) {
      cars[i].setMap(null); //delete all previous cars
    }
    cars.length = 0;
  }

 
  $.get("http://localhost/VacanTaxi/index.php/front/get_list", {},
   function(data){
     for (var i = 0; i < data.length; i++) {
  var marker = new google.maps.Marker({
        position: new google.maps.LatLng(data[i].lat,data[i].lon), 
        map: map,
	icon: carIcons[0],
        title: data[i].title
      });
  cars.push(marker);

  (function(i, marker) {
  	google.maps.event.addListener(marker, 'click', function() {
        if (!infowindow) {infowindow = new google.maps.InfoWindow();}
        $.post( "http://localhost/VacanTaxi/index.php/front/get_driver2", {'id':data[i].id} ,
      	function( data ) {infowindow.setContent(data);});
        infowindow.open(map, marker);  
        });
        
      })(i, marker);
      }
     
   }, "json");
  
   setTimeout(loadMarkers, 5000);  
}

function getCoordinates(address) {
    // Check to see if we already have a geocoded object. If not we create one
    if(!geocoder) {
      geocoder = new google.maps.Geocoder();	
    }

    // Creating a GeocoderRequest object
    var geocoderRequest = {
      address: address
    }

    // Making the Geocode request
    geocoder.geocode(geocoderRequest, function(results, status) {
      
      // Check if status is OK before proceeding
      if (status == google.maps.GeocoderStatus.OK) {

        // Center the map on the returned location
        map.setCenter(results[0].geometry.location);

        // Check to see if we've already got a Marker object
        if (!markerWe) {
          // Creating a new marker and adding it to the map
          markerWe = new google.maps.Marker({
            map: map
          });
        }
        
        // Setting the position of the marker to the returned location
        markerWe.setPosition(results[0].geometry.location);

        // Check to see if we've already got an InfoWindow object
        if (!infowindow) {
          // Creating a new InfoWindow
          infowindow = new google.maps.InfoWindow();
        }

        // Creating the content of the InfoWindow to the address
        // and the returned position
        var content = '<strong>' + results[0].formatted_address + '</strong><br />';
        content += 'Lat: ' + results[0].geometry.location.lat() + '<br />';
        content += 'Lng: ' + results[0].geometry.location.lng();

        // Adding the content to the InfoWindow
        infowindow.setContent(content);

        // Opening the InfoWindow
        infowindow.open(map, markerWe);

      } 
      
    });
  
  }
