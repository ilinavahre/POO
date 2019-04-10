<?php

	class Personal
	{
		public $id;
		public $idUsuario;
		public $cargo;
		public $idEquipo;

		public function __construct ($equipo)
		{
			$this->id ='';
			$this->idUsuario = '';
			$this->cargo = '';
			$this->idEquipo = $equipo->id;
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

		public function listar ($equipo)
		{
		}
	};

?>
