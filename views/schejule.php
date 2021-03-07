<?php
    $autopub = @connectDB()->bindQuery("SELECT * FROM date_conf WHERE date='".date("Y/m/d")."' ");
    foreach($autopub as $key => $vals){ 
    $ceker = connectDB()->Query("SELECT * FROM application WHERE packid='".$vals->package_name."' ");
    $fetch = connectDB()->Fetch($ceker);
    $mode = explode("/",$fetch['directdownload']);
    $date_update = trim(@$mode[0]);
    $mode = trim(@$mode[1]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,siteSetting()->source_api."/?id=".$vals->package_name."&user=".siteSetting()->user."&password=".siteSetting()->password."&license=".siteSetting()->license_code."&key=".siteSetting()->apikey."&domain=".$_SERVER['HTTP_HOST']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    $get_data = curl_exec ($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close ($ch);
    $json = json_decode($get_data);

    if($date_update == trim(@$json->date_release)){
    $stas = "[yes]";
    }else{
    $stas = "[no]";
    }
    echo $vals->package_name." ".$stas."<br>";

    if($mode !== "manual"){
    if(isset($vals->package_name)) {
    $dates = "";
    if(strpos($vals->package_name,"play.google.com")){
        $pack = explode("id=",$vals->package_name);
        $pack = explode("&",$pack[1]);
        $pack = $pack[0];
    }else{
        $pack = $vals->package_name;
    }
    $split = explode("\r",$pack);
    foreach ($split as $key => $value) {
    $check = connectDB()->Query("SELECT * FROM application WHERE packid='".$value."' ");
    $rows = connectDB()->rowCount($check);
    if($rows == 1) $tms = "update";
    else $tms = "";

        
            if(get_api_data($value,false,$dates,$tms)){
                echo "<sukses/>";
            }else{
                echo "<fail/>";
            }
        
    }
}



    connectDB()->Query("DELETE FROM date_conf WHERE package_name='".$pack."' ");


$record = @connectDB()->Query("SELECT * FROM application ORDER BY rank ASC");
$nom = 1;
while($show = @connectDB()->Fetch($record)) {
connectDB()->Query("UPDATE application SET decending='".$nom."' WHERE id='".$show['id']."' ");
$nom++;
}
}
}
exit;
    