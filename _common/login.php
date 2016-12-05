
<?php

	include("config.php");
	require_once("src/php/functions.php");

	session_start();
	
	// load variables from post
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$username = sanitize($_POST["username"]);
		$password = encrypt(sanitize($_POST["password"]));
	}


	// get user's data from database
	try {		
		$sql = "SELECT id, username, password, level FROM user WHERE username=?";
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute([$username]))) {
			throw new PDOException("execution of query failed!");
		}
		
		$data = $stmt->fetch();
		
	} catch(PDOException $e) {
		log_pdo_error($e->getMessage());
	}
	
	echo "<br>"."<"."<br>";
	
	echo $data['id']."<br>";
	echo $data['username']."<br>";
	echo $data['password']."<br>";
	
	echo ">"."<br>";
	

// // 	// checks if user exists
// // 	
// // 	if (!$stmt->fetchColumn();) {
// // 		
// // 	}
// 	
// // 	if($result->rowCount() == 0) {
// // 		print_error("username does not exist.");
// // 		$connection = null;
// // 		echo("<a href=\"home.html\">return</a>");
// // 		exit();
// // 	}
// // 
// 
	// verify password FIXME compare function
	if($data['password'] != $password) {
		$pdo = null;
		
// 		FIXME report error to form
		
		echo "wrong password.";
		echo("<a href=\"home.php\">return</a>");
	}


	$pdo = null;
	
	// pass the values into the session
	$_SESSION['id'] = $data['id'];
	$_SESSION['username'] = $data['username'];
	$_SESSION['level'] = $data['level'];
	

	// get back
	if ($data['level'] == 2) {
		header("Location: admin_panel.php");
		
	} elseif ($data['level'] < 2) {
		header("Location: home.php");
		
	}

?>




