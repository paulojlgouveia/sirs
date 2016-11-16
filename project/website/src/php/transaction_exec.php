
<html>
	<body>
		<?php
			// Inicia sessão para passar variaveis entre ficheiros php
			session_start();
			$nif = $_SESSION['nif'];
			
			$day = $_REQUEST["day"];		

			$checkbox = $_POST["checkbox"];
			
			// Variáveis de conexão à BD
			$host="db.ist.utl.pt";
			$user="ist175657";
			$password="qykd1377";
			$dbname = $user;
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
			// Descobre os leilões que começaram num determinado dia
			$sql = "select * from leilao natural join leilaor
					where dia=\"".$day."\"";
			$result = $connection->query($sql);
			if (!$result) {
				echo("<p> Erro na Query:($sql)<p>");
				exit();
			}
			
			// Inicia uma transacção
			$sql = "start transaction;";
			$action = $connection->query($sql);
			if (!$action) {
				echo("<p> Erro na Query:($sql)<p>");
				exit();
			}
									
			$i = 0;
			$now = new DateTime(date("Y-m-d H:i:s"));
			foreach($result as $row){
				
				// Calcula a data a que o leilão termina
				$date = new DateTime($row["dia"]." +".$row["nrdias"]." days");
				
				// Descobre se o utilizador está inscrito no leilão
				$sql = "select * from concorrente where pessoa=".$nif." and leilao=".$row["lid"].";";
				$aux = $connection->query($sql);
				if (!$aux) {
					echo("<p> Erro na Query:($sql)<p>");
					exit();
				}
				
				if($date > $now and $aux->rowCount() == 0 and $checkbox[$i]){
					// Regista o utilizador no leilão
					$sql = "insert into concorrente (pessoa,leilao) VALUES (".$nif.", ".$row["lid"].")";
					$action = $connection->query($sql);
					if (!$action) {
						echo("<p> Erro na Query:($sql) <p>");
						
						// Cancela e transacção
						$sql = "rollback;";
						$action = $connection->query($sql);
						if (!$action)
							echo("<p> Erro na Query:($sql)<p>");
						exit();
					}
				}
				$i = $i+1;
			}
			
			// Termina a transacção
			$sql = "commit;";
			$action = $connection->query($sql);
			if (!$action) {
				echo("<p> Erro na Query:($sql)<p>");
				exit();
			}

		?>
		
		<head>
			<meta http-equiv="refresh" content="0; URL=transaction.php">
			<meta name="keywords" content="automatic redirection">
		</head>
		<body>
			If the page doesn't automatically load click 
			<a href="transaction">here</a> 
		</body>
	</body>
</html>

