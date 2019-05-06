<?php

	class Sesion
	{
		public static function iniciar()
		{
			session_start();
		}

		public static function login_ok ()
		{
			if (Sesion::get('login') == 1)
				return true;
			else
				return false;
		}

		public static function get ($nombre)
		{
			if (isset($_SESSION[$nombre]))
				return $_SESSION[$nombre];
			else
				return '';
		}

		public static function set ($nombre, $valor)
		{
			$_SESSION[$nombre] = $valor;
		}
		
		public static function limpiar ()
		{
			session_destroy();
		}
	};

	Sesion::iniciar();
