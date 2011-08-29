var map, geocoder,latlng,latLng_marker, markerWe, cnt;
var cars =[];
var infowindow, infowindow2;
var browserSupportFlag =  new Boolean();
var carIcons = [];
carIcons[0] = new google.maps.MarkerImage(
	base_url+'style/images/car.png', 
	new google.maps.Size(32, 32),
	new google.maps.Point(0, 0), 
	new google.maps.Point(16, 30)
);

carIcons[1] = new google.maps.MarkerImage(
	base_url+'style/images/car2.png', 
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
			latlng = results[0].geometry.location;
			map.setCenter(results[0].geometry.location);
			if (!markerWe) {
				markerWe = new google.maps.Marker({
					map: map,
				});
			}
			markerWe.setPosition(results[0].geometry.location);
			if (!infowindow) {
				infowindow = new google.maps.InfoWindow();
			}
			//console.log(results[0]);
			
			var content = '<strong>' + results[0].formatted_address + '</strong><br />';
			content += 'Lat: ' + results[0].geometry.location.lat() + '<br />';
			content += 'Lng: ' + results[0].geometry.location.lng();
			infowindow.setContent(content);
			infowindow.open(map, markerWe);
	mapContent();
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
	//findCityCoordinates(city)
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(success, errorfunct);	 
	}
	function errorfunct(code){
		//mapContent();
		console.log(code);
		if (code.code==2)
			alert("Ваше точное местоположение не определено");
		findCityCoordinates(city);
	}

	function success(position) {
		latlng =  new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		//codeLatLng(latlng);
		map.setCenter(latlng);
		if (!markerWe) {
			markerWe = new google.maps.Marker({
				map: map,
				title: 'Вы здесь',
				draggable: true
			});
		}
		markerWe.setPosition(latlng);
		if (!infowindow) {
			infowindow = new google.maps.InfoWindow();
			infowindow.setContent("Вы здесь");
			infowindow.open(map, markerWe);
		}
		mapContent();
	}
	
}
function mapContent(){
	if(!markerWe){
		markerWe = new google.maps.Marker({
			position: latlng,
			title: 'Вы здесь',
			map: map,
			draggable: true
		});
		markerWe.setPosition();
	}
	/*var content = '<strong>' + 'Address:' +latLng_marker.formatted_address +'</strong><br />';
	content += 'Lat:' + latLng_marker.lat()+'<br/>';
	content += 'Lng: ' + latLng_marker.lng();*/
	var content = 'Lat:' + latlng.lat()+'<br/>';
	content += 'Lng: ' + latlng.lng();
	if (!infowindow) {
		infowindow = new google.maps.InfoWindow();
	}
	infowindow.setContent(content);
	infowindow.open(map, markerWe);
	
	google.maps.event.addListener(markerWe, 'dragend', function(event) {
		var location = event.latLng;
		markerWe.setPosition(location);
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
	$.get(base_url+"front/get_list", {},
		function(data){
			for (var i = 0; i < data.length; i++) {
				var carMarker = new google.maps.Marker({
					position: new google.maps.LatLng(data[i].lat,data[i].lon), 
					map: map,
					icon: carIcons[0],
					title: data[i].title
				});
				cars.push(carMarker);
				(function(i, carMarker) {		
					google.maps.event.addListener(carMarker, 'click', 
					function() {
						if (!infowindow2) {infowindow2 = new google.maps.InfoWindow();}
						$.post( base_url+"front/get_driver2", {'id':data[i].id} ,
							function( data ) {
								infowindow2.setContent(data);
							}
						);
						infowindow2.open(map, carMarker);  
					});
				})(i, carMarker);
			}
		}, "json");
	setTimeout(loadMarkers, 10*5000);  
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
$(document).ready(function(){
	$("#data_to_server").click(function(){
		sendDataToServer();
	});
});
function sendDataToServer(){
	$.get(base_url+'map/update_position',{lat:latlng.lat(),lon:latlng.lng()});
	setTimeout('sendDataToServer()',60*1000);
}
