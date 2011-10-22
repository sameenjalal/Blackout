<?

	function pull($access_token,$instruction,$args=array())
	{
		$new_arg = array();

		foreach($args as $key=>$val)
		{
			$new_arg[] = $key.'='.$val;
		}
		$url = 'https://api.foursquare.com/v2/'.$instruction.'?oauth_token='.$access_token.'&'.implode('&',$new_arg);
		return file_get_contents($url);
		
	}



	function pull_secret($access_token,$instruction,$args=array())
	{
		$new_arg = array();

		foreach($args as $key=>$val)
		{
			$new_arg[] = $key.'='.$val;
		}
		$url = 'https://api-kushal-staging.foursquare.com/v2/'.$instruction.'?oauth_token='.$access_token.'&'.implode('&',$new_arg);
		return file_get_contents($url);
		
	}

	function get_checkins($access_token,$start_time,$end_time=0)
	{



		$args = array();
		$args['afterTimestamp'] = $start_time;
		if(!$end){
			$args['beforeTimestamp'] = $end_time;
		}
		$temp = pull($access_token,'users/self/checkins',$args);
		$temp = json_decode($temp);		
		$temp = $temp->response->checkins->items;		
		return $temp;
	}

	function get_checkin_info($checkin)
	{


		$out = array();
		$out['id'] = $checkin->id;
		$out['time'] = $checkin->createdAt;
		$out['name'] = $checkin->venue->name;
		$out['lat'] = $checkin->venue->location->lat;
		$out['lng'] = $checkin->venue->location->lng;
		$out['comments'] = $checkin->comments->items;
		$out['photos'] = $checkin->photos->items;
		
		//friends???
		
		//$friends = pull_secret($temp->access_token,'checkins/'.$in_info['id']);
		//$friends = json_decode($friends);




		return $out;	
		
		
	}
	
	function get_adventure_list($num){

		$res = db_query('SELECT * FROM adventures WHERE id="%s"', $num);


		$result = db_fetch_assoc($res);

		

		//$ad = get_adventures(get_user_id(get_access_token()));

		$ad = $result[0];
//		debug_r($ad);

		$checks = get_checkins(get_access_token(),$ad['start_time'],$ad['end_time']);
		$check2=array();
		foreach($checks as $check)
		{
			$check2[] = get_checkin_info($check);
			
		}
		


		return $check2;
	}



?>
