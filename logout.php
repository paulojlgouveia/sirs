
<?php
//    include("config.php");
	
	session_start();
	
	if(session_destroy()) {
		header("Location: home.php");
	}

?>

<!--<html>
	<head>
		<meta http-equiv="refresh" content="0; URL=../../home.html">
		<meta name="keywords" content="automatic redirection">
	</head>

	<body>
		If the page doesn't automatically load
		<a href="home.html">click here</a>
	</body>
</html>-->



