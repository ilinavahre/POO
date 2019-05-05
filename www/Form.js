var Form = function (id, action)
{
	var _this = this;

	this.element = document.getElementById(id);

	this.element.onsubmit = function()
	{
		var data = _this.getData();

		_this.element.querySelector(".error").innerHTML = '';

		Ajax.post (action, data, function(resp)
		{
			if (resp.status == 'error')
			{
				_this.element.querySelector(".error").innerHTML = resp.mensaje;
				return;
			}
			
			if (resp.status == 'ok')
				_this.onSuccess (resp);
		});


		return false;
	};
};

Form.prototype.getData = function()
{
	var data = { };

	var list = this.element.querySelectorAll("input");

	for (var i = 0; i < list.length; i++)
	{
		var input = list[i];

		if (input.type == "submit")
			continue;

		if (input.type == "checkbox")
		{
			if (input.checked == true)
				data[input.name] = "1";
			else
				data[input.name] = "0";

			continue;
		}

		data[input.name] = input.value;
	}
	
	return data;
};

Form.prototype.onSuccess = function(data)
{
};
