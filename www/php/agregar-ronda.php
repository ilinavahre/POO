<?php

	require_once('clases/Sesion.php');
	require_once('clases/Ronda.php');

	if (Sesion::login_ok() == false)
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Necesita iniciar sesion.' ]));

	$nombre = '';
	$fecha = '';
	$id_torneo = '';
	$id_equipoA = '';
	$id_equipoB = '';
	$puntajeA = '';
	$puntajeB = '';

	if (isset($_REQUEST['nombre'])) $nombre = $_REQUEST['nombre'];
	if (isset($_REQUEST['fecha'])) $fecha = $_REQUEST['fecha'];
	if (isset($_REQUEST['id_torneo'])) $id_torneo = $_REQUEST['id_torneo'];
	if (isset($_REQUEST['id_equipoA'])) $id_equipoA = $_REQUEST['id_equipoA'];
	if (isset($_REQUEST['id_equipoB'])) $id_equipoB = $_REQUEST['id_equipoB'];
	if (isset($_REQUEST['puntajeA'])) $puntajeA = $_REQUEST['puntajeA'];
	if (isset($_REQUEST['puntajeB'])) $puntajeB = $_REQUEST['puntajeB'];

	if (strlen($nombre) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el nombre.' ]));
	if (preg_match('/^[A-Za-z0-9_ ]+$/', $nombre) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Por favor quitar carácteres incorrectos del nombre.' ]));

	if (strlen($id_torneo) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el torneo.' ]));
	if (preg_match('/^[0-9]+$/', $id_torneo) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Torneo invalido.' ]));

	if (strlen($id_equipoA) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el equipo A.' ]));
	if (preg_match('/^[0-9]+$/', $id_equipoA) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Equipo A invalido.' ]));

	if (strlen($id_equipoB) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el equipo B.' ]));
	if (preg_match('/^[0-9]+$/', $id_equipoB) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Equipo B invalido.' ]));

	if ($id_equipoA == $id_equipoB)
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Los equipos no pueden ser el mismo.' ]));

	if (strlen($fecha) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta la fecha de inicio.' ]));
	if (preg_match('/^\d\d\d\d-\d\d-\d\d+$/', $fecha) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Fecha tiene formato incorrecto' ]));

	if (strlen($puntajeA) == 0) $puntajeA = '0';
	if (preg_match('/^[0-9]+$/', $puntajeA) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Puntaje A debe ser numero.' ]));

	if (strlen($puntajeB) == 0) $puntajeB = '0';
	if (preg_match('/^[0-9]+$/', $puntajeB) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Puntaje B debe ser numero.' ]));

	$temp = new Ronda();
	if ($temp->cargar([ 'nombre' => $nombre, 'id_torneo' => $id_torneo ]))
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Nombre de ronda ya existe en el torneo.' ]));

	// -----------------------------------

	$temp = new Ronda();

	$temp->nombre = $nombre;
	$temp->id_torneo = $id_torneo;
	$temp->fecha = $fecha;
	$temp->id_equipoA = $id_equipoA;
	$temp->id_equipoB = $id_equipoB;
	$temp->puntajeA = $puntajeA;
	$temp->puntajeB = $puntajeB;

	if (!$temp->guardar())
		die (json_encode([ 'status' => 'error', 'mensaje' => $conexion->error() ]));

	echo json_encode([ 'status' => 'ok' ]);
