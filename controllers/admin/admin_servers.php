<?php

use GuzzleHttp\Client;

function ServersAdmin()
{

	load_libraries(array('admin/generate_admin_class', 'utilities/menu_selected'));
	load_libraries(array('autoload'), PhangoVar::$base_path.'modules/wpanel2/vendor/');

	load_lang('wpanel2');
	load_model('wpanel2');
	
	/*$client = new Client();
	$response = $client->get('http://www.web-t-sys.com');*/
	
	$arr_menu[0]=array('Home', set_admin_link('servers', array()));
	
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
			
			$admin->show();
		
		break;
	
		case 1:
		
			settype($_GET['server_type'], 'integer');
		
			$arr_menu[1]=array(PhangoVar::$lang['wpanel2']['servers_list'], set_admin_link('servers', array('op' => 1, 'server_type' => $_GET['server_type'])));
		
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
			
			settype($arr_server['id'], 'integer');
			
			if($arr_server['id']>0)
			{
			
				$arr_menu[1]=array(PhangoVar::$lang['wpanel2']['servers_list'], set_admin_link('servers', array('op' => 1, 'server_type' => $_GET['server_type'])));
				$arr_menu[2]=array(PhangoVar::$lang['wpanel2']['configure_server'], set_admin_link('servers', array('op' => 2, 'server_type' => $_GET['server_type'])));
				
				echo menu_barr_hierarchy($arr_menu, 'op', $yes_last_link=0, $arr_final_menu=array(), $return_arr_menu=0);
				
				echo '<h2>'.PhangoVar::$lang['wpanel2']['configure_server'].' - '.$arr_server['name'].'</h2>';
				
				if($arr_server['configured']==0)
				{
				
					//Obtain info from server
				
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