<?php

	$x = new PDO("pgsql:host=localhost;dbname=postgres;user=Delia;password=");

	$comando = $x->query ("select * from colors where color='12'");
	
	print_r($x->errorInfo());

	$datos = $comando->fetchAll (PDO::FETCH_ASSOC);

	echo json_encode ($datos);
