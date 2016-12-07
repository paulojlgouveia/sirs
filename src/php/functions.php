
<?php

	function enable_error_reporting() {
		ini_set('display_startup_errors', 1);
		ini_set('display_errors', 1);
		error_reporting(-1);
	}
	
	
	// hashing function FIXME bcrypt
	function encrypt($data) {
		$result = hash("sha256", $data);
		return $result;
	}


	// input sanitization FIXME
	function clean_input($data) {
// 		$data = trim($data);
// 		$data = stripslashes($data);
// 		$data = htmlspecialchars($data);
// 		$data = mysql_real_escape_string($data);
		return $data;
	}

	

	// error logging //
	
	function log_pdo_error($message) {
		echo $message;
		file_put_contents('log/PDO_errors.txt', $message, FILE_APPEND);
	}

	function log_query_error($message) {
			echo $message;

		file_put_contents('log/query_errors.txt', $message, FILE_APPEND);
	}

	function log_top_level_error($message) {
		echo $message;
		file_put_contents('log/server_errors.txt', $message, FILE_APPEND);
	}

?>



