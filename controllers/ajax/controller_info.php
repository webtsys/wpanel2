<?php

load_model('wpanel2');
load_lang('wpanel2');
load_libraries(array('utilities'), PhangoVar::$base_path.'modules/wpanel2/libraries/');

class InfoSwitchClass extends ControllerSwitchClass {

	public function obtain_info_from_server($server_id)
	{
	
		if(ConfigWpanel::$login->check_login())
		{

			$arr_server=PhangoVar::$model['wserver']->select_a_row($server_id);
			
			$url_info_server=make_direct_url(get_server_url($arr_server['host']), 'wserver2', 'showinfo', array('action' => 'os', 'token' => 'token'));
			
			echo server_restful_connect($url_info_server);
			
			//echo json_encode($json);
			
		}
		else
		{
		
			echo json_encode(array('txt_error' => 'Error: no login in system'));
		
		}
	
	}

}

?>