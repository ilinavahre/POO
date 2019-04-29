<?php

	$x=new PDO("pgsql:host=localhost;dbname=postgres;user=Delia;password=");
	
	$comando = $x->query("select * from colors");
	
	$datos = $comando->fetchAll(PDO::FETCH_ASSOC);

	echo "<table border='1'>";

	foreach ($datos as $i)
	{
		echo "<tr>";

		foreach ($i as $valor)
		{
			echo "<td>";
			echo $valor;
			echo "</td>";
		}
		
		echo "</tr>";
	}
