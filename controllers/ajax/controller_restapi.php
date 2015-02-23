<?php

load_model('wpanel2');
load_lang('wpanel2');
load_libraries(array('utilities'), PhangoVar::$base_path.'modules/wpanel2/libraries/');

class RestApiSwitchClass extends ControllerSwitchClass {

	public function index()
	{
	
		if(ConfigWpanel::$login->check_login())
		{
		
			PhangoVar::$model['wserver']->components['server_type']->name_field_to_field='codename';
			
			$arr_server=PhangoVar::$model['wserver']->select_a_row($_GET['server_id']);
			
			//$server_to_create=form_text($server_to_create);
			
			//, 'server_type' => $arr_server['']
			
			$arr_rest=$_GET;
			
			settype($_GET['action_rest'], 'string');
			
			if($_GET['action_rest']=='')
			{
			
				$_GET['action_rest']='index';
			
			}
			
			$arr_rest['action']=$_GET['action_rest'];
			
			$arr_rest['token']=ConfigWpanel::$login->obtain_cookie_token();
			
			$url_info_server=make_direct_url(get_server_url($arr_server['host']), 'wserver2', slugify($_GET['controller']), $arr_rest);
			
			echo server_restful_connect($url_info_server);
			
			//echo json_encode($json);
			
		}
		else
		{
		
			echo json_encode(array('login' => 0, 'txt_error' => 'Error: no login in system'));
		
		}
	
	}

}

?>