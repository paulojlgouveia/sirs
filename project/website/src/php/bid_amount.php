
<?php
   include("config.php");
//    session_start();
?>

<html>
	<h1> Sistema de Leiloes de Recursos Maritimos </h1>

	<body>
		<?php
			$lid = $_REQUEST['lid'];
			
			// Descobre o valor do maior lance						
			$sql = "select max(valor) as min from lance where leilao=".$lid.";";
			$result = $connection->query($sql);
			if (!$result) {
				echo("<p> Erro na Query:($sql)<p>");
				exit();
			}
			$result = $result->fetch();		
			
			if(is_null($result["min"])){
				// Descobre o valor base do leilão
				$sql = "select valorbase as min from leilao natural join leilaor where lid=".$lid.";";
				$result = $connection->query($sql);
				if (!$result) {
					echo("<p> Erro na Query:($sql)<p>");
					exit();
				}
				$result = $result->fetch();
			}
			else
				$result["min"] = $result["min"] + 1;
			
			echo("<p>Valor minimo: ".$result["min"]."</p>");
		?>

		<form action="bid_exec.php" method="post">
			<p><input type="hidden" name="lid" value="<?=$lid?>"/></p>
			<p>Novo valor: <input type="text" name="valor"/></p>
			<p><input type="submit" value="Submeter"/></p>
		</form>
	</body>

	<a href="bid.php">return</a>
</html>
