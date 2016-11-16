 
<html>
	<body>
		<?php
			session_start();
			
			// Termina a sessão do utilizador
			session_destroy();
		?>
		
		<head>
			<meta http-equiv="refresh" content="0; URL=login.html">
			<meta name="keywords" content="automatic redirection">
		</head>
		<body>
			If the page doesn't automatically load click 
			<a href="login.html">here</a> 
		</body>
		
	</body>
</html>

