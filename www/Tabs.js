var Tabs = function (id_header, id_container)
{
	var _this = this;

	this.header = document.getElementById (id_header);
	this.container = document.getElementById (id_container);

	this.links = this.header.querySelectorAll("a");

	for (var i = 0; i < this.links.length; i++)
	{
		this.links[i].onclick = function()
		{
			_this.show (this.name);
			return false;
		};
	}
	
	this.hideAll();
};

Tabs.prototype.hideAll = function()
{
	for (var i = 0; i < this.links.length; i++)
	{
		var link = this.links[i];

		var div = this.container.querySelector("div[name="+link.name+"]");
		div.style.display = "none";
	}
};

Tabs.prototype.show = function (name)
{
	this.hideAll();

	var div = this.container.querySelector("div[name="+name+"]");
	div.style.display = "block";
};
