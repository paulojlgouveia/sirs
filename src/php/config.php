
<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/functions.php');
	

	function get_new_pdo() {
		
		session_start();
		
		if (isset($_SESSION['id'])) {
			if ($_SESSION['level'] == 2) {
				// admin db priveleges
				$host='localhost';
				$user='admin';
				$password='5up3r D1ff1cul7 4dm1n P455w0rd';
				$dbname = 'auctionsDB';
				$charset = 'utf8';
					
			} elseif ($_SESSION['level'] == 1) {
				// user db priveleges
				$host='localhost';
				$user='user';
				$password='1 4m ju57 4 C0mm0n U53r P3454n7';
				$dbname = 'auctionsDB';
				$charset = 'utf8';
			}
			
		} else {
			// guest db priveleges for regestering and stuff
			$host='localhost';
			$user='general';
			$password='N07 r34Lly 4 h4Rd P4$$w0rd 70 6u355';
			$dbname = 'auctionsDB';
			$charset = 'utf8';
		}
		
// 			$host='localhost';
// 			$user='root';
// 			$password='ju57 50m3 p455w0rD';
// 			$dbname = 'auctionsDB';
// 			$charset = 'utf8';

		
		// data source name
		$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
		
		
		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		
		
		try {
			return new PDO($dsn, $user, $password, $options);
			
		} catch(PDOException $e) {
			log_pdo_error($e->getMessage());		
		}
	}

	
	
	
	function get_general_pdo() {

		$host='localhost';
		$user='general';
		$password='N07 r34Lly 4 h4Rd P4$$w0rd 70 6u355';
		$dbname = 'auctionsDB';
		$charset = 'utf8';
		
		// data source name
		$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
		
		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		
		try {
			return new PDO($dsn, $user, $password, $options);
			
		} catch(PDOException $e) {
			log_pdo_error($e->getMessage());		
		}
		
	}


	function get_user_pdo() {
		
		session_start();
		
		if (isset($_SESSION['id']) && ($_SESSION['level'] == 1)) {
		
			$host='localhost';
			$user='user';
			$password='1 4m ju57 4 C0mm0n U53r P3454n7';
			$dbname = 'auctionsDB';
			$charset = 'utf8';
			
			
			// data source name
			$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
			
			$options = [
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES   => false,
			];
			
			try {
				return new PDO($dsn, $user, $password, $options);
				
			} catch(PDOException $e) {
				log_pdo_error($e->getMessage());		
			}
			
		} else {
			// FIXME throw exception
		}
		
	}


	function get_admin_pdo() {
		
		session_start();
		
		if (isset($_SESSION['id']) && ($_SESSION['level'] == 2)) {
			
			$host='localhost';
			$user='admin';
			$password='5up3r D1ff1cul7 4dm1n P455w0rd';
			$dbname = 'auctionsDB';
			$charset = 'utf8';
			
			// data source name
			$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
			
			$options = [
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES   => false,
			];
			
			try {
				return new PDO($dsn, $user, $password, $options);
				
			} catch(PDOException $e) {
				log_pdo_error($e->getMessage());		
			}
			
		} else {
			// FIXME throw exception
		}
		
	}

?>




