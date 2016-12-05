<link rel="stylesheet" href="src/css/general.css">
<link rel="stylesheet" href="src/css/productListing.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">


<body>
<div class="center" >
<?php 

include("config.php");
require_once("src/php/functions.php");

session_start();

try {		
		$sql = "SELECT * FROM item";
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute())) {
			throw new PDOException("execution of query failed!");
		}
		
		$data = $stmt->fetchAll();
		
	} catch(PDOException $e) {
		log_pdo_error($e->getMessage());
	}



foreach($data as $product) { 
?>
  	<!-- start product -->	 
	<div class="prod-info-main prod-wrap clearfix">
		<div class="row">
				<div class="col-md-5 col-sm-12 col-xs-12">
					<div class="product-image"> 
						<img src="img/<?=$product['Image']?>" class="img-responsive rotprod"> 
					</div>
				</div>
				<div class="col-md-7 col-sm-12 col-xs-12">
				<div class="product-detail">
						<h5 class="name">
							<a href="#"> <?=$product['ProductName']?>	</a>
							<a href="#">
								<span>Product Category</span>
							</a>                            

						</h5>
						<p class="price-container">
							<span><?=$product['Price']?>€</span>
						</p>
						<span class="tag1"></span> 
				</div>
				<div class="description">
					<p><?=$product['description']?></p>
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

	

<?php 

} ?>
</div>
</body> 
