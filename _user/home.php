<?php 

	session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/queries.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/exceptions.php');
	
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
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_user/sidebar.php'); ?>
		
		<h1> SIRS Auction House </h1>
		
		<div class="productListingSection">
			
			<div id="new-auctions" class="section">
				
				<h5> Recenetly opened </h5>
				
				<?php foreach($new as $item) { ?>
					
					<div class="prod-info-main prod-wrap clearfix">
						
						<div class="row">
							
							<div class="col-md-5 col-sm-12 col-xs-12">
								<div class="product-image"> 
									<img src="/img/items/<?=$item['username']?>/<?=$item['image']?>" class="img-responsive rotprod" style="max-height:250px"> 
								</div>
							</div>
							
							<div class="col-md-7 col-sm-12 col-xs-12">
								
								<div class="product-detail">
									<h3 class="name">
										<a href="#"> <?=$item['name']?>	</a>
											<span style="color:darkgrey; font-size:16px;">auctioned by <span style="font-size:larger; color:#00AC11"><?=$item['username']?></span></span>
									</h3>
									<p class="price-container">
										<span style="color:darkgrey; font-size:16px;">current highest bid <span><?=$item['value']?> €</span></span>
									</p>
									<span class="tag1"></span> 
								</div>
								
								<div class="product-info smart-form">
									<div class="row">
										<div class="col-md-12"> 
											<p><?=$item['description']?></p>
											<a href="javascript:void(0);" class="btn btn-info" style="float:right;"><span>More info</span></a>
										</div>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					
				<?php } ?>
				
			</div>
			
			<div id="hot-auctions" class="section">
				
				<h5> Most bid </h5>
				
				<?php foreach($hot as $item) { ?>
					
					<div class="prod-info-main prod-wrap clearfix">
						
						<div class="row">
							
							<div class="col-md-5 col-sm-12 col-xs-12">
								<div class="product-image"> 
									<img src="/img/items/<?=$item['username']?>/<?=$item['image']?>" class="img-responsive rotprod" style="max-height:250px"> 
								</div>
							</div>
							
							<div class="col-md-7 col-sm-12 col-xs-12">
								
								<div class="product-detail">
									<h3 class="name">
										<a href="#"> <?=$item['name']?>	</a>
											<span style="color:darkgrey; font-size:16px;">auctioned by <span style="font-size:larger; color:#00AC11"><?=$item['username']?></span></span>
									</h3>
									<p class="price-container">
										<span style="color:darkgrey; font-size:16px;">current highest bid <span><?=$item['value']?> €</span></span>
									</p>
									<span class="tag1"></span> 
								</div>
								
								<div class="product-info smart-form">
									<div class="row">
										<div class="col-md-12"> 
											<p><?=$item['description']?></p>
											<a href="javascript:void(0);" class="btn btn-info" style="float:right;"><span>More info</span></a>
										</div>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					
					
				<?php } ?>
				
			</div>
			
		</div>
		
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_common/footer.html'); ?>		
	</body>
	
</html>





