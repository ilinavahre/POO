<?php

	class Equipo
	{
		public $id;
		public $nombre;
		public $idLiga;

		public function __construct ()
		{
			$this->id ='';
			$this->nombre = '';
			$this->idLiga = '';
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

		public function asignarLiga ($liga)
		{
			$this->idLiga = $liga->id;
		}
	};

?>
