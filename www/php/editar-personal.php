<?php

	require_once('clases/Sesion.php');
	require_once('clases/Personal.php');

	if (Sesion::login_ok() == false)
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Necesita iniciar sesion.' ]));

	$id_usuario = '';
	$id_equipo = '';
	$cargo = '';

	if (isset($_REQUEST['id'])) $id = $_REQUEST['id'];
	if (isset($_REQUEST['cargo'])) $cargo = $_REQUEST['cargo'];
	if (isset($_REQUEST['id_usuario'])) $id_usuario = $_REQUEST['id_usuario'];
	if (isset($_REQUEST['id_equipo'])) $id_equipo = $_REQUEST['id_equipo'];

	if (strlen($id) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta la ID.' ]));
	if (preg_match('/^[0-9]+$/', $id) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'ID debe ser numero.' ]));

	if (strlen($cargo) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el cargo.' ]));
	if (preg_match('/^[A-Za-z0-9_ ]+$/', $cargo) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Por favor quitar carácteres incorrectos del cargo.' ]));

	if (strlen($id_usuario) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el usuario.' ]));
	if (preg_match('/^[0-9]+$/', $id_usuario) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Usuario invalido.' ]));

	if (strlen($id_equipo) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el equipo.' ]));
	if (preg_match('/^[0-9]+$/', $id_equipo) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Equipo invalido.' ]));

	$temp = new Personal();
	if ($temp->cargar([ 'id_usuario' => $id_usuario, 'id_equipo' => $id_equipo ], [ 'id' => $id ] ))
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Usuario ya existe en el equipo.' ]));

	// -----------------------------------

	$temp = new Personal();
	$temp->cargar ([ 'id' => $id ]);

	$temp->id_usuario = $id_usuario;
	$temp->id_equipo = $id_equipo;
	$temp->cargo = $cargo;

	if (!$temp->guardar())
		die (json_encode([ 'status' => 'error', 'mensaje' => $conexion->error() ]));

	echo json_encode([ 'status' => 'ok' ]);
