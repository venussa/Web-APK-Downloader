<div class="main" style="padding-top:20px;">
<?php if((update_checker() == 1) and empty($_SESSION['latters_update'])){ 

        ?>
    <div class="update-notif" style="border:1px #e2e2e3 solid;padding: 20px;background: #edfaec;border-radius: 5px;margin-bottom: 10px;color:#666">
        Good News !, Some Update Was Found. Are you want to update this script now ?
         <span style="float: right;margin-top: -10px;">
          <button onClick="script_update()" style="cursor:pointer;padding: 10px;background: #24cd77;border:1px #24cd77 solid;border-radius: 5px;color:#fff"> Update Now</button> 
        <button onClick="update_latter()" style="cursor:pointer;padding: 10px;background: #f1f1f1;border:1px #e2e2e3 solid;border-radius: 5px;color:#666"> Update Latter</button>
    </span>
    </div>
<?php } ?>
<?php



$bind = connectDB()->bindQuery("SELECT * FROM setting");
foreach($bind as $key => $value);
$binds = connectDB()->bindQuery("SELECT * FROM comment");
foreach($binds as $keys => $values);

?>
<form method="POST" action="" enctype="multipart/form-data">
<div class="right" style="width: 30%">
<div class="box" style="padding:10px;cursor: pointer;">
<h4 style="padding: 5px;padding-left: 0px;margin-bottom: 10px;">Featured Image</h4>
       <input autocomplete="off" type="file" name="image" id="img" class="form-control" style="display: none;">
       <?php if(!empty($value->image)) { ?>
<button id="bts" style="display: none;width:100%;background: transparent;border:1px #ccc solid" type="button" class="btn btn-default" onClick="klik('')"><h1 style="font-size:10em;"><i style="color:#eee" class="ti-camera"></i></h1></button>
    <img style="" onClick="klik('')" id="image_upload_preview" style="border:1px #e2e2e3 solid;border-radius: 5px;" src="<?=$value->image?>" width="100%">
    <?php } else{ ?>
<button id="bts" style="width:100%;background: transparent;border:1px #ccc solid" type="button" class="btn btn-default" onClick="klik('')"><h1 style="font-size:10em;"><i style="color:#eee" class="ti-camera"></i></h1></button>
    <img style="display: none;border:1px #e2e2e3 solid;border-radius: 5px;" onClick="klik('')" id="image_upload_preview" src="<?=$value->image?>" width="100%">

        <?php }?>
</div>
<div class="box" style="padding:10px;">
<?php
$check_mode = implode("",file(SERVER."/views/metaimg.txt"));
if($check_mode == 1){
    $check1 = "checked='true'";
}else{
    $check2 = "checked='true'";
}
?>
<h4 style="color:#666;font-size: 17px;margin-bottom: 10px;margin-top: 10px;">Image Setting</h4>
<div style="border:1px #e2e2e3 solid;border-radius: 5px;padding: 10px;">
<div style="margin-bottom: 10px;">
<input type="checkbox" name="mode_img1" class="cekbox" onclick="cbs(this)" value="1" <?=@$check1?>> Save Image On Server
</div>
<div>
<input type="checkbox" name="mode_img2" class="cekbox" onclick="cbs(this)" value="2" <?=@$check2?>> Hotlink Image
</div>
</div>
</div>
<div class="box" style="padding:10px;">

<h4 style="color:#666;font-size: 17px;margin-bottom: 7px;margin-top: 10px;">Tags / Keyword</h4>
<span id="alert" style="font-size: 10px;color:#ccc">* Please use (,) for spliting keyword</span>
<textarea type="text" id="hide-key" placeholder="Tulis Tag Terkait" name="keyword" onkeyup="return load_keyword(this)" style="color:#666;padding: 6px;border:1px #e2e2e3 solid;width: 95%;height: 100px"><?=siteSetting()->keyword?></textarea>
<div class="tag-result" style="padding-top: 10px;">
    <?php
    $keymeta = explode(",",siteSetting()->keyword);
    foreach($keymeta as $meta => $keyw){ if(!empty(trim($keyw))){ ?>
    <button onClick='return delete_key_data(this)' data='<?=$meta?>' text='<?=$keyw?>' type='button' id='tag-key-<?=$meta?>' style='padding:5px;background:#f5f5f5;color:#666;border:1px #e2e2e3 solid;border-radius:5px;margin-right:3px;margin-bottom:3px;'><?=$keyw?>&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-times' style='color:#666;font-size:11px;' ></i></button>
    <?php } }
    ?>
