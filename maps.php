<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<title>Blackout</title>
	<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script src="http://maps.google.com/maps?file=api&v=2&sensor=false&key=ABQIAAAAsgqWSIQltBwZ838YNyxQnRT2tVxuwsOEhjl6IPUZleOhibtmWxQYQbyhIzw9XcL35iRPea1QQ31SRQ" type="text/javascript"></script>

	<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" /> 
 
	</head> 
 
	<body> 
		<div id="center"> 
				<form id="stop-form" action="" method="get"> Address<br /> 
				<input id="address" type="text" name="address" value="" /><br /> 
				<br /> 
				<input id="submit" type="Submit" value="Submit"/> 
			</form> 
			
			<script type="text/javascript"> 
				var map;
				var directionsService = new google.maps.DirectionsService();
				var directionsDisplay;
 
				function initialize() {
					directionsDisplay = new google.maps.DirectionsRenderer();
					var myOptions = {
						zoom:7,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					map = new google.maps.Map($("#map_canvas")[0], myOptions);

					directionsDisplay.setMap(map);
				}

//				$(window).load(initialize);
//				$('#submit').click(plot_directions);

				var latlngs;
				var start;
				var end;
				var waypts;
				var latlngs_start;
				var latlngs_end;

				function plot_directions() {

					latlngs = [ new google.maps.LatLng(40.487978, -74.439342), new google.maps.LatLng(40.487978, -74.439342), new google.maps.LatLng(40.498187, -74.445195), new google.maps.LatLng(40.5041, -74.449091), new google.maps.LatLng(40.523768, -74.458305), new google.maps.LatLng(40.51992, -74.433583), new google.maps.LatLng(40.533959, -74.436622), new google.maps.LatLng(40.485633, -74.437406), new google.maps.LatLng(40.499666, -74.445021), new google.maps.LatLng(40.502681, -74.451444),
					];

					latlngs_start = new google.maps.LatLng(40.487978, -74.439342);
					latlngs_end = new google.maps.LatLng(40.487978, -74.439342);

					latlngs = latlngs.splice(0,1);
					latlngs = latlngs.splice(0,latlngs.length-1);

					start = latlngs_start; //document.getElementById("start").value;
					end = latlngs_end;//document.getElementById("end").value;
					var waypts = [];
					for (var i = 0 ; i < latlngs.length ; i++ ) {
						waypts.push({
							location:latlngs[i],
							stopover:true
						});
					}

					var request = {
						origin: start, 
						destination: end,
						waypoints: waypts,
						travelMode: google.maps.DirectionsTravelMode.DRIVING

					};

					directionsService.route(request, function(response, status) {
						
						if (status == google.maps.DirectionsStatus.OK) {
							  directionsDisplay.setDirections(response);
						  var route = response.routes[0];
						  // For each route, display summary information.
						}
					});
					return false;
				};
 
			</script> 
 
			<div id="table_div"> </div> 
 
			<span id="closest_span"> </span> 
 
			<span id="map_text"> </span> 
			<div id="map_canvas" style="width: 800px"> asdfasdfasdfasdfasdfsadf </div> 
		</div> 
	</body> 
</html> 
