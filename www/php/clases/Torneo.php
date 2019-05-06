<?php

	require_once('ObjetoBase.php');

	class Torneo extends ObjetoBase
	{
		public $id;
		public $nombre;
		public $finicio;
		public $id_liga;

		public function __construct ()
		{
			parent::__construct('torneos');

			$this->query_select = 'SELECT a.id, a.nombre, a.id_liga, a.finicio, b.nombre nombre_liga '.
								  'FROM torneos AS a '.
								  'INNER JOIN ligas AS b ON b.id=a.id_liga';
		}

		public function antesGuardar()
		{
			$this->datos = [];
			$this->datos['id'] = $this->id;
			$this->datos['nombre'] = $this->nombre;
			$this->datos['finicio'] = $this->finicio;
			$this->datos['id_liga'] = $this->id_liga ? $this->id_liga : null;
		}

		public function despuesCargar()
		{
			$this->id = $this->campo('id');
			$this->nombre = $this->campo('nombre');
			$this->finicio = $this->campo('finicio');
			$this->id_liga = $this->campo('id_liga');
			$this->nombre_liga = $this->campo('nombre_liga');
		}
	};

?>