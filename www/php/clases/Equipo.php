<?php

	require_once('ObjetoBase.php');

	class Equipo extends ObjetoBase
	{
		public $id;
		public $nombre;
		public $id_liga;

		public function __construct ()
		{
			parent::__construct('equipos');

			$this->query_select = 'SELECT a.id, a.nombre, a.id_liga, b.nombre nombre_liga FROM equipos AS a INNER JOIN ligas AS b ON b.id=a.id_liga';
		}

		public function antesGuardar()
		{
			$this->datos = [];
			$this->datos['id'] = $this->id;
			$this->datos['nombre'] = $this->nombre;
			$this->datos['id_liga'] = $this->id_liga ? $this->id_liga : null;
		}

		public function despuesCargar()
		{
			$this->id = $this->campo('id');
			$this->nombre = $this->campo('nombre');
			$this->id_liga = $this->campo('id_liga');
			$this->nombre_liga = $this->campo('nombre_liga');
		}
	};

?>