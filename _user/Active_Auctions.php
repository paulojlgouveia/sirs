<?php 

	session_start();
	
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/queries.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/exceptions.php');
	
	
	
	function get_user_active_auctions($user_id) {
		
		$pdo = get_new_pdo();
		
		$sql = "SELECT 	*
				FROM open_auctions
				WHERE owner_id = ?
				ORDER BY auction_id DESC";
				
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute([$user_id]	))) {
			throw new QueryException($sql);
		}
		
		$pdo = null;
		
		return $stmt->fetchAll();
	}
	
	// prepare data before going into the page
	try {
		$active = get_user_active_auctions($_SESSION['id']);
		
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
		
		
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_common/navigation.php'); ?>
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_user/sidebar.php'); ?>
		
		<h1> SIRS Auction House </h1>
		


		
		
		<div class="productListingSection">
			
			
				
				<h3> Active Auctions </h3>
				
				<?php foreach($active as $item) { ?>
					
					
						<div class="prod-info-main prod-wrap clearfix">
						<div class="row">
							<div class="col-md-5 col-sm-12 col-xs-12">
								<div class="product-image"> 
									<img src="/img/items/<?=$item['image']?>" class="img-responsive rotprod" style="max-height:250px"> 
								</div>
							</div>
							<div class="col-md-7 col-sm-12 col-xs-12">
								<div class="product-detail">
										<h3 class="name">
											<a href="#"> <?=$item['name']?>	</a>											
										</h3>
										<p class="price-container">
											<span><?=$item['value']?>€</span>
										</p>
										<span class="tag1"></span> 
								</div>
									
								
								
								<div class="product-info smart-form">
									<div class="row">
										<div class="col-md-12"> 
											<p><?=$item['description']?></p>
											<a href="javascript:void(0);" class="btn btn-info" style="float:right;"><span>More Info</span></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
						
					
					
				<?php } ?>
				
			
			
			
			
		</div>
		
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_common/footer.html'); ?>		
	</body>
	
</html>