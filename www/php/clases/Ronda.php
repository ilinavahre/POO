<?php

	class Ronda
	{
		public $id;
		public $nombre;
		public $fecha;
		public $idEquipoA;
		public $idEquipoB;
		public $puntajeA;
		public $puntajeB;
		public $idTorneo;

		public function __construct ($torneo, $equipoA, $equipoB)
		{
			$this->id ='';
			$this->nombre = '';
			$this->fecha = '';
			$this->idEquipoA = $equipoA->id;
			$this->idEquipoB = $equipoB->id;
			$this->puntajeA = 0;
			$this->puntajeB = 0;
			$this->idTorneo = $torneo->id;
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

		public function listar ($torneo)
		{
		}
	};

?>
