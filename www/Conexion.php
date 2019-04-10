<?php

	class Conexion
	{
		public $host;
		public $usuario;
		public $password;

		public function __construct ($host, $usuario, $password)
		{
			$this->host = $host;
			$this->usuario = $usuario;
			$this->password = $password;
		}

		public function listarFilas ($consulta)
		{
		}

		public function ejecutar ($consulta)
		{
		}
	};

?>
