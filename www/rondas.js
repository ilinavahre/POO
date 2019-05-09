var Rondas =
{
	init: function()
	{
		var _this = this;

		this.tabs = new Tabs ('tabs_rondas', 'tabs_rondas_container');
		this.tabs.show('listar');

		this.tabs.onTabActivated = function(name)
		{
			switch(name)
			{
				case 'listar':
					_this.tabla.load();
					break;
			}
		};

		this.form_agregar_ronda = new Form ("form_agregar_ronda", "php/agregar-ronda.php");
		this.form_agregar_ronda.onSuccess = function (data)
		{
			_this.form_agregar_ronda.setData({ });
			_this.tabs.show('listar');
		};

		this.form_editar_ronda = new Form ("form_editar_ronda", "php/editar-ronda.php");
		this.form_editar_ronda.onSuccess = function (data)
		{
			_this.tabs.show('listar');
		};

		this.tabla = new Table ('tabla_rondas', 'php/listar-rondas.php');
		this.tabla.onSuccess = function (data)
		{
			/* ********* */
			var options = "<option value=''></option>";

			for (var i = 0; i < data.length; i++)
				options += "<option value='" + data[i].id + "'>" + data[i].nombre + "</option>";

			var list = document.querySelectorAll("select[name='id_ronda']");
			for (var i = 0; i < list.length; i++)
				list[i].innerHTML = options;

			/* ********* */
			var encabezado = [];
			var datos = [];

			encabezado.push('ID');
			encabezado.push('Torneo');
			encabezado.push('Nombre de Ronda');
			encabezado.push('Fecha');
			encabezado.push('Equipo A');
			encabezado.push('Equipo B');
			encabezado.push('Puntaje A');
			encabezado.push('Puntaje B');
			encabezado.push('---');

			for (var i = 0; i < data.length; i++)
			{
				var fila = data[i];

				var temp = [];
				temp.push(fila.id);
				temp.push(fila.nombre_torneo);
				temp.push(fila.nombre);
				temp.push(fila.fecha);
				temp.push(fila.nombre_equipoA);
				temp.push(fila.nombre_equipoB);
				temp.push(fila.puntajeA);
				temp.push(fila.puntajeB);
				temp.push(
					"<a onclick='Rondas.editar("+fila.id+");'>Editar</a>"+
					"<a onclick='Rondas.eliminar("+fila.id+");'>Borrar</a>"
				);

				datos.push(temp);
			}

			return { header: encabezado, data: datos };
		};

		this.tabla.load();
	},

	editar: function (id)
	{
		var _this = this;

		Ajax.get ('php/get-ronda.php?id=' + id, function (resp)
		{
			_this.form_editar_ronda.setData (resp.data);
			_this.tabs.show('editar');
		});
	},

	eliminar: function (id)
	{
		var _this = this;

		Ajax.get ('php/eliminar-ronda.php?id=' + id, function (resp)
		{
			_this.tabla.load();
		});
	}
};
