<?php


namespace tool;


/* This is a drop-in replacement for the MySQLi object which is instrumented
 * using the instrumentation class.
 *
 * Change all instances of:  $obj = new mysqli(...)
 *                   with:   $obj = new mysqli_perf(...)
 *
 * If you use the functional interface replace:  mysqli_connect(...)
 *                                        with:  MySQLi_per::mysqli_connect(...)
 */

use Instrumentation;

class MySQLi_perf extends MySQLi
{
	#>1 IS ONLY SAFE IN AUTOCOMMIT MODE!!!!
	public static $deadlock_try_limit = 1;

	/* Object interface constructor */
	public function __construct($host = null, $user = null, $pass = null, $db = null)
	{
		if ($host === null) {
			ini_get("mysql.default_host");
		}
		if ($user === null) {
			ini_get("mysql.default_user");
		}
		if ($pass === null) {
			ini_get("mysql.default_password");
		}
		Instrumentation::get_instance()->increment('mysql_connection_count');
		Instrumentation::get_instance()->timer();
		parent::__construct($host, $user, $pass, $db);
		Instrumentation::get_instance()->increment('mysql_connect_time', Instrumentation::get_instance()->timer());
	}

	public function query($query, $resultmode = null)
	{
		$instance = Instrumentation::get_instance();

		$retry_count = 0;

		while ($retry_count < MySQLi_perf::$deadlock_try_limit) {
			$query = $instance->instrument_query($query, $retry_count);
			$instance->increment('mysql_query_count', 1);
			$retry_count = 0;

			$instance->timer();
			$r = parent::query($query, $resultmode);
			$instance->increment('mysql_query_exec_time', $instance->timer());

			if (mysqli_errno($this) == 1213) { /* 1213 (ER_LOCK_DEADLOCK)
									  Deadlock detected retry operation */
				$instance->increment('mysql_deadlock_count', 1);
				++$retry_count;
				continue; // loop to the start of the while loop
			}

			break;

		}

		return $r;
	}

	public function multi_query($query, $resultmode = null)
	{
		$instance = Instrumentation::get_instance();

		$retry_count = 0;

		while ($retry_count < MySQLi_perf::$deadlock_try_limit) {
			$query = $this->instrument_query($query, $retry_count);
			$instance->increment('mysql_query_count', 1);
			$retry_count = 0;

			Instrumentation::get_instance()->timer();
			$r = parent::multi_query($query, $resultmode);

			$instance->increment('mysql_query_exec_time', Instrumentation::get_instance()->timer());

			if ($this->errno() == 1213) { /* 1213 (ER_LOCK_DEADLOCK)
									  Deadlock detected retry operation */
				$instance->increment('mysql_deadlock_count', 1);
				++$retry_count;
				continue; // loop to the start of the while loop
			}

			break;

		}

		return $result;
	}

	/* emulate functional mysqli_connect interface */
	public static function mysqli_connect(
		$host = null,
		$user = null,
		$pass = null,
		$db = null,
		$port = null,
		$socket = null
	) {

		Instrumentation::get_instance()->timer();;
		$r = mysqli_connect($host, $user, $pass, $db, $port, $socket);
		Instrumentation::get_instance()->increment('mysql_connection_count');
		Instrumentation::get_instance()->increment('mysql_connect_time', Instrumentation::get_instance()->timer());
		return $r;
	}

	/* emulate functional mysqli_query interface */
	public static function mysqli_query($link, $query, $resultmode = null)
	{
		$instance = Instrumentation::get_instance();

		$retry_count = 0;
		$result = false;
		while ($retry_count < MySQLi_perf::$deadlock_try_limit) {
			$query = $instance->instrument_query($query, $retry_count);
			$instance->increment('mysql_query_count', 1);
			$retry_count = 0;

			Instrumentation::get_instance()->timer();
			$result = mysqli_query($link, $query, $resultmode);
			$errno = mysqli_errno($link);
			$instance->increment('mysql_query_exec_time', Instrumentation::get_instance()->timer());

			if ($errno == 1213) { /* 1213 (ER_LOCK_DEADLOCK)
									  Deadlock detected retry operation */
				$instance->increment('mysql_deadlock_count', 1);
				++$retry_count;
				continue; // loop to the start of the while loop
			}

			break;

		}

		return $result;
	}

	/* emulate functional mysqli_multi_query interface. only increment counter by one for now.. */
	public static function mysqli_multi_query($query, $resultmode = MYSQL_STORE_RESULT)
	{
		$instance = Instrumentation::get_instance();

		$retry_count = 0;

		while ($retry_count < MySQLi_perf::$deadlock_try_limit) {
			$query = $this->instrument_query($query, $retry_count);
			$instance->increment('mysql_query_count', 1);
			$retry_count = 0;

			Instrumentation::get_instance()->timer();
			$r = parent::multi_query($query, $resultmode);

			$instance->increment('mysql_query_exec_time', Instrumentation::get_instance()->timer());

			if ($this->errno() == 1213) { /* 1213 (ER_LOCK_DEADLOCK)
									  Deadlock detected retry operation */
				$instance->increment('mysql_deadlock_count', 1);
				++$retry_count;
				continue; // loop to the start of the while loop
			}

			break;

		}

		return $result;
	}


}

