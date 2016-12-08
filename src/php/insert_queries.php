
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
	
	

	
	
	
?>



