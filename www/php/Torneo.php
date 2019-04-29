<?php

	class Torneo
	{
		public $id;
		public $nombre;
		public $fechaDeInicio;
		public $idLiga;

		public function __construct ($liga)
		{
			$this->id ='';
			$this->nombre = '';
			$this->fechaDeInicio = '';

			$this->idLiga = $liga->id;
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

		public function listar ($liga)
		{
		}
	};

?>
