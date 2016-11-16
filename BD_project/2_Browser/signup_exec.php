
<html>
	<body>
		<?php
			// Inicia sessão para passar variaveis entre ficheiros php
			session_start();
			$nif = $_SESSION["nif"];

			$lid = $_REQUEST["lid"];
			
			// Variáveis de conexão à BD
			$host="db.ist.utl.pt";
			$user="ist175657";
			$password="dlno1642";
			$dbname = $user;
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			echo("<p>Connected to MySQL database $dbname on $host as user $user</p>\n");
			
			// Regista o utilizador no leilão
			$sql = "insert into concorrente (pessoa,leilao) VALUES ($nif,$lid)";
			$result = $connection->query($sql);
			if (!$result) {
				echo("<p> Erro na Query:($sql)<p>");
				exit();
			}
		?>
		
		<head>
			<meta http-equiv="refresh" content="0; URL=signup.php">
			<meta name="keywords" content="automatic redirection">
		</head>
		<body>
			If the page doesn't automatically load click 
			<a href="signup.php">here</a> 
		</body>
		
	</body>
</html>

