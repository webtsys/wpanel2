<?php

function post_install()
{

	//load_model
	
	load_model('wpanel2');
	
	//PhangoVar::$model['server_type']->insert(array('name' => 'MySQL', 'default' => 1));
	
	//PhangoVar::$model['server_type']->insert(array('name' => 'Postfix', 'default' => 1));
	
	$arr_lang['db']=array('es-ES' => 'Servidor de bases de datos', 'en-US' => 'Database Server');
	$arr_lang['web']=array('es-ES' => 'Servidor Web', 'en-US' => 'Web Server');
	$arr_lang['mail']=array('es-ES' => 'Servidor de correo', 'en-US' => 'Mail server');
	
	echo "---Creating server types by default...\n";
	
	PhangoVar::$model['server_type']->insert(array('name' => $arr_lang['db'], 'codename' => 'dbserver', 'default' => 1));
	PhangoVar::$model['server_type']->insert(array('name' => $arr_lang['web'], 'codename' => 'webserver', 'default' => 1));
	PhangoVar::$model['server_type']->insert(array('name' => $arr_lang['mail'], 'codename' => 'smtpserver', 'default' => 1));
	
	return true;

}

?>