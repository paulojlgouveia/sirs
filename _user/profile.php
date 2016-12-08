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
<!doctype html>

<html>
	<title>Auction</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="/src/css/general.css">
	<link rel="stylesheet" href="/src/css/userProfile.css">
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
		
			<div class="centerInPage">
			
				<div class="container">
				
                      <form class="form-horizontal">
                      <fieldset>
                      
                      <!-- Form Name -->
                      <legend style="margin-bottom: 40px;">User Information</legend>
                      
                      <!-- Text input-->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">name</label>  
                        <div class="col-md-4">
                        <input id="textinput" name="textinput" type="text" placeholder="name" class="form-control input-md">
                          
                        </div>
                      </div>
                      
                      <!-- Text input-->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">last name</label>  
                        <div class="col-md-4">
                        <input id="textinput" name="textinput" type="text" placeholder="last name" class="form-control input-md">
                          
                        </div>
                      </div>
                      
                      <!-- File Button --> 
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="filebutton">photo</label>
                        <div class="col-md-4">
						  <img src="../img/avatars/derpina.jpg" style="max-height:70px">
                          <input id="filebutton" name="filebutton" class="input-file" type="file">
                        </div>
                      </div>
                      
                      <!-- Text input-->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">birthday</label>  
                        <div class="col-md-4">
                        <input id="textinput" name="textinput" type="text" placeholder="birthday" class="form-control input-md">
                          
                        </div>
                      </div>            
                      
                      <!-- Text input-->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">contact email address</label>  
                        <div class="col-md-4">
                        <input id="textinput" name="textinput" type="text" placeholder="contact email address" class="form-control input-md">
                          
                        </div>
                      </div>
                      
                      <!-- Text input-->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="textinput">phone</label>  
                        <div class="col-md-4">
                        <input id="textinput" name="textinput" type="text" placeholder="phone" class="form-control input-md">
                          
                        </div>
                      </div>           
                      
                      
                      <!-- Select Basic -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="selectbasic">gender</label>
                        <div class="col-md-4">
                          <select id="selectbasic" name="selectbasic" class="form-control">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                          </select>
                        </div>
                      </div>            
                      
                      <!-- Button -->
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="singlebutton"></label>
                        <div class="col-md-4">
                          <button id="singlebutton" name="singlebutton" class="btn btn-primary">submit</button>
                        </div>
                      </div>
                      
                      </fieldset>
                      </form>
                      
                  </div>			
			</div>
          		

			
		<?php require($_SERVER['DOCUMENT_ROOT'].'/_common/footer.html'); ?>		
	</body>
	
</html>