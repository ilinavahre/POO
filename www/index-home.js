function salir()
{
	Ajax.get ('php/logout.php', function(resp)
	{
		window.location.reload();
	});

	return false;
}

function main()
{
	var tabs_1 = new Tabs ('tabs_1', 'tabs_1_container');
	tabs_1.show('usuarios');

	tabs_1.onTabActivated = function (name)
	{
		switch (name)
		{
			case 'usuarios':
				Usuarios.tabs.show('listar');
				break;

			case 'ligas':
				Ligas.tabs.show('listar');
				break;

			case 'equipos':
				Equipos.tabs.show('listar');
				break;

			case 'personal':
				Personal.tabs.show('listar');
				break;

			case 'torneos':
				Torneos.tabs.show('listar');
				break;

			case 'participantes':
				Participantes.tabs.show('listar');
				break;

			case 'rondas':
				Rondas.tabs.show('listar');
				break;
		}
	};

	Usuarios.init();
	Ligas.init();
	Equipos.init();
	Personal.init();
	Torneos.init();
	Participantes.init();
	Rondas.init();
}
