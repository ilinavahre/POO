<?php

	// GET y POST

	if (preg_match("/^[A-Za-z0-9 ']+$/", $_GET['nombre']))
		echo 'El nombre es <b>' . $_GET['nombre'] . '</b>';
	else
		echo 'No injectar!!!';
