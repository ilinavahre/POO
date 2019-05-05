function main()
{
	var f = new Form ("form_login", "php/login.php");

	f.onSuccess = function (data)
	{
		window.location.reload();
	};
}
