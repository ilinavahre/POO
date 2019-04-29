var Table = function (id)
{
	this.element = document.getElementById(id);
	
	this.thead = document.createElement("thead");
	this.tbody = document.createElement("tbody");

	this.element.appendChild(this.thead);
	this.element.appendChild(this.tbody);
};

Table.prototype.head = function (list)
{
	var html = "";

	html += "<tr>";

	for (var i = 0; i < list.length; i++)
		html += "<td>" + list[i] + "</td>";

	html += "</tr>";

	this.thead.innerHTML = html;
};

Table.prototype.data = function (list)
{
	var html = "";

	for (var j in list)
	{
		html += "<tr>";

		for (var i in list[j])
			html += "<td>" + list[j][i] + "</td>";

		html += "</tr>";
	}

	this.tbody.innerHTML = html;
};
