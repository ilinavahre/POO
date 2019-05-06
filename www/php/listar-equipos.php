<?php

	require_once('clases/Sesion.php');
	require_once('clases/Equipo.php');

	if (Sesion::login_ok() == false)
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Necesita iniciar sesion.' ]));

	$x = new Equipo();
	$data = $x->listar();

	die (json_encode([ 'status' => 'ok', 'data' => $data ]));