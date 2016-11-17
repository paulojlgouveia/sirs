
<html>
	<h1> Sistema de Leiloes de Recursos Maritimos </h1>
	<a href="../../home.html">return</a>
	<br><br>
	
	<body>
		<?php
			// Variáveis de conexão à BD
			$host="db.ist.utl.pt";
			$user="ist175657";
			$password="qykd1377";
			$dbname = $user;
			$connection = new PDO("mysql:host=" . $host. ";dbname=" . $dbname, $user, $password,
			array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			
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

