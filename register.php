<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/functions.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/queries.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/insert_queries.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/exceptions.php');

	session_start();


	// load variables from post 
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = clean_input($_POST["username"]);
		$email = clean_input($_POST["email"]);
		$password = clean_input($_POST["password"]);
		$rpassword = clean_input($_POST["rpassword"]);
	}
	

	// get user's data from database
	try {		
		$data = get_login_info($username);
		
	} catch(QueryException $e) {
		log_query_error($e->getMessage());
	}
	
	
	// verify existance of user
	if ($data) {
		echo "FIXME proper error\n user exists."."<br>";
		die(header("location: register.html"));
	}

	

// 	// FIXME verify strength of password if we have time
// 	switch() {
// 		//FIXME diferent values for too short, invalid chars, etc
// 	}




	// check if passwords match
	if (strcmp($password, $rpassword) !== 0) {
// 		FIXME print_error("passwords do not match.");
		exit();
	}
	
	
	$password = password_hash($password, PASSWORD_DEFAULT);

	
	// insert values in database
	try {
		register_user($username, $password, $email);
		
	} catch(QueryException $e) {
		//FIXME
		log_pdo_error($e->getMessage());
	}
	

	// imidiate login
	// get user's data from database to make sure he's there
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
	
	
	// pass the values into the session
	$_SESSION['id'] = $data['user_id'];
	$_SESSION['username'] = $data['username'];
	$_SESSION['level'] = $data['level'];
	
	header("location: _user/home.php")
	
?>