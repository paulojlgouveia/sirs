
<!doctype html>
<!--
<?php


// 	include("config.php");
// 	require_once("src/php/functions.php");
// 
// 	session_start();
// 	
// 	// load variables from post
// 	if($_SERVER["REQUEST_METHOD"] == "POST") {
// 		$p_id = sanitize($_POST["ProductID"]);
// 	}
// 	
// 	
// 	try {		
// 		$sql = "SELECT  FROM item";
// 		$stmt = $pdo->prepare($sql);
// 		if (!($stmt->execute())) {
// 			throw new PDOException("execution of query failed!");
// 		}
// 		
// 		$data = $stmt->fetchAll();
// 		
// 	} catch(PDOException $e) {
// 		log_pdo_error($e->getMessage());
// 	}
// 	
// 	
	
?>
-->

<html>
	<head>
		<title>Product Page</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="styles/normalize.css">
		<link rel="stylesheet" type="text/css" href="styles/styles.css">
		<link rel="stylesheet" type="text/css" href="/src/css/productPage.css">
		<link rel="stylesheet" type="text/css" href="/src/css/Comments.css">
		
	</head>
	
	
	<body>
	<?php require($_SERVER['DOCUMENT_ROOT'].'/_common/navigation.php'); ?>
		<div class="mainPiece">
			 <div class="productFrame">
			 	  <div class="topHalf">
    			 	  <div class="productImage"> 
    						<img src="/img/items/cartman/clyde_frog.jpg"> 
    				  </div>
    				  <div class="productInfo">
					  	   <h1>Derpina McDerp</h1>
					  	   <div>
						   		<p>Price - 200€</p>
						   </div>
						   <div>
						   </div>					  
					  </div>
				  </div>
				  <div>
    				  <h1>Description</h1>
    				  <div class="productDescription">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ultricies condimentum velit vel scelerisque. Nam id libero sit amet libero ultrices interdum dignissim nec lorem. Maecenas placerat massa sit amet augue interdum rutrum. Fusce vel lectus arcu. Quisque quis elit et lorem suscipit faucibus a ut odio. Proin ut ante consectetur dui mattis pulvinar non quis neque. Proin ultrices lectus vel orci lacinia a iaculis nibh hendrerit. Mauris sagittis aliquam odio vitae pulvinar. Suspendisse id dolor nibh, sed consectetur sem. Phasellus lacinia laoreet sem, ac ultrices libero lobortis quis. Morbi accumsan tempus neque, sed varius lectus molestie imperdiet. Vivamus porttitor facilisis nunc, sed feugiat quam adipiscing ac. Quisque dolor tellus, porta in ultrices sit amet, luctus sed nunc. Quisque sodales scelerisque orci sed ullamcorper. Nunc nisl arcu, dignissim sed tempor eget, blandit a massa. Praesent ut metus enim, in dictum felis. Integer sagittis ipsum eu mauris lacinia rhoncus. Mauris turpis ligula, dapibus nec rhoncus bibendum, tristique eu nunc. Duis dapibus blandit justo et auctor. Nunc non elit vel diam luctus ullamcorper. Nulla elementum tristique ultricies. Etiam sit amet felis leo, non imperdiet sapien. Suspendisse venenatis, erat ac mollis sagittis, nulla arcu semper felis, a tempus dolor nibh in est. Nullam. </div>
				  </div>
			 </div>
			 
			 <div class="commentSection">
        		<h1>Comments</h1>
        			<ul class="commentsList">
        				<li class="commentsItem">
        					<div class="userComment">
            					<div class="userInfo">
                                  <p class="userInfo">Annie Silverston<span style="font-weight:lighter; color:#9B9B9B"> - 4 hours ago</span></p>
                                  
                                </div>
                              	<div class="userCommentText">
        							 <p>Awesome stuffs.</p>
        						</div>
        					</div>                  
                       </li>
					   <li class="commentsItem">
        					<div class="userComment">
            					<div class="userInfo">
                                  <p class="userInfo">Derpy McDerp<span style="font-weight:lighter; color:#9B9B9B"> - 12 hours ago</span></p>
                                  
                                </div>
                              	<div class="userCommentText">
        							 <p>Oh yeah oasjldkasjdlajdlasjdlakjdlasjd.</p>
        						</div>
        					</div>                  
                       </li>
                      <!-- More comments -->
                  
                      <li class="write-new">
					  	  <div>
    						  <form action="#" method="post">
                                  <textarea class="textBoxArea" placeholder="Write your comment here" name="comment" maxlength="255"></textarea>
                                  <div>
                                      <button type="submit" >Submit</button>
                                  </div>
                              </form>
						  </div>                                            
                      </li>
                  
                  </ul>
        		</div>		
		</div>
  
	</body>
</html>



