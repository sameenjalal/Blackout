<?

include('helpers.php');
include('db_helpers.php');
include('foursquare_tools.php');

$temp get_access_token();
if(!$temp ){ 
	header('Location: https://foursquare.com/oauth2/authenticate?client_id=BBGNM1UQHHNWJWXDALCVLG5C1JLQMLLMQPIR1UYA0AU3ERNK&response_type=code&redirect_uri=http://sameenjalal.com/blackout/foursquare_handler.php');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta name="description" content="Fear no BlackOut" />
<title>BLACKOUT</title>

<style type="text/css" media="all">
@import "design.css";
</style>
</head>

	<body>
	
	<div id=center>
		<div id="logo"><a href="home.html"><img src="bol.png" alt="BlackOut" height="100" width="375" /></a></div>
		<div id="box1"></div>
		<div id="box2">
		<h1>Blackout Adventure Trail</h1>

		<a href="#" class = "leave">Logout</a>
		
		<p class="navigation-bar">
		<a href="home_loggedin.html">Home</a> | 
		<a href="adventure.php">Adventure Trail</a> | 
		<a href="preferences.html">Preferences</a>
		</p>
		
		<p>Currents trails:</p>
		<br>
		<p>Placeholder</p>
		<p>Placeholder</p>
		<p>Placeholder</P>
		
		<div id=googlemap>
		<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
		src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=31.371289,86.572266&amp;z=4&amp;output=embed"></iframe>
		<br /><small><a href="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=31.371289,86.572266&amp;z=4&amp;source=embed" 
		style="color:#0000FF;text-align:left">View Larger Map</a></small>
		</div>
		
		</div>
	
		<div id="box3">
		</div> 
	</body>
	
	<footer>
		<div id=fin>
		<p class="final">Copyright©2011 USACS</p>
		</div>
	</footer>
</html>	
	
		
