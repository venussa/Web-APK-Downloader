<?php require_once(SERVER."/views/".themeConfig()."part/header.php");?>
<div class="body-content">
<?php
if(empty(getPermalink()->splice(2)) and (empty(GET('sort'))) ){
if(getPermalink()->splice(1) !== "developer"){
$list = connectDB()->bindQuery("SELECT * FROM category WHERE categori='".getPermalink()->splice(1)."' ORDER BY id DESC LIMIT 10");
$nums = 1;
foreach($list as $list_key => $list_order){ 
$query = @connectDB()->bindQuery("SELECT * FROM application WHERE category1='".$list_order->categori."' and category2='".$list_order->name."' ORDER BY total_raiting DESC LIMIT 10");
if($query){
?>
<?php 
if($nums == 2){
$ads = advertise()->mobile_box;
if(!empty(trim($ads))){
	echo "<div style='margin-top:10px;'>".$ads."</div>";
}
}
?>
<div class="artikel-list art-ls" ctl="" data="<?=$list_order->id?>" cat="<?=$list_order->categori?>" style="height: 240px;overflow: hidden;">
<h2 class="text-head"><?=ucwords($list_order->name)?></h2>
<p class="text-head-desc">Explore The <?=$list_order->name," ".ucwords($list_order->categori)?>  in here</p>
<a href="<?php echo getPermalink()->homeUrl()?>/<?=$list_order->categori?>/<?=$list_order->url?>" class="view-more" style="text-decoration: none;">View More</a>
<div style="overflow-y: scroll;">
<div class="list-container">
<ul class="cont-list">
<?php 
foreach($query as $list_query => $val){
?>
		<li class="cont-list-mem" >
		<a href="<?=permalink_control($val->packid)?>" class="href-wrap" style="text-decoration: none;">
		<img data-original="<?=screenshot($val->icon,100)?>" src="/views/themes/playtostore/mobile/img/big.svg" width="100%" class="icon-img lazy-icon">
		<div class="limit-box" style="height: 47px;overflow: hidden;">
		<h3 style="font-size: 12px"><?=$val->title?></h3>
		</div>
		<small style="color:#a7a8a7" ><?php if(!empty($val->size)) echo manage()->wordLimit($val->size,2); else echo manage()->wordLimit("Varies With Device",2);?></small>
		</a>
	</li>
<?php } ?>
</ul>
</div>
</div>
</div>
<?php 
$nums++;
}
} ?>
<div id="cat-result"></div>
<div id="cat-more" onClick="more_genre(1)" style="text-align: center;padding: 20px;padding-bottom: 10px;"><img src="<?="/views/".themeConfig()."img/ovalo.svg"?>" width="30"></div>
</div>
<?php }else{ ?>

<?php 
$developer = connectDB()->bindQuery("SELECT * FROM developer ORDER BY id ASC LIMIT 15");
$nums = 1;
foreach($developer as $key => $vals){ ?>
<?php
if($nums == 2){
$ads = advertise()->mobile_box;
if(!empty(trim($ads))){
	echo "<div style='margin-top:10px;'>".$ads."</div>";
}
}
?>
<a href="/developer/<?=$vals->dev_url?>" style="text-decoration: none;">
<div style="margin-top: 10px;background: #fff;padding-bottom: 15px;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);" class="art-ls" ctl="" data="<?=$vals->id?>" cat="">
	<img data-original="<?=screenshot($vals->dev_banner,400)?>" src="/views/themes/playtostore/mobile/img/big-lebar.svg" width="100%">
<table width="100%" style="margin-top: 10px">
<tr>
<td style="width: 85px" valign="top">
	<img data-original="<?=screenshot($vals->dev_icon,100)?>" src="/views/themes/playtostore/mobile/img/big.svg" style="width:85px;height: 85px;border-radius: 100%;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);margin-top: 5px;margin-left:15px">
</td>
<td valign="top" style="padding-left: 10px">
	<h3 style="font-size: 16px;margin-top: 5px;color:#434343"><?=$vals->dev_name?></h3>
	<p style="font-size: 14px;color:#434343"><?=limitSTR($vals->dev_short_desc,80)?></p>
</td>
</tr>
</table>
</div>
</a>
<?php 
$nums++;
} ?>
<div id="cat-result"></div>
<div id="cat-more" onClick="more_genre(5)" style="text-align: center;padding: 20px;padding-bottom: 10px;"><img src="<?="/views/".themeConfig()."img/ovalo.svg"?>" width="30"></div>
<?php }
}else{ ?>
<?php
if(empty(GET('sort'))){

	$active1 = "catag-active";
	$active2 = "catag";
	$active3 = "catag";
	$specom = "ORDER BY id DESC";
	$ctl = "1";

}else{
	if(GET('sort') == "new"){
	$active1 = "catag";
	$active2 = "catag-active";
	$active3 = "catag";
	$specom = "ORDER BY time DESC";
	$ctl = "2";
	}elseif(GET('sort') == "rating"){
	$active1 = "catag";
	$active2 = "catag";
	$active3 = "catag-active";
	$specom = "ORDER BY decending DESC";
	$ctl = "3";
	}
}

if(!empty(getPermalink()->splice(2))){
if(getPermalink()->splice(1) !== "developer"){
$froms = connectDB()->Query("SELECT * FROM category WHERE url='".getPermalink()->splice(2)."' ");
$froms = connectDB()->Fetch($froms);
$tit_name = $froms['name'];
$clause = "category2";
$link2 = "/".$froms['url']."/";
}else{
$devs_data = connectDB()->Query("SELECT * FROM developer WHERE dev_url='".getPermalink()->splice(2)."' ");
$devs_data = connectDB()->Fetch($devs_data);
$tit_name = $devs_data['dev_name'];
$clause = "developer";
$link2 = "/".getPermalink()->splice(2)."/";

}
}else{
$tit_name = ucwords(getPermalink()->splice(1));
$clause = "category1";
$link2 = "/";
}


?>

<?php if(getPermalink()->splice(1) == "developer"){ ?>
<img data-original="<?=screenshot($devs_data['dev_banner'],500)?>" src="/views/themes/playtostore/mobile/img/big-lebar.svg" width="100%" style="height:auto">
<center>
		<?php if(!empty($devs_data['dev_icon'])) { ?>
	<img data-original="<?=screenshot($devs_data['dev_icon'],100)?>" src="/views/themes/playtostore/mobile/img/big.svg" style="width: 100px;height:100px;border-radius: 100%;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);margin-top: -80px">
	<?php } ?>
</center>
<div style="background: #fff;padding: 15px;text-align: center;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);margin-top:-20px;margin-bottom: -43px">
	<h1 onClick="close_share()" style="font-size: 20px;color:#434343"><?=$devs_data['dev_name']?> <i style="cursor: pointer;font-size: 15px" class="fa fa-share-alt"></i></h1>		
	<div id="box-shares" style="background: #fff;border-radius: 5px;width: 80%;padding: 10px;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);right: 10%;top:100px;position:fixed;display: none;text-align: center;">
		<span onclick="close_share()" style="float: right;margin-top: -5px"><i style="font-size: 15px;" class="fa fa-times"></i></span>
		
	</div>
	<p style="font-size: 14px" id="bete"><?=limitSTR($devs_data['dev_short_desc'],140)?></p>
	<p style="font-size: 14px;display: none;" id="ate"><?=$devs_data['dev_short_desc']?></p>
	<?php if(strlen($devs_data['dev_short_desc']) > 140){ ?>
	<p id="besow"><a href="javascript:void(0)" onClick="showdev()" style="font-size:14px;text-decoration: none;color: #0ba9c3">View More <i class="fa fa-chevron-down"></i></a></p>
	<?php } ?>
	</div>
<?php } ?>
<div style="padding: 10px;padding-top:15px;padding-right: 6px;padding-bottom: 30px">
	
		<?php
		if(getPermalink()->splice(1) !== "developer"){ ?>
		<span style="float: left;margin-top:0px;margin-left: -5px"><span class="catag-active" style="padding: 6px">
		<i class="fa fa-cube" style="font-size: 16px"></i> 
	<?=$tit_name?></span></span>
	<span style="float: right;">
	<a style="text-decoration: none;" href="/<?=getPermalink()->splice(1)?><?=$link2?>"><span class="<?=$active1?>">Newest</span></a>
	<a style="text-decoration: none;" href="/<?=getPermalink()->splice(1)?><?=$link2?>?sort=new"><span class="<?=$active2?>">Update</span></a>
	<a style="text-decoration: none;" href="/<?=getPermalink()->splice(1)?><?=$link2?>?sort=rating"><span class="<?=$active3?>">Rating</span></a>
	</span>
	<?php }else{?>
		
	<?php } ?>
		
	
	
</div>
<div class="list-detail" style="padding:5px;">
<?php 
if(empty(getPermalink()->splice(2))) {
	$cat_id = getPermalink()->splice(1);
}else{
	if(getPermalink()->splice(1) !== "developer"){
	$cat_id = getPermalink()->splice(2);
	}else{
	$cat_id = getPermalink()->splice(2)."|dev";
	}
}

$list = @connectDB()->bindQuery("SELECT * FROM application WHERE ".$clause."='".strtolower($tit_name)."' ".$specom." LIMIT 15");
if($list){
$nums = 1;
foreach ($list as $key => $value) { 

if(empty(GET('sort'))){
	$attr_id = $value->id;
}else{
	if(GET('sort') == "new"){
		if(empty($value->time)){
			$v = 0;
		}else{
			$v = $value->time;
		}
		$attr_id = $v;
	}elseif(GET('sort') == "rating"){
		$attr_id = $value->decending;
	}
}

	?>
<?php 
if($nums == 2){
$ads = advertise()->mobile_responsive;
if(!empty(trim($ads))){
	echo "<div style='margin-top:5px;margin-bottom:5px'>".$ads."</div>";
}
}
?>
<a href="<?=permalink_control($value->packid)?>" style="text-decoration: none;">
<div class="panel panel-default art-ls" ctl="<?=$ctl?>" data="<?=$attr_id?>" cat="<?=$cat_id?>" style="padding: 10px;padding-top: 20px;padding-bottom: 20px;margin-bottom: 5px">
	<table width="100%" style="margin:-15px;margin-left: 0px;">
		<tr>
			<td style="width: 80px;padding: 0px;padding-left: 0px"><img style="border-radius: 5px;" width="100%" data-original="<?=screenshot($value->icon,100)?>" src="/views/themes/playtostore/mobile/img/big.svg"></td>
			<td valign="top" style="padding-left: 10px"><h1 style="font-size: 14px;margin-top: 5px;color: #434343;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?=limitSTR($value->title,25)?></h1>
			<p style="margin-top: -6px;font-size: 12px;color:#666"><?=$value->developer?></p>
			<p style="color:#666;font-size: 12px;margin-top:15px"><?=$value->size?>  <span style="float: right;"><span class="fa fa-star" style="font-size: 10px"></span> <?=$value->raiting?></span></p>
			</td>
		</tr>
	</table>
</div>
</a>
<?php 
$nums++;
} ?>
<div id="cat-result"></div>
<div id="cat-more" onClick="more_genre(2)" style="text-align: center;padding: 20px;padding-bottom: 10px;"><img src="<?="/views/".themeConfig()."img/ovalo.svg"?>" width="30"></div>
</div>
<?php }else{ ?>
<div style="padding: 0px;margin-top: -22px">
<div style="background: #fff;border-radius: 5px;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);">
<h1 align="center" style="padding: 45px;padding-bottom: 60px;color:#434343;font-size: 25px">Not Found</h1>
</div>
</div>
<?php }
}
require_once(SERVER."/views/".themeConfig()."part/footer.php");?>