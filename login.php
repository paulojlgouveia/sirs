
<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'src/php/functions.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'src/php/queries.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'src/php/exceptions.php');
	
	session_start();

	
	// load variables from post
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = clean_input($_POST["username"]);
		$password = clean_input($_POST["password"]);
	}


	// get user's data from database
	try {		
		$data = get_login_info($username);
		
	} catch(PDOException $e) {
		log_query_error($e->getMessage());
	}
	
	
	// verify existance of user
	if (!$data) {
		echo "FIXME proper error\n user does not exist."."<br>";
		die(header("location: login.html"));
	}
	
	
	echo "<br>"."<"."<br>";
	
	echo $data['user_id']."<br>";
	echo $data['username']."<br>";
	echo $data['password']."<br>";
	
	echo ">"."<br>";
	
	
	// verify password
	if (!password_verify($password, $data['password'])) {
		echo "FIXME proper error\n wrong password"."<br>";
		die(header("location: login.html"));
	}
	
	
	// pass the values into the session
	$_SESSION['id'] = $data['id'];
	$_SESSION['username'] = $data['username'];
	$_SESSION['level'] = $data['level'];
	

	// get back
	if ($data['level'] == 2) {
		exit(header("location: _administration/home.php"));
		
	} elseif ($data['level'] == 1) {
		exit(header("location: _user/home.php"));
		
	}

?>




