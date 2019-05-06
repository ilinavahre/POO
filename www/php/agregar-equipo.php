<?php

	require_once('clases/Sesion.php');
	require_once('clases/Equipo.php');

	if (Sesion::login_ok() == false)
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Necesita iniciar sesion.' ]));

	$nombre = '';
	$id_liga = '';

	if (isset($_REQUEST['nombre'])) $nombre = $_REQUEST['nombre'];
	if (isset($_REQUEST['id_liga'])) $id_liga = $_REQUEST['id_liga'];

	if (strlen($nombre) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el nombre.' ]));
	if (preg_match('/^[A-Za-z0-9_ ]+$/', $nombre) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Por favor quitar carácteres incorrectos del nombre.' ]));

	if (strlen($id_liga) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta la liga.' ]));
	if (preg_match('/^[0-9]+$/', $id_liga) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Liga invalida.' ]));

	$temp = new Equipo();
	if ($temp->cargar([ 'nombre' => $nombre ]))
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Nombre de equipo ya existe.' ]));

	// -----------------------------------

	$temp = new Equipo();

	$temp->nombre = $nombre;
	$temp->id_liga = $id_liga;

	if (!$temp->guardar())
		die (json_encode([ 'status' => 'error', 'mensaje' => $conexion->error() ]));

	echo json_encode([ 'status' => 'ok' ]);
