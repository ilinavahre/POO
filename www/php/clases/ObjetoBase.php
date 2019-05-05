<?php

	require_once ('Conexion.php');

	class ObjetoBase
	{
		protected $datos;
		protected $nombreTabla;

		public function __construct ($nombreTabla)
		{
			$this->nombreTabla = $nombreTabla;
			$this->datos = [];
			$this->despuesCargar();
		}

		public function guardar()
		{
			$this->antesGuardar();
		}

		public function borrar()
		{
			global $conexion;

			if ($this->datos['id'] != '')
				$conexion->ejecutar ('DELETE FROM ' . $this->nombreTabla . ' WHERE id=' . $this->datos['id']);
		}

		public function cargar ($campos)
		{
			global $conexion;

			$condicion = '';
			
			foreach ($campos as $nombre => $valor)
				$condicion .= ' AND ' . $nombre . '=' . $conexion->quote($valor);

			if (strlen($condicion) != 0)
				$condicion = substr($condicion, 5);

			$this->datos = $conexion->obtenerFila ('SELECT * FROM ' . $this->nombreTabla . ' WHERE ' . $condicion . ' LIMIT 1');

			if (count($this->datos) == 0)
				$this->datos = [];

			$this->despuesCargar();

			if (count($this->datos) == 0)
				return false;
			else
				return true;
		}

		public function listar ()
		{
			global $conexion;

			$datos = $conexion->obtenerFilas ('SELECT * FROM ' . $this->nombreTabla);
			return $datos;
		}

		public function campo ($nombre)
		{
			if (isset($this->datos[$nombre]))
				return $this->datos[$nombre];
			else
				return '';
		}

		public function antesGuardar()
		{
		}

		public function despuesCargar()
		{
		}
	};
