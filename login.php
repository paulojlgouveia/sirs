
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/functions.php');
	enable_error_reporting();
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/queries.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/exceptions.php');
	
	session_start();

	
	// load variables from post
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = clean_input($_POST["username"]);
		$password = clean_input($_POST["password"]);
	}


	$pdo = get_new_pdo();
	
	$pdo->beginTransaction();
	
	
	// get user's data from database
	$sql = "SELECT user_id, username, password, level
			FROM user
			WHERE username=?";
			
	$stmt = $pdo->prepare($sql);
	
	if (!($stmt->execute([$username]))) {
		throw new QueryException($sql);
	}	
	
	$data = $stmt->fetch();
	
	
	// verify existance of user
	if (!$data) {
		echo "FIXME proper error\n user does not exist."."<br>";
		die(header("location: login.html"));
	}
	
	
	// verify password
	if (!password_verify($password, $data['password'])) {
		echo "FIXME proper error\n wrong password"."<br>";
		die(header("location: login.html"));
	}
	
	$sql = "INSERT INTO login (user_id) VALUES (?)";
	
	$stmt = $pdo->prepare($sql);
	if (!($stmt->execute([$data['user_id']]))) {
		throw new QueryException($sql);
	}
	
	
	// pass the values into the session
	$_SESSION['id'] = $data['user_id'];
	$_SESSION['username'] = $data['username'];
	$_SESSION['level'] = $data['level'];
	
	
	$pdo->commit();
	$pdo = null;
	
	
	// get back
	if ($_SESSION['level'] == 2) {
		exit(header("location: _administration/home.php"));
		
	} elseif ($_SESSION['level'] == 1) {
		exit(header("location: _user/home.php"));
		
	}

?>