</div>
</div>
<div class="box">
    <div class="bd">
        <div class="bg-whitse" style="padding: 15px;border-radius: 5px;border:1px #fff solid;">
<h4 style="padding: 5px;padding-left: 0px">Icon</h4>
<br>
<input autocomplete="off" type="file" name="icon" id="imgs" class="form-control" style="display: none;">

<?php if(!empty($value->icon)) { ?>
<button id="btss" style="display:none;width:60px;height:60px;background: transparent;border:1px #ccc solid;cursor: pointer;" type="button" class="btn btn-default" onClick="klik('s')"><h1 style="font-size:2em;"><i style="color:#eee;margin-top: -10px;" class="ti-camera"></i></h1></button>
    <img style="" onClick="klik('s')" id="image_upload_previews" src="<?=$value->icon?>" style="cursor: pointer;" width="60" height="60">

<?php } else{ ?>
<button id="btss" style="cursor: pointer;width:60px;height:60px;background: transparent;border:1px #ccc solid" type="button" class="btn btn-default" onClick="klik('s')"><h1 style="font-size:2em;"><i style="color:#eee;margin-top: -10px;" class="ti-camera"></i></h1></button>
    <img style="display: none;cursor: pointer;" onClick="klik('s')" id="image_upload_previews" src="<?=$value->icon?>" width="60" height="60">
<?php } ?>

<br>
<br>
<h4 style="padding: 5px;padding-left: 0px">Logo Desktop</h4>
<br>
<input autocomplete="off" type="file" name="logo" id="imgss" class="form-control" style="display: none;">

<?php if(!empty($value->logo)) { ?>
<button id="btsss" style="cursor: pointer;display: none;width:100%;background: transparent;border:1px #ccc solid" type="button" class="btn btn-default" onClick="klik('ss')"><h1 style="font-size:5em;"><i style="color:#eee;margin-top: -10px;" class="ti-camera"></i></h1></button>
    <img  onClick="klik('ss')" style="cursor: pointer;" id="image_upload_previewss" src="<?=$value->logo?>" width="100%" height="">
    <?php } else{ ?>
<button id="btsss" style="width:100%;background: transparent;border:1px #ccc solid" type="button" class="btn btn-default" onClick="klik('ss')"><h1 style="font-size:5em;"><i style="color:#eee;margin-top: -10px;" class="ti-camera"></i></h1></button>
    <img  style="display: none;cursor: pointer; " onClick="klik('ss')" id="image_upload_previewss" src="<?=$value->logo?>" width="100%" height="">
        <?php } ?>

    <br>
<br>
<h4 style="padding: 5px;padding-left: 0px">Logo Mobile</h4>
<br>
<input autocomplete="off" type="file" name="logo2" id="imgsss" class="form-control" style="display: none;">

<?php if(!empty($value->logo2)) { ?>
<button id="btssss" style="cursor: pointer;display: none;width:100%;background: transparent;border:1px #ccc solid" type="button" class="btn btn-default" onClick="klik('sss')"><h1 style="font-size:5em;"><i style="color:#eee;margin-top: -10px;" class="ti-camera"></i></h1></button>
    <div style="background: #f1f1f1">
    <img  onClick="klik('sss')" style="cursor: pointer;" id="image_upload_previewsss" src="<?=$value->logo2?>" width="100%" height="">
</div>
    <?php } else{ ?>
<button id="btssss" style="cursor: pointer;width:100%;background: transparent;border:1px #ccc solid" type="button" class="btn btn-default" onClick="klik('sss')"><h1 style="font-size:5em;"><i style="color:#eee;margin-top: -10px;" class="ti-camera"></i></h1></button>
    
    <img  style="display: none;cursor: pointer; " onClick="klik('sss')" id="image_upload_previewsss" src="<?=$value->logo2?>" width="100%" height="">

        <?php } ?>

