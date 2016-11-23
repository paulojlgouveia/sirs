 
<?php
   include("config.php");

	session_start();

	if(session_destroy()) {
		header("Location: ../../home.html");
	}

?>

<html>

	<head>
		<meta http-equiv="refresh" content="0; URL=../../home.html">
		<meta name="keywords" content="automatic redirection">
	</head>
	
	<body>
		If the page doesn't automatically load click 
		<a href="../../home.html">here</a> 
	</body>
	
</html>

