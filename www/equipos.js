var Equipos =
{
	init: function()
	{
		var _this = this;

		this.tabs = new Tabs ('tabs_equipos', 'tabs_equipos_container');
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

		this.form_agregar_equipo = new Form ("form_agregar_equipo", "php/agregar-equipo.php");
		this.form_agregar_equipo.onSuccess = function (data)
		{
			_this.form_agregar_equipo.setData({ });
			_this.tabs.show('listar');
		};

		this.form_editar_equipo = new Form ("form_editar_equipo", "php/editar-equipo.php");
		this.form_editar_equipo.onSuccess = function (data)
		{
			_this.tabs.show('listar');
		};

		this.tabla = new Table ('tabla_equipos', 'php/listar-equipos.php');
		this.tabla.onSuccess = function (data)
		{
			/* ********* */
			var options = "<option value=''></option>";

			for (var i = 0; i < data.length; i++)
				options += "<option value='" + data[i].id + "'>" + data[i].nombre + "</option>";

			var list = document.querySelectorAll("select[name='id_equipo'], select[name='id_equipoA'], select[name='id_equipoB']");
			for (var i = 0; i < list.length; i++)
				list[i].innerHTML = options;

			/* ********* */
			var encabezado = [];
			var datos = [];

			encabezado.push('ID');
			encabezado.push('Nombre de Equipo');
			encabezado.push('Liga');
			encabezado.push('---');

			for (var i = 0; i < data.length; i++)
			{
				var fila = data[i];

				var temp = [];
				temp.push(fila.id);
				temp.push(fila.nombre);
				temp.push(fila.nombre_liga);
				temp.push(
					"<a onclick='Equipos.editar("+fila.id+");'>Editar</a>"+
					"<a onclick='Equipos.eliminar("+fila.id+");'>Borrar</a>"
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

		Ajax.get ('php/get-equipo.php?id=' + id, function (resp)
		{
			_this.form_editar_equipo.setData (resp.data);
			_this.tabs.show('editar');
		});
	},

	eliminar: function (id)
	{
		var _this = this;

		Ajax.get ('php/eliminar-equipo.php?id=' + id, function (resp)
		{
			_this.tabla.load();
		});
	}
};
