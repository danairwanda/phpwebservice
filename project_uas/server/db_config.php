<?php 
	if (! defined('MUST_FROM_INDEX')) exit ('Cannot access file directly');

	$db_host	=	'localhost';
	$db_user	=	'root';
	$db_pwd		=	'';
	$db_port	=	'3306';
	$db_schema	=	'db_enterprise';

	$conn = mysql_connect($db_host, $db_user, $db_pwd) or die ('Failed while making database connection');
	if ($conn) {
		mysql_select_db($db_schema);
	}
		
 ?>