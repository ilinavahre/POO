<?php

	include 'php/clases/Sesion.php';

	if (Sesion::login_ok() == true)
		echo file_get_contents('index-home.html');
	else
		echo file_get_contents('index-login.html');
