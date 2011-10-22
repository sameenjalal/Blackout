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
 
	<script type="text/javascript">

		$('#form_adventure').submit(function(event) 
			var form = $(this).parent('form');
			console.log(form);
			form.serialize;
	
			$ajax{
				url: 'sameenjalal.com/blackout/formsubmit.php',
				data: form.serialize;
				success: function(response){
					alert(response);
				};
			}
			event.preventDefault();
			return false;
		)
	</script>
</head>

<body>
	<? echo('$_REQUEST[]');?>
</body>

</html>
