<?php

	require_once('clases/Sesion.php');
	require_once('clases/Liga.php');

	if (Sesion::login_ok() == false)
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Necesita iniciar sesion.' ]));

	$id = '';
	$nombre = '';

	if (isset($_REQUEST['id'])) $id = $_REQUEST['id'];
	if (isset($_REQUEST['nombre'])) $nombre = $_REQUEST['nombre'];

	if (strlen($id) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta la ID.' ]));
	if (preg_match('/^[0-9]+$/', $id) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'ID debe ser numero.' ]));

	if (strlen($nombre) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el nombre.' ]));
	if (preg_match('/^[A-Za-z0-9_ ]+$/', $nombre) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Por favor quitar carácteres incorrectos del nombre.' ]));

	$temp = new Liga();
	if ($temp->cargar ([ 'nombre' => $nombre ], [ 'id' => $id ]))
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Nombre de liga ya existe.' ]));

	// -----------------------------------

	$temp = new Liga();
	$temp->cargar ([ 'id' => $id ]);

	$temp->nombre = $nombre;

	if (!$temp->guardar())
		die (json_encode([ 'status' => 'error', 'mensaje' => $conexion->error() ]));

	echo json_encode([ 'status' => 'ok' ]);
