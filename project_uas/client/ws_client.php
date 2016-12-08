<?php 
	//include nusoap library
	require '../../lib/nusoap.php';
	//wsdl configuration
	$wsdl = 'http://enterprise.dev/project_uas/server/index.php?wsdl';

	//create instance
	$ws_client = new nusoap_client ( $wsdl, true );

	//debug if needed
	//$ws_client->debugLevel = 1;
	
	//header configuration
	$user = "wsclient";
	$pass = "secret";

	//encrypt header value
	$user = base64_encode ( $user );
	$pass = base64_encode ( $pass );

	$header = '<AuthSoapHeader>
	<UserName>' . $user . '</UserName>
	<Password>' . $pass . '</Password>
	</AuthSoapHeader>';

	//set header
	$ws_client->setHeaders ( $header );

	// Function to print Fault
	function detect_fault() {
		global $ws_client;

		//detect fault and error
		if ($ws_client->fault) {
			exit ( $ws_client->faultstring );
		} else {
			$err = $ws_client->getError ();
			if ($err) {
				exit ( $err );
			}
		}
	}

	//Function to Echo Debug Result
	function echo_debug(){
		global $ws_client;
		echo "<pre>".$ws_client->debug_str."</pre>";
		echo "<pre>".$ws_client->request."/<pre>";
		print_r($ws_client->requestHeaders);
	}

	//define Call Function for list_propinsi Service
	function call_ws_list_propinsi($p_key_search, $p_page, $p_page_size) {
	global $ws_client;

	//parameters configuration
	$params = array ('p_key_search' => $p_key_search, 'p_page' => $p_page, 'p_page_size' =>
	$p_page_size );

	//call method service
	$ws_data = $ws_client->call ( 'list_propinsi', $params);

	detect_fault ();

	//decode data
	$ws_data = unserialize ( base64_decode ( $ws_data ) );
	//print_r($ws_data);

	//echo debug if needed
	//echo_debug();
	
	return $ws_data;
	}
 ?>