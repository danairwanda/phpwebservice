<?php 
	//just for simple security - all php file must called from index.php
	define('MUST_FROM_INDEX','ENTERPRISE');
	//load nusoap library
	require '../../lib/nusoap.php';
	//Load db configuration
	require 'db_config.php';
	//run ws server
	require 'ws_server.php';
 ?>