<?php 
	if (! defined ( 'MUST_FROM_INDEX' )) exit ( 'Cannot access file directly' );

	//WS Configuration
	define ( 'WS_NAMA_KELOMPOK', 'WS_KELOMPOK_X' );
	define ( 'WS_NAMA_WSDL', 'WSDL_' . WS_NAMA_KELOMPOK . '.wsdl' );

	//Create WS Service Instance with WSDL
	$ws_svr = new nusoap_server ();
	$ws_svr->soap_defencoding = 'UTF-8';
	$ws_svr->configureWSDL ( WS_NAMA_KELOMPOK, 'urn:' . WS_NAMA_WSDL );

	//Function CheckAuth - User Authentication
	function CheckAuth($p_header) {
		global $ws_svr;
		$arr_h = $p_header;
		$user_name = $arr_h ['AuthSoapHeader'] ['UserName'];
		$password = $arr_h ['AuthSoapHeader'] ['Password'];

		$user_name = base64_decode($user_name);
		$password = base64_decode($password);

		$return = false;
		if (($user_name == 'wsclient') & ($password == 'secret')) {
			$return = true;
		} else {
		$ws_svr->fault ( 'WSS-ERR-LOGIN-001', 'INVALID_USER_OR_PASSWORD', 'LOGIN', 'Kombinasi
		User dan Password Salah' );
			$return = false;
		}
		return $return;
	}

	//Web Service Function - List Propinsi
	function list_propinsi($p_key_search, $p_page, $p_page_size) {
		global $conn, $ws_svr;

		if (! CheckAuth ( $ws_svr->requestHeader )) {
		$return ['data_count'] = 0;
		$return ['data'] = 0;
		} else {
		$v_key_search = (!$p_key_search || $p_key_search=='')? '' : $p_key_search;
		$v_page = (!$p_page || $p_page=='')? 0 : $p_page;
		$v_page_size = (!$p_page_size || $p_page_size=='')? 10 : $p_page_size;

		$v_page = (int)$v_page;
		$v_page_size=(int)$v_page_size;

		$v_key_search = '%'.$v_key_search.'%';
		$v_key_search=(string)$v_key_search;

		$sql = "SELECT * FROM info_penduduk_propinsi WHERE prop_nama like '%s' LIMIT %d, %d";

		$sql = sprintf($sql,$v_key_search,$v_page,$v_page_size);

		$stmt = mysql_query ( $sql, $conn );

		$return_data_count = mysql_affected_rows ( $conn );
		$return_data = array ();
		if (is_resource ( $stmt )) {
			while ( $row = mysql_fetch_array( $stmt ) ) {
				$return_data [] = $row;
			}
		}

			$return ['data_count'] = $return_data_count;
			$return ['data'] = $return_data;
		}
		//encode data
		$return = base64_encode ( serialize ( $return ) );
		
		return $return;
	}
	//Register Function to Service
	$ws_svr->register ( 'list_propinsi', array ('p_key_search' => 'xsd:string', 'p_page' => 'xsd:integer', 'p_page_size' =>'xsd:integer' ),
	array ('return' => 'xsd:string' ),
	'urn:' . WS_NAMA_WSDL,
	'urn:' . WS_NAMA_WSDL . '#list_propinsi',
	'rpc',
	'encoded',
	'Deskripsi fungsi list_propinsi' );

	//Create The Service Response
	$HTTP_RAW_POST_DATA = isset ( $HTTP_RAW_POST_DATA ) ? $HTTP_RAW_POST_DATA : '';
	$ws_svr->service ( $HTTP_RAW_POST_DATA );
	exit ();

 ?>