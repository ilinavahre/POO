<?php

	require_once('clases/Sesion.php');
	require_once('clases/Torneo.php');

	if (Sesion::login_ok() == false)
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Necesita iniciar sesion.' ]));

	$id = '';
	$nombre = '';
	$finicio = '';
	$id_liga = '';

	if (isset($_REQUEST['id'])) $id = $_REQUEST['id'];
	if (isset($_REQUEST['nombre'])) $nombre = $_REQUEST['nombre'];
	if (isset($_REQUEST['finicio'])) $finicio = $_REQUEST['finicio'];
	if (isset($_REQUEST['id_liga'])) $id_liga = $_REQUEST['id_liga'];

	if (strlen($id) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta la ID.' ]));
	if (preg_match('/^[0-9]+$/', $id) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'ID debe ser numero.' ]));

	if (strlen($nombre) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el nombre.' ]));
	if (preg_match('/^[A-Za-z0-9_ ]+$/', $nombre) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Por favor quitar carácteres incorrectos del nombre.' ]));

	if (strlen($id_liga) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta la liga.' ]));
	if (preg_match('/^[0-9]+$/', $id) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Liga invalida.' ]));

	if (strlen($finicio) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta la fecha de inicio.' ]));
	if (preg_match('/^\d\d\d\d-\d\d-\d\d+$/', $finicio) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Fecha tiene formato incorrecto' ]));

	$temp = new Torneo();
	if ($temp->cargar ([ 'nombre' => $nombre, 'id_liga' => $id_liga ], [ 'id' => $id ]))
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Nombre de torneo ya existe en la liga.' ]));

	// -----------------------------------

	$temp = new Torneo();
	$temp->cargar ([ 'id' => $id ]);

	$temp->nombre = $nombre;
	$temp->id_liga = $id_liga;
	$temp->finicio = $finicio;

	if (!$temp->guardar())
		die (json_encode([ 'status' => 'error', 'mensaje' => $conexion->error() ]));

	echo json_encode([ 'status' => 'ok' ]);
