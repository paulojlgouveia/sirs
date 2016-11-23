
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
			
			// Descobre os dias em que foram iniciados leilões
			$sql = "select distinct dia from leilao order by dia";
			$result = $connection->query($sql);
			if (!$result) {
				echo("<p> Erro na Query:($sql)<p>");
				exit();
			}
			
			foreach($result as $row){	
				echo("<a href=\"transaction_select.php?day={$row["dia"]}\">".$row["dia"]."</a>\n");		
				echo("<br>");	
			}
			echo("</table>\n");
		?>
		
	</body>
	
</html>

