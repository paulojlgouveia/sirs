

<?php 

	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']. 'src/php/config.php');
	require_once($_SERVER['DOCUMENT_ROOT']. 'src/php/functions.php');
	require_once($_SERVER['DOCUMENT_ROOT']. 'src/php/queries.php');

	// prepare data before going into the page
	try {
		$data = get_new_items();
		
	} catch(PDOException $e) {
		log_query_error($e->getMessage());
	}
	
?>



<link rel="stylesheet" href="src/css/general.css">
<link rel="stylesheet" href="src/css/productListing.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">


<?php foreach($data as $item) { ?>

  	<!-- start product -->	 
	<div class="prod-info-main prod-wrap clearfix">
		<div class="row">
				<div class="col-md-5 col-sm-12 col-xs-12">
					<div class="product-image"> 
						<img src="img/<?=$item['image']?>" class="img-responsive rotprod"> 
					</div>
				</div>
				<div class="col-md-7 col-sm-12 col-xs-12">
				<div class="product-detail">
						<h5 class="name">
							<a href="#"> <?=$item['name']?>	</a>
							<a href="#">
								<span>Product Category</span>
							</a>                            

						</h5>
						<p class="price-container">
							<span><?=$item['value']?>€</span>
						</p>
						<span class="tag1"></span> 
				</div>
				<div class="description">
					<p><?=$item['description']?></p>
				</div>
				<div class="product-info smart-form">
					<div class="row">
						<div class="col-md-12"> 
							<a href="javascript:void(0);" class="btn btn-danger btn-cart"><span>Add to cart</span></a>
                            <a href="javascript:void(0);" class="btn btn-info"><span>More info</span></a>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- end product -->

	

<?php } ?>




