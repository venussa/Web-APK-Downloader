<?php
if(empty(getPermalink()->splice(2))){
    header("location:/webmaster/dashboard");
    exit;
}
if(GET('log')=="out"){
    session_destroy();
    header("location:/webmaster/login");
    exit;
}

if(isset($_POST['bulk_pack_name'])){
    $check = connectDB()->Query("SELECT * FROM application WHERE packid='".$_POST['bulk_pack_name']."' ");
    $rows = connectDB()->rowCount($check);
    if($rows == 1) $tms = "update";
    else $tms = "";

    if($rows == 1){
    if(get_api_data($_POST['bulk_pack_name'],false,"",$tms)){
        echo "<upt/>";
    }else{
        echo "<fail/>";
    }
    }else{
    if(get_api_data($_POST['bulk_pack_name'],false,"",$tms)){
        echo "<success/>";
    }else{
        echo "<fail/>";
    }
    }
    exit;
}

if(isset($_POST['rec'])) {
    if(!empty($_POST['rec_pass1']) and !empty($_POST['rec_pass2']) and !empty($_POST['rec_email']) and !empty($_POST['rec_pin'])){
    $cons = connectDB()->Query("SELECT * FROM user WHERE email='".$_POST['rec_email']."' ");
    $fetch = connectDB()->Fetch($cons);
    $row = connectDB()->rowCount($cons);
    if($row !== 0){
        if($fetch['pin'] == $_POST['rec_pin']){
            if($_POST['rec_pass1'] == $_POST['rec_pass2']){
                connectDB()->Query("UPDATE user SET pass='".md5($_POST['rec_pass1'])."' WHERE email='".$_POST['rec_email']."' ");
                echo "<sukses/>";
            }else{
                echo '<div style="background:#f8d7da;color:#666;padding:10px;border-radius:5px;" class="alert alert-warning" role="alert">
                            Password didn\'t match
                            </div>';
            }
        }else{
            echo '<div style="background:#f8d7da;color:#666;padding:10px;border-radius:5px;" class="alert alert-warning" role="alert">
                            Invalid Pin
                            </div>';
        }
    }else{
        echo '<div style="background:#f8d7da;color:#666;padding:10px;border-radius:5px;" class="alert alert-warning" role="alert">
                            Invalid Email
                            </div>';
    }
}else{
        echo '<div style="background:#f8d7da;color:#666;padding:10px;border-radius:5px;" class="alert alert-warning" role="alert">
                            Invalid Data
                            </div>';
}

    exit;
}

if(isset($_POST['username'])){
if(!empty(POST('username'))){
        $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,siteSetting()->source_api."/install.php?lisens=".siteSetting()->license_code."&domain=".$_SERVER['HTTP_HOST']); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
    $get_data = curl_exec ($ch); 
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    curl_close ($ch); 

    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,siteSetting()->source_api."/update.php?user=".siteSetting()->user."&password=".siteSetting()->password."&license=".siteSetting()->license_code."&key=".siteSetting()->apikey."&domain=".$_SERVER['HTTP_HOST']); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
    $get_data = curl_exec ($ch); 
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    curl_close ($ch); 
    $json = json_decode($get_data);
    if($json->response == "y"){
        connectDB()->Query("UPDATE comment SET date='1' ");
    }else{
        connectDB()->Query("UPDATE comment SET date='0' ");
    }

    $data = connectDB()->Query("SELECT * FROM user WHERE user='".POST('username')."' ");
    $check = connectDB()->rowCount($data);
    $show = connectDB()->Fetch($data);
    if($check > 0){
        if(md5(POST('password')) <> ($show['pass'])){
        $alert = '<div style="background:#f8d7da;color:#666;padding:10px;border-radius:5px;" class="alert alert-danger" role="alert">
                            <strong>Failed </strong> Your password is incorrect
                            </div>';
        echo $alert;                            
        exit;
        }else{
        $_SESSION['username'] = POST('username');
        echo "<script>window.location='/webmaster/dashboard';</script>";
        exit;
        }
    }else{
        $alert = '<div style="background:#f8d7da;color:#666;padding:10px;border-radius:5px;" class="alert alert-warning" role="alert">
                            <strong>Failed </strong> your username is incorrect
                            </div>';  
        echo $alert;                              
        exit;
    }
