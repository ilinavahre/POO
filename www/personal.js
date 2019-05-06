var Personal =
{
	init: function()
	{
		var _this = this;

		this.tabs = new Tabs ('tabs_personal', 'tabs_personal_container');
		this.tabs.show('listar');

		this.form_agregar_personal = new Form ("form_agregar_personal", "php/agregar-personal.php");
		this.form_agregar_personal.onSuccess = function (data)
		{
			_this.form_agregar_personal.setData({ });
			_this.tabla.load();
			_this.tabs.show('listar');
		};

		this.form_editar_personal = new Form ("form_editar_personal", "php/editar-personal.php");
		this.form_editar_personal.onSuccess = function (data)
		{
			_this.tabla.load();
			_this.tabs.show('listar');
		};

		this.tabla = new Table ('tabla_personal', 'php/listar-personal.php');
		this.tabla.onSuccess = function (data)
		{
			var encabezado = [];
			var datos = [];

			encabezado.push('ID');
			encabezado.push('Nombre de Usuario');
			encabezado.push('Nombre de Equipo');
			encabezado.push('Cargo');
			encabezado.push('---');

			for (var i = 0; i < data.length; i++)
			{
				var fila = data[i];

				var temp = [];
				temp.push(fila.id);
				temp.push(fila.nombre_usuario);
				temp.push(fila.nombre_equipo);
				temp.push(fila.cargo);
				temp.push(
					"<a onclick='Personal.editar("+fila.id+");'>Editar</a>"+
					"<a onclick='Personal.eliminar("+fila.id+");'>Borrar</a>"
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

		Ajax.get ('php/get-personal.php?id=' + id, function (resp)
		{
			_this.form_editar_personal.setData (resp.data);
			_this.tabs.show('editar');
		});
	},

	eliminar: function (id)
	{
		var _this = this;

		Ajax.get ('php/eliminar-personal.php?id=' + id, function (resp)
		{
			_this.tabla.load();
		});
	}
};
