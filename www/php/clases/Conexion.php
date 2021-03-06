<?php

	require_once('Globals.php');

	class Conexion
	{
		public $host;
		public $usuario;
		public $password;
		public $base;
		
		public $pdo;
		public $last_query;

		public function __construct ()
		{
			$this->host = Globals::$sql_host;
			$this->usuario = Globals::$sql_usuario;
			$this->password = Globals::$sql_password;
			$this->base = Globals::$sql_base;

			$this->conectar();
		}

		public function conectar()
		{
			$this->pdo = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->base . ";user=" . $this->usuario . ";password=" . $this->password);
		}

		public function obtenerFilas ($consulta)
		{
			$this->last_query = $consulta;
			$query = $this->pdo->query ($consulta);

			if ($query == false)
				die ($this->pdo->errorInfo()[2]);

			return $query->fetchAll (PDO::FETCH_ASSOC);
		}

		public function obtenerFila ($consulta)
		{
			$this->last_query = $consulta;
			$filas = $this->obtenerFilas($consulta);

			if (count($filas) != 0)
				return $filas[0];

			return [];
		}

		public function ejecutar ($consulta)
		{
			$this->last_query = $consulta;
			return $this->pdo->exec ($consulta);
		}

		public function quote ($valor)
		{
			return $this->pdo->quote ($valor);
		}

		public function error ()
		{
			return $this->pdo->errorInfo()[2];
		}
	};

	// Crear objeto de conexion global.
	$conexion = new Conexion();
	$conexion->conectar();
