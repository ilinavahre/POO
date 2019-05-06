var Ligas =
{
	init: function()
	{
		var _this = this;

		this.tabs = new Tabs ('tabs_ligas', 'tabs_ligas_container');
		this.tabs.show('listar');

		this.form_agregar_liga = new Form ("form_agregar_liga", "php/agregar-liga.php");
		this.form_agregar_liga.onSuccess = function (data)
		{
			_this.form_agregar_liga.setData({ });
			_this.tabla.load();
			_this.tabs.show('listar');
		};

		this.form_editar_liga = new Form ("form_editar_liga", "php/editar-liga.php");
		this.form_editar_liga.onSuccess = function (data)
		{
			_this.tabla.load();
			_this.tabs.show('listar');
		};

		this.tabla = new Table ('tabla_ligas', 'php/listar-ligas.php');
		this.tabla.onSuccess = function (data)
		{
			/* ********* */
			var options = "<option value=''></option>";

			for (var i = 0; i < data.length; i++)
				options += "<option value='" + data[i].id + "'>" + data[i].nombre + "</option>";

			var list = document.querySelectorAll("select[name='id_liga']");
			for (var i = 0; i < list.length; i++)
				list[i].innerHTML = options;

			/* ********* */
			var encabezado = [];
			var datos = [];

			encabezado.push('ID');
			encabezado.push('Nombre de Liga');
			encabezado.push('---');

			for (var i = 0; i < data.length; i++)
			{
				var fila = data[i];

				var temp = [];
				temp.push(fila.id);
				temp.push(fila.nombre);
				temp.push(
					"<a onclick='Ligas.editar("+fila.id+");'>Editar</a>"+
					"<a onclick='Ligas.eliminar("+fila.id+");'>Borrar</a>"
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

		Ajax.get ('php/get-liga.php?id=' + id, function (resp)
		{
			_this.form_editar_liga.setData (resp.data);
			_this.tabs.show('editar');
		});
	},

	eliminar: function (id)
	{
		var _this = this;

		Ajax.get ('php/eliminar-liga.php?id=' + id, function (resp)
		{
			_this.tabla.load();
		});
	}
};
