
<!doctype html>

<?php


	include("config.php");
	require_once("src/php/functions.php");

	session_start();
	
	// load variables from post
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$p_id = sanitize($_POST["ProductID"]);
	}
	
	
	try {		
		$sql = "SELECT  FROM item";
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute())) {
			throw new PDOException("execution of query failed!");
		}
		
		$data = $stmt->fetchAll();
		
	} catch(PDOException $e) {
		log_pdo_error($e->getMessage());
	}
	
	
	
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Product Page</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles/normalize.css">
		<link rel="stylesheet" type="text/css" href="styles/styles.css">
		<script src="scripts/jquery.js"></script>
		
		<script src="scripts/modernizr.js"></script>
	</head>
	<body>
		<div class="product clear">
			<header>
				<hgroup>
					<h1>Apple iPhone 4 - 16GB</h1>
					<h4>The most amazing iPhone yet.</h4>
				</hgroup>
			</header>
			<figure>
				<img src="images/iphone4s-3d.png">
			</figure>
			<section>
				<p>The faster dual-core A5 chip. The 8MP camera with all-new optics also shoots 1080p HD video. And introducing Siri. It's the most amazing iPhone yet.</p>
				<details>
					<summary>Product Features</summary>
						<ul>
							<li>8 mega pixel camera with full 1080p video recording</li>
							<li>Siri voice assitant</li>
							<li>iCloud</li>
							<li>Air Print</li>
							<li>Retina display</li>
							<li>Photo and video geotagging</li>
						</ul>
				</details>
				<button>Buy Now</button> 
			</section>
		</div>
		<script>
			if ($('html').hasClass('no-details')) {
				
				var summary = $('details summary');

				summary.siblings().wrapAll('<div class="slide"></div>');

				$('details:not(.open) summary').siblings('div').hide();

				summary.click(function() { 
					$(this).siblings('div').toggle();
	          			$('details').toggleClass('open');
       			});
			 }
		</script>

	</body>
</html>



