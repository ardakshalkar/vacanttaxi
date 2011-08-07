 (function() {
  
  // Defining some global variables
  var map, geocoder, marker, infowindow, latLng_marker, cnt;
  // Creating a latLng for the center of the map
  var latlng = new google.maps.LatLng(43.255058, 76.91262800000004);
  window.onload = function() {
	  
    // Creating a new map
    var options = {  
      zoom: 15,  
      center: latlng,  
      mapTypeId: google.maps.MapTypeId.ROADMAP  
    };  
	  
    map = new google.maps.Map(document.getElementById('map'), options);

	marker = new google.maps.Marker({
	position: latlng,
	title: 'We',
	map: map,
	draggable: true
	});
	latLng_marker= marker.getPosition();
	      // Creating a new InfoWindow
          infowindow = new google.maps.InfoWindow();
       

        // Creating the content of the InfoWindow to the address
        // and the returned position
        var content = '<strong>' + 'Address:' + latLng_marker.formatted_address +'</strong><br />';
        content += 'Lat:' + latLng_marker.lat()+'<br/>';
        content += 'Lng: ' + latLng_marker.lng();
		
        // Adding the content to the InfoWindow
        infowindow.setContent(content);

        // Opening the InfoWindow
        infowindow.open(map, marker);
	    
	google.maps.event.addListener(marker, 'dragend', function() {
	  var location = marker.getPosition();
	 //document.write(location);
	 var c = '<strong>' + 'Address:' + location.formatted_address +'</strong><br />';
        c += 'Lat:' + location.lat()+'<br/>';
        c += 'Lng: ' + location.lng();
		 // Adding the content to the InfoWindow
        infowindow.setContent(c);

        // Opening the InfoWindow
        infowindow.open(map, marker);
		
  	});
	
	 
    // Getting a reference to the HTML form
    var form = document.getElementById('addressForm');

    // Catching the forms submit event
    form.onsubmit = function() {
      // Getting the address from the text input
      var address = document.getElementById('address').value;
      
      // Making the Geocoder call 
      getCoordinates(address);
      
      // Preventing the form from doing a page submit
      return false;
      
    }
    
  }

  // Create a function the will return the coordinates for the address
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
        if (!marker) {
          // Creating a new marker and adding it to the map
          marker = new google.maps.Marker({
            map: map
          });
        }
        
        // Setting the position of the marker to the returned location
        marker.setPosition(results[0].geometry.location);

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
        infowindow.open(map, marker);

      } 
      
    });
  
  }
  
  /* var geocoder = new google.maps.Geocoder();
 
	function geocodePosition(pos) {
  		var content = '<strong>' + 'Address:' + pos.formatted_address +'</strong><br />';
        content += 'Lat:' + pos.lat()+'<br/>';
        content += 'Lng: ' + pos.lng();
		
		return content;
  });
}*/

})();
