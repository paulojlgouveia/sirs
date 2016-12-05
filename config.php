
<?php
	$host="localhost";
	$user="root";
	$password="ju57 50m3 p455w0rD";
	$dbname = "auctionsDB";
	$charset = 'utf8';

	// data source name
	$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
	
	$options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
	];
	
	try {
		$pdo = new PDO($dsn, $user, $password, $options);
		
	} catch(PDOException $e) {
		log_pdo_error($e->getMessage());		
	}

?>


