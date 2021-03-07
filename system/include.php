<?php

namespace icluding;

class manage{

	

	// checking mobile device
	function is_mobile($mobile = null,$desktop = null){
		$mystring = @$_SERVER['HTTP_USER_AGENT'];
		$findme   = 'Android';
		$pos = strpos(strtolower($mystring), strtolower($findme));
		$ismobile = false;
		if ($pos !== false) {
		$ismobile = true;
		} else {
		}
		$findme   = 'iPhone';
		$pos = strpos(strtolower($mystring), strtolower($findme));
		if ($pos !== false) {
		  $ismobile = true;
		}
		$findme   = 'Mobile Safari';
		$pos = strpos(strtolower($mystring), strtolower($findme));
		if ($pos !== false) {
		  $ismobile = true;
		}

		$findme   = 'Blackberry';
		$pos = strpos(strtolower($mystring), strtolower($findme));
		if ($pos !== false) {
		  $ismobile = true;
		}

		$findme   = 'MeeGo';
		$pos = strpos(strtolower($mystring), strtolower($findme));
		if ($pos !== false) {
		  $ismobile = true;
		}

		if(!isset($_SESSION['device'])){
		if ($ismobile == true)
		{
		   if(!empty($mobile)){
		   		return $mobile;
		   }else{
		   		return true;
		   }
		}
		else
		{
			if(!empty($desktop)){
		   		return $desktop;
		   }else{
		   		return false;
		   }	
		}
		}else{
		if(@$_SESSION['device'] == "mobile") {
			if(!empty($mobile)){
		   		return $mobile;
		   }else{
		   		return true;
		   }
		}else{
			if(!empty($desktop)){
		   		return $desktop;
		   }else{
		   		return false;
		   }	
		}
		}
	}

	// define home url
	function homeUrl(){
		
		if(@$_SERVER['HTTPS'] == true) $protocol = "https://" ; else $protocol = "http://";
			
			
	     $root = explode("/",$_SERVER['DOCUMENT_ROOT']);
	    $root = $root[count($root)-1];
	    $root = explode($root,SERVER);
	    $root = $root[1];
	    $home_dir = $root;

	    return $protocol.$_SERVER['HTTP_HOST'].$home_dir;	
	}

	// cal js file
	function callJS($data){

		if(is_array($data)){
			foreach($data as $key => $val){
				if(strpos($val,".js")){
					$join[] = "<script src=\"".$this->homeUrl()."/views/".$val."\"></script>\r";
				}
			}
				return implode("",$join);
		}else{
			if(strpos($val,".js")){
				return "<script src=\"".$this->homeUrl()."/views/".$val."\"></script>\r";
			}
		}
	}

	// call css file
	function callCSS($data){
		
		if(is_array($data)){
			foreach($data as $key => $val){
				if(strpos($val,".css")){
					$join[] = "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$this->homeUrl()."/views/".$val."\" />\r";
				}
			}
				return implode("",$join);
		}else{
			if(strpos($val,".css")){
				return "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$this->homeUrl()."/views/".$val."\" />\r";
			}
		}
	}

	// count time history
	function timeHistory($timestamp){
            
        $timestamp      = (int) $timestamp;
        $current_time   = time();
        $diff           = $current_time - $timestamp;
        $intervals      = array (
            'tahun' => 31556926, 'bulan' => 2629744, 'minggu' => 604800, 'hari' => 86400, 'jam' => 3600, 'menit'=> 60
        );
        if ($diff == 0)
        {
            return 'Baru Saja';
        }   
        if ($diff < 60)
        {
            return $diff == 1 ? $diff . ' De' : $diff . ' Detik Lalu';
        }       
        if ($diff >= 60 && $diff < $intervals['jam'])
        {
            $diff = floor($diff/$intervals['menit']);
            return $diff == 1 ? $diff . ' Menit Lalu' : $diff . ' Menit Lalu';
        }       
        if ($diff >= $intervals['jam'] && $diff < $intervals['hari'])
        {
            $diff = floor($diff/$intervals['jam']);
            return $diff == 1 ? $diff . ' Jam Lalu' : $diff . ' Jam Lalu ';
        }   
        if ($diff >= $intervals['hari'] && $diff < $intervals['minggu'])
        {
            $diff = floor($diff/$intervals['hari']);
            return $diff == 1 ? $diff . ' Hari Lalu' : $diff . ' Hari Lalu';
        }   
        if ($diff >= $intervals['minggu'] && $diff < $intervals['bulan'])
        {
            $diff = floor($diff/$intervals['minggu']);
            return $diff == 1 ? $diff . ' Minggu Lalu' : $diff . ' Minggu Lalu';
        }   
        if ($diff >= $intervals['bulan'] && $diff < $intervals['tahun'])
        {
            $diff = floor($diff/$intervals['bulan']);
            return $diff == 1 ? $diff . ' Bulan Lalu' : $diff . ' Bulan Lalu';
        }   
        if ($diff >= $intervals['tahun'])
        {
            $diff = floor($diff/$intervals['tahun']);
            return $diff == 1 ? $diff . ' Tahun Lalu' : $diff . ' Tahun Lalu';
        }
        }

    // bad word list
    function badword_list(){
		return array(
			"anjing",
			"babi",
			"ngentot",
			"ngewe",
			"bangsat",
			"kontol",
			);
	}

	// alphabet
	function Alphabet(){
		return array(
			"a" => array("@","4"),
			"b" => array("8","13"),
			"c" => array("©"),
			"d" => array("d"),
			"e" => array("3"),
			"f" => array("f"),
			"g" => array("9"),
			"h" => array("h"),
			"i" => array("1"),
			"j" => array("7"),
			"k" => array("k"),
			"l" => array("l"),
			"m" => array("m"),
			"n" => array("n"),
			"o" => array("0"),
			"p" => array("p"),
			"q" => array("q"),
			"r" => array("r"),
			"s" => array("5"),
			"t" => array("t"),
			"u" => array("u"),
			"v" => array("v"),
			"w" => array("vv"),
			"x" => array("x"),
			"y" => array("y"),
			"z" => array("z"),
		);
	}

	// limit word to visible
	function wordLimit($text="",$num=""){
		$text = explode(" ",$text);
		foreach ($text as $key => $value):
			if(($key + 1) <= $num):
				$result[] = $value;
				$counts[] = 1;
			endif;
		endforeach;
		if((array_sum($counts)) == ($num)):
		$result = implode(" ",$result)." ...";
		else:
		$result = implode(" ",$result);
		endif;
		return $result;
	}

	// filter word
	function optimize_word($text = null){
		// mengoptimasi agar tiap karakter menjadi lebih efisien
		if(!empty($text)):
			$insert = null;
			$_SESSION['tmp_text'] = $text;
				foreach (Alphabet() as $key => $value) :
					for($i = 1; $i <= count($value); $i++):
						$alpha[] = $key;
					endfor;
					$regex = str_replace($value,$alpha, $_SESSION['tmp_text']);
					$alpha = null;
					$_SESSION['tmp_text'] = $regex;
				endforeach;
			$static = null;
			for($a = 1; $a <= 10; $a++):
				foreach(Alphabet() as $key => $value):
					for($i = strlen($_SESSION['tmp_text']); $i >0; $i--):
						$static .= $key;
						$optimize = str_replace($static, $key, $_SESSION['tmp_text']);
						$_SESSION['tmp_text'] = $optimize;
					endfor;
					$static = null;
				endforeach;
			endfor;
			return $_SESSION['tmp_text'];
		endif;
	}
	function bad_word_filter($text = null){
		// menyeleksi keberadaan kata kasar
		if(!empty($text)):
			$split = explode(" ",strtolower($text));
			foreach ($split as $key => $value):
				$preg = preg_replace('([!@#$%^&*()_+=-`~[]{}\|;:",<.>/?])', "", $value);
				$word = optimize_word($preg);
				if(in_array($word,badword_list())):
					$replace = "<button style='padding:5px;background-color:#ff0000;color:#fff;border:1px #ff0000 solid;border-radius:10px;' > $word </button> ";
					$last_filter[] = $replace;
				else:
					$last_filter[] = $word;
				endif;
			endforeach;
		$join_word = implode(" ",$last_filter);
		return $join_word;
		endif;
	}

	// facebook bot share
	function fb_bot_share($data){
		define('FACEBOOK_SDK_V4_SRC_DIR', SERVER.'/library/');
		require_once(SERVER.'/library/autoload.php');
			$fb = new Facebook\Facebook([
		 		'app_id' => $data['app_id'],
		 		'app_secret' => $data['secret_key'],
		 		'default_graph_version' => $data['version'],
			]);

			$linkData = [ 'link' => $data['link'],'message' => ['msg']];
			$pageAccessToken = $data['token'];
			try {
		 	$response = $fb->post('/me/feed', $linkData, $pageAccessToken);
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
		 	echo 'Graph returned an error: '.$e->getMessage();
		 	exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
		 	echo 'Facebook SDK returned an error: '.$e->getMessage();
		 	exit;
			}
			$graphNode = $response->getGraphNode();
	}

}



// resize image on url bar
class magicImage{

	var $allowableTypes = array(IMAGETYPE_GIF,IMAGETYPE_JPEG,IMAGETYPE_PNG);

    public function imageCreateFromFile($filename, $imageType) {
		  switch($imageType) {
			  case IMAGETYPE_GIF  : return imagecreatefromgif($filename);
			  case IMAGETYPE_JPEG : return imagecreatefromjpeg($filename);
			  case IMAGETYPE_PNG  : return imagecreatefrompng($filename);
			  default   : return false;
	  	}
    }

  public function generate($sourceFilename, $maxWidth, $maxHeight, $targetFormatOrFilename = 'jpg') {

	  $size = getimagesize($sourceFilename);

	  if(!in_array($size[2], $this->allowableTypes)) {
	 	 return false;
	  }

	  $pathinfo = pathinfo($targetFormatOrFilename);
	 
	  if($pathinfo['basename'] == $pathinfo['filename']) {

	 		$extension = strtolower($targetFormatOrFilename);
	  
	  		$targetFormatOrFilename = null;
	  }

	  else {
	  		
	  		$extension = strtolower($pathinfo['extension']);

	  }

	  switch($extension) {

		  case 'gif' : $function = 'imagegif'; break;
		  case 'png' : $function = 'imagepng'; break;
		  default    : $function = 'imagejpeg'; break;

	  }

	 
	  $source = $this->imageCreateFromFile($sourceFilename, $size[2]);
	
	  if(!$source) {
		  return false;
	  }

	  if($targetFormatOrFilename == null) {
	  if($extension == 'jpg') {
	            header("Content-Type: image/jpeg");
	            }
	            else {
	            header("Content-Type: image/$extension");
	            }
	        }

	        if($size[0] <= $maxWidth && $size[1] <= $maxHeight) {
	            $function($source, $targetFormatOrFilename);
	        }
	        else {

	            $ratioWidth = $maxWidth / $size[0];
	            $ratioHeight = $maxHeight / $size[1];

	            if($ratioWidth < $ratioHeight) {
	                $newWidth = $maxWidth;
	                $newHeight = round($size[1] * $ratioWidth);
	            }
	            else {
	                $newWidth = round($size[0] * $ratioHeight);
	                $newHeight = $maxHeight;
	            }

	            $target = imagecreatetruecolor($newWidth, $newHeight);

	            $color = imagecolorallocate($target, 255, 255, 255);

	          // fill entire image
	            $targets = imagefill($target, 0, 0, $color);
	            imagecopyresampled($target, $source, 0, 0, 0, 0, $newWidth, $newHeight, $size[0], $size[1]);
	            $function($target, $targetFormatOrFilename);
	        }
	        return true;
    }

    function homeUrl(){
		
		if(@$_SERVER['HTTPS'] == true) $protocol = "https://" ; else $protocol = "http://";
			
			
	     $root = explode("/",$_SERVER['DOCUMENT_ROOT']);
	    $root = $root[count($root)-1];
	    $root = explode($root,SERVER);
	    $root = $root[1];
	    $home_dir = $root;

	    return $protocol.$_SERVER['HTTP_HOST'].$home_dir;	
	}


	// generate url image
    function generateIMG($url = null,$width = null,$height = null){

    	if(!empty($url)){
	    	if(empty($width) and empty($height)){
		    	list($width, $height, $type, $attr) = getimagesize($url);
				return $this->homeUrl()."/image/".base64_encode($url)."/".$width."/".$height."/".$type;
			}else{
				list($widths, $heights, $type, $attr) = getimagesize($url);
				return $this->homeUrl()."/image/".base64_encode($url)."/".$width."/".$heights."/".$type;
			}
		}
    }
}