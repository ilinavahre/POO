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

	Usuarios.init();
}
