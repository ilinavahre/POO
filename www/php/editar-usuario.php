<?php

	require_once('clases/Usuario.php');
	require_once('clases/Sesion.php');

	if (Sesion::login_ok() == false)
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Necesita iniciar sesion.' ]));

	$id = '';
	$nombre = '';
	$apellido = '';
	$username = '';
	$password = '';
	$fnac = '';

	if (isset($_REQUEST['id'])) $id = $_REQUEST['id'];
	if (isset($_REQUEST['nombre'])) $nombre = $_REQUEST['nombre'];
	if (isset($_REQUEST['apellido'])) $apellido = $_REQUEST['apellido'];
	if (isset($_REQUEST['username'])) $username = $_REQUEST['username'];
	if (isset($_REQUEST['password'])) $password = $_REQUEST['password'];
	if (isset($_REQUEST['fnac'])) $fnac = $_REQUEST['fnac'];

	if (strlen($id) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta la ID.' ]));
	if (preg_match('/^[0-9]+$/', $id) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'ID debe ser numero.' ]));

	if (strlen($nombre) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el nombre.' ]));
	if (preg_match('/^[A-Za-z0-9_ ]+$/', $nombre) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Por favor quitar carácteres incorrectos del nombre.' ]));

	if (strlen($apellido) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el apellido.' ]));
	if (preg_match('/^[A-Za-z0-9_ ]+$/', $apellido) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Por favor quitar carácteres incorrectos del apellido.' ]));

	if (strlen($username) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta el nombre de usuario.' ]));
	if (strlen($username) < 5) die (json_encode([ 'status' => 'error', 'mensaje' => 'Nombre de usuario debe ser minimo 5 letras.' ]));
	if (preg_match('/^[A-Za-z0-9_]+$/', $username) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Por favor quitar carácteres incorrectos del nombre de usuario.' ]));
	if (strlen($username) > 40) die (json_encode([ 'status' => 'error', 'mensaje' => 'Nombre de usuario no puede ser más de 40 letras.' ]));

	if (strlen($password) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Falta la contraseña.' ]));
	if (strlen($password) < 5) die (json_encode([ 'status' => 'error', 'mensaje' => 'Contraseña debe ser minimo 5 letras.' ]));
	if (strlen($password) > 40) die (json_encode([ 'status' => 'error', 'mensaje' => 'Contraseña no puede ser más de 40 letras.' ]));

	if (strlen($fnac) != 0 && preg_match('/^\d\d\d\d-\d\d-\d\d+$/', $fnac) == 0) die (json_encode([ 'status' => 'error', 'mensaje' => 'Fecha tiene formato incorrecto' ]));

	$temp = new Usuario();
	if ($temp->cargar ([ 'username' => $username ], [ 'id' => $id ]))
		die (json_encode([ 'status' => 'error', 'mensaje' => 'Nombre de usuario ya existe.' ]));

	// -----------------------------------

	$temp = new Usuario();
	$temp->cargar ([ 'id' => $id ]);

	$temp->nombre = $nombre;
	$temp->apellido = $apellido;
	$temp->fnac = $fnac;
	$temp->username = $username;
	$temp->password = $password;

	if (!$temp->guardar())
		die (json_encode([ 'status' => 'error', 'mensaje' => $conexion->error() ]));

	echo json_encode([ 'status' => 'ok' ]);
