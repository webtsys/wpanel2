<?php

function ServersAdmin()
{
	load_model('wpanel2');

	load_libraries(array('admin/generate_admin_class', 'utilities/menu_selected'));
	load_libraries(array('utilities'), PhangoVar::$base_path.'modules/wpanel2/libraries/');

	load_lang('wpanel2');
	
	/*$client = new Client();
	$response = $client->get('http://www.web-t-sys.com');*/
	settype($_GET['server_type'], 'integer');
	settype($_GET['id'], 'integer');
	
	$arr_menu[0]=array(PhangoVar::$lang['wpanel2']['servers_type'], set_admin_link('servers', array()));
	$arr_menu[1]=array(PhangoVar::$lang['wpanel2']['servers_list'], set_admin_link('servers', array('op' => 1, 'server_type' => $_GET['server_type'])));
	$arr_menu[2]=array(PhangoVar::$lang['wpanel2']['configure_server'], set_admin_link('servers', array('op' => 2, 'server_type' => $_GET['server_type'], 'id' => $_GET['id'])));
	
	settype($_GET['op'], 'integer');
	
	switch($_GET['op'])
	{
	
		default:
		
			echo menu_barr_hierarchy($arr_menu, 'op', $yes_last_link=0, $arr_final_menu=array(), $return_arr_menu=0);
		
			echo '<h2>'.PhangoVar::$lang['wpanel2']['servers_type'].'</h2>';
			
			//$models['server_type']->
			$admin=new GenerateAdminClass('server_type');
			
			$admin->arr_fields=array('name', 'default');
			
			$admin->arr_fields_no_showed=array('default');
			
			$admin->options_func='TypeOptionsListModel';
			
			$admin->set_url_post(set_admin_link('servers', array('op' => 0, 'server_type' => 0)));
			
			$admin->show();
		
		break;
	
		case 1:
		
		
			echo menu_barr_hierarchy($arr_menu, 'op', $yes_last_link=0, $arr_final_menu=array(), $return_arr_menu=0);
		
			echo '<h2>'.PhangoVar::$lang['wpanel2']['servers_list'].'</h2>';
			
			PhangoVar::$model['wserver']->create_form();
			
			PhangoVar::$model['wserver']->forms['server_type']->form='HiddenForm';
			
			PhangoVar::$model['wserver']->forms['server_type']->set_param_value_form($_GET['server_type']);
			
			$admin=new GenerateAdminClass('wserver');
			
			$admin->arr_fields=array('name', 'server_type');
			
			$admin->arr_fields_edit=array('name', 'host', 'webmonitor', 'server_type');
			
			$admin->arr_fields_no_showed=array('server_type');
			
			$admin->set_url_post(set_admin_link('servers', array('op' => 1, 'server_type' => $_GET['server_type'])));
			
			$admin->options_func='ServerOptionsListModel';
			
			$admin->where_sql='where server_type='.$_GET['server_type'];
			
			$admin->show();
		
		break;
		
		case 2:
		
			//here, generate the new server.
			
			//settype()
			
			//$arr_server
			
			settype($_GET['id'], 'integer');
			
			$arr_server=PhangoVar::$model['wserver']->select_a_row($_GET['id']);
			
			//$arr_server['server_type']=PhangoVar::$model['wserver']->components['server_type']->show_formatted();
			
			settype($arr_server['id'], 'integer');
			
			if($arr_server['id']>0)
			{
			
				
				echo menu_barr_hierarchy($arr_menu, 'op', $yes_last_link=0, $arr_final_menu=array(), $return_arr_menu=0);
				
				echo '<h2>'.PhangoVar::$lang['wpanel2']['configure_server'].' - '.$arr_server['name'].'</h2>';
				
				if($arr_server['configured']==0)
				{
					//make_direct_url($base_url, $module, $controller_folders, $parameters_func=array(), $extra_parameters=array())
					//Obtain info from server
					
					//$url_info_server=make_direct_url(get_server_url($arr_server['host']), 'wserver2', 'showinfo', array('id' => AdminSwitchClass::$login->session['IdUser_admin'], 'token' => AdminSwitchClass::$login->session['token_client']));
					
					$ajax_url=make_direct_url(PhangoVar::$base_url, 'wpanel2', 'ajax/info', array('action' => 'obtain_info_from_server', 'server_id' => $arr_server['id'], 'token' => AdminSwitchClass::$login->session['token_client']));
					
					PhangoVar::$arr_cache_header[]=load_view(array($ajax_url, 'load_info', 'load_error_info'), 'wpanel2/ajaxpanel', 'wpanel2');
					
					echo load_view(array(), 'wpanel2/showinfo', 'wpanel2');
					
					/**
					* Here load the view for fill the result.
					*/
					
					/*$client = new Client();
					
					try {
					
						$response = $client->get($url_info_server, [ 'verify' => ConfigWpanel::$verify_guzzle_ssl ]  );
						
						$json = $response->json();
						
						if($json['login']==0)
						{
						
							echo $json['txt_error'];
						
						}
						
					} catch (exception $e) {
					
						echo $e->getMessage();
					
					}*/
					 
				
				}
				else
				{
				
					
				
				}
		
			}
			
		break;
		
	
	}
	
}

function ServerOptionsListModel($url_options, $model_name, $id, $arr_row)
{

	$arr_options=BasicOptionsListModel($url_options, $model_name, $id);
	
	$arr_options[]='<a href="'.set_admin_link('servers', array('op' => 2, 'server_type' => $arr_row['server_type'], 'id' => $id)).'">'.PhangoVar::$lang['wpanel2']['configure_server'].'</a>';
	
	return $arr_options;

}

function TypeOptionsListModel($url_options, $model_name, $id, $arr_row)
{

	$arr_options=BasicOptionsListModel($url_options, $model_name, $id);
	
	$arr_options[]='<a href="'.set_admin_link('servers', array('op' => 1, 'server_type' => $id)).'">'.PhangoVar::$lang['wpanel2']['view_servers'].'</a>';
	
	return $arr_options;

}

?>