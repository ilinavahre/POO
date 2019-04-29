var Form = function (id)
{
	var _this = this;

	this.element = document.getElementById(id);

	this.element.onsubmit = function()
	{
		_this.onSubmit (_this.getData());
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

Form.prototype.onSubmit = function(data)
{
};
