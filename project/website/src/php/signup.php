
<?php
   include("config.php");
//    session_start();
?>

<html>
	<h1> Sistema de Leiloes de Recursos Maritimos </h1>
	<a href="../../deprecated.html">return</a>
	<br><br>
	
	<body>
		<?php
			// Inicia sessão para passar variaveis entre ficheiros php
			session_start();
			$nif = $_SESSION["nif"];
					
			// Descobre os leilões registados
			$sql = "select * from leilao natural join leilaor order by lid";
			$result = $connection->query($sql);
			if (!$result) {
				echo("<p> Erro na Query:($sql)<p>");
				exit();
			}
			
			echo("<table border=\"1\">\n");
			echo("<tr>
					<td>leilao</td>
					<td>nif</td>
					<td>dia</td>
					<td>nrleilaonodia</td>
					<td>nome</td>
					<td>tipo</td>
					<td>valorbase</td>
					<td>estado</td>
				</tr>\n");
			
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
				
				echo("<tr><td>");
				echo($row["lid"]); echo("</td><td>");
				echo($row["nif"]); echo("</td><td>");
				echo($row["dia"]); echo("</td><td>");
				echo($row["nrleilaonodia"]); echo("</td><td>");
				echo($row["nome"]); echo("</td><td>");
				echo($row["tipo"]); echo("</td><td>");
				echo($row["valorbase"]); echo("</td><td>");
				
				// Verifica se o leilão já terminou
				if($date < $now)
					echo("encerrado");
				else if($aux->rowCount() != 0)
					echo("inscrito");
				else		
					echo("<a href=\"signup_exec.php?lid={$row["lid"]}\">inscrever</a>\n");		
					
				echo("</td></tr>");
			}
			echo("</table>\n");
		?>
	</body>
</html>

