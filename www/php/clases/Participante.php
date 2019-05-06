<?php

	require_once('ObjetoBase.php');

	class Participante extends ObjetoBase
	{
		public $id;
		public $id_torneo;
		public $id_equipo;

		public function __construct ()
		{
			parent::__construct('participantes');

			$this->query_select = 'SELECT a.id, a.id_torneo, a.id_equipo, b.nombre nombre_torneo, c.nombre nombre_equipo '.
								  'FROM participantes AS a '.
								  'INNER JOIN torneos AS b ON b.id=a.id_torneo '.
								  'INNER JOIN equipos AS c ON c.id=a.id_equipo ';
		}

		public function antesGuardar()
		{
			$this->datos = [];
			$this->datos['id'] = $this->id;
			$this->datos['id_torneo'] = $this->id_torneo ? $this->id_torneo : null;
			$this->datos['id_equipo'] = $this->id_equipo ? $this->id_equipo : null;
		}

		public function despuesCargar()
		{
			$this->id = $this->campo('id');
			$this->id_torneo = $this->campo('id_torneo');
			$this->id_equipo = $this->campo('id_equipo');

			$this->nombre_torneo = $this->campo('nombre_torneo');
			$this->nombre_equipo = $this->campo('nombre_equipo');
		}
	};

?>