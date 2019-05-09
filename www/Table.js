var Table = function (id, action)
{
	this.element = document.getElementById(id);

	this.thead = document.createElement("thead");
	this.tbody = document.createElement("tbody");

	this.element.appendChild(this.thead);
	this.element.appendChild(this.tbody);

	this.action = action;
	this.load();
};

Table.prototype.load_head = function (list)
{
	var html = "";

	html += "<tr>";

	for (var i = 0; i < list.length; i++)
		html += "<td>" + list[i] + "</td>";

	html += "</tr>";

	this.thead.innerHTML = html;
};

Table.prototype.load_data = function (list)
{
	var html = "";

	for (var j in list)
	{
		html += "<tr>";

		for (var i in list[j])
			html += "<td>" + (list[j][i].toString() || '') + "</td>";

		html += "</tr>";
	}

	this.tbody.innerHTML = html;
};

Table.prototype.load = function ()
{
	var _this = this;

	Ajax.get (this.action, function(resp)
	{
		if (resp.status == 'error')
			return;

		if (resp.status == 'ok')
		{
			var temp = _this.onSuccess (resp.data);

			_this.data = temp.data;
			_this.header = temp.header;

			_this.load_head (_this.header);
			_this.load_data (_this.data);
		}
	});
};

Table.prototype.onSuccess = function (data)
{
};
