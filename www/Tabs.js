var Tabs = function (id_header, id_container)
{
	var _this = this;

	this.header = document.getElementById (id_header);
	this.container = document.getElementById (id_container);

	this.links = this.header.querySelectorAll("a[name]");

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
	var list = this.container.querySelectorAll("div[name]");

	for (var i = 0; i < list.length; i++)
		list[i].style.display = "none";
};

Tabs.prototype.show = function (name)
{
	this.hideAll();

	var div = this.container.querySelector("div[name="+name+"]");
	if (div) div.style.display = "block";
};
