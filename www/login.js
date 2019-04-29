function main()
{
	var tabs = new Tabs("my_tabs", "my_tabs_container");
	var tabs_colors = new Tabs("tabs_colors", "tabs_colors_container");

	var t = new Table ("colors");

	var f = new Form ("add_color");

	f.onSubmit = function(data)
	{
		Ajax.post ("test2_2.php", data, function(data)
		{
			if (data.status == 'OK')
			{
				tabs_colors.show("color_list");

				Ajax.get ("test2.php", function(data)
				{
					t.head (Object.keys(data[0]));
					t.data (data);
				});
			}
		});
	};

	Ajax.get ("test2.php", function(data)
	{
		t.head (Object.keys(data[0]));
		t.data (data);
	});
}
