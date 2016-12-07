
<?php 

	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/queries.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/exceptions.php');
	
	session_start();
	
	// prepare data before going into the page
	try {
		$new = get_new_auctions();
		
	} catch(PDOException $e) {
		log_query_error($e->getMessage());
	}
	
	try {
		$hot = get_hot_auctions();
		
	} catch(PDOException $e) {
		log_query_error($e->getMessage());
	}
	
	
?>


<html>
	<title>Auction</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="/src/css/general.css">
	<link rel="stylesheet" href="/src/css/productListing.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

	
	<body>
		
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_common/header.html'); ?>
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_common/navigation.php'); ?>
		
		<h1> sirs project 2 </h1>
		<h3><i> the reboot nobody asked for </i></h3>


		
		FIXME check if id= or class=
		<div class="center">
			
			<div id="new-auctions">
				
				<h5> Recenetly opened </h5>
				
				<?php foreach($new as $item) { ?>
					
					<article href="#">
						<div class="product-image"> 
							<img src="/img/items/<?=$item['username']?>/<?=$item['image']?>"> 
						</div>
						
						<div class="product-info">
							<h5> <?=$item['name']?> </h5>
							<p><i>from</i></p> <?=$item['username']?> </h6>
							<p><?=$item['description']?></p>
						</div>
						
					</article>
					
				<?php } ?>
				
			</div>
			
			<div id="hot-auctions">
				
				<h5> Most bid </h5>
				
				<?php foreach($hot as $item) { ?>
					
					<article href="#">
						<div class="product-image"> 
							<img src="/img/items/<?=$item['username']?>/<?=$item['image']?>"> 
						</div>
						
						<div class="product-info">
							<h5> <?=$item['name']?> </h5>
							<p><?=$item['description']?></p>
						</div>
						
					</article>
					
				<?php } ?>
				
			</div>
			
		</div>
		
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_common/footer.html'); ?>		
	</body>
	
</html>



