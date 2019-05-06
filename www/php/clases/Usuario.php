<?php

	require_once('ObjetoBase.php');

	class Usuario extends ObjetoBase
	{
		public $id;
		public $nombre;
		public $apellido;
		public $fnac;
		public $username;
		public $password;
		public $usertype;

		public function __construct()
		{
			parent::__construct('usuarios');
		}

		public function antesGuardar()
		{
			$this->datos['id'] = $this->id;
			$this->datos['nombre'] = $this->nombre;
			$this->datos['apellido'] = $this->apellido;
			$this->datos['fnac'] = $this->fnac ? $this->fnac : null;
			$this->datos['username'] = $this->username;
			$this->datos['password'] = $this->password;
			$this->datos['usertype'] = $this->usertype;
		}

		public function despuesCargar()
		{
			$this->id = $this->campo('id');
			$this->nombre = $this->campo('nombre');
			$this->apellido = $this->campo('apellido');
			$this->fnac = $this->campo('fnac');
			$this->username = $this->campo('username');
			$this->password = $this->campo('password');
			$this->usertype = $this->campo('usertype');
		}
	};

?>
