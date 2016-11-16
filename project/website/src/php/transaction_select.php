
<html>
	<h1> Sistema de Leiloes de Recursos Maritimos </h1>
	<a href="transaction.php">return</a>
	<br><br>
	
	<body>
		<?php
			// Inicia sessão para passar variaveis entre ficheiros php
			session_start();
			$nif = $_SESSION["nif"];
			
			$day = $_REQUEST["day"];
								
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
			
			echo("<form action=\"transaction_exec.php?day={$day}\" method=\"post\">");
			echo("<table border=\"1\">\n");
			echo("<tr>
					<td>leilao</td>
					<td>nif</td>
					<td>dia</td>
					<td>nrleilaonodia</td>
					<td>nome</td>
					<td>tipo</td>
					<td>valorbase</td>
					<td>inscrever</td>
				</tr>\n");
			
			$i = 0;
			$now = new DateTime(date("Y-m-d H:i:s"));
			foreach($result as $row){
				
				// Calcula a data a que o leilão termina
				$date = new DateTime($row["dia"]." +".$row["nrdias"]." days");
				
				// Descobre se o utilizador está inscrito no leilão
				$sql = "select * from concorrente where pessoa=".$nif." and leilao=".$row["lid"].";";
				$aux = $connection->query($sql);
				if (!$aux) {
					echo("</table>\n<p> Erro na Query:($sql)<p>");
					exit();
				}
				
				// Verifica se o utilizador se encontra inscrito no leilão e se este está activo
				if($date > $now and $aux->rowCount() == 0){
					echo("<tr><td>");
					echo($row["lid"]); echo("</td><td>");
					echo($row["nif"]); echo("</td><td>");
					echo($row["dia"]); echo("</td><td>");
					echo($row["nrleilaonodia"]); echo("</td><td>");
					echo($row["nome"]); echo("</td><td>");
					echo($row["tipo"]); echo("</td><td>");
					echo($row["valorbase"]); echo("</td><td>");
					echo("<input type=\"checkbox\" name=\"checkbox[".$i."]\" value=\"selected\" /></>\n");
					echo("</td></tr>");
				}
				$i = $i+1;
			}
			echo("</table>\n");
			echo("<input type=\"submit\" value=\"Inscrever\"/>");
			echo("</form>");
		?>
	</body>
</html>

