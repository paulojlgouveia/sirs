
<?php

// single place for queries
// to avoid having to change several files upon DB update

	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/config.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/exceptions.php');


	function register_user($username, $password, $email) {
		
		$pdo = get_new_pdo();
		
		// multiple users trying to register with the same info
		$pdo->beginTransaction();
		
		$sql = "INSERT INTO user (username,password,email) VALUES (?,?,?)";
				
		$stmt = $pdo->prepare($sql);
		
		if (!($stmt->execute([$username,$password,$email]))) {
			$pdo->rollBack();
			throw new QueryException($sql);
			exit();
		}	
		
		$pdo->commit();
		$pdo = null;
		
		return;
	}
	

	
	
// this should work but are untested //


	function comment($auction_id, $username, $text) {
		
		$pdo = get_new_pdo();
		
		$sql = "INSERT INTO comment (auction_id, author_id, text) VALUES (?,?,?)";
		
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute([$auction_id, $username, $text]))) {
			throw new QueryException($sql);
		}
		
		$pdo = null;
		
		return;
	}

	
	
// FIXME from here on down is all work in progress //
	
	
	function login($username, $password) {
		
		$pdo = get_new_pdo();
		
		$pdo->beginTransaction();
		
		
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
		if (!($stmt->execute($data['user_id']))) {
			throw new QueryException($sql);
		}
		
		
		// pass the values into the session
		$_SESSION['id'] = $data['user_id'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['level'] = $data['level'];
		
		
		// get back
		if ($_SESSION['level'] == 2) {
			exit(header("location: ".$_SERVER['DOCUMENT_ROOT']."/_administration/home.php"));
			
		} elseif ($_SESSION['level'] == 1) {
			exit(header("location: ".$_SERVER['DOCUMENT_ROOT']."/_user/home.php"));
			
		}
		
		
		$pdo->commit();
		$pdo = null;
		
		return;
	}
	
	
	function logout($user_id) {
		
		session_start();
		
		$pdo = get_new_pdo();
		
		$sql = "UPDATE login
				SET logout = CURRENT_TIMESTAMP
				Where user_id = ? AND logout IS NULL";
		
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute($_SESSION['id']))) {
			throw new QueryException($sql);
		}
		
		$pdo = null;
		
		if(session_destroy()) {
			header("Location: ".$_SERVER['DOCUMENT_ROOT']."/home.php");
		}
		
		return;
	}
	


	
	
	
?>



