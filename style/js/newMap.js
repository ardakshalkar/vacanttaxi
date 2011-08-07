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
function findCityCoordinates(city){
	if(!geocoder) {
		geocoder = new google.maps.Geocoder();	
	}
	var geocoderRequest = {
		address: city
	}
	geocoder.geocode(geocoderRequest, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			if (!markerWe) {
				markerWe = new google.maps.Marker({
					map: map
				});
			}
			markerWe.setPosition(results[0].geometry.location);
			if (!infowindow) {
				infowindow = new google.maps.InfoWindow();
			}
			console.log(results[0]);
			var content = '<strong>' + results[0].formatted_address + '</strong><br />';
			//content += 'Lat: ' + results[0].geometry.location.lat() + '<br />';
			//content += 'Lng: ' + results[0].geometry.location.lng();
			infowindow.setContent(content);
			infowindow.open(map, markerWe);
		} 
	});
}
function initialize(){
	var options = {
		zoom: 13,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var mapContainer = document.getElementById('map');
	map = new google.maps.Map(mapContainer, options);
	
	findCityCoordinates(city);
	
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(success, errorfunct);	 
	}

	function errorfunct(code){
			
	}

	function success(position) {
		latlng =  new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		codeLatLng(latlng);
	}
}
function mapContent(){
	/*markerWe = new google.maps.Marker({
		position: latlng,
		title: 'Вы здесь',
		map: map,
		draggable: true
	});
	markerWe.setPosition();*/	
	latLng_marker= markerWe.getPosition();
	var content = '<strong>' + 'Address:' +latLng_marker.formatted_address +'</strong><br />';
	content += 'Lat:' + latLng_marker.lat()+'<br/>';
	content += 'Lng: ' + latLng_marker.lng();
	infowindow.setContent(content);
	infowindow.open(map, markerWe);
	google.maps.event.addListener(markerWe, 'dragend', function(event) {
		var location = event.latLng;
		markerWe.setPosition(event.latLng);
		var c = '<strong>' + 'Address:' + location.formatted_address +'</strong><br />';
		c += 'Lat:' + location.lat()+'<br/>';
		c += 'Lng: ' + location.lng();
		infowindow2.setContent(c);
		infowindow2.open(map, markerWe);
	});	
	loadMarkers();
}
function loadMarkers(){
	if (cars) {
		for (i in cars) {
		cars[i].setMap(null);
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
					google.maps.event.addListener(marker, 'click', 
					function() {
						if (!infowindow) {infowindow = new google.maps.InfoWindow();}
						$.post( "http://localhost/VacanTaxi/index.php/front/get_driver2", {'id':data[i].id} ,
							function( data ) {
								infowindow.setContent(data);
							}
						);
						infowindow.open(map, marker);  
					});
				})(i, marker);
			}
		}, "json");
	setTimeout(loadMarkers, 60*1000);  
}

function getCoordinates(address) {
	if(!geocoder) {
		geocoder = new google.maps.Geocoder();	
	}
	var geocoderRequest = {
		address: address
	}
	geocoder.geocode(geocoderRequest, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			if (!markerWe) {
				markerWe = new google.maps.Marker({
					map: map
				});
			}
			markerWe.setPosition(results[0].geometry.location);
			if (!infowindow) {
				infowindow = new google.maps.InfoWindow();
			}
			var content = '<strong>' + results[0].formatted_address + '</strong><br />';
			content += 'Lat: ' + results[0].geometry.location.lat() + '<br />';
			content += 'Lng: ' + results[0].geometry.location.lng();
			infowindow.setContent(content);
			infowindow.open(map, markerWe);
		} 
	});
}
function codeLatLng(latlng) 
{
	if(!geocoder) {
		geocoder = new google.maps.Geocoder();	
	}
	geocoder.geocode({'latLng': latlng}, function(results, status) 
	{
		if (status == google.maps.GeocoderStatus.OK) 
		{
			if (results[1].formatted_address.indexOf(city) !=-1 ){
				map.setCenter(latlng);
				markerWe.setPosition(latlng);
				mapContent();
			}
			else {
				getCoordinates(city);
				mapContent();
			}
		}
	});
}
