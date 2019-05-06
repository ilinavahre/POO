<?php

	require_once('clases/Sesion.php');

	Sesion::limpiar();

	echo json_encode([ 'status' => 'ok' ]);