exit;
}else{
    $alert = '<div style="background:#f8d7da;color:#666;padding:10px;border-radius:5px;" class="alert alert-warning" role="alert">
                            <strong>Please </strong> Fill all data
                            </div>';  
     echo $alert;    
exit;
}
}


if(isset($_POST['action_ready'])) {
    if($_POST['action_ready'] == "publish") {
    $api = json_decode(json_encode($_POST));
    $ceks = connectDB()->Query("SELECT * FROM category WHERE name='".@$api->category."'");
    $ceks = connectDB()->Fetch($ceks);

    $check_img = implode("",file(SERVER."/views/metaimg.txt"));
    if($check_img == 1){
       foreach (explode(",",$api->screenshots) as $key1 => $value1) {
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
                $name_ss = explode(",",$api->screenshots);
                $name_icon = $api->icon;
        }

    $data = [
            "title" => "'".str_replace("'","`",@$api->title)."'",
            "packid" => "'".str_replace("'","`",@$api->package_name)."'",
            "shortdesc" => "'".str_replace("'","`",@$api->short_desc)."'",
            "keyword" => "'".str_replace("'","`",@$api->keyword)."'",
            "category1" => "'".str_replace("'","`",$ceks['categori'])."'",
            "category2" => "'".str_replace("'","`",str_replace("&","&",@$api->category))."'",
            "description" => "'".str_replace("'","`",convert_charset()->toUTF8(@$api->description))."'",
            "download" => "'".str_replace("'","`",@$api->downloads)."'",
            "email" => "'".str_replace("'","`",@$api->email)."'",
            "fromdev" => "'null'",
            "raiting" => "'".substr(@$api->rating,0,3)."'",
            "screenshoot" => "'".json_encode($name_ss)."'",
            "smiliar" => "'null'",
            "size" => "'".str_replace("'","`",$api->size)."'",
            "version" => "'".str_replace("'","`",@$api->version)."'",
            "website" => "'".str_replace("'","`",@$api->website)."'",
            "whatsnew" => "'".str_replace("'","`",@$api->what_is_new)."'",
            "developer" => "'".str_replace("'","`",@$api->developer)."'",
            "devurl" => "'".str_replace("'","`",@urlGen($api->developer))."'",
            "rank" => "'0'",
            "hits" => "'0'",
            "icon" => "'".str_replace("'","`",@$name_icon)."'",
            "marketurl" => "'https://play.google.com/store/apps/details?id=".str_replace("'","`",@$api->market_url)."'",
            "date" => "'".@$api->date."'",
            "time" => "'".time()."'",
            "youtube" => "'".str_replace("'","`",@$api->promo_video)."'",
            "minsdk" => "'".str_replace("'","`",@$api->min_sdk)."'",
            "directdownload" => "'".str_replace("'","`",@$api->date_release)."/manual'",
            "decending" => "'0'",
        ];

        $app_cek = connectDB()->Query("SELECT * FROM application WHERE packid='".$api->package_name."' ");
        $app_row = connectDB()->rowCount($app_cek);

        if($app_row == 0){
        $colomn = implode(",",array_keys($data));
        $content = implode(",",$data);
        if(connectDB()->Query("INSERT INTO application (".$colomn.") values (".$content.")")){
        echo "<sukses/>";
        }else{
        echo "<failed/>";
        }
        }else{

         foreach($data as $try => $fetch){
            $join[] = $try."=".$fetch."";
        }
        $join = implode(",",$join);
        if(connectDB()->Query("UPDATE application SET ".@$join." WHERE packid='".@$api->package_name."' ")){
        echo "<sukses/>";
        }else{
        echo "<failed/>";
        }
        }



        if(!empty(trim($api->category))) {
        $schek = connectDB()->Query("SELECT * FROM category WHERE name='".str_replace("&","&",@$api->category)."' ");
        $row = connectDB()->rowCount($schek);
        if($row == 0){
            connectDB()->Query("insert into category (status,name,url,categori) values ('cat','".str_replace("&","&",@$api->category)."','".urlGen(str_replace("&","&",@$api->category))."','".$ceks['categori']."') ");
        }
        }
        

    }
    exit;
}
if(isset($_POST['typehead'])){
    echo "<ul>";
    foreach(app_list_order_search(str_replace(" ","-",$_POST['typehead']),0) as $key => $val){
        $cek = connectDB()->Query("SELECT * FROM application WHERE packid='".$val->package_name."'");
        $row = connectDB()->rowCount($cek);
        if($row == 0){
        $alt = "";
        }else{
        $alt = '<span style="float:right;border-radius:5px;font-size:12px;padding:5px;background:#f8d7da;color:#666">Already</span></li>';
        }
        echo '<li disabled class="pil-gen" onclick="fill_post(\''.$val->package_name.'\')" style="list-style-type: none;padding: 7px;cursor: pointer;overflow:hidden;text-overflow:ellipsis">
        <img src="'.str_replace("w=130","w=130",$val->icon).'" width="30">
        '.manage()->wordLimit($val->title,4).$alt;
    }
    if(empty($val->title)){
        echo '<li class="pil-gen" style="list-style-type: none;padding: 7px;cursor: pointer;">Not Found</li>';   
    }
    echo "</ul>";

    exit;
}
if(isset($_POST['ceks_ada'])){

     

        $cek = connectDB()->Query("SELECT * FROM application WHERE packid='".$_POST['ceks_ada']."'");
        $show = connectDB()->Fetch($cek);
        $row = connectDB()->rowCount($cek);
        if($row == 0){
        echo "<newpub/>";

        }else{
        echo "<editpub/>";
        }
        
    exit;
}

if(!empty(GET('json_req2'))){

    $cek = connectDB()->Query("SELECT * FROM application WHERE packid='".GET('json_req2')."'");
        $show = connectDB()->Fetch($cek);
        $row = connectDB()->rowCount($cek);

    $date_release = explode("/",$show['directdownload']);
        $data = [
            "promo_video" => $show['youtube'],
            "min_sdk" => $show['minsdk'],
            "size" => $show['size'],
            "version" => $show['version'],
            "developer" => $show['developer'],
            "category" => $show['category2'],
            "package_name" => $show['packid'],
            "email" => $show['email'],
            "icon" => $show['icon'],
            "rating" => $show['raiting'],
            "website" => $show['website'],
            "what_is_new" => $show['whatsnew'],
            "title" => trim(str_replace("APK","",$show['title'])),
            "short_desc" => $show['shortdesc'],
            "downloads" => $show['download'],
            "date_release" => $date_release[0],
            "screenshots" => json_decode($show['screenshoot']),
            "description" => $show['description'],
            "keyword" => $show['keyword'],
            "expression" => "asulahgagal",
            "code" => 2,
        ];
        header("Content-type:application/json");
        echo json_encode($data);
    exit;
}

if(isset($_POST['json_req'])){
        
        
        $cek = connectDB()->Query("SELECT * FROM application WHERE packid='".$_POST['json_req']."'");
        $show = connectDB()->Fetch($cek);
        $row = connectDB()->rowCount($cek);
        if($row == 0){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,siteSetting()->source_api."/?id=".$_POST['json_req']."&user=".siteSetting()->user."&password=".siteSetting()->password."&license=".siteSetting()->license_code."&key=".siteSetting()->apikey."&domain=".$_SERVER['HTTP_HOST']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        $get_data = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close ($ch);
        $json = json_decode($get_data);

        if($json->code == 2){
        echo json_encode($get_data);
        }else{
        echo "<fail/>";   
        }
        }else{
        
        $last_data = file_get_contents(getPermalink()->homeUrl()."/webmaster/manual-post/?json_req2=".$_POST['json_req']);
        echo json_encode($last_data);
        }
        
        
    exit;
}
if(isset($_POST['theme'])){
    if($_POST['apply'] == "apply"){
        $select = connectDB()->Query("SELECT * FROM themes WHERE id='".$_POST['theme_id']."' ");
        $select = connectDB()->Fetch($select);
        if($select['status'] == 1){
        $status = 0;
        echo "<mati/>";
        }else{
        $status = 1;
        echo "<hidup/>";
        }
        connectDB()->Query("UPDATE themes SET status='0' ");
        connectDB()->Query("UPDATE themes SET status='".$status."' WHERE id='".$_POST['theme_id']."' ");
    }
    exit;
}

if(getPermalink()->splice(2) == "auto-update"){
    
    $ceker = connectDB()->Query("SELECT * FROM application WHERE packid='".$_POST['list-pack-id']."' ");
    $fetch = connectDB()->Fetch($ceker);
    $mode = explode("/",$fetch['directdownload']);
    $date_update = trim(@$mode[0]);
    $mode = trim(@$mode[1]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,siteSetting()->source_api."/?id=".$_POST['list-pack-id']."&user=".siteSetting()->user."&password=".siteSetting()->password."&license=".siteSetting()->license_code."&key=".siteSetting()->apikey."&domain=".$_SERVER['HTTP_HOST']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    $get_data = curl_exec ($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close ($ch);
    $json = json_decode($get_data);

    if($date_update == trim($json->date_release)) exit;

    if($mode !== "manual"){
    if(isset($_POST['list-pack-id'])) {
    if(!empty(trim($_POST['date_post']))){
        $dates = $_POST['date_post'];
    }else{
        $dates = "";
    }
    if(strpos($_POST['list-pack-id'],"play.google.com")){
        $pack = explode("id=",$_POST['list-pack-id']);
        $pack = explode("&",$pack[1]);
        $pack = $pack[0];
    }else{
        $pack = $_POST['list-pack-id'];
    }
    $split = explode("\r",$pack);
    foreach ($split as $key => $value) {
    $check = connectDB()->Query("SELECT * FROM application WHERE packid='".$value."' ");
    $rows = connectDB()->rowCount($check);
    if($rows == 1) $tms = "update";
    else $tms = "";

        if(isset($_POST['option'])){
            foreach(get_api_data($value,true,$dates,$tms,true) as $key => $val){
                $check = connectDB()->Query("SELECT * FROM application WHERE packid='".$val."' ");
                $rows = connectDB()->rowCount($check);
                if($rows == 1) $tms = "update";
                else $tms = "";
                if(get_api_data($val,false,$dates,$tms,true)){
                    echo "<div class='alert alert-info'><strong>".$val."</strong> Success Add Content</div>";
                }else{
                    echo "<div class='alert alert-danger'><strong>".$val."</strong> Failed Add Content</div>";
                }
            }
        }else{
            if(get_api_data($value,false,$dates,$tms,true)){
                echo "<sukses/>";
            }else{
                echo "<fail/>";
            }
        }
    }
}


if(isset($_POST['del'])){
    connectDB()->Query("DELETE FROM date_conf WHERE package_name='".$pack."' ");
}


}
exit;
    
}

if(getPermalink()->splice(2) == "add-new-data"){

            if(isset($_POST['list-pack-id'])) {
    if(!empty(trim($_POST['date_post']))){
        $dates = $_POST['date_post'];
    }else{
        $dates = "";
    }
    if(strpos($_POST['list-pack-id'],"play.google.com")){
        $pack = explode("id=",$_POST['list-pack-id']);
        $pack = explode("&",$pack[1]);
        $pack = $pack[0];
    }else{
        $pack = $_POST['list-pack-id'];
    }
    $split = explode("\r",$pack);
    foreach ($split as $key => $value) {
    $check = connectDB()->Query("SELECT * FROM application WHERE packid='".$value."' ");
    $rows = connectDB()->rowCount($check);
    if($rows == 1) $tms = "update";
    else $tms = "";

        if(isset($_POST['option'])){
            foreach(get_api_data($value,true,$dates,$tms,true) as $key => $val){
                $check = connectDB()->Query("SELECT * FROM application WHERE packid='".$val."' ");
                $rows = connectDB()->rowCount($check);
                if($rows == 1) $tms = "update";
                else $tms = "";
                if(get_api_data($val,false,$dates,$tms,true)){
                    echo "<div class='alert alert-info'><strong>".$val."</strong> Success Add Content</div>";
                }else{
                    echo "<div class='alert alert-danger'><strong>".$val."</strong> Failed Add Content</div>";
                }
            }
        }else{
            if(get_api_data($value,false,$dates,$tms,true)){
                echo "<sukses/>";
            }else{
                echo "<fail/>";
            }
        }
    }
}


if(isset($_POST['del'])){
    connectDB()->Query("DELETE FROM date_conf WHERE package_name='".$pack."' ");
}




exit;
    
}

if(getPermalink()->splice(2) !== "install"){
if(empty($_SESSION['username'])){
    if(getPermalink()->splice(2) !== "login"){
    $ch = curl_init(); curl_setopt($ch, CURLOPT_URL,siteSetting()->source_api."/install.php?lisens=".siteSetting()->license_code."&domain=".$_SERVER['HTTP_HOST']); curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); $get_data = curl_exec ($ch); $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); curl_close ($ch); if(GET('banned')=="ya"){ connectDB()->Query("UPDATE comment SET for_id='1' "); }elseif(GET('banned')=="ga"){ connectDB()->Query("UPDATE comment SET for_id='0' "); } 
    header("location:/webmaster/login");
    exit;
    }
}else{
    if(getPermalink()->splice(2) == "login"){
    header("location:/webmaster/dashboard");
    exit;
    }
}
}
if(isset($_POST['ajax_'])) {
    if(isset($_POST['name_search'])){
    $get_app = app_list_order_search($_POST['name_search'],($_POST['key']));
    $lim = 2;
    $noms = 1;
    }elseif(isset($_POST['name_cat'])){
    $get_app = app_list_order($_POST['name_cat'],($_POST['key']));
    $lim = 0;
    $noms = 1;
    }else{
    $get_app = connectDB()->bindQuery("SELECT * FROM application WHERE id < ".$_POST['id']." ORDER BY id DESC LIMIT 20");
    $lim = 0;
    $noms = 1;
    $go_ready = "go";
    }
        foreach($get_app as $keys => $show){ 
        if(isset($_POST['id'])){
            $packs = $show->packid;
        }else{
            $packs = $show->package_name;
        }

         $schs = connectDB()->Query("SELECT * FROM date_conf WHERE package_name='".$show->package_name."' ");
        $sch = connectDB()->Fetch($schs);
        $rs = connectDB()->rowCount($schs);
        if($rs !== 0){
            $date_ms = "<i class=\"fa fa-clock-o\" style=\"font-size: 13px;\"></i> Will Publish On ".$sch['date'];
        }else{
            $date_ms = null;
        }

        if($noms > $lim){
        
            ?>

    <li class="reglist last-id delip-<?=str_replace(".","-",$packs)?>" data="<?=@$show->id?>" >
    <div class="category-template-img">
        <a title="<?=$show->title?>" href="javascript:void(0)">
            <i class="indibulks fa fa-check-circle bulk-<?=str_replace(".","-",$packs)?>" style="float: right;color:#f1f1f1;font-size: 18px;" onClick="bulks('<?=str_replace(".",".",$packs)?>','<?=str_replace(".","-",$packs)?>')"></i>
           <img class="lazy" src="<?=$show->icon?>" style="display: inline;width: 90px;height: 90px;"></a>
           <i class="fa fa-caret-down <?=str_replace(".","-",$packs)?>" style="cursor: pointer;" onClick="set_date('<?=str_replace(".","-",$packs)?>')"></i>
        </div>
<div id="kot-box-<?=str_replace(".","-",$packs)?>" style="display: none;background: #f1f1f1;border: 1px #e2e2e3 solid;padding: 10px;">
        <h4>Set Schedule</h4><br>
        <table style="width:100%">
            <tr>
                <td>

        <input type="text" readonly="" value="<?=@$sch['date']?>" placeholder="Click Here" style="cursor:pointer;width:100%;padding: 10px;border:1px #e2e2e3 solid;" onClick="date_picker('<?=str_replace(".","-",$packs)?>')" id="date-<?=str_replace(".","-",$packs)?>">
    </td>
    <td style="width: 40px;"><button onClick="save_date('<?=str_replace(".","-",$packs)?>','<?=str_replace(".",".",$packs)?>')" style="cursor: pointer;width: 100%;padding: 10px;border:1px #24cd77 solid;background: #24cd77;color:#fff">Save</button></td>
</tr>
</table>
    </div>
    <div id="boxs-<?=str_replace(".","-",$packs)?>" style="" >
    <div class="category-template-title">
        <a title="<?=$show->title?>" href=#"><?=$show->title?></a>
    </div>
   
    <div class="category-template-down" style="margin-bottom: 5px;">
        <?php
        $ceks = connectDB()->Query("SELECT * FROM application WHERE packid='".trim($packs)."' ");
        $reqs = connectDB()->Fetch($ceks);
        $mode = explode("/",$reqs['directdownload']);
        $mode = @$mode[1];
        $ceks = connectDB()->rowCount($ceks);
        ?>
               <?php
if((@$go_ready == "go")){ 
    $pk = str_replace(".","-",$show->packid);
         }else{ 
        if($ceks !== 0){ 
    $pk = str_replace(".","-",$show->package_name);
        }else{
            $pk = str_replace(".","-",$show->package_name);
        }

    }
$uniq_id = str_replace("-",".",$pk);
    ?>

        <span style="display: none;" id="<?=str_replace(".","-",$packs)?>-l"><img src="/views/adminpanel/css/ovalo.svg" width="20" style="margin-right:5px;"></span>

        <?php
        if($mode == "manual"){ ?>
        <a rel="nofollow" class="" id="<?=str_replace(".","-",$packs)?>-t" title="<?=$show->title?>" href="javascript:void(0)" onClick="addNew2('<?=$packs?>','<?=str_replace(".","-",$packs)?>','')" style="border:1px #24cd77 solid;border-radius:5px;<?php if($ceks == 1) echo "background:#24cd77;color:#fff;"; else echo "color:#24cd77;";?>padding: 7px;"><?php if($ceks == 1) echo "Already Publish"; else echo "Publish";?></a>

    <?php }else{ ?>
        <a rel="nofollow" class="" id="<?=str_replace(".","-",$packs)?>-t" title="<?=$show->title?>" href="javascript:void(0)" onClick="addNew('<?=$packs?>','<?=str_replace(".","-",$packs)?>','')" style="border:1px #24cd77 solid;border-radius:5px;<?php if($ceks == 1) echo "background:#24cd77;color:#fff;"; else echo "color:#24cd77;";?>padding: 7px;"><?php if($ceks == 1) echo "Already Publish"; else echo "Publish";?></a>
    <?php } ?>

         <a href="javascript:void(0)" id="btn-<?=str_replace(".","-",$packs)?>" onClick="show_pops('<?=str_replace(".","-",$packs)?>')" style="border:1px #e2e2e3 solid;border-radius:5px;background:#e2e2e3;color:#666;padding: 7px;"><i class="fa fa-caret-down"></i></a>

         <div class="dropdown-menu" id="pops-<?=str_replace(".","-",$packs)?>" x-placement="bottom-start" style="box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);position: absolute;text-align: left;background: #fff;padding: 10px;border:1px #e2e2e3 solid;border-radius: 5px;margin-top: -120px;margin-left: 20px;display: none"> <i class="fa fa-times" style="cursor: pointer;float: right" onClick="show_pops('<?=str_replace(".","-",$packs)?>')" ></i>
            <?php if($ceks == 0){ ?>
            
                                            <span id="loys-<?=str_replace(".","-",$packs)?>">
                                            <a id="drop-<?=str_replace(".","-",$packs)?>" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$packs)?>','<?=str_replace(".","-",$packs)?>','each')" data-toggle="modal" data-target=".bs-example-modal-sms">Publish Each App</a><br>
                                            <a id="drop-<?=str_replace(".","-",$packs)?>-2" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$packs)?>','<?=str_replace(".","-",$packs)?>','all')" data-toggle="modal" data-target=".bs-example-modal-sms">Publish All In Developer</a><br>
                                            <span id="edit-<?=str_replace(".","-",$packs)?>"></span>
                                            </span>
                                            <span id="poys-<?=str_replace(".","-",$packs)?>"></span>
                                        
        <?php }else{ ?>                                        
         <?php if($mode !== "manual"){ ?>
                                            <span id="loys-<?=str_replace(".","-",$packs)?>">
                                            <a id="drop-<?=str_replace(".","-",$packs)?>" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$packs)?>','<?=str_replace(".","-",$packs)?>','each')" data-toggle="modal" data-target=".bs-example-modal-sms">Update Each App</a><br>
                                            <a id="drop-<?=str_replace(".","-",$packs)?>-2" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$packs)?>','<?=str_replace(".","-",$packs)?>','all')" data-toggle="modal" data-target=".bs-example-modal-sms">Update All In Developer</a><br>
                                            <span id="edit-<?=str_replace(".","-",$packs)?>">
                                             <a id="drop-<?=str_replace(".","-",$packs)?>-3" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="go_edit1('<?=$packs?>')" data-toggle="modal" data-target=".bs-example-modal-sms">Edit Post</a>
                                            </span>
                                            </span>
                                            <span id="poys-<?=str_replace(".","-",$packs)?>"></span>
                                        
        <?php }else{ ?>
                                            <span id="loys-<?=str_replace(".","-",$packs)?>">
                                            <a id="drop-<?=str_replace(".","-",$packs)?>" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp2('<?=str_replace(".",".",$packs)?>','<?=str_replace(".","-",$packs)?>','each')" data-toggle="modal" data-target=".bs-example-modal-sms">Update Each App</a><br>
                                            <a id="drop-<?=str_replace(".","-",$packs)?>-2" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp2('<?=str_replace(".",".",$packs)?>','<?=str_replace(".","-",$packs)?>','all')" data-toggle="modal" data-target=".bs-example-modal-sms">Update All In Developer</a><br>
                                            <span id="edit-<?=str_replace(".","-",$packs)?>">
                                             <a id="drop-<?=str_replace(".","-",$packs)?>-3" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="go_edit2('<?=$packs?>')" data-toggle="modal" data-target=".bs-example-modal-sms">Edit Post</a>
                                            </span>
                                            </span>

                                            <span id="poys-<?=str_replace(".","-",$packs)?>"></span>
        <?php }
         } ?>
        </div>
