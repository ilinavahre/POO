<?php

	class Usuario
	{
		public $id;
		public $nombre;
		public $apellido;
		public $fechaDeNacimiento;
		public $nombreDeUsuario;
		public $password;
		public $tipo;

		public function __construct ()
		{
			$this->id ='';
			$this->nombre = '';
			$this->apellido = '';
			$this->fechaDeNacimiento = '';
			$this->nombreDeUsuario = '';
			$this->password = '';
			$this->tipo = '';
		}

		public function guardar ()
		{
		}

		public function borrar ()
		{
		}

		public function cargar ($id)
		{
		}

		public function listar ()
		{
		}
	};

?>
