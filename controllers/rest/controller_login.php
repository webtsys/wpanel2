<?php

load_model('wpanel2', 'admin');

class LoginSwitchClass extends ControllerSwitchClass {

	public function index($token_sended)
	{
	
		//Check token
		
		//Only allowed from ip's in database.
		
		$server_ip=form_text($_SERVER['REMOTE_ADDR']);
		
		$token_sended=form_text($token_sended);
		
		$c_server=PhangoVar::$model['wserver']->select_count('where host="'.$server_ip.'"');
		
		if($c_server>0)
		{
		
			$count=PhangoVar::$model['user_admin']->select_count('where token_client="'.sha1($token_sended).'"');
		
			if($count==1)
			{
			
				$json=array('login' => 1);
				
				echo json_encode($json);
			}
		
		}
		else
		{
			$json=array('login' => 0);
			
			echo json_encode($json);
		
		}
	
	}

}

?>