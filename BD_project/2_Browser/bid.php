 
<html>
	<h1> Sistema de Leiloes de Recursos Maritimos </h1>
	<a href="home.html">return</a>
	<br><br>
	
	<body>
		<?php
			// Inicia sessão para passar variaveis entre ficheiros php
			session_start();
			$nif = $_SESSION['nif'];
			
			// Variáveis de conexão à BD
			$host="db.ist.utl.pt";
			$user="ist175657";
			$password="dlno1642";
			$dbname = $user;
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
			// Descobre os leilões registados
			$sql = "select * from
					leilao natural join leilaor
					order by lid";
			$result = $connection->query($sql);
			if (!$result) {
				echo("<p> Erro na Query:($sql)<p>");
				exit();
			}
			
			echo("<table border=\"1\">\n");
			echo("<tr>
					<td>leilao</td>
					<td>nif</td>
					<td>nome</td>
					<td>tempo restante</td>
					<td>valor base</td>
					<td>valor actual</td>
					<td>maior licitador</td>
				</tr>\n");
					
			$now = new DateTime(date("Y-m-d H:i:s"));
			foreach($result as $row){			
				
				// Calcula o tempo restante para o leilão encerrar
				$date = new DateTime($row["dia"]." +".$row["nrdias"]." days");
				$timeleft = $date->diff($now);
				
				// Verifica se o leilão já terminou
				if($date > $now){
					echo("<tr><td>");
					echo($row["lid"]); echo("</td><td>");
					echo($row["nif"]); echo("</td><td>");
					echo($row["nome"]); echo("</td><td>");
					echo($timeleft->format("%a days, %H:%I:%S")); echo("</td><td>");
					echo($row["valorbase"]); echo("</td><td>");
				
					// Descobre o valor do maior lance
					$sql = "select max(valor) as max, pessoa 
							from lance where leilao=".$row["lid"];
					$aux1 = $connection->query($sql);
					if (!$aux1) {
						echo("</table>\n<p> Erro na Query:($sql)<p>");
						exit();
					}
					
					$aux1 = $aux1->fetch();				
					if(!is_null($aux1["max"])){
						echo($aux1["max"]);echo("</td><td>");
						
						// Descobre a pessoa que efectuou o lance mais alto
						$sql = "select pessoa from lance 
								where leilao=".$row["lid"].
								" and valor =".$aux1["max"];
						$aux2 = $connection->query($sql);
						if (!$aux2) {
							echo("</table>\n<p> Erro na Query:($sql)<p>");
							exit();
						}
						$aux2 = $aux2->fetch();
						
						echo($aux2["pessoa"]);echo("</td><td>");	
					}
					else{
						echo("-");echo("</td><td>");
						echo("-");echo("</td><td>");
					}		
					
					// Descobre se o utilizador está inscrito no leilão
					$sql = "select * from concorrente where pessoa=".$nif." and leilao=".$row["lid"].";";
					$aux3 = $connection->query($sql);
					if (!$aux3) {
						echo("</table>\n<p> Erro na Query:($sql)<p>");
						exit();
					}
					
					if($aux3->rowCount() != 0)
						echo("<a href=\"bid_amount.php?lid={$row["lid"]}\">licitar</a>\n");

					echo("</td></tr>");	
				}
			}
			echo("</table>\n");
		?>
		<head>
			<meta http-equiv="refresh" content="10; URL=bid.php">
			<meta name="keywords" content="automatic redirection">
		</head>
	</body>
</html>

