<?php

	require_once('clases/Sesion.php');
	require_once('clases/Participante.php');

	if (Sesion::login_ok() == false)
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Necesita iniciar sesion.' ]));

	$id = '';
	$id_torneo = '';
	$id_equipo = '';

	if (isset($_REQUEST['id'])) $id = $_REQUEST['id'];
	if (isset($_REQUEST['id_torneo'])) $id_torneo = $_REQUEST['id_torneo'];
	if (isset($_REQUEST['id_equipo'])) $id_equipo = $_REQUEST['id_equipo'];

	if (strlen($id) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta la ID.' ]));
	if (preg_match('/^[0-9]+$/', $id) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'ID debe ser numero.' ]));

	if (strlen($id_torneo) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el torneo.' ]));
	if (preg_match('/^[0-9]+$/', $id_torneo) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Torneo invalido.' ]));

	if (strlen($id_equipo) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el equipo.' ]));
	if (preg_match('/^[0-9]+$/', $id_equipo) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Equipo invalido.' ]));

	$temp = new Participante();
	if ($temp->cargar([ 'id_torneo' => $id_torneo, 'id_equipo' => $id_equipo ], [ 'id' => $id ]))
		die (json_encode([ 'status' => 'error', 'mensaje' => 'El equipo ya esta participando en el torneo.' ]));

	// -----------------------------------

	$temp = new Participante();
	$temp->cargar ([ 'id' => $id ]);

	$temp->id_torneo = $id_torneo;
	$temp->id_equipo = $id_equipo;

	if (!$temp->guardar())
		die (json_encode([ 'status' => 'error', 'mensaje' => $conexion->error() ]));

	echo json_encode([ 'status' => 'ok' ]);