<span id="dina-<?=$pk?>">
    <?php 
        if((@$go_ready == "go")){ ?>
            <a href="javascript:void(0)" class="trash-<?=str_replace(".","-",$show->packid)?>" onClick="del_apps('<?=str_replace(".",".",$show->packid)?>','<?=str_replace(".","-",$show->packid)?>')" style="border:1px #de0303 solid;border-radius:5px;background: #fff;border:1px #de0303 solid;padding: 7px;"><i style="font-size: 15px;color: #de0303" class="fa fa-trash"></i></a>
        <?php }else{ ?>
        <?php if($ceks !== 0){ ?>
            <a href="javascript:void(0)" class="trash-<?=str_replace(".","-",$show->package_name)?>" onClick="del_apps_other('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>')" style="border:1px #de0303 solid;border-radius:5px;background: #fff;border:1px #de0303 solid;padding: 7px;"><i style="font-size: 15px;color: #de0303" class="fa fa-trash"></i></a>
        <?php }else{?>

        <?php } ?>
        <?php }
        ?>
    </span>
    </div>
    <span style="color:#ccc;font-size: 10px;" id="msg-<?=str_replace(".","-",$packs)?>"><?=@$date_ms?></span>
</div>
</li>

<?php }
$noms++;
} ?>
<li id="new-result" style="display: none;"></li>
<?php 

