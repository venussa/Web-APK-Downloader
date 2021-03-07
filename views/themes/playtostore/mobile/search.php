<?php
require_once(SERVER."/views/".themeConfig()."part/header.php");?>
<?php require_once(SERVER."/views/".themeConfig()."part/spellcheck.php");?>
<?php 
if(trim(getPermalink()->splice(2)) == ""){
header("location:/");
exit;
}?>
<div class="body-content">
<div style="padding: 10px;padding-top:15px;padding-right: 6px;padding-bottom: 37px">
	<span style="float: left;margin-top:0px;margin-left: -5px"><span class="catag-active" style="padding: 6px"><i class="fa fa-search" style="font-size: 16px"></i> Search Result</span>
	
	</span>
	<span style="float: right;">
	<span class="catag">Keyword : <?=$natural?></span>
	
	</span>
</div>
<div style="padding: 5px;padding-top:0px">	
<?php
if(isset($result_search[0])){
	$resp = 1;
	for ($i = 0; $i < count($result_search); $i++) { 
	$execute1 = @connectDB()->bindQuery("SELECT * FROM application WHERE packid='".$result_search[$i]."' ");
	foreach ($execute1 as $key => $value) { 
	if(!empty($value->title)){
	?>
	<?php
	if($i == 2){
$ads = advertise()->mobile_box;
if(!empty(trim($ads))){
	echo "<div style='margin-top:5px;margin-bottom:5px'>".$ads."</div>";
}
}
?>
<a href="<?=permalink_control($value->packid)?>" style="text-decoration: none;">
<div class="panel panel-default art-ls" ctl="" data="0" cat="<?=$word?>" style="padding: 10px;padding-top: 20px;padding-bottom: 20px;margin-bottom: 5px">
	<table width="100%" style="margin:-15px;margin-left: 0px;">
		<tr>
			<td style="width: 80px;padding: 0px;padding-left: 0px"><img style="border-radius: 5px;" width="100%" data-original="<?=screenshot($value->icon,100)?>" src="/views/themes/playtostore/mobile/img/big.svg"></td>
			<td valign="top" style="padding-left: 10px"><h1 style="font-size: 14px;margin-top: 5px;color: #434343;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?=limitSTR($value->title,25)?></h1>
			<p style="margin-top: -6px;font-size: 12px;color:#666"><?=$value->developer?></p>
			<p style="color:#666;font-size: 12px;margin-top:15px"><?=$value->size?>  <span style="float: right;"><span class="fa fa-star" style="font-size: 10px"></span><?=$value->raiting?></span></p>
			</td>
		</tr>
	</table>
</div>
</a>
<?php } 
}
?>		
<?php
}
?>
<div id="cat-result"></div>
<div id="cat-more" onClick="more_genre(3)" style="text-align: center;padding: 20px;padding-bottom: 10px;"><img src="<?="/views/".themeConfig()."img/ovalo.svg"?>" width="30"></div>
<?php
}else{
$resp = "0";
?>
<div style="padding: 0px;margin-top: -22px">
<div style="background: #fff;border-radius: 5px;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);">
<h1 align="center" style="padding: 45px;padding-bottom: 60px;color:#434343;font-size: 25px">Not Found</h1>
</div>
</div>
<?php
}

?>
</div>
</div>
<?php

require_once(SERVER."/views/".themeConfig()."part/footer.php");?>