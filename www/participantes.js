var Participantes =
{
	init: function()
	{
		var _this = this;

		this.tabs = new Tabs ('tabs_participantes', 'tabs_participantes_container');
		this.tabs.show('listar');

		this.form_agregar_participante = new Form ("form_agregar_participante", "php/agregar-participante.php");
		this.form_agregar_participante.onSuccess = function (data)
		{
			_this.form_agregar_participante.setData({ });
			_this.tabla.load();
			_this.tabs.show('listar');
		};

		this.form_editar_participante = new Form ("form_editar_participante", "php/editar-participante.php");
		this.form_editar_participante.onSuccess = function (data)
		{
			_this.tabla.load();
			_this.tabs.show('listar');
		};

		this.tabla = new Table ('tabla_participantes', 'php/listar-participantes.php');
		this.tabla.onSuccess = function (data)
		{
			/* ********* */
			var options = "<option value=''></option>";

			for (var i = 0; i < data.length; i++)
				options += "<option value='" + data[i].id + "'>" + data[i].nombre + "</option>";

			var list = document.querySelectorAll("select[name='id_participante']");
			for (var i = 0; i < list.length; i++)
				list[i].innerHTML = options;

			/* ********* */
			var encabezado = [];
			var datos = [];

			encabezado.push('ID');
			encabezado.push('Torneo');
			encabezado.push('Equipo Participante');
			encabezado.push('---');

			for (var i = 0; i < data.length; i++)
			{
				var fila = data[i];

				var temp = [];
				temp.push(fila.id);
				temp.push(fila.nombre_torneo);
				temp.push(fila.nombre_equipo);
				temp.push(
					"<a onclick='Participantes.editar("+fila.id+");'>Editar</a>"+
					"<a onclick='Participantes.eliminar("+fila.id+");'>Borrar</a>"
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

		Ajax.get ('php/get-participante.php?id=' + id, function (resp)
		{
			_this.form_editar_participante.setData (resp.data);
			_this.tabs.show('editar');
		});
	},

	eliminar: function (id)
	{
		var _this = this;

		Ajax.get ('php/eliminar-participante.php?id=' + id, function (resp)
		{
			_this.tabla.load();
		});
	}
};
