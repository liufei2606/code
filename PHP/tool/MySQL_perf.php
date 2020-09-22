<?php


namespace tool;

/* This class can be used to replace calls to the non-object oriented mysql_ class of functions.
 * replace calls to mysql_connect with MySQL_perf::connect
 *                  mysql_query with MySQL_perf::mysql_query
 *
 * This class is abstract and can't be instantiated because the mysql_ interface is not object oriented.
 * Thus this class functions only as a convenient namespace for the functions.
 */

use Instrumentation;

abstract class MySQL_perf {
	private static $connection_list = array();
	#>1 IS ONLY SAFE IN AUTOCOMMIT MODE!!!!
	public static $deadlock_try_limit = 1;

	public static function mysql_connect( $host = NULL, $user=NULL, $pass=NULL, $new_link = NULL , int $flags = NULL ) {

		if($host === NULL) ini_get("mysql.default_host");
		if($user === NULL) ini_get("mysql.default_user");
		if($pass === NULL) ini_get("mysql.default_password");
		if($flags === NULL) $flags = 0;

		/* PHP reuses a connection if one has already been established, so don't increment
		 * the counter on connection reuse.
		 */
		if($new_link || empty(MySQL_perf::$connection_list[$host . $user . $pass . $flags])) {
			Instrumentation::get_instance()->increment('mysql_connection_count');
		}

		/* record the connection */
		MySQL_perf::$connection_list[$host . $user . $pass . $flags] = 1;
		Instrumentation::get_instance()->timer();
		$r = mysql_connect($host, $user, $pass, $new_link, $flags);
		Instrumentation::get_instance()->increment('mysql_connect_time', Instrumentation::get_instance()->timer());
		return $r;
	}


	public static function mysql_query($sql, $conn=false) {
		$instance = Instrumentation::get_instance();

		$retry_count = 0;


		while($retry_count < MySQL_perf::$deadlock_try_limit) {
			$instance->increment('mysql_query_count', 1);
			$instance->instrument_query($sql, $retry_count);

			$result = false;
			$errno = -1;
			Instrumentation::get_instance()->timer();
			if ($conn !== false) {
				$result = mysql_query($sql, $conn);
				$errno = mysql_errno($conn);
			} else {
				$result = mysql_query($sql);
				$errno = mysql_errno($conn);
			}
			$instance->increment('mysql_query_exec_time',Instrumentation::get_instance()->timer());

			if ($errno == 1213) { /* 1213 (ER_LOCK_DEADLOCK)
									  Deadlock detected retry operation */

				++$retry_count;
				continue; // loop to the start of the while loop
			}

			break; /* exit loop to return result */

		}

		return $result;
	}
}
