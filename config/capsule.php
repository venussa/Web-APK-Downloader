<?php

// callback namespace
use connect\query\query_exec;
use connect\uriconf\permalink;
use creat\data\paramater;
use icluding\manage;
use icluding\magicImage;
use ForceUTF8\hash\Encodings_utf8;

// call back database
function connectDB(){
	return new query_exec();
}

// call back permalink class
function getPermalink(){
	return new permalink();
}

// Method Get
function GET($data = null){
	$call = new paramater();
	return $call->get($data);
}

function generateIMG($url = null,$width = null,$height = null){
	$call = new magicImage();
	return $call->generateIMG($url,$width,$height);

}

// Method Post
function POST($data = null){
	$call = new paramater();
	return $call->post($data);
}

// get session
function SESSION($data = null){
	$call = new paramater();
	return $call->session($data);
}

// get server
function SERVER($data = null){
	$call = new paramater();
	return $call->server($data);
}

// call manage class
function manage(){
	return new manage();
}

// get server info
function info(){
	 $data = explode(" ",microtime());
     return substr( (double) $data[0],0,4);
}

function themeConfig(){
	if(manage()->is_mobile()){
		$is_mobile = "mobile/";
	}else{
		$is_mobile = "desktop/";
	}

	$theme = connectDB()->Query("SELECT * FROM themes WHERE status='1' ");
	$theme = connectDB()->Fetch($theme);
	$theme = $theme["name"]."/";
	return "themes/".$theme.$is_mobile;
}

// include file
function getFile($data){
	if(strpos($data,".php")){
	@require_once(SERVER."/views/".themeConfig().$data);
	}else{
	@require_once(SERVER."/views/".themeConfig().$data.".php");
	}
}

// math string
function contains_word($str, $word) {
  $arr = preg_split('/\W+/', $str, NULL, PREG_SPLIT_NO_EMPTY);
  foreach ($arr as $value) {
    if ($value === $word) {
      return true;
    }
  }
  return false;
}

// fix special charset
function convert_charset(){
	$data = new Encodings_utf8();
	return $data;
}
