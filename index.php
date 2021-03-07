<?php

// start session
session_start();

// set time zone
date_default_timezone_set('Asia/Jakarta');

//show error
error_reporting(-1);
ini_set('display_errors', 'Off');

// time limit
set_time_limit(0);

// timezone
date_default_timezone_set('Asia/Jakarta');

//home directoy
DEFINE("SERVER",str_replace("\\","/",__DIR__));

//scan and include system
foreach(glob(SERVER."/system/*.php") as $key => $value){
	require_once($value);
}

//scan and include config
foreach(glob(SERVER."/config/*.php") as $key => $value){
	require_once($value);
}
