

<!DOCTYPE html>
<html>
<script type="text/javascript">
	
	var helpContent;
	var help_container;

	init_Help = function(){
		// help_container = document.getElementById("help_container");

		help_main_container = document.createElement('div');
		help_main_container.id = 'help_main_container';
		help_container.appendChild(help_main_container);

		helpContent = document.createElement('div');
		helpContent.id = 'helpContent';
		helpContent.classList.add("helpContent");
		helpContent.innerHTML = "<?php echo HELPCONTENT ?>";
		help_main_container.appendChild(helpContent);
	};


</script>

<body>
</body>
</html>