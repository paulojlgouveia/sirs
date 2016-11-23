
<?php
   include("config.php");
//    session_start();
?>
 
<html>
	<body>
		<?php
			// Inicia sessão para passar variaveis entre ficheiros php
			session_start();
			$nif = $_SESSION['nif'];
			
			// Função para limpar os dados de entrada
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			
			// Carregamento de variáveis através do metodo POST;
			if ($_SERVER["REQUEST_METHOD"] == "POST"){
				$lid = test_input($_POST["lid"]);
				$valor = test_input($_POST["valor"]);
				if(empty($valor))
					$valor = 0;
			}
			
			// Descobre se o utilizador já licitou no leilão
			$sql = "select * from lance where pessoa=".$nif." and leilao=".$lid.";";
			$result = $connection->query($sql);
			if (!$result) {
				echo("<p> Erro na Query:($sql)<p>");
				exit();
			}
			
			if($result->rowCount() == 0){
				// Cria uma nova licitação
				$sql = "insert into lance(pessoa, leilao, valor) 
						values(".$nif.",".$lid.",".$valor.");";
				$result = $connection->query($sql);
				if (!$result) {
					echo("<p> Erro na Query:($sql)<p>");
					exit();
				}	 		
			} else {
				// Actualiza o valor da licitação
				$sql = "update lance set valor=".$valor."
						where pessoa=".$nif." and leilao=".$lid.";";
				 
				$result = $connection->query($sql);		
				if (!$result) {
					echo("<p> Erro na Query:($sql)<p>");
					exit();
				}
			}
		?>
	
		<head>
			<meta http-equiv="refresh" content="0; URL=bid.php">
			<meta name="keywords" content="automatic redirection">
		</head>
		<body>
		If the page doesn't automatically load click 
		<a href="bid.php">here</a>
		</body>
	</body>
</html>
