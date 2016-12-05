
<!doctype html>

<?php
	session_start();
	phpinfo();
?>


<html>
	<title>Auction</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<body>
		
		<?php require($DOCUMENT_ROOT . "header.html"); ?>
		<?php require($DOCUMENT_ROOT . "navigation.php"); ?>
		
		<h1>home page</h1>
		
		<?php require($DOCUMENT_ROOT . "content.php"); ?>
		
		
		
		
		<?php require($DOCUMENT_ROOT . "footer.html"); ?>
		
	</body>
	
</html>



