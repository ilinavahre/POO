<?php

	require_once('ObjetoBase.php');

	class Liga extends ObjetoBase
	{
		public $id;
		public $nombre;

		public function __construct ()
		{
			parent::__construct('ligas');
		}

		public function antesGuardar()
		{
			$this->datos['id'] = $this->id;
			$this->datos['nombre'] = $this->nombre;
		}

		public function despuesCargar()
		{
			$this->id = $this->campo('id');
			$this->nombre = $this->campo('nombre');
		}
	};

?>