exit;
}


if(isset($_POST['package_name']) and !empty(trim($_POST['package_name'])) ){
        $name = str_replace("-",".",$_POST['package_name']);
        $date = $_POST['date'];
        $cek = explode("/",$date);
        list($y,$m,$d) = $cek;
        
        if($y < date("Y")){
            echo "<invalid/>";
            exit;          
        }
        if($m < date("m")){
            echo "<invalid/>";
            exit;          
        }
        if($d < date("d")){
            echo "<invalid/>";
            exit;          
        }


        $query = connectDB()->Query("SELECT * FROM date_conf WHERE package_name='".$name."' ");
        $row = connectDB()->rowCount($query);
        if($row == 0){
            connectDB()->Query("insert into date_conf (package_name,date) values ('".$name."','".$date."')");
        }else{
            connectDB()->Query("UPDATE date_conf SET date='".$date."' WHERE package_name='".$name."' ");
        }
        exit;
    }


//proses management
if(isset($_POST['del_pack_id']) and !empty(trim($_POST['del_pack_id']))) {
connectDB()->Query("DELETE FROM application WHERE packid='".$_POST['del_pack_id']."' ");
connectDB()->Query("DELETE FROM topapps WHERE packid='".$_POST['del_pack_id']."' ");
connectDB()->Query("DELETE FROM updateapps WHERE packid='".$_POST['del_pack_id']."' ");
exit;
}

