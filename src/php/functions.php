
<?php

	function enable_error_report() {
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
	function clean($data) {
// 		$data = trim($data);
// 		$data = stripslashes($data);
// 		$data = htmlspecialchars($data);
// 		$data = mysql_real_escape_string($data);
		return $data;
	}

	
	// cleans and displays an error message FIXME
	function log_pdo_error($message) {
		file_put_contents('log/PDO_errors.txt', $message, FILE_APPEND);
	}

	



?>



