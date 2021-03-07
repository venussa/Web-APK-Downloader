<?php
namespace connect\uriconf;

// call class magic image
use icluding\magicImage;
// permalink reader
class permalink{

	// read uri as space
	function declarate_space($data,$config = null, $whitelist = null){

		if(!empty($this->splice(1))){
			
			// checking and sellection
			if(in_array($this->splice(1),array_keys($data))){
				foreach($data as $key => $val){
					if(in_array($key, $whitelist)) $detach = null; else $detach = $config;
					if($this->splice(1) == $key){

						// url found
						if(is_file(SERVER."/views/".$detach.$val.".php")){
						    ob_start();
				            require_once(SERVER."/views/".$detach.$val.".php");
				            $out = ob_get_clean();
				            echo $out;		
							exit;
						}else{

							//url found but target not found
							require_once(SERVER."/404.php");
							exit;
						}
					}
				}
			}else{

				// url not found
				if($this->splice(1) == "image"){
				
					$call = new magicImage();
					return $call->generate(base64_decode($this->splice(2)),$this->splice(3),$this->splice(4),$this->splice(5));
				
				}else{
					if(in_array("cusTom", $whitelist)) $detach = null; else $detach = $config;
					if(isset($data['cusTom'])){
						if(is_file(SERVER."/views/".$detach.$data['cusTom'].".php")){
							require_once(SERVER."/views/".$detach.$data['cusTom'].".php");
						}else{
							require_once(SERVER."/404.php");		
						}
					}else{
						require_once(SERVER."/404.php");	
					}
					
				
				}
				exit;

			}
		}else{
			
			// set default target
			if(is_file(SERVER."/views/".$config."index.php")){			 	    		
	    		ob_start();
	            require_once(SERVER."/views/".$config."index.php");
	            $out = ob_get_clean();
	            echo $out;	
	    		exit;
			}else{
				echo "WELCOME TO OUR FRAME WORK";	
				}
			
			}
	}

    // get offset uri
    function splice($num = null){
    	
    	// get uri
     	$root = explode("/",$_SERVER['DOCUMENT_ROOT']);
    	$root = $root[count($root)-1];
    	$root = explode($root,SERVER);
    	$root = $root[1];
    	$home_dir = $root;

    	// chek offset as integer
    	if(!empty( (int) $num)){

    	  // cheking if available top point
		  if(strpos($_SERVER['REQUEST_URI'],"'")){
		 	 require_once(SERVER."/404.php");
		  	 exit;

		  }else{

		 	 // call offset uri
		  	 $splice = str_replace($home_dir,null,$_SERVER['REQUEST_URI']);
		  	 $splice = explode("?",$splice);
		  	 $splice = $splice[0];
		 	 $data = explode("/",$splice);
		 	 
		 	 // call offset uri
		 	 if($num !== null){
		 		return @$data[$num];
		 	 }else{
		  		return @$data;
			 }
		  }
		}else{

			// default call offset
			return str_replace($home_dir,null,$_SERVER['REQUEST_URI']);
		}
	}

	// get url document active
	function documentUrl(){
		
		if(@$_SERVER['HTTPS'] == true) $protocol = "https://" ; else $protocol = "http://";
		return $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	}

	// get home url
	function homeUrl(){
		
		if(@$_SERVER['HTTPS'] == true) $protocol = "https://" ; else $protocol = "http://";
		
		
     	$root = explode("/",$_SERVER['DOCUMENT_ROOT']);
    	$root = $root[count($root)-1];
    	$root = explode($root,SERVER);
    	$root = $root[1];
    	$home_dir = $root;

    	return $protocol.$_SERVER['HTTP_HOST'].$home_dir;	
	}
}