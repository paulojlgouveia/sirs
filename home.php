
<!doctype html>

<?php
	session_start();
?>


<html>
	<title>Auction</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<body>
		
		<?php require($_SERVER['DOCUMENT_ROOT']. "/_common/header.html"); ?>
		<?php require($_SERVER['DOCUMENT_ROOT']. "/_common/navigation.php"); ?>
		
		<h1>home page</h1>
		
		FIXME check if id= or class=
		<div id="new" class="center">
			<?php require($_SERVER['DOCUMENT_ROOT']. "new.php"); ?>
		</div>
		
		<br>
		<a href="src/php/info.php"> website info, please no exploit, not yet</a>
		
		<div id="hot">
			<?php require($_SERVER['DOCUMENT_ROOT']. "new.php"); ?>
		</div>
		
		
		<?php require($_SERVER['DOCUMENT_ROOT']. "/_common/footer.html"); ?>
		
	</body>
	
</html>



