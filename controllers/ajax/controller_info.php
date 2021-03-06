<?php

load_model('wpanel2');
load_lang('wpanel2');
load_libraries(array('utilities'), PhangoVar::$base_path.'modules/wpanel2/libraries/');

class InfoSwitchClass extends ControllerSwitchClass {

	public function obtain_info_from_server($server_id)
	{
	
		if(ConfigWpanel::$login->check_login())
		{
		
			PhangoVar::$model['wserver']->components['server_type']->name_field_to_field='codename';

			$arr_server=PhangoVar::$model['wserver']->select_a_row($server_id);
			
			//, 'server_type' => $arr_server['']
			
			$url_info_server=make_direct_url(get_server_url($arr_server['host']), 'wserver2', 'showinfo', array('action' => 'os', 'token' => ConfigWpanel::$login->obtain_cookie_token(), 'server_type' => $arr_server['server_type']));
			
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