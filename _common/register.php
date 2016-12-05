
<?php

	include("config.php");
	include("src/php/functions.php");

	session_start();


	// load variables from post
	if($_SERVER["REQUEST_METHOD"] == "POST") {
			$username = sanitize($_POST["username"]);
			$name = sanitize($_POST["name"]);
			$email = sanitize($_POST["email"]);
			$password = sanitize($_POST["password"]);
			$rpassword = sanitize($_POST["rpassword"]);
			$cc = sanitize($_POST["cc"]);
	}
	
	echo "1";

	// get user's data from database
	try {	
		$sql = "SELECT id FROM user WHERE username=?";
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute([$username]))) {
			throw new PDOException("execution of query failed!");
		}
		
	} catch(PDOException $e) {
		log_pdo_error($e->getMessage());
	}

	echo "2";

	// verify if user exists
	try {	
		$data = $stmt->fetchAll();
		if ($data) {
			// FIXME user exists exception
			exit();
		}
		
	} catch(PDOException $e) {
		log_pdo_error($e->getMessage());
	}

	echo "3";


// 	// FIXME verify strength of password
// 	switch() {
// 		//FIXME diferent values for too short, invalid chars, etc
// 	}
	
	echo "4";
	
	// check if passwords match
	if (strcmp($password, $rpassword) !== 0) {
// 		FIXME print_error("passwords do not match.");
		exit();

	}
	
	echo "5";

	
	$crypt_password = encrypt($password);

	echo "6";
	
	// insert values in database
	try {	
		$sql = "INSERT INTO user (username,password,name,email,cc) VALUES (?,?,?,?,?)";
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute([$username,$crypt_password,$name,$email,$cc]))) {
			throw new PDOException("execution of query failed!");
			exit();
		}
		
	} catch(PDOException $e) {
		log_pdo_error($e->getMessage());
	}
	
	echo "7";


	// imidiate login
	header("Location: login.php");

// 	$_SESSION['username'] = $username;
// 	$_SESSION['level'] = 1;


?>




