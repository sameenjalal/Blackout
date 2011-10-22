<?
	$apikey='ABQIAAAAM3KB8UgMBoakoLO2D-5R4BT2tVxuwsOEhjl6IPUZleOhibtmWxQAPslVZ6Y3EP74xIQ10fOF8YVegQ';
	function debug_r($text)
	{
		echo '<pre>';
		print_r($text);
		echo '</pre>';
	}

	if(file_exists('cache'))
		$cache = unserialize(file_get_contents('cache'));
	else
		$cache = array();

	if(isset($_REQUEST['debug']))
	{
		debug_r($_REQUEST);
		debug_r($cache);
		$debug = 1;
	}
?>

<html>
	<head>

		<title> WherethefuckRU - Rutgers Off Campus Bus Stop Assistant </title>
		<link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=<?=$apikey?>&sensor=false"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	</head>

	<body>
		<div id="center">
			<h1> Wherethefuck<span id="red">RU</span></h1>
			<script type="text/javascript">
				var directionDisplay;
				var directionsService = new google.maps.DirectionsService();
				var map;

				function initialize() {
					directionsDisplay = new google.maps.DirectionsRenderer();
					var myOptions = {
						zoom:7,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
					};
					map = new google.maps.Map($("#map_canvas")[0], myOptions);
					directionsDisplay.setMap(map);

					plot_points();
				};

				$(window).load(initialize);

//				latlngs = [ new google.maps.LatLng(40.749537, -73.9879906), new google.maps.LatLng(40.758883, -73.981014), new google.maps.LatLng(40.7618193, -73.9791976), new google.maps.LatLng(40.761628, -73.968478) ];


//					latlngs = [ new google.maps.LatLng(40.487978, -74.439342), new google.maps.LatLng(40.487978, -74.439342), new google.maps.LatLng(40.498187, -74.445195), new google.maps.LatLng(40.5041, -74.449091), new google.maps.LatLng(40.523768, -74.458305), new google.maps.LatLng(40.51992, -74.433583), new google.maps.LatLng(40.533959, -74.436622), new google.maps.LatLng(40.485633, -74.437406), new google.maps.LatLng(40.499666, -74.445021), new google.maps.LatLng(40.502681, -74.451444)
				//	];
				
				function plot_points() 
				{
					for(var i=0; i < latlngs.length; i++)
					{
						latlngs[i] = new google.maps.LatLng(latlngs[i].lat, latlngs[i].lng);
					}

					console.log(latlngs);

					latlngs_start = latlngs[0];
					latlngs_end = latlngs[latlngs.length-1];

					var waypts = [];
					for (var i = 1 ; i < latlngs.length -1 ; i++ ) {
						waypts.push({
							location:latlngs[i],
							stopover:true
						});
					}

					console.log(waypts);

					var request = {
						origin: latlngs_start, 
						destination: latlngs_end,
						waypoints: waypts,
						optimizeWaypoints: false,
						travelMode: google.maps.DirectionsTravelMode.DRIVING

					};

					directionsService.route(request, function(response, status) {
						
						if (status == google.maps.DirectionsStatus.OK) {
							console.log(response);
							  directionsDisplay.setDirections(response);
						}
					});

					event.preventDefault();
					return false;
	
				}
					/*
				{
					console.log('Hello '+ latlngs);

					latlngs_start = latlngs[0];
					latlngs_end = latlngs[latlngs.length-1];

					var waypts = [];
					for (var i = 1 ; i < latlngs.length -1 ; i++ ) {
						waypts.push({
							location:latlngs[i],
							stopover:true
						});
					}

					var request = {
						origin: latlngs_start, 
						destination: latlngs_end,
						waypoints: waypts,
						optimizeWaypoints: false,
						travelMode: google.maps.DirectionsTravelMode.DRIVING

					};

					directionsService.route(request, function(response, status) {
						
						if (status == google.maps.DirectionsStatus.OK) {
							console.log(response);
							  directionsDisplay.setDirections(response);
						}
					});

					event.preventDefault();
					return false;
	
				};
					 */

			</script>

			<div id="table_div"> </div>

			<span id="closest_span"> </span>

			<span id="map_text"> </span>
			<div id="map_canvas" style="width: 800px"> </div>

	<?
		if(isset($_REQUEST['address'])):
			$origin = $_REQUEST['address'];
			$minresult = NULL;
			$minstop = '';
			if(isset($_REQUEST['search_stops']))
				$search_stops = $_REQUEST['search_stops'];
			else
				$search_stops = array();


			echo "You entered $origin as the Origin. \n<br />";
			$origin .= ' near New Brunswick, NJ';

			$origin = strtolower($origin);
		?>
			<table>
				<tr>
					<th> Stop </th>
					<th> Distance </th>
					<th> Walking Time </th>
				</tr>
		<?
			foreach($stops as $stop)
			{
				if(!in_array($stop['stopId'], $search_stops))
					continue;
				$url = 'http://maps.googleapis.com/maps/api/directions/json?mode=walking&sensor=false&';

				$geocoded_origin = $origin;

				if(isset($cache[$origin]))
				{
					$geocoded_origin = $cache[$origin];				
					if(isset($debug))
						echo 'Cache hit for '.$origin." \n<br />";
				}

				$query_params = array(
					'origin' => $geocoded_origin,
					'destination' => $stop['lat'].','.$stop['lon'],
				);

				$url = $url.http_build_query($query_params);

				$content = file_get_contents($url);
				$result = json_decode($content); 

				if(isset($debug))
					debug_r($result);
			
				$latlong = (string)($result->routes[0]->legs[0]->start_location->lat.','.$result->routes[0]->legs[0]->start_location->lng);

	//			echo "Caching ".$geocoded_origin.' latlon '.$latlong.' <br />';
				$cache[$geocoded_origin] = $latlong;

	//			debug_r($cache);


				$duration = $result->routes[0]->legs[0]->duration->value;
				$duration_text = $result->routes[0]->legs[0]->duration->text;

				$distance = $result->routes[0]->legs[0]->distance->text;

				echo '<tr>';
				echo '<td> '.$stop['title']. '</td>';
				echo '<td> '.$distance. '</td>';
				echo '<td> '.$duration_text. '</td>';
				echo '</tr>';

				if(!$minresult)
				{
					$minresult = $result->routes[0]->legs[0];
					$minstop = $stop;
				}
				if($minresult->duration->value > $duration)
				{
					$minresult = $result->routes[0]->legs[0];
					$minstop = $stop;
				}
			}

			echo '</table>';

			file_put_contents('cache', serialize($cache));

			echo "The closest stop is <b>".$minstop['title']."</b> which is <b> ".$minresult->distance->text."</b> away and a ".$minresult->duration->text." walk.\n<br />";

			$origin_arr = explode(',', $geocoded_origin);
			$origin_lat = $origin_arr[0];
			$origin_lon = $origin_arr[1];

			$dest_lat = $minstop['lat'];
			$dest_lon = $minstop['lon'];
		?>

		  
			<script type="text/javascript">

			  function calcRoute() {
			  }
			</script>

		<? endif; ?>

		</div>
		<center id="copyright"> Copyright&copy; 2011 <a href="/"> Vaibhav Verma </a> </center>
	</body>
</html>
