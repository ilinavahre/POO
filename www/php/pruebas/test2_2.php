<?php

	$x = new PDO("pgsql:host=localhost;dbname=postgres;user=Delia;password=");
	
	$comando = $x->exec ("insert into colors values(".$x->quote($_POST['nombre']).", ".$x->quote($_POST['color']).")");

	$resp = array();
	$resp['status'] = 'OK';

	echo json_encode ($resp);
