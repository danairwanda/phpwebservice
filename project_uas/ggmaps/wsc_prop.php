<?php 
	
	require '../client/ws_client.php';

	// Get parameter form URL
	$v_prop_nama	=	(isset($_REQUEST["prop_nama"])) ? $_REQUEST["prop_nama"] : '';
	$v_prop_nama	=	'%' . $v_prop_nama . '%';
	$v_prop_nama	=	(string) $v_prop_nama;
	$v_page			=	0;
	$v_page_size	=	100;

	// Call list propinsi WSC function
	$ws_data		=	call_ws_list_propinsi($v_prop_nama, $v_page, $v_page_size);
	$n 				=	$ws_data['data_count'];
	$prop_data		=	$ws_data['data'];

	// Start XML file, create parent node
	$dom 			=	new DOMDocument("1.0");
	$node			=	$dom->createElement("marker");
	$parnode		=	$dom->appendChild($node);

	// header("Content-type: text/xml");
	header( "Content-type: text/xml");

	// Iterate through the rows, adding XML node for each
	for ($i=0; $i < $n; $i++) { 
				$jml 	=	($prop_data[$i] ['prop_jml_penduduk_pria'] + $prop_data[$i]
					['prop_jml_penduduk_wanita']);
				$node = $dom->createElement("marker");	
				$newnode	=	$parnode->appendChild($node);
				$newnode->setAttribute("prop_nama", $prop_data[$i]['prop_nama']);	
				$newnode->setAttribute("prop_ibukota", $prop_data[$i]['prop_ibukota']);	
				$newnode->setAttribute("prop_penduduk",$jml);	
				$newnode->setAttribute("prop_penduduk_pria",$prop_data[$i]['prop_jml_penduduk_pria']);
				$newnode->setAttribute("prop_penduduk_wanita",$prop_data[$i]['prop_jml_penduduk_wanita']);
				$newnode->setAttribute("prop_website", $prop_data[$i]['prop_website']);
				$newnode->setAttribute("lat", $prop_data[$i]['prop_map_latitude']);	
				$newnode->setAttribute("lng", $prop_data[$i]['prop_map_longitude']);	
			}		

			echo $dom->saveXML();		

 ?>