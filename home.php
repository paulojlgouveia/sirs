
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

	<style>
/*		http://stackoverflow.com/questions/13465052/html-code-to-put-image-in-left-and-text-in-right-side-of-screen-with-footer-belo
		.product-image {
			float: left;
		}*/
		
		img.item-quickview {
			width:4cm;
			height:4cm;
		}
		
		div.section {
			border: 1px solid darkgrey;
		}
		
		article {
			border: 1px solid darkgrey;
		}
	</style>
	
	<body>
		
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_common/header.html'); ?>
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_common/navigation.php'); ?>
		
		<h1> sirs project 2 </h1>
		<h3><i> the reboot nobody asked for </i></h3>


		
		FIXME check if id= or class=
		<div class="center">
			
			<div id="new-auctions" class="section">
				
				<h5> Recenetly opened </h5>
				
				<?php foreach($new as $item) { ?>
					
					<article href="#">
						<div class="product-image"> 
							<img class="item-quickview"
								src="/img/items/<?=$item['username']?>/<?=$item['image']?>"> 
						</div>
						
						<div class="product-info">
							<h5> <?=$item['name']?> </h5>
							<p><i>from</i> <?=$item['username']?> </p>
							<p><?=$item['description']?></p>
						</div>
						
					</article>
					
				<?php } ?>
				
			</div>
			
			<div id="hot-auctions" class="section">
				
				<h5> Most bid </h5>
				
				<?php foreach($hot as $item) { ?>
					
					<article href="#">
						<div class="product-image"> 
							<img class="item-quickview"
								src="/img/items/<?=$item['username']?>/<?=$item['image']?>"> 				
						</div>
						
						<div class="product-info">
							<h5> <?=$item['name']?> </h5>
							<p><i>from</i> <?=$item['username']?> </p>
							<p><?=$item['description']?></p>
						</div>
						
					</article>
					
				<?php } ?>
				
			</div>
			
		</div>
		
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_common/footer.html'); ?>		
	</body>
	
</html>


