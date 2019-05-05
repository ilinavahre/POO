<?php

	require_once('clases/Usuario.php');
	require_once('clases/Sesion.php');

	$username = '';
	$password = '';

	if (isset($_REQUEST['username'])) $username = $_REQUEST['username'];
	if (isset($_REQUEST['password'])) $password = $_REQUEST['password'];

	if (strlen($username) == 0)
	{
		echo json_encode([ 'status' => 'error', 'mensaje' => 'Falta el nombre de usuario.' ]);
		exit;
	}

	if (strlen($password) == 0)
	{
		echo json_encode([ 'status' => 'error', 'mensaje' => 'Falta la contraseña.' ]);
		exit;
	}

	if (preg_match('/^[A-Za-z0-9_]+$/', $username) == 0)
	{
		echo json_encode([ 'status' => 'error', 'mensaje' => 'Por favor quitar carácteres incorrectos del nombre de usuario.' ]);
		exit;
	}

	if (strlen($username) < 5)
	{
		echo json_encode([ 'status' => 'error', 'mensaje' => 'Nombre de usuario debe ser minimo 5 letras.' ]);
		exit;
	}

	if (strlen($password) < 5)
	{
		echo json_encode([ 'status' => 'error', 'mensaje' => 'Contraseña debe ser minimo 5 letras.' ]);
		exit;
	}

	if (strlen($username) > 40)
	{
		echo json_encode([ 'status' => 'error', 'mensaje' => 'Nombre de usuario no puede ser más de 40 letras.' ]);
		exit;
	}

	if (strlen($password) > 40)
	{
		echo json_encode([ 'status' => 'error', 'mensaje' => 'Contraseña no puede ser más de 40 letras.' ]);
		exit;
	}

	// -----------------------------------

	$usuario = new Usuario();
	if ($usuario->cargar([ 'username' => $username, 'password' => $password ]))
	{
		Sesion::set('login', 1);
		Sesion::set('usuario', $usuario->id);

		echo json_encode([ 'status' => 'ok' ]);
	}
	else
		echo json_encode([ 'status' => 'error', 'mensaje' => 'El nombre de usuario es incorrecto o contraseña incorrecta' ]);