$param = getPermalink()->splice(2);
switch ($param) {

    case 'update-application':
    $check = connectDB()->Query("SELECT * FROM application WHERE packid='".POST('appid')."' ");
    $rows = connectDB()->rowCount($check);
    if($rows == 1) $tms = "update";
    else $tms = "";

        $post = get_api_data(POST("appid"),true,'',$tms,true);
        if($post !== false){
            echo "<yeay/>";
            connectDB()->Query("DELETE FROM updateapps WHERE packid='".POST('appid')."'");

            if(POST('act')=="all"){
            foreach($post as $key => $val){
                $check = connectDB()->Query("SELECT * FROM application WHERE packid='".$_POST['bulk_pack_name']."' ");
                $rows = connectDB()->rowCount($check);
                if($rows == 1) $tms = "update";
                else $tms = "";
                get_api_data($val,false,'',$tms,true);
            }
            }
        echo "<yeay/>";
        }else{
            echo "<Gagal/>";
        }



        
    exit;
    break;

}


// page management

require_once(SERVER."/views/adminpanel/header.php");?>
<?php
$param = getPermalink()->splice(2);
switch ($param) {
    case 'login':
        require_once(SERVER."/views/adminpanel/login.php");
        break;
    
    case 'dashboard':
        require_once(SERVER."/views/adminpanel/dashboard.php");
        break;

    case 'post':
        require_once(SERVER."/views/adminpanel/post.php");
    break;

    case 'themes':
        require_once(SERVER."/views/adminpanel/themes.php");
    break;

    case 'advertise':
        require_once(SERVER."/views/adminpanel/advertise.php");
    break;

    case 'manual-post':
        require_once(SERVER."/views/adminpanel/manual-post.php");
    break;
    case 'bulk-post':
        require_once(SERVER."/views/adminpanel/bulk-post.php");
    break;

    
    case 'setting':
        if(getPermalink()->splice(3) == "basic-setting")
        require_once(SERVER."/views/adminpanel/basic-setting.php");
        else if(getPermalink()->splice(3) == "other-setting")
         require_once(SERVER."/views/adminpanel/other-setting.php");
     else require_once(SERVER."/views/adminpanel/permalink-setting.php");
    break;
   
}
?>
<?php require_once(SERVER."/views/adminpanel/footer.php");?>