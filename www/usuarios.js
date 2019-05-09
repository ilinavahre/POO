var Usuarios =
{
	init: function()
	{
		var _this = this;

		this.tabs = new Tabs ('tabs_usuarios', 'tabs_usuarios_container');
		this.tabs.show('listar');
		
		this.tabs.onTabActivate = function(name)
		{
			switch(name)
			{
				case 'listar':
					_this.tabla.load();
					break;
			}
		};

		this.form_agregar_usuario = new Form ("form_agregar_usuario", "php/agregar-usuario.php");
		this.form_agregar_usuario.onSuccess = function (data)
		{
			_this.form_agregar_usuario.setData({ });
			_this.tabs.show('listar');
		};

		this.form_editar_usuario = new Form ("form_editar_usuario", "php/editar-usuario.php");
		this.form_editar_usuario.onSuccess = function (data)
		{
			_this.tabs.show('listar');
		};

		this.tabla = new Table ('tabla_usuarios', 'php/listar-usuarios.php');
		this.tabla.onSuccess = function (data)
		{
			/* ********* */
			var options = "<option value=''></option>";

			for (var i = 0; i < data.length; i++)
				options += "<option value='" + data[i].id + "'>" + data[i].nombre + "</option>";

			var list = document.querySelectorAll("select[name='id_usuario']");
			for (var i = 0; i < list.length; i++)
				list[i].innerHTML = options;

			/* ********* */
			var encabezado = [];
			var datos = [];

			encabezado.push('ID');
			encabezado.push('Nombre de Usuario');
			encabezado.push('Nombre');
			encabezado.push('Fecha de Nacimiento');
			encabezado.push('---');

			for (var i = 0; i < data.length; i++)
			{
				var fila = data[i];

				var temp = [];
				temp.push(fila.id);
				temp.push(fila.username);
				temp.push(fila.nombre + ' ' + fila.apellido);
				temp.push(fila.fnac);
				temp.push(
					"<a onclick='Usuarios.editar("+fila.id+");'>Editar</a>"+
					"<a onclick='Usuarios.eliminar("+fila.id+");'>Borrar</a>"
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

		Ajax.get ('php/get-usuario.php?id=' + id, function (resp)
		{
			_this.form_editar_usuario.setData (resp.data);
			_this.tabs.show('editar');
		});
	},

	eliminar: function (id)
	{
		var _this = this;

		Ajax.get ('php/eliminar-usuario.php?id=' + id, function (resp)
		{
			_this.tabla.load();
		});
	}
};
