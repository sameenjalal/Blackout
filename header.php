<? include_once('helpers.php'); ?>
<?
	$apikey='ABQIAAAAM3KB8UgMBoakoLO2D-5R4BT2tVxuwsOEhjl6IPUZleOhibtmWxQAPslVZ6Y3EP74xIQ10fOF8YVegQ';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta name="description" content="Fear no BlackOut" />
<title>BLACKOUT</title>

		<link rel="stylesheet" type="text/css" href="/blackout/Bilal/design.css" media="screen"/>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
</head>

	<body>

		<div id="center">
			<div id="logo"><a href="home.html"><img src="Bilal/bol.png" alt="BlackOut" height="100" width="375" /></a></div>

				<div id="box1"></div>
				<div id="box2">
				<h1>Welcome to Blackout</h1>
				
				<p class="navigation-bar">
					<a href="home.php">Home</a> | 
					<a href="home.php">Adventure Trail</a> | 
					<a href="preferences.html">Preferences</a>
				</p>

<? if(get_access_token()): ?> 
				<a href="#" class = "leave">Logout</a>
<? endif; ?>


