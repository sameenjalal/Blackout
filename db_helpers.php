<?

	//include('foursquare_handler.php');

	function insert_user($access_token,$session_code=0)
	{

		$res = db_query('SELECT * FROM users WHERE access_token="%s"', $access_token);

		$result = db_fetch_assoc($res);
	
		if(!$result)
		{
			db_query('INSERT INTO users SET access_token="%s"', $access_token); 
		}
	}

	function get_adventure($adventure_id)
	{
		$res = db_query('SELECT * FROM adventures WHERE id="%s"', $adventure_id);

		$result = db_fetch_assoc($res);

		$result = $result[0];
	}


	function add_adventure($name,$start_time,$end_time)
	{

		db_query('INSERT INTO adventures (user_id,name,start_time,end_time) VALUES(%s,"%s",%s,%s)',get_user_id(get_access_token()),$name,$start_time,$end_time);
	}

	function remove_adventure($adventure_id)
	{
		db_query('DELETE FROM adventures WHERE id="%s"',$adventure_id);
	}


	function get_user_id($access_token)
	{
		$res = db_query('SELECT * FROM users WHERE access_token="%s"', $access_token);

		$result = db_fetch_assoc($res);

		$result = $result[0]['id'];
		return $result;
	}


	function get_adventures($user_id)
	{
		
		$res = db_query('SELECT * FROM adventures WHERE user_id="%s"', $user_id);

		$result = db_fetch_assoc($res);

		return $result;

	}
		





?>
