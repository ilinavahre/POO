var Ajax = function()
{
};

Ajax.get = function (url, callback)
{
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function(x)
	{
		if (this.readyState == 4 && this.status == 200)
		{
			callback (JSON.parse(this.responseText));
		}
	};

	xhttp.open("GET", url, true);
	xhttp.send();
};

Ajax.post = function (url, data, callback)
{
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function(x)
	{
		if (this.readyState == 4 && this.status == 200)
		{
			callback (JSON.parse(this.responseText));
		}
	};

	var formData = new FormData();

	for (var i in data)
		formData.append(i, data[i]);

	xhttp.open("POST", url, true);
	xhttp.send(formData);
};
