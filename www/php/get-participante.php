<?php

	require_once('clases/Sesion.php');
	require_once('clases/Participante.php');

	if (Sesion::login_ok() == false)
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Necesita iniciar sesion.' ]));

	$id = '';

	if (isset($_REQUEST['id'])) $id = $_REQUEST['id'];

	if (strlen($id) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta la ID.' ]));
	if (preg_match('/^[0-9]+$/', $id) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'ID debe ser numero.' ]));

	$x = new Participante();
	$x->cargar ([ 'id' => $id ]);

	die (json_encode([ 'status' => 'ok', 'data' => $x->datos ]));
