<?php

	require_once ('Conexion.php');

	class ObjetoBase
	{
		public $datos;
		public $nombreTabla;

		public function __construct ($nombreTabla)
		{
			$this->nombreTabla = $nombreTabla;
			$this->datos = [];
			$this->despuesCargar();
		}

		public function guardar()
		{
			global $conexion;

			$this->antesGuardar();
			
			$campos = [];
			$valores = [];
			
			$condicion = '';

			foreach ($this->datos as $nombre => $valor)
			{
				if ($nombre == 'id')
				{
					if ($valor != '')
						$condicion = 'id=' . $valor;

					continue;
				}

				$campos[] = $nombre;
				$valores[] = $valor === null ? 'NULL' : $conexion->quote($valor);
			}

			if ($condicion != '')
				$query = 'UPDATE ' . $this->nombreTabla . ' SET ' . implode(',', array_map(function ($a, $b) { return $a.'='.$b; }, $campos, $valores)) . ' WHERE ' . $condicion;
			else
				$query = 'INSERT INTO ' . $this->nombreTabla . '(' . implode(',', $campos) . ') VALUES(' . implode(',', $valores) . ')';

			return $conexion->ejecutar ($query);
		}

		public function borrar()
		{
			global $conexion;

			if ($this->campo('id') != '')
				$conexion->ejecutar ('DELETE FROM ' . $this->nombreTabla . ' WHERE id=' . $this->campo('id'));
		}

		public function cargar ($campos, $campos_not=null)
		{
			global $conexion;

			$condicion = '';
			
			foreach ($campos as $nombre => $valor)
				$condicion .= ' AND ' . $nombre . '=' . $conexion->quote($valor);

			if ($campos_not != null)
			{
				foreach ($campos_not as $nombre => $valor)
					$condicion .= ' AND NOT ' . $nombre . '=' . $conexion->quote($valor);
			}

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
