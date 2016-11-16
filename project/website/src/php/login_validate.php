 
<html>
	<body>
		<?php
			// Inicia sessão para passar variaveis entre ficheiros php
			session_start();
			
			// Função para limpar os dados de entrada
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			
			// Carregamento de variáveis através do metodo POST;
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$nif = test_input($_POST["nif"]);
				$pin = test_input($_POST["pin"]);
			}
			
			// Variáveis de conexão à BD
			$host="db.ist.utl.pt";
			$user="ist175657";
			$password="qykd1377";
			$dbname = $user;
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
						
			// Descobre a palavra passe do utilizador
			$sql = "select * from pessoa where nif=".$nif;
			$result = $connection->query($sql);
			if(!$result) {
				echo("<p> Erro na Query:($sql)<p>");
				exit();
			}
			
			// Verifica se o utilizador é válido
			if($result->rowCount() == 0){
				echo("<p>Nif Invalido!</p>\n");
				$connection = null;
				echo("<a href=\"login.html\">return</a>");
				exit();				
			}				
			
			$result = $result->fetch();
			$safepin = $result["pin"];
			$username = $result["nome"];
			
			// Verifica se a palavra passe está correta
			if($safepin != $pin ) {
				echo("<p>Pin Invalido!</p>\n");
				$connection = null;
				echo("<a href=\"login.html\">return</a>");
				exit();
			}
			
			// Passa as variáveis para a sessão;
			$_SESSION["nif"] = $nif;
			$_SESSION["username"] = $username;
		?>
		
		<head>
			<meta http-equiv="refresh" content="0; URL=home.html">
			<meta name="keywords" content="automatic redirection">
		</head>
		<body>
			If the page doesn't automatically load click 
			<a href="home.html">here</a> 
		</body>
	</body>
</html>

