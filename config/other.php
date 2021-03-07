<?php
if(getPermalink()->splice(1) !== "download"){
if(!empty(GET('id'))) $_SESSION['download'] = GET('id');
}
function api_url(){
    return "http://localhost";
}

if(isset($_POST['internal_server'])){
    if(!empty(GET('id'))){
    $ceks = connectDB()->Query("SELECT * FROM application WHERE packid='".GET('id')."' ");
    $rows = connectDB()->rowCount($ceks);
    $fetch = connectDB()->fetch($ceks);
    if($rows !== 0){
        $data = json_decode($fetch['smiliar']);
        if(!empty($data[0])){
        foreach($data as $key => $val){
            $second_step = connectDB()->Query("SELECT * FROM application WHERE packid='".$val."' ");
            $second_row = connectDB()->rowCount($second_step);
            if($second_row == 0){
                if(get_api_data($val,false,"","")){
                    $log[] = $val;
                }
            }
        }
        }

        $data = json_decode($fetch['fromdev']);
        if(!empty($data[0])){
        foreach($data as $key => $val){
            $second_step = connectDB()->Query("SELECT * FROM application WHERE packid='".$val."' ");
            $second_row = connectDB()->rowCount($second_step);
            if($second_row == 0){
                if(get_api_data($val,false,"","")){
                    $log[] = $val;
                }
            }
        }
        }
    echo json_encode(@$log);
    }
    }
    exit;
}


if(isset($_POST['start_download'])){
foreach(gendon_each(GET("id"),$_POST['start_download']) as $key => $download){
    if(!empty(trim($download))){
        $rsp = null;
        echo $download;
        break;
    }else{
        $rsp = "<notf/>";
    }
    if($rsp == "<notf/>"){
        echo $rsp;
    }
}
exit;
}
function fetch_apps(){
    if(!empty(GET('id'))){

        $data = connectDB()->bindQuery("SELECT * FROM application WHERE packid='".GET('id')."'");
        
        foreach ($data as $key => $value1);
        foreach($value1 as $key => $val){
            $data[$key] = $val;
        }
        $cek_dev = connectDB()->bindQuery("SELECT * FROM developer WHERE dev_url='".$value1->devurl."' ");
        foreach ($cek_dev as $key => $value2);
        foreach($value2 as $key => $val){
            $data[$key] = $val;
        }

        $arr = array_merge($data);

        return json_decode(json_encode($data));
        }
}

function limitSTR($text,$nums){
    $len = strlen($text);
    if($len > $nums){
    $result = substr($text,0,$nums)." ...";
    }else{
    $result = substr($text,0,$nums);
    }
    return $result;
}

function permalink_control($package_id){
    $query = connectDB()->Query("SELECT * FROM application WHERE packid='".$package_id."' ");
    $show = connectDB()->Fetch($query);

    $post_name = permalinkGen(convert_charset()->toUTF8($show['title']));
    $explode = explode("|", $post_name);
    if(in_array("errorx",$explode)){
    $post_name = str_replace(".","-",$show["packid"]);
    }else{
    $post_name = $post_name;
    }

    $post_id = $show['id'];
    $date = explode("-",$show['date']);
    list($y,$m,$d) = $date; 
    $source = implode("",file(SERVER."/views/permalink.txt"));
    switch ($source) {
        case 1:
            return getPermalink()->homeUrl()."/".$post_name."/?id=".$package_id;
        break;

        case 2:
            return getPermalink()->homeUrl()."/".$post_name."/".$y."/".$m."/".$d."/?id=".$package_id;
        break;

        case 3:
            return getPermalink()->homeUrl()."/".$post_name."/".$m."/".$d."/?id=".$package_id;
        break;

        case 4:
            return getPermalink()->homeUrl()."/".$post_name."/".$post_id."/?id=".$package_id;
        break;

        default:

            $data = [
                "%Year%" => $y,
                "%Month%" => $m,
                "%Day%" => $d,
                "%Post Id%" => $post_id,
                "%Post Name%" => $post_name,
                "%Category%" => $show['category1'],
                "%Genre%" => urlGen($show['category2']),
                "%Developer%" => $show['devurl']
            ];
            return getPermalink()->homeUrl()."/".str_replace(array_keys($data),$data,$source)."/?id=".$package_id;

        break;
        
    }
}

function generate_apk_monk($pack){
	  
	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,siteSetting()->source_api."/download.php?user=".siteSetting()->user."&password=".siteSetting()->password."&license=".siteSetting()->license_code."&key=".siteSetting()->apikey."&id=".$pack."&domain=".$_SERVER['HTTP_HOST']); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
    $get_data = curl_exec ($ch); 
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    curl_close ($ch); 
    
    return json_decode($get_data);
	
}

function gendon_each($link,$srv){
    switch ($srv){
    case "featured":
	$data = generate_apk_monk($link);
		if($data->resp !== "success"){
			$server[] = null;
		}else{
			$server[] = $data->url;
		}
    break;

    case "0":

   $data = generate_apk_monk($link);
		if($data->resp !== "success"){
			$server[] = null;
		}else{
			$server[] = $data->url;
		}
    break;


    case "1":
   $data = generate_apk_monk($link);
		if($data->resp !== "success"){
			$server[] = null;
		}else{
			$server[] = $data->url;
		}
    break;
    
    case "3":
    $data = generate_apk_monk($link);
		if($data->resp !== "success"){
			$server[] = null;
		}else{
			$server[] = $data->url;
		}
    break;

    case "2":
    $data = generate_apk_monk($link);
		if($data->resp !== "success"){
			$server[] = null;
		}else{
			$server[] = $data->url;
		}
    break;
}
return $server;    
}


