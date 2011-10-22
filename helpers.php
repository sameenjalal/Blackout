<?php
	/** This is a nice version of print_r you can use while debugging webpages. It'll print the array prettier. */
	function debug_r($arr)
	{
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
	}

	/** This function prints out the html encoded version of text. If you are printing out a variable and you know it doesn't contain html, use encho() instead of echo(). Helps a lot in avoiding XSS bugs. */
	function encho($text)
	{
		echo htmlspecialchars($text);
	}

	define('DB_USER', 'samjalal');
	define('DB_PASS', 'akash123');
	define('DB_HOST', 'mysql.sameenjalal.com');
	define('DB_NAME', 'sameen_test');
	
	/** This function connects us to the database defined in the macros above. */
	function db_connect()
	{
		mysql_connect(DB_HOST, DB_USER, DB_PASS);		
		mysql_select_db(DB_NAME);
	}

	/** This function is equivalent to calling mysql_query(sprintf(query, ...)). It will mysql_real_escape all args after the first arg in sprintf.
	 * This is awesome for avoiding SQL injections.
	 * You can set sql_explain=1 in the $_REQUEST to debug sql_queries.
	 */
	function db_query($query)
	{
		$num_args = func_num_args();

		$args = array();
		$args[] = $query;

		for($i = 1; $i < $num_args; $i++)
		{
			$args[] = mysql_real_escape_string(func_get_arg($i));
		}

		$query = call_user_func_array('sprintf', $args);

		if($_REQUEST['sql_explain'] == 1)
		{
			debug_r('Query: '.$query."\n");
		}

		$res = mysql_query($query) or die('Mysql Error occurred: '.mysql_error(). '	 File: '.__FILE__. ' Line: '.__LINE__. "\n Query: $query\n");
		return $res;
	}


	/** This function returns back a list of entries in the table. Each entry is an associative array of stuff.
	 * DO NOT USE THIS FOR BIG TABLES
	 */
	function db_fetch_assoc($res)
	{
		$rv = array();
		while($row = mysql_fetch_assoc($res))
		{
			$rv[] = $row;
		}
		return $rv;
	}

	db_connect();
	$success = session_start();
	if(!$success)
	{
		die('Session was not successfully started in '.__FILE__.' on line '.__LINE__);
	}

	/** This is a function that returns the user's access token if he is logged in. */
	function get_access_token()
	{
		if(isset($_SESSION['session_code']) && isset($_SESSION['access_token']))
		{
			return $_SESSION['access_token'];
		}

		return NULL;
	}

	/** Logs a user in. Sets session variables. */
	function authenticate_user($access_token, $code)
	{
		if($code && $access_token)
		{
			$_SESSION['session_code'] = $code;
			$_SESSION['access_token'] = $access_token;
		}
	}