</div>

</div></div>

</div>




<div class="left" style="width: 68%">
    <div class="box">
 


   <div class="bd" style="margin-bottom: 10px;">
    <div class="bg-white" style="padding: 15px;border-radius: 5px;">
    <h4 style="padding: 5px;padding-left: 0px;font-size: 20px;">Basic Setting</h4>
    <small style="color:#ccc">All of your site basic setting will be save here, don't forget to click save button</small>
    
    <table style="width: 97%;margin-top: 20px;">
    <tr>
        <td style="padding: 5px;width: 150px;"><h4>Heading</h4><br>
        <small style="color:#ccc">* Name identification</small>
    </td>
        <td style="padding: 5px"><input style="border:1px #e2e2e3 solid;padding:10px;width: 100%;" type="" class="form-control" name="sitename" placeholder="sitename ..." value="<?=$value->sitename?>"></td>
    </tr>
    <tr>
        <td style="padding: 5px;width: 150px;"><h4>Sub Heading</h4></td>
        <td style="padding: 5px"> <input style="border:1px #e2e2e3 solid;padding:10px;width: 100%;" type="" class="form-control" name="title" placeholder="Site title ..." value="<?=$value->title?>"></td>
    </tr>
    <tr>
        <td style="padding: 5px;width: 150px;"><h4>Description</h4><br><small style="color:#ccc">* Insert your the ebst description, 160 character recomend</small></td>
        <td style="padding: 5px"><textarea style="border:1px #e2e2e3 solid;padding:10px;width: 100%;height: 100px;" class="form-control" name="description" placeholder="Site description ..."><?=$value->description?></textarea></td>
    </tr>
    <tr>
        <td valign="top" style="padding: 5px;width: 150px;"><h4>Smartplay API Key</h4><br><small style="color:#ccc">* Don't remove if u don't have key backup. it's important</small></td>
        <td style="padding: 5px"> <input style="border:1px #e2e2e3 solid;padding:10px;width: 100%;" type="" class="form-control" name="api" placeholder="Smarplay Api Key" value="<?=$value->api?>">
        
        </td>
    </tr>
    <tr>
        <td style="padding: 5px;width: 150px;"><h4>Facebook Url</h4><br>
        <small style="color:#ccc">* Fanspage, Official Account or Other Page wall</small></td>
        <td style="padding: 5px">  <input style="border:1px #e2e2e3 solid;padding:10px;width: 100%;" type="" class="form-control" name="fb" placeholder="Facebook Fanspage Url ..." value="<?=$value->fb?>"></td>
    </tr>
    <tr>
        <td style="padding: 5px;width: 150px;"><h4>Twitter Url</h4><br><small style="color:#ccc">* Insert your the ebst description, 160 character recomend</small></td>
        <td style="padding: 5px"> <input style="border:1px #e2e2e3 solid;padding:10px;width: 100%;" type="" class="form-control" name="tw" placeholder="Twitter Fanspage Url ..." value="<?=$value->tw?>"></td>
    </tr>
    <tr>
        <td style="padding: 5px;width: 150px;"><h4>Google+ url</h4><br><small style="color:#ccc">* Insert your the ebst description, 160 character recomend</small></td>
        <td style="padding: 5px"><input style="border:1px #e2e2e3 solid;padding:10px;width: 100%;" type="" class="form-control" name="gp" placeholder="Google+ Fanspage Url ..." value="<?=$value->gp?>"></td>
    </tr>
    <tr>
        <td style="padding: 5px;width: 150px;" valign="top"><h4>Comment Widget Code</h4><br><small style="color:#ccc">* Insert your comment widget code like disqus, facebook comment, and other</small></td>
        <td style="padding: 5px"><textarea style="border:1px #e2e2e3 solid;padding:10px;width: 100%;height: 100px;" class="form-control" name="disqus" placeholder="Site description ..."><?=base64_decode($values->status)?></textarea></td>
    </tr>
    <tr>
        <td style="padding: 5px;width: 150px;" valign="top"><h4>Add Snippet Code ( Heading Position )</h4><br><small style="color:#ccc">* For adding Google Analitic, histats, or other widget</small></td>
        <td style="padding: 5px"> <textarea style="border:1px #e2e2e3 solid;padding:10px;width: 100%;height: 200px;" class="form-control" name="snippet1" placeholder="Site description ..."><?=base64_decode(siteSetting()->snippet1)?></textarea></td>
    </tr>
    <tr>
        <td style="padding: 5px;width: 150px;" valign="top"><h4>Add Snippet Code ( Footer Position )</h4><br><small style="color:#ccc">* For adding Google Analitic, histats, or other widget</small></td>
        <td style="padding: 5px"><textarea style="border:1px #e2e2e3 solid;padding:10px;width: 100%;height: 200px;" class="form-control" name="snippet" placeholder="Site description ..."><?=base64_decode(siteSetting()->snippet)?></textarea>
        <br><br>
        
        <hr style="border: transparent;border-bottom: 1px #e2e2e3 solid;" />
        <br>
        <button style="cursor: pointer;background: #24cd77;color:#fff;padding: 10px;width: 200px;border:1px #24cd77 solid" type="submit" value="Save" name="submit" class="btn btn-info">Save Changes</button>
        </td>
    </tr>
     


    </table>
   


