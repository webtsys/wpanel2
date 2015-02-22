<?php

function ShowInfoView($arr_server)
{

PhangoVar::$arr_cache_jscript['wpanel2'][]='mustache.js';

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
					
					if(data.error_txt==null)
					{
					
						data.error_txt='Unknown error';
					
					}
					
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
					
					
					var template = $('#template').html();
					
					Mustache.parse(template);
					
					data.system_info['module_installed']=function () {
					
						if(this.installed==0)
						{
						
							return '<?php echo PhangoVar::$lang['wpanel2']['install_module']; ?>';
						
						}
						else
						{
						
							return '<?php echo PhangoVar::$lang['wpanel2']['uninstall_module']; ?>';
						
						}
					
					};
					
					/*$('.distro').val(data.system_info.distribution[0]);
					$('.version_distro').val(data.system_info.distribution[1]);*/
					
					/*for(i in data.system_info.available_modules)
					{
					
						data.system_info.available_modules[i].distro=data.system_info.distribution[0];
						data.system_info.available_modules[i].version_distro=data.system_info.distribution[1];
					
					}*/
					
					var rendered = Mustache.render(template, data.system_info);
					
					$('#target').html(rendered);
				
				}
			
			}
		
		}
		
		function load_error_info(data)
		{
			
			$('#error_login').html(data.error_txt);
		
		}
		
		$(document).ready( function () {
		
			$('body').on('click', '.package_install', function () {
			
				
				
				return false;
			
			});
		
		});
	
</script>

<?php

PhangoVar::$arr_cache_header[]=ob_get_contents();

ob_end_clean();

$ajax_url=make_direct_url(PhangoVar::$base_url, 'wpanel2', 'ajax/info', array('action' => 'obtain_info_from_server', 'server_id' => $arr_server['id'], 'token' => AdminSwitchClass::$login->session['token_client']));
					
PhangoVar::$arr_cache_header[]=load_view(array($ajax_url, 'load_info', 'load_error_info'), 'wpanel2/ajaxpanel', 'wpanel2');

ob_start();

?>
<span class="error" id="error_login"></span>
<div id="info_server">
	<p><label for="server"><?php echo PhangoVar::$lang['wpanel2']['operating_system']; ?></label>: <span id="distro"></span> <span id="version"></span></p>
	<p><label for="server"><?php echo PhangoVar::$lang['wpanel2']['arch']; ?></label>: <span id="arch"></span></span></p>
</div>
<!--<div class="info_category">
	<p><label for="category">Categoría</label>: {{category}}</p>
	<p><label for="name">Nombre</label>: {{name}}</p>
</div>-->
<?php

$cont_index=ob_get_contents();

ob_end_clean();

echo load_view(array(PhangoVar::$lang['wpanel2']['server_info'], $cont_index), 'content');

//os/debian/7/webserver/apache
/*{"machine":"i686","distribution":["debian","7.8",""],"processor":"","available_modules":[{"category":"webserver","name":"Apache 2.2 for Debian Wheezy","package":"apache2","installed":0,"os_version":"7.*","version":"2.2.*","os":"debian","description":"This script install a special default configuration file"},{"category":"webserver","name":"Nginx webserver for Wheezy","package":"nginx","installed":0,"os_version":"7.*","version":"1.2.1","os":"debian","description":"This script install a special default configuration file for nginx"}],"system":"Linux"}*/

?>
<div id="target">
</div>
<script id="template" type="x-tmpl-mustache">
{{#available_modules}}
<div class="content">
	<div class="title">
		{{name}}
	</div>
	<div class="cont">
		<div id="info_module">
			<p><label for="package"><?php echo PhangoVar::$lang['wpanel2']['package']; ?></label>: <span class="package">{{package}}</span></p>
			<p><label for="package"><?php echo PhangoVar::$lang['wpanel2']['name']; ?></label>: <span class="package">{{name}}</span></p>
			<p><label for="description"><?php echo PhangoVar::$lang['wpanel2']['description']; ?></label>: <span class="description">{{description}}</span></p>
			<!--<input type="hidden" name="package" value="{{package}}">-->
			<!--<input type="hidden" name="category" value="{{category}}">
			<input type="hidden" name="distro" value="{{distro}}">
			<input type="hidden" name="version_distro" value="{{version_distro}}">-->
			<p><input type="button" class="package_install" value="{{module_installed}}" id="{{package}}_install"/></p>
		</div>
	</div>
</div>
{{/available_modules}}
</script>
<?php




}

?>