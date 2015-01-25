<?php

use GuzzleHttp\Client;

load_libraries(array('autoload'), PhangoVar::$base_path.'modules/wpanel2/vendor/');

function get_server_url($host)
{

	return 'https://'.$host.':'.ConfigWpanel::$server_port;

}

function server_restful_connect($url_server)
{

	$json=array();
				
	$client = new Client();
				
	try {

		$response = $client->get($url_server, [ 'verify' => ConfigWpanel::$verify_guzzle_ssl ]  );
		
		$json = $response->json();
		
		return json_encode($json);
		
	} catch (exception $e) {
		//.'<p>'.$response->getBody()
		return json_encode(array('error_txt' => $e->getMessage() , 'code_error' => 1));

	}
	
}

?>