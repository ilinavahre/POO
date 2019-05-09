<?php

	require_once('ObjetoBase.php');

	class Ronda extends ObjetoBase
	{
		public $id;
		public $id_torneo;
		public $nombre;
		public $fecha;
		public $id_equipoA;
		public $id_equipoB;
		public $puntajeA;
		public $puntajeB;

		public $nombre_equipoA;
		public $nombre_equipoB;
		public $nombre_torneo;

		public function __construct ()
		{
			parent::__construct('rondas');

			$this->query_select = 'SELECT a.id, a.id_torneo, a.nombre, a.fecha, a.id_equipoA "id_equipoA", a.id_equipoB "id_equipoB", '.
								  'a.puntajeA "puntajeA", a.puntajeB "puntajeB", '.
								  'e1.nombre "nombre_equipoA", e2.nombre "nombre_equipoB", '.
								  'b.nombre nombre_torneo '.
								  'FROM rondas AS a '.
								  'INNER JOIN equipos AS e1 ON e1.id=a.id_equipoA '.
								  'INNER JOIN equipos AS e2 ON e2.id=a.id_equipoB '.
								  'INNER JOIN torneos AS b ON b.id=a.id_torneo ';
		}

		public function antesGuardar()
		{
			$this->datos = [];
			$this->datos['id'] = $this->id;
			$this->datos['id_torneo'] = $this->id_torneo;
			$this->datos['nombre'] = $this->nombre;
			$this->datos['fecha'] = $this->fecha;
			$this->datos['id_equipoA'] = $this->id_equipoA;
			$this->datos['id_equipoB'] = $this->id_equipoB;
			$this->datos['puntajeA'] = $this->puntajeA;
			$this->datos['puntajeB'] = $this->puntajeB;
		}

		public function despuesCargar()
		{
			$this->id = $this->campo('id');
			$this->id_torneo = $this->campo('id_torneo');
			$this->nombre = $this->campo('nombre');
			$this->fecha = $this->campo('fecha');
			$this->id_equipoA = $this->campo('id_equipoA');
			$this->id_equipoB = $this->campo('id_equipoB');
			$this->puntajeA = $this->campo('puntajeA');
			$this->puntajeB = $this->campo('puntajeB');

			$this->nombre_equipoA = $this->campo('nombre_equipoA');
			$this->nombre_equipoB = $this->campo('nombre_equipoB');
			$this->nombre_torneo = $this->campo('nombre_torneo');
		}
	};

?>