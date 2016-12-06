
<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/functions.php');
?>
	
	
<html>
	<title>Auction</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<body>
		
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_common/header.html'); ?>
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_common/navigation.php'); ?>
		
		<h1>user profile page</h1>
		
		<div id="sidebar" class="sidebar">
			<?php require('sidebar.php'); ?>
		</div>
		
		FIXME check if id= or class=
		<div class="center">
			
			<div id="new">
				<?php require($_SERVER['DOCUMENT_ROOT'].'/new.php'); ?>
			</div>
			
		</div>
		
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_common/footer.html'); ?>		
	</body>
	
</html>
