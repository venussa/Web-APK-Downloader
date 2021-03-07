<?php
namespace creat\data;

// callback permalink;
use connect\uriconf\permalink;

// read paramater on url
class paramater{

	// get declaration paramater symbol
	var $identification = array("?","=");

	// get splitter paramater
	var $splice_data = array("&");

	// read offset index
	function get($index = null){

		// fetch data
		$get_permalink = new permalink();
		$start = @explode($this->identification[0],$get_permalink->splice());
		if(isset($start[1])){
		$split = @explode($this->splice_data[0],$start[1]);

			// checking visible paramater
			foreach ($split as $key => $value) {

					$extract = explode($this->identification[1], $value);
					
					if(!empty($index)){

					$response = true;

					// check allowing paramater
					if($index == $extract[0]){
					
					return $extract[1];

				// if no config found
				}else{

				}
			}else{

			// commbine data
			$response = false;
			$result[] = "'".@$extract[0]."' => '".@$extract[1]."'";
			}
		}

			// return all
			if($response == false){
				$combine = implode(",",$result);
				$set_data = '$new_data = ['.$combine.'];';
				eval($set_data);
				return $new_data;
			}
		}else{

			// if method get not found
			return array();
		}
	}

	// read offset post
	function post($index = null){
		if(!empty($index)){
			foreach ($_POST as $key => $value) {
				if($index == $key){
					return $value;
				}
			}	
		}else{
			return $_POST;
		}
	}

	// read offset session
	function session($index = null){
		if(!empty($index)){
			foreach ($_SESSION as $key => $value) {
				if($index == $key){
					return $value;
				}
			}	
		}else{
			return $_SESSION;
		}
	}

	// read offset server
	function server($index = null){
		if(!empty($index)){
			foreach ($_SERVER as $key => $value) {
				if($index == $key){
					return $value;
				}
			}	
		}else{
			return $_SERVER;
		}
	}
}