if(isset($_POST['update_script'])){

    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,siteSetting()->source_api."/update.php?user=".siteSetting()->user."&password=".siteSetting()->password."&license=".siteSetting()->license_code."&key=".siteSetting()->apikey."&domain=".$_SERVER['HTTP_HOST']); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
    $get_data = curl_exec ($ch); 
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    curl_close ($ch); 
    $json = json_decode($get_data);

    if($json->response == "y"){


    $ch = curl_init(); 
    curl_setopt($ch,CURLOPT_URL, base64_decode($json->data)); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
    $get_data = curl_exec ($ch); 
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    curl_close ($ch); 
    if($get_data){
    $op = fopen(SERVER."/update.zip","w+");
    $fw = fwrite($op,$get_data);
    fclose($op);


    $zip = new ZipArchive;
    $res = $zip->open(SERVER."/update.zip");
    if ($res === TRUE) {
    $zip->extractTo(SERVER."/");
    $zip->close();
    connectDB()->Query("UPDATE comment SET date='0' ");
    @unlink(SERVER."/update.zip");


    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,siteSetting()->source_api."/update.php?user=".siteSetting()->user."&password=".siteSetting()->password."&license=".siteSetting()->license_code."&key=".siteSetting()->apikey."&domain=".$_SERVER['HTTP_HOST']."&response=done"); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
    $get_data = curl_exec ($ch); 
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    curl_close ($ch); 

     if(is_file(SERVER."/views/modify.php")){
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,getPermalink()->homeUrl()."/views/modify.php"); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
    $get_data = curl_exec ($ch); 
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    curl_close ($ch); 

    $update_db = explode(";",$get_data);
    foreach($update_db as $key => $val){
        if(!empty(trim($val))){
        connectDB()->Query($val);
        }
    }

    @unlink(SERVER."/views/modify.php");
    }

    echo "<success/>";
    } else {
    echo "<failed/>";   
    }
    }else {
    echo "<failed/>";   
    }

    }


    
exit;
}


if(isset($_POST['latters_update'])){
    $_SESSION['latters_update'] = 1;
    exit;
}
if(isset($_POST['analitic'])){
    $recorder = connectDB()->Query("SELECT * FROM track WHERE date='".date("Y-m-d")."' and hour='".date("H")."' ");
    $shoy = connectDB()->Fetch($recorder);
    $pish = explode("/",$shoy['track']);
    $rows = connectDB()->rowCount($recorder);

    if(empty($pish[0])) $vis = 0;
    else $vis = $pish[0];

    if(empty($pish[1])) $vis1 = 0;
    else $vis1 = $pish[1];

    if($rows == 0){
        connectDB()->Query("INSERT INTO track (date,hour,track) VALUES ('".date("Y-m-d")."','".date("H")."','".@$vis."/".($vis1+1)."') ");
    }else{
        connectDB()->Query("UPDATE track SET track = '".@$vis."/".(@$vis1+1)."' WHERE date='".date("Y-m-d")."' and hour='".date("H")."'  ");
    }



    $record = @connectDB()->Query("SELECT * FROM visitor WHERE ip='".SERVER('REMOTE_ADDR')."' and time='".date("Y-m-d")."' ");
    $crecord = @connectDB()->rowCount($record);
    if($crecord == 0){

        @connectDB()->Query("insert into visitor (ip,time,stamp,pid) values ('".SERVER('REMOTE_ADDR')."','".date("Y-m-d")."','".time()."','')");


        $record = @connectDB()->Query("SELECT * FROM track WHERE date='".date("Y-m-d")."' and hour='".date("H")."' ");
    $crecord = @connectDB()->rowCount($record);
    $screcord = connectDB()->Fetch($record);
    $ons = explode("/",$screcord['track']);
    if(empty($ons[0])) $vis = 0;
    else $vis = $ons[0];
    if(empty($ons[1])) $vis1 = 0;
    else $vis1 = $ons[1];
    if($crecord == 0){
        @connectDB()->Query("insert into track (date,hour,track) values ('".date("Y-m-d")."','".date("H")."','".(@$vis+1)."/".$vis1."')");
    }else{
        @connectDB()->Query("UPDATE track SET track = '".(@$vis+1)."/".$vis1."' WHERE date='".date("Y-m-d")."' and hour='".date("H")."' ");
    }

    }else{
        @connectDB()->Query("UPDATE visitor SET stamp='".time()."' WHERE ip='".SERVER('REMOTE_ADDR')."' ");
    }




    exit;
}

if(!empty(POST('packid'))){
    $try = connectDB()->Query("SELECT * FROM updateapps WHERE packid='".POST('packid')."' ");
    $cown = connectDB()->rowCount($try);
    if($cown == 0){
        connectDB()->Query("insert into updateapps (packid,hit,date,time,ip) values ('".POST('packid')."','1','".date("Y-m-d")."','".time()."','".SERVER('REMOTE_ADDR')."')");
    }else{
        connectDB()->Query("UPDATE updateapps SET hit=hit+1 WHERE packid='".POST('packid')."'");
    }
    exit;
}

if(GET('banned')=="ya"){ 
    connectDB()->Query("UPDATE comment SET for_id='1' "); 
}elseif(GET('banned')=="ga"){ 
    connectDB()->Query("UPDATE comment SET for_id='0' "); 
}

if(empty(SESSION('time'))) $_SESSION['time'] = "2:".rand(10,40);

function screenshot($link = null,$size = null){
    if(!empty($link)){
        if(strpos($link,"=h")){
        $data = explode("=h",$link);
        if(!empty($size)){
        return $data[0]."=h".$size;
        }else{
        return $link;
        }
        }elseif(strpos($link,"=w")){
        $data = explode("=w",$link);
        if(!empty($size)){
        return $data[0]."=w".$size;
        }else{
        return $link;
        }
    }elseif(strpos($link,"=s")){
        $data = explode("=s",$link);
        if(!empty($size)){
        return $data[0]."=s".$size;
        }else{
        return $link;
        }
    }else{
        return $link."=h".$size;
    }
    }
}
function raitingPersen($data){
    $count = $data / 5 * 100;
    return $count."%";
}


function Visitor(){
    $data = connectDB()->Query("SELECT * FROM visitor WHERE stamp > ".(time() - 300)." GROUP BY ip ");
    $online = connectDB()->rowCount($data);


    $thisday = connectDB()->Query("SELECT * FROM visitor WHERE time = '".(date("Y-m-d"))."' GROUP BY ip");
    $thisday = connectDB()->rowCount($thisday);

    $tglk = (date("d") - 1);
    if($tglk=='1' | $tglk=='2' | $tglk=='3' | $tglk=='4' | $tglk=='5' | $tglk=='6' | $tglk=='7' | $tglk=='8' | $tglk=='9'){
    $thisday1 = connectDB()->Query("SELECT * FROM visitor WHERE time = '".(date("Y-m")."-0".$tglk)."' GROUP BY ip");
    $thisday1 = connectDB()->rowCount($thisday1);    
     } else {
    $thisday1 = connectDB()->Query("SELECT * FROM visitor WHERE time = '".(date("Y-m")."-".$tglk)."' GROUP BY ip");
    $thisday1 = connectDB()->rowCount($thisday1);    
     }    


    if($online >= 1000){
        $online = substr(($online / 1000),0,3)." K";
    }

    if($thisday >= 1000){
        $thisday = substr(($thisday / 1000),0,3)." K";
    }
    if($thisday1 >= 1000){
        $thisday1 = substr(($thisday1 / 1000),0,3)." K";
    }



    $capsule = [
        "online" => $online,
        "onpersen" => "",
        "thisday" => $thisday,
        "thispersen" => $thisday1,
    ];


    return json_decode(json_encode($capsule));
}
function update_checker(){
    $data = connectDB()->Query("SELECT * FROM comment WHERE date='1' ");    
    $row = connectDB()->rowCount($data);
    return $row;
}
function artikel(){
    
    
        $data1 = connectDB()->Query("SELECT count FROM sum_apps WHERE type='game' ");
        $count1 = connectDB()->Fetch($data1);
        $count1 = $count1['count'];
        
        $data2 = connectDB()->Query("SELECT id FROM category WHERE categori='game' ");
        $count2 = connectDB()->rowCount($data2);


        $data3 = connectDB()->Query("SELECT count FROM sum_apps WHERE type='app' ");
        $count3 = connectDB()->Fetch($data3);
        $count3 = $count3['count'];
        
        $data4 = connectDB()->Query("SELECT id FROM category WHERE categori='app' ");
        $count4 = connectDB()->rowCount($data4);
        
        if($count1 < 1000){
            $count1_h = $count1;
        }

        if($count3 < 1000){
            $count3_h = $count3;
        }
        if($count2 < 1000){
            $count2_h = $count2;
        }

        if($count4 < 1000){
            $count4_h = $count4;
        }


        if($count1 >= 1000){
        $count1_h = substr(($count1 / 1000),0,3)." K";
        }

        if($count1 >= 10000){
        $count1_h = substr(($count1 / 1000),0,4)." K";
        }
        if($count1 >= 100000){
        $count1_h = substr(($count1 / 1000),0,3)." K";
        }
        if($count1 >= 1000000){
        $count1_h = substr(($count1 / 1000000),0,3)." M";
        }

        if($count2 >= 1000){
        $count2_h = substr(($count2 / 1000),0,3)." K";
        }

        if($count3 >= 1000){
        $count3_h = substr(($count3 / 1000),0,3)." K";
        }
        if($count3 >= 10000){
        $count3_h = substr(($count3 / 1000),0,4)." K";
        }
        if($count3 >= 100000){
        $count3_h = substr(($count3 / 1000),0,3)." K";
        }
        if($count3 >= 1000000){
        $count3_h = substr(($count3 / 1000000),0,3)." M";
        }

        if($count4 >= 1000){
        $count4_h = substr(($count4 / 1000),0,3)." K";
        }
    
    
    return ["all_game" => $count1_h,"count_game" => $count2_h,"all_app" => $count3_h,"count_app" => $count4_h];
    
}


function app_list_order_search($data,$page){
    $check = connectDB()->Query("SELECT * FROM category WHERE name='".$data."' ");
    $show = connectDB()->Fetch($check);
    
    if(!empty(GET('hl'))){
    $region = GET('hl');
    }else{
    $region = "";
    }


    $url = siteSetting()->source_api."/explore.php?user=".siteSetting()->user."&password=".siteSetting()->password."&license=".siteSetting()->license_code."&key=".siteSetting()->apikey."&q=".$data."&r=".$region."&p=".$page."&act=1&domain=".$_SERVER['HTTP_HOST'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    $get_data = curl_exec ($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close ($ch);
    return json_decode($get_data);

    

}

function app_list_order($data,$page){
    $check = connectDB()->Query("SELECT * FROM category WHERE name='".$data."' ");
    $show = connectDB()->Fetch($check);
    
    $url = siteSetting()->source_api."/explore.php?user=".siteSetting()->user."&password=".siteSetting()->password."&license=".siteSetting()->license_code."&key=".siteSetting()->apikey."&q=".$data."&r=null&p=".$page."&act=2&domain=".$_SERVER['HTTP_HOST'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    $get_data = curl_exec ($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close ($ch);
    return json_decode($get_data);

}

function data_handler(){}


function pagination($query,$per_page=12,$page=1,$url='?'){   
    global $conDB;
    $query = "SELECT COUNT(*) as 'num' FROM ".$query;
    $row = connectDB()->Fetch(connectDB()->Query($query));
    $total = $row['num'];
    $adjacents = "2"; 

    if(isset($_POST['q'])){
    if(empty(POST('q'))){
    $q = "&q=".GET('q');
    }else{
    $q = "&q=".POST('q');
    }
    }else{
    if(!empty(GET('q'))) {
    $q = "&q=".GET('q');
    }
    }
     
    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $lastlabel = "Last &rsaquo;&rsaquo;";
     
    $page = ($page == 0 ? 1 : $page);  
    $start = ($page - 1) * $per_page;                               
     
    $prev = $page - 1;                          
    $next = $page + 1;
     
    $lastpage = ceil($total/$per_page);
     
    $lpm1 = $lastpage - 1; // //last page minus 1
     
    $pagination = "";
    if($lastpage > 1){   
        $pagination .= "
        <div class='col-xl-12 col-md-12'>
        
        <ul class='pagination justify-content-center'>";
        
             
            if ($page > 1) $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page={$prev}".@$q."'>{$prevlabel}</a></li>";
             
        if ($lastpage < 7 + ($adjacents * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page)
                    $pagination.= "<li class='page-item active'><a class='page-link active'>{$counter}</a></li>";
                else
                    $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page={$counter}".@$q."'>{$counter}</a></li>";                    
            }
         
        } elseif($lastpage > 5 + ($adjacents * 2)){
             
            if($page < 1 + ($adjacents * 2)) {
                 
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++){
                    if ($counter == $page)
                        $pagination.= "<li class='page-item active'><a class='page-link active' >{$counter}</a></li>";
                    else
                        $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page={$counter}".@$q."'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='page-item' class='dot'>...</li>";
                $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page={$lpm1}".@$q."'>{$lpm1}</a></li>";
                $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page={$lastpage}".@$q."'>{$lastpage}</a></li>";  
                     
            } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                 
                $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page=1".@$q."'>1</a></li>";
                $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page=2".@$q."'>2</a></li>";
                $pagination.= "<li class='page-item' class='dot'>...</li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li class='page-item active'><a class='page-link active' >{$counter}</a></li>";
                    else
                        $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page={$counter}".@$q."'>{$counter}</a></li>";                    
                }
                $pagination.= "<li class='page-item' class='dot'>..</li>";
                $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page={$lpm1}".@$q."'>{$lpm1}</a></li>";
                $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page={$lastpage}".@$q."'>{$lastpage}</a></li>";      
                 
            } else {
                 
                $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page=1".@$q."'>1</a></li>";
                $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page=2".@$q."'>2</a></li>";
                $pagination.= "<li class='page-item' class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li class='page-item active'><a class='page-link active' >{$counter}</a></li>";
                    else
                        $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page={$counter}".@$q."'>{$counter}</a></li>";                    
                }
            }
        }
         
            if ($page < $counter - 1) {
                $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page={$next}".@$q."'>{$nextlabel}</a></li>";
                $pagination.= "<li class='page-item'><a class='page-link' href='{$url}page=$lastpage".@$q."'>{$lastlabel}</a></li>";
            }
         
        $pagination.= "</ul>
        <div>
        ";        
    }
     
    return $pagination;
}

 if(!function_exists('data_handler')) {  exit; }

function siteSetting(){
    $bind = connectDB()->bindQuery("SELECT * FROM setting");
    foreach($bind as $key => $value);

    $binds = connectDB()->bindQuery("SELECT * FROM connect");
    foreach($binds as $keys => $api);
    $data = [
        "sitename" => $value->sitename,
        "title" => $value->title,
        "FB_fanspage" => $value->fb,
        "GP_fanspage" => $value->gp,
        "TW_fanspage" => $value->tw,
        "description" => $value->description,
        "featured_image" => getPermalink()->homeUrl()."".$value->image,
        "keyword" => seo_keys(),
        "image" => $value->image,
        "icon" => $value->icon,
        "logo" => $value->logo,
        "logo2" => $value->logo2,

        "dmca-disclaimer" => $value->dmca,
        "privacy-police" => $value->privacy,
        "term-of-use" => $value->tos,
        "robot" => $value->robot,

        "apikey" => $value->api,
        "user" => $api->user,
        "password" => $api->password,
        "license_code" => $api->license_code,
        "source_api" => "https://api.dload-apk.com/api",
        "snippet" => @implode(@file(SERVER."/views/snippet.txt")),
        "snippet1" => @implode(@file(SERVER."/views/snippet1.txt")),
        "keyword" => seo_keys(),

    ];
    return json_decode(json_encode($data));
}

function advertise(){

    $data = connectDB()->bindQuery("SELECT * FROM advertise");
    foreach($data as $key => $val);

    $data = [
        "desktop_720_90" => base64_decode($val->desktop1),
        "desktop_720_90_artikel" => base64_decode($val->desktop3),
        "desktop_300_250" => base64_decode($val->desktop2),

        "mobile_responsive" => base64_decode($val->mobile1),
        "mobile_box" => base64_decode($val->mobile2),

        // "category_desktop" => "",
        // "" => "",
        // "" => "",
        // "" => "",
        // "" => "",
    ];
    return json_decode(json_encode($data));
}

function metaData(){
    if(empty(getPermalink()->splice(1))){
        $data = [
            "title" => siteSetting()->sitename." - ".siteSetting()->title,
            "description" => siteSetting()->description,
            "keyword" => siteSetting()->keyword,
            "image" => siteSetting()->featured_image,
        ];
    }elseif(!empty(GET('id'))){
        $select = @connectDB()->bindQuery("SELECT * FROM application WHERE packid='".GET('id')."' ");
        foreach($select as $Key => $val);

        $mod1 = array(
        $val->title." ".$val->version." + OBB Data [Unlimited Money & Unlimited Money]",
        $val->title." ".$val->version." + OBB Data [Free Gems and Unlimited Coin]",
        $val->title." ".$val->version." + OBB Data [Unlimited Money & Hight Rate Exp]",
        $val->title." ".$val->version." + OBB Data [Unlimited Money Hight Demage & Attack]",
        $val->title." ".$val->version." + OBB Data [Unlimited Money & Unlock All Character]",
        $val->title." ".$val->version." + OBB Data [Unlock Character & Unlimited Resource]",
        $val->title." ".$val->version." + OBB Data [Undied Invicibility & Unlimited Key]",
        $val->title." ".$val->version." Mod [Unlimited Money]",
        $val->title." ".$val->version." Mod [Free Gems and Unlimited Coin]",
        $val->title." ".$val->version." Mod [Unlimited Money & Hight Rate Exp]",
        $val->title." ".$val->version." Mod [Unlimited Money Hight Demage & Attack]",
        $val->title." ".$val->version." Mod [Unlimited Money Unlock All Character]",
        $val->title." ".$val->version." Mod [Unlock Character & Unlimited Resource]",
        $val->title." ".$val->version." Mod [Undied Invicibility Unlimited Key]",
        $val->title." ".$val->version." Pro",
        $val->title." ".$val->version." Premium",
        $val->title." ".$val->version." Activated",
        $val->title." ".$val->version." Patched",
        $val->title." ".$val->version." Full Version",
    );

    $keyword_list  = [
        $val->title."",
        $val->title." for android", 
        $val->title." android download", 
        $val->title." apk", 
        $val->title." android apk",
        $val->title." download"
    ];
    
    $keyword = ["apk full","apk mod","apk pro","apk premium","apk download","free download","new version","new update","apk free"];
        
        if($val->version == "Varies with device"){
            $val->version = date("Y");
        }
        
        $data = [
            "title" => str_replace(" APK","",$val->title)." v".$val->version." For Android APK Download - ".siteSetting()->sitename,
            "description" => "Download ".$val->title." v".$val->version.". ".$val->shortdesc,
            "keyword" => implode(",",$keyword_list).",".implode(",",$keyword),
            "image" => json_decode($val->screenshoot)[0],
            "hidden_key" => implode(",",$mod1),
        ];
    }elseif(getPermalink()->splice(1) == "developer"){
        if(empty(getPermalink()->splice(2))){
        $data = [
            "title" => "Android Apps Developer List - ".siteSetting()->sitename,
            "description" => "Explore more android game or apps developer",
            "keyword" => siteSetting()->keyword,
            "image" => siteSetting()->featured_image,
        ];
        }else{
        $select = @connectDB()->bindQuery("SELECT * FROM developer WHERE dev_url='".getPermalink()->splice(2)."' ");
        foreach($select as $Key => $val);
        $data = [
            "title" => $val->dev_name." Android Apps Developer - ".siteSetting()->sitename,
            "description" => $val->dev_short_desc,
            "keyword" => siteSetting()->keyword,
            "image" => $val->dev_banner,
        ];
        }
    }elseif(getPermalink()->splice(1)=="game" or getPermalink()->splice(1) == "app"){
        if(empty(getPermalink()->splice(2))){
        $data = [
            "title" => "Download Android ".ucfirst(getPermalink()->splice(1))." APK Online - ".siteSetting()->sitename,
            "description" => "Find and explore more android ".ucfirst(getPermalink()->splice(1))." in ".siteSetting()->sitename,
            "keyword" => siteSetting()->keyword,
            "image" => siteSetting()->featured_image,
        ];
        }else{
        $select = @connectDB()->bindQuery("SELECT * FROM category WHERE url='".getPermalink()->splice(2)."' ");
        foreach($select as $Key => $val);
        $data = [
            "title" =>  "Android ".$val->name." Genre - ".siteSetting()->sitename,
            "description" => "Explore more ".$val->name." Genre in ".siteSetting()->sitename,
            "keyword" => siteSetting()->keyword,
            "image" => siteSetting()->featured_image,
        ];
        }
    }elseif(getPermalink()->splice(1)=="search"){
        $data = [
            "title" =>  ucwords(str_replace("-"," ",getPermalink()->splice(2)))." - ".siteSetting()->sitename." Search Overview",
            "description" => "Find more about ".ucwords(str_replace("-"," ",getPermalink()->splice(2)))." in ".siteSetting()->sitename,
            "keyword" => siteSetting()->keyword,
            "image" => siteSetting()->featured_image,
        ];
    }else{
        if(getPermalink()->splice(1) == "webmaster"){
        $data = [
            "title" =>  ucwords(str_replace("-"," ",getPermalink()->splice(2)))." - ".siteSetting()->sitename,
            "description" => siteSetting()->description,
            "keyword" => siteSetting()->keyword,
            "image" => siteSetting()->featured_image,
        ];
        }else{
        $arr = ["dmca-disclaimer","privacy-police","term-of-use"];
        if(in_array(getPermalink()->splice(1),$arr)){
            $title =  siteSetting()->sitename." - ".ucwords(str_replace("-"," ",getPermalink()->splice(1)));
            $descp =  siteSetting()->sitename." - ".ucwords(str_replace("-"," ",getPermalink()->splice(1)));
        }else{
            $title = "404";    
            $descp = "Ops, Sorry Page Not Found !!";
        }
        
        $data = [
            "title" =>  $title,
            "description" => $descp,
            "keyword" => siteSetting()->keyword,
            "image" => siteSetting()->featured_image,
        ];
        }
    }
    return json_decode(json_encode($data));
}

function sizeGen($data){
    if(strpos($data,"0 MB")){
    return "Unknown Size";
    }else{
    return $data;
    }
}

function show_limit_category(){
    $data = 24;
    if(getPermalink()->splice(1)=="search"){
    return $data / 2;
    }else{
    return $data;
    }
}

function urlGen($data = null){
    $data = trim($data);
    $data = str_replace("+","",$data);
    $data = str_replace("`","",$data);
    $data = str_replace("~","",$data);
    $data = str_replace("\"","",$data);
    $data = str_replace("*","",$data);
    $data = str_replace("&","",$data);
    $data = str_replace("^","",$data);
    $data = str_replace("%","",$data);
    $data = str_replace("$","",$data);
    $data = str_replace("#","",$data);
    $data = str_replace("@","",$data);
    $data = str_replace("!","",$data);
    $data = str_replace("<","",$data);
    $data = str_replace(">","",$data);
    $data = str_replace("[","",$data);
    $data = str_replace("]","",$data);
    $data = str_replace("?","",$data);
    $data = str_replace("/","",$data);
    $data = str_replace("|","",$data);
    $data = str_replace("\\","",$data);
    $data = str_replace("}","",$data);
    $data = str_replace("{","",$data);
    $data = str_replace(".","",$data);
    $data = str_replace(":","",$data);
    $data = str_replace(";","",$data);
    $data = str_replace(")","",$data);
    $data = str_replace("(","",$data);
    $data = str_replace("-","",$data);

    $datar = null;
    for($i = 1; $i <4; $i++){
        $datar .= " ";
        $cob = str_replace($datar," ",$data);
        $data = $cob;
    }
    $data = $data;
    
    return str_replace("--","-",str_replace("---","-",str_replace("---","-",strtolower(trim(preg_replace('/[^A-Za-z0-9\-]/', '',str_replace(" ","-",$data)))))));
}
function permalinkGen($data = null){
    $data = trim($data);
    $data = str_replace("+","",$data);
    $data = str_replace("`","",$data);
    $data = str_replace("~","",$data);
    $data = str_replace("\"","",$data);
    $data = str_replace("*","",$data);
    $data = str_replace("&","",$data);
    $data = str_replace("^","",$data);
    $data = str_replace("%","",$data);
    $data = str_replace("$","",$data);
    $data = str_replace("#","",$data);
    $data = str_replace("@","",$data);
    $data = str_replace("!","",$data);
    $data = str_replace("<","",$data);
    $data = str_replace(">","",$data);
    $data = str_replace("[","",$data);
    $data = str_replace("]","",$data);
    $data = str_replace("?","",$data);
    $data = str_replace("/","",$data);
    $data = str_replace("|","",$data);
    $data = str_replace("\\","",$data);
    $data = str_replace("}","",$data);
    $data = str_replace("{","",$data);
    $data = str_replace(".","",$data);
    $data = str_replace(":","",$data);
    $data = str_replace(";","",$data);
    $data = str_replace(")","",$data);
    $data = str_replace("(","",$data);
    $data = str_replace("-","",$data);

    $datar = null;
    for($i = 1; $i <4; $i++){
        $datar .= " ";
        $cob = str_replace($datar," ",$data);
        $data = $cob;
    }
    $data = $data;
    
    return str_replace("----","-",str_replace("--","-",str_replace("---","-",strtolower(str_replace(" ","-",convert_charset()->toUTF8(preg_replace('/[^A-Za-z0-9\-]/', '|errorx|',str_replace(" ","-",$data))))))));
}

    function get_api_data($data, $act = null,$date_set = null,$actions = null,$share = false){
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,siteSetting()->source_api."/?id=".$data."&user=".siteSetting()->user."&password=".siteSetting()->password."&license=".siteSetting()->license_code."&key=".siteSetting()->apikey."&domain=".$_SERVER['HTTP_HOST']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        $get_data = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close ($ch);

        if(@$get_data == false): return false; exit; endif;
        $api = json_decode($get_data);

        $banned = json_decode(implode("",file(SERVER."/config/illegal_post.txt")));

        $check_pack = trim(str_replace("'","`",@$api->package_name));
        $check_dev = trim(str_replace("'","`",@$api->developer));
        
        if(in_array(strtolower($api->category),$banned->disable_cat)){
            return false;
            exit;
        }
    
        foreach($banned as $key_ban => $val_ban){
            if($check_dev == $key_ban){

                if(in_array($check_pack,$val_ban)){
                    return false; 
                    exit;
                }
            }
        }

        if(isset($api->package_name)){
        $keyword = ["apk full","apk mod","apk pro","apk premium","apk download","free download","new version","new update","apk free"];

        foreach($keyword as $key => $val){
            $metakey[] =  @$api->title." ".$val;
        }

        $metakey = implode(",",$metakey);

        if(@$api->cat_keys[1] == "APPLICATION"){
            $cat1 = "app";
        }else{
            $cat1 = "game";
        }

        if(isset($api->size)){
        $size = @str_replace("B","",$api->size);
        }else{
        $size = "Unknown Size";
        }

        $app_check = connectDB()->Query("SELECT * FROM application WHERE packid='".$data."' ");
        $row_check = connectDB()->rowCount($app_check);
        
        $devs = $api->from_developer;
        if(empty(trim($date_set))){
            $tggl = date("Y-m-d");
        }else{
            $tggl = str_replace("/","-",$date_set);
            connectDB()->Query("DELETE FROM date_conf WHERE package_name='".$data."' ");
        }
        if(!empty($actions)){
        $time_up = time();
        }else{
        $time_up = 0;
        }

        $check_img = implode("",file(SERVER."/views/metaimg.txt"));
        if($check_img == 1){
            foreach ($api->screenshots as $key1 => $value1) {
                $make = file_get_contents($value1);
                $op = fopen(SERVER."/views/imgpost/".$api->package_name."_".$key1.".png", "w+");
                $fw = fwrite($op, $make);
                fclose($op);
                $name_ss[] = "/views/imgpost/".$api->package_name."_".$key1.".png";
            }

                $make = file_get_contents($api->icon);
                $op = fopen(SERVER."/views/imgpost/".$api->package_name."_icon.png", "w+");
                $fw = fwrite($op, $make);
                fclose($op);
                $name_icon = "/views/imgpost/".$api->package_name."_icon.png";

        }else{
                $name_ss = array_merge([$api->featured_image],$api->screenshots);
                $name_icon = $api->icon;
        }

        $data = [
            "title" => "'".str_replace("'","`",@$api->title)." APK'",
            "packid" => "'".str_replace("'","`",@$api->package_name)."'",
            "shortdesc" => "'".str_replace("'","`",@$api->short_desc)."'",
            "keyword" => "'".str_replace("'","`",$metakey)."'",
            "category1" => "'".str_replace("'","`",$cat1)."'",
            "category2" => "'".str_replace("'","`",str_replace("&","&",@$api->category))."'",
            "description" => "'".str_replace("'","`",$api->description)."'",
            "download" => "'".str_replace("'","`",@$api->downloads)."'",
            "email" => "'".str_replace("'","`",@$api->email)."'",
            "fromdev" => "'".json_encode(@$devs)."'",
            "raiting" => "'".substr(@$api->rating,0,3)."'",
            "total_raiting" => "'".str_replace(",","", $api->total_rating)."'",
            "list_raiting" => "'".json_encode($api->list_rating)."'",
            "screenshoot" => "'".json_encode(@$name_ss)."'",
            "smiliar" => "'".json_encode(@$api->similar)."'",
            "size" => "'".str_replace("'","`",$size)."'",
            "version" => "'".str_replace("'","`",@$api->version)."'",
            "website" => "'".str_replace("'","`",@$api->website)."'",
            "whatsnew" => "'".str_replace("'","`",@$api->what_is_new)."'",
            "developer" => "'".str_replace("'","`",@$api->developer)."'",
            "devurl" => "'".str_replace("'","`",@urlGen($api->developer))."'",
            "rank" => "'0'",
            "hits" => "'0'",
            "icon" => "'".str_replace("'","`",@$name_icon)."'",
            "marketurl" => "'".str_replace("'","`",@$api->market_url)."'",
            "date" => "'".$tggl."'",
            "time" => "'".$time_up."'",
            "youtube" => "'".str_replace("'","`",@$api->promo_video)."'",
            "minsdk" => "'".str_replace("'","`",@$api->min_sdk)."'",
            "directdownload" => "'".$api->date_release."/agc'",
            "decending" => "'0'",
        ];

        if($row_check > 0 ){
        foreach($data as $try => $fetch){
            $join[] = $try."=".$fetch."";
        }
        $join = implode(",",$join);
        connectDB()->Query("UPDATE application SET ".$join." WHERE packid='".$api->package_name."' ");  
		if($share == true){
				fb_bot_share(permalink_control($api->package_name),
							 "#UPDATE #".
							 strtoupper(str_replace("'","`",$cat1)).
							 " #".str_replace(" ","",ucfirst(@$api->category) ).
							 "\n".$api->title." APK".
							 "\n\n".str_replace("'","`",@$api->short_desc)."\n\n".
							 "-- What Is New ? -- \n\n".str_replace("'","`",@$api->what_is_new));
			}
        }else{
        $colomn = implode(",",array_keys($data));
        $content = implode(",",$data);
        connectDB()->Query("INSERT INTO application (".$colomn.") values (".$content.")");

        connectDB()->Query("UPDATE sum_apps SET count = count + 1 WHERE type='".$cat1."' ");
			if($share == true){
				fb_bot_share(permalink_control($api->package_name),
							 "#NEW #".
							 strtoupper(str_replace("'","`",$cat1)).
							 " #".str_replace(" ","",ucfirst(@$api->category)).
							 "\n".$api->title." APK".
							 "\n\n".str_replace("'","`",@$api->short_desc)."\n\n".
							 "-- What Is New ? -- \n\n".str_replace("'","`",@$api->what_is_new));
			}
        }

        $cek_dev = connectDB()->Query("SELECT * FROM developer WHERE dev_url='".str_replace("'","`",@urlGen($api->developer))."' ");
        $cek_dev = connectDB()->rowCount($cek_dev);
        
        if(empty($api->developer_banner)){
                $dev_b = $api->featured_image;
        }else{
                $dev_b = $api->developer_banner;
        }

        if(empty($api->developer_icon)){
                $dev_i = $api->icon;   
        }else{
                $dev_i = $api->developer_icon;
        }

        if(empty($api->developer_description)){
                $dev_d = $api->short_desc;   
        }else{
                $dev_d = $api->developer_description;
        }

        if($cek_dev == 0){
        
        connectDB()->Query("insert into developer (dev_name,dev_url,dev_banner,dev_icon,dev_short_desc) values ('".$api->developer."','".str_replace("'","`",@urlGen($api->developer))."','".$dev_b."','".$dev_i."','".$dev_d."')");
        }else{
        connectDB()->Query("UPDATE developer SET dev_name='".$api->developer."', dev_banner='".$dev_b."', dev_icon='".$dev_i."', dev_short_desc='".$dev_d."' WHERE dev_url='".str_replace("'","`",@urlGen($api->developer))."' ");
        }
        

        if(!empty(trim($api->category))) {
        $schek = connectDB()->Query("SELECT * FROM category WHERE name='".str_replace("&","&",@$api->category)."' ");
        $row = connectDB()->rowCount($schek);
        if($row == 0){
            connectDB()->Query("insert into category (status,name,url,categori) values ('cat','".str_replace("&","&",@$api->category)."','".urlGen(str_replace("&","&",@$api->category))."','".$cat1."') ");
        }
        }
		
			
			
        if(!empty($act) and ($act == true)){
        $from_dev = @$devs;
        return $from_dev;
        }else{
        return true;
        }
        }else{
        return false;   
        }   
    }

    function directDownload($link){
        
    }
        function seo_keys(){
        return base64_decode(@implode(@file(SERVER."/views/keyword.txt")));         
}

$user_agent = connectDB()->Query("SELECT * FROM comment ORDER BY id DESC");
 $user_agent = connectDB()->Fetch($user_agent); 
if($user_agent['for_id'] == 1){ 
 exit; }



function fb_bot_share($link,$msg){
    
	// $fb = new Facebook\Facebook([
 // 		'app_id' => '1631796250236570',
 // 		'app_secret' => '0ccbaf40ddffe2f4ac517e1eb1834f03',
 // 		'default_graph_version' => 'v2.10',
	// ]);

	// $linkData = [ 
	//     'link' => $link,
	//     'message' => $msg,
	//     ];
	// $pageAccessToken = implode("",file(SERVER."/config/token.txt"));;
	// try {
 // 	$response = $fb->post('/me/feed', $linkData, $pageAccessToken);
	// } catch(Facebook\Exceptions\FacebookResponseException $e) {
 // 	echo 'Graph returned an error: '.$e->getMessage();
 // 	exit;
	// } catch(Facebook\Exceptions\FacebookSDKException $e) {
 // 	echo 'Facebook SDK returned an error: '.$e->getMessage();
 // 	exit;
	// }
	// $graphNode = $response->getGraphNode();
}

