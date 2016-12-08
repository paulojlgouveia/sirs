
<?php

	session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/config.php');
	
	$pdo = get_new_pdo();
	
	$sql = "UPDATE login
			SET logout = CURRENT_TIMESTAMP
			WHERE login.user_id=? AND login.logout IS NULL";
	
	$stmt = $pdo->prepare($sql);
	if (!($stmt->execute([$_SESSION['id']]))) {
		throw new QueryException($sql);
	}
	
	$pdo = null;
	
	if(session_destroy()) {
		exit(header("Location: home.php"));
	}

?>


