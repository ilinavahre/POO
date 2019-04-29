<?php

	$x = new PDO("pgsql:host=localhost;dbname=postgres;user=Delia;password=");

	$comando = $x->query ("select * from colors");

	$datos = $comando->fetchAll (PDO::FETCH_ASSOC);

	echo json_encode ($datos);