</div>
   </div>

      </div>
</div>

</form>
<?php

if(isset($_POST['submit'])){

    if(!empty($_FILES['image']['name'])){
        move_uploaded_file($_FILES['image']['tmp_name'],SERVER."/views/image/".$_FILES['image']['name']);
        $image = "/views/image/".$_FILES['image']['name'];
    }else{
        $image = $value->image;
    }

    if(!empty($_FILES['icon']['name'])){
        move_uploaded_file($_FILES['icon']['tmp_name'],SERVER."/views/image/".$_FILES['icon']['name']);
        $icon = "/views/image/".$_FILES['icon']['name'];            
    }else{
        $icon = $value->icon;
    }

    if(!empty($_FILES['logo']['name'])){
        move_uploaded_file($_FILES['logo']['tmp_name'],SERVER."/views/image/".$_FILES['logo']['name']);
        $logo = "/views/image/".$_FILES['logo']['name'];
    }else{
        $logo = $value->logo;
    }

      if(!empty($_FILES['logo2']['name'])){
        move_uploaded_file($_FILES['logo2']['tmp_name'],SERVER."/views/image/".$_FILES['logo2']['name']);
        $logo2 = "/views/image/".$_FILES['logo2']['name'];
    }else{
        $logo2 = $value->logo2;
    }

    $data = [
        "sitename" => $_POST['sitename'],
        "title" => $_POST['title'],
        "description" => $_POST['description'],
        "fb" => $_POST['fb'],
        "tw" => $_POST['tw'],
        "gp" => $_POST['gp'],
        "api" => $_POST['api'],
        "image" => $image,
        "icon" => $icon,
        "logo" => $logo,
        "logo2" => $logo2,
    ];

    foreach($data as $a => $b){
        if($a !== "logo2"){
        $fill .= $a."='".$b."',";
        }else{
        $fill .= $a."='".$b."'";
        }
    }    

    if(isset($_POST['mode_img1']) or isset($_POST['mode_img2'])){
        if(isset($_POST['mode_img1'])) $configs = 1;
        if(isset($_POST['mode_img2'])) $configs = 2;
        $op = fopen(SERVER."/views/metaimg.txt","w+");
        $fw = fwrite($op, $configs);
        fclose($op);
    }

    if(isset($_POST['keyword'])){
    $op = fopen(SERVER."/views/keyword.txt","w+");
    $fw = fwrite($op, base64_encode($_POST['keyword']));
    fclose($op);
    }

    connectDB()->Query("UPDATE setting SET ".$fill."");
    connectDB()->Query("UPDATE comment SET status='".base64_encode($_POST['disqus'])."' ");
    $op = fopen(SERVER."/views/snippet.txt","w+");
    $fw = fwrite($op, base64_encode($_POST['snippet']));
    fclose($op);
    $op = fopen(SERVER."/views/snippet1.txt","w+");
    $fw = fwrite($op, base64_encode($_POST['snippet1']));
    fclose($op);
    header('location:');

}

?>
</div>