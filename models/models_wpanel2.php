<?php

load_libraries(array('i18n_fields'));

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

/**
* Scripts used for configure the server.
*/

PhangoVar::$model['wpanel_script']=new Webmodel('wpanel_script');

PhangoVar::$model['wpanel_script']->change_id_default('id');

PhangoVar::$model['wpanel_script']->set_component('name', 'CharField', array(255));

PhangoVar::$model['wpanel_script']->set_component('name', 'ForeignKeyField', array('server_type'));

PhangoVar::$model['wpanel_script']->set_component('script_name', 'CharField', array(255));


?>