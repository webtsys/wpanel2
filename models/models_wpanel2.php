<?php

load_libraries(array('i18n_fields', 'login'));
load_model('admin');

/**
* Server type
*/

PhangoVar::$model['server_type']=new Webmodel('server_type');

PhangoVar::$model['server_type']->change_id_default('id');

PhangoVar::$model['server_type']->set_component('name', 'I18nField', array(new CharField(512)), 1);

PhangoVar::$model['server_type']->set_component('codename', 'CharField', array(50), 1);

PhangoVar::$model['server_type']->set_component('parent_type', 'ParentField', array('server_type'), 0);

//You cannot delete default server type

PhangoVar::$model['server_type']->set_component('default', 'BooleanField', array());

/**
* Server 
*/

PhangoVar::$model['wserver']=new Webmodel('wserver');

PhangoVar::$model['wserver']->change_id_default('id');

PhangoVar::$model['wserver']->set_component('name', 'CharField', array(255), 1);

PhangoVar::$model['wserver']->set_component('host', 'CharField', array(255), 1);

PhangoVar::$model['wserver']->set_component('webmonitor', 'CharField', array(255), 0);

PhangoVar::$model['wserver']->set_component('server_type', 'ForeignKeyField', array('server_type'));

//A configured server only can use migration options or update options.

PhangoVar::$model['wserver']->set_component('configured', 'BooleanField', array());

PhangoVar::$model['wserver']->components['server_type']->name_field_to_field='codename';
PhangoVar::$model['wserver']->components['server_type']->fields_related_model=array('id', 'name');

/**
* Scripts used for configure the server.
*/

PhangoVar::$model['wpanel_script']=new Webmodel('wpanel_script');

PhangoVar::$model['wpanel_script']->change_id_default('id');

PhangoVar::$model['wpanel_script']->set_component('name', 'CharField', array(255));

PhangoVar::$model['wpanel_script']->set_component('name', 'ForeignKeyField', array('server_type'));

PhangoVar::$model['wpanel_script']->set_component('script_name', 'CharField', array(255));

class ConfigWpanel {

	//Always hardcoded https.

	static public $server_port=443;
	
	/**
	* Examples from Guzzle
	// Use the system's CA bundle (this is the default setting)
	$client->get('/', ['verify' => true]);

	// Use a custom SSL certificate on disk.
	$client->get('/', ['verify' => '/path/to/cert.pem']);

	// Disable validation entirely (don't do this!).
	$client->get('/', ['verify' => false]);
	*/
	
	static public $verify_guzzle_ssl=false;
	
	static public $login;

}

/**
* A copy of $login admin for check_login out of the admin site.
*/

ConfigWpanel::$login=new LoginClass('user_admin', 'username', 'password', 'token_client', $arr_user_session=array('IdUser_admin', 'privileges_user', 'username', 'token_client'), $arr_user_insert=array('username', 'password', 'repeat_password', 'email'));


?>