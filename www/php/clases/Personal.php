<?php

	require_once('ObjetoBase.php');

	class Personal extends ObjetoBase
	{
		public $id;
		public $id_usuario;
		public $id_equipo;
		public $cargo;

		public function __construct ()
		{
			parent::__construct('personal');

			$this->query_select = 'SELECT a.id, a.id_usuario, a.id_equipo, a.cargo, b.nombre nombre_usuario, c.nombre nombre_equipo '.
								  'FROM personal AS a '.
								  'INNER JOIN usuarios AS b ON b.id=a.id_usuario '.
								  'INNER JOIN equipos AS c ON c.id=a.id_equipo';
		}

		public function antesGuardar()
		{
			$this->datos = [];
			$this->datos['id'] = $this->id;
			$this->datos['id_usuario'] = $this->id_usuario ? $this->id_usuario : null;
			$this->datos['id_equipo'] = $this->id_equipo ? $this->id_equipo : null;
			$this->datos['cargo'] = $this->cargo;
		}

		public function despuesCargar()
		{
			$this->id = $this->campo('id');
			$this->id_usuario = $this->campo('id_usuario');
			$this->id_equipo = $this->campo('id_equipo');
			$this->cargo = $this->campo('cargo');

			$this->nombre_usuario = $this->campo('nombre_usuario');
			$this->nombre_equipo = $this->campo('nombre_equipo');
			
		}
	};

?>