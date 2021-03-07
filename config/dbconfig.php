<?php
use connect\query\connDB;

// connect to pdo database
function PDOconnect(){
	// call class connDB
	$database = new connDB();

	// mysql config auth
	$database->host = ('localhost');
	$database->user = ('root');
	$database->pass = ('');
	$database->dbms = ('smartplay');

	// run connection
	try{
	$db = new PDO('mysql:host='.$database->host.';dbname='.$database->dbms,$database->user, $database->pass);
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	return $db;
	}catch (Exception $e){
	
		header('location:/install');
		exit;
	
	exit;
	}
}
?>
