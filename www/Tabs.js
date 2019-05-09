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
	var list = this.container.children;

	for (var i = 0; i < list.length; i++)
		list[i].style.display = "none";
};

Tabs.prototype.show = function (name)
{
	this.hideAll();

	var list = this.container.children;

	for (var i = 0; i < list.length; i++)
	{
		if (list[i].attributes.name && list[i].attributes.name.value == name)
		{
			this.onTabActivated (name);

			list[i].style.display = "block";
			break;
		}
	}
};

Tabs.prototype.onTabActivated = function (name)
{
};
