<?php

function ShowInfoView()
{

ob_start();
					
?>

<script language="javascript">
	
		function load_info(data)
		{
			
			if(data.login==0)
			{
				
				$('#error_login').html(data.error_txt);
			
			}
			else
			{
				
				if(data.error!=0)
				{
					
					$('#error_login').html(data.error_txt);
				
				}
				else
				{
					//alert(JSON.stringify(data))
					/*$('#error_login').html(data.error_txt);*/
					
					/*
					{"login":1,"error":0,"error_txt":"","system_info":{"machine":"i686","distribution":["debian","7.8",""],"processor":"","available_modules":{"apache":{"category":"webserver","name":"Apache 2.2 for Debian Wheezy","basename":"apache","os_version":"wheezy","version":"1.0","description":"This script install a special default configuration file"},"nginx":{"category":"webserver","os_version":"wheezy","basename":"nginx","name":"Nginx webserver for Wheezy","description":"This script install a special default configuration file for nginx"}},"system":"Linux"}}
					*/
					
					$('#distro').html(data.system_info.distribution[0]);
					$('#version').html(data.system_info.distribution[1]);
					$('#arch').html(data.system_info.machine);
				
				}
			
			}
		
		}
		
		function load_error_info(data)
		{
			
			$('#error_login').html(data.error_txt);
		
		}
	
</script>

<?php

PhangoVar::$arr_cache_header[]=ob_get_contents();

ob_end_clean();

ob_start();

?>
<span class="error" id="error_login"></span>
<div id="info_server">
	<p><label for="server">Sistema operativo</label>: <span id="distro"></span> <span id="version"></span></p>
	<p><label for="server">Arquitectura</label>: <span id="arch"></span></span></p>
</div>
<!--<div class="info_category">
	<p><label for="category">Categoría</label>: {{category}}</p>
	<p><label for="name">Nombre</label>: {{name}}</p>
</div>-->
<?php

$cont_index=ob_get_contents();

ob_end_clean();

echo load_view(array('Información del servidor', $cont_index), 'content');

}

?>