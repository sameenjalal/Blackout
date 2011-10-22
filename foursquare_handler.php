<?

	include_once('helpers.php');
	include_once('db_helpers.php');
	include_once('foursquare_tools.php');

	$url = 'https://foursquare.com/oauth2/access_token?client_id=BBGNM1UQHHNWJWXDALCVLG5C1JLQMLLMQPIR1UYA0AU3ERNK&client_secret=WHRZV0W2ZFJPY2CMSEXB5H1VNKFLFWY53ZLLH0ZQLTDIRTNG&grant_type=authorization_code&redirect_uri=http://sameenjalal.com/blackout/foursquare_handler.php&code='.$_REQUEST['code'];

	$temp= file_get_contents($url);

	$temp = json_decode($temp);


	insert_user($temp->access_token);



	authenticate_user($temp->access_token, $_REQUEST['code']);
	

	header('LOCATION:http://sameenjalal.com/blackout/home.php');
	
	//$res = db_query('SELECT * FROM users WHERE access_token=%s', ...);

	//db_fetch_assoc($res);
	
	//if($res == array())
	//	db_query('INSERT INTO users SET access_token=%s', $temp->access_token); 
	

	

	//$url2 = 'https://api.foursquare.com/v2/users/self?oauth_token='.$temp->access_token;
	//debug_r($temp);
	//$temp2 = pull($temp->access_token,'users/self/checkins');

	
	//ins = get_checkins($temp->access_token,'0','1299140125');

	//debug_r($ins);
	
	//$in_info = get_checkin_info($ins[4]);

//	add_adventure('Adventure 1',1298106060,2298150937);
	

	//$checks = get_adventure_list(0);

	//debug_r($checks);	 
	/*$ad = get_adventures(get_user_id(get_access_token()));


	$checks = get_checkins($temp->access_token,$ads[0]['start_time'],$ads[0]['end_time']);
	$check2=array();
	foreach($checks as $check)
	{
		$check2[] = get_checkin_info($check);
	}*/

	

	//remove_adventure($ad[0]['id']);
	//debug_r($in_info);

	//$output = json_decode($temp2);

	//debug_r($output);
	
	
?>
