<?
	$apikey='ABQIAAAAM3KB8UgMBoakoLO2D-5R4BT2tVxuwsOEhjl6IPUZleOhibtmWxQAPslVZ6Y3EP74xIQ10fOF8YVegQ';
	include_once('db_helpers.php');
	include_once('foursquare_tools.php');
?>

<?php include_once('header.php'); ?>
<?php $adventure_id = $_REQUEST['id']; ?>
<?
	if(!is_numeric($adventure_id))
	{
		echo 'Invalid Adventure id entered.';
		exit();
	}
	$adventure_data = get_adventure_list($adventure_id);
	$lat_lng = array();
	$names = array();
	foreach($adventure_data as $adv)
	{
		$lat_lng[] = array('lat' => $adv['lat'], 'lng' => $adv['lng']);
		$names[] = $adv['name'];
	}
//	debug_r($lat_lng);
?>
Your Journey: <br />
<ul>
<?
	foreach($names as $name)
	{
?>
		<li> <?= $name ?> </li>
<?
	}
?>
</ul>


		<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=<?=$apikey?>&sensor=false"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

			<script type="text/javascript">
				var directionDisplay;
				var directionsService = new google.maps.DirectionsService();
				var map;

				var latlngs = <?= json_encode($lat_lng); ?>;

				function initialize() {
					directionsDisplay = new google.maps.DirectionsRenderer();
					var myOptions = {
						zoom:7,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
					};
					map = new google.maps.Map($("#map_canvas")[0], myOptions);
					directionsDisplay.setMap(map);

					plot_points(latlngs);
				};

				$(window).load(initialize);

//				latlngs = [ new google.maps.LatLng(40.749537, -73.9879906), new google.maps.LatLng(40.758883, -73.981014), new google.maps.LatLng(40.7618193, -73.9791976), new google.maps.LatLng(40.761628, -73.968478) ];


//					latlngs = [ new google.maps.LatLng(40.487978, -74.439342), new google.maps.LatLng(40.487978, -74.439342), new google.maps.LatLng(40.498187, -74.445195), new google.maps.LatLng(40.5041, -74.449091), new google.maps.LatLng(40.523768, -74.458305), new google.maps.LatLng(40.51992, -74.433583), new google.maps.LatLng(40.533959, -74.436622), new google.maps.LatLng(40.485633, -74.437406), new google.maps.LatLng(40.499666, -74.445021), new google.maps.LatLng(40.502681, -74.451444)
				//	];
				
				function plot_points(latlngs) 
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
			</script>


		</div>
		<div id="map_canvas" style="width: 800px; height: 600px;"> </div>
		<center id="copyright"> Copyright&copy; 2011 <a href="/"> Vaibhav Verma </a> </center>
	</body>
</html>
