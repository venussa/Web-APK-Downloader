<?php
require_once(SERVER."/views/".themeConfig()."part/header.php");?>
<?php require_once(SERVER."/views/".themeConfig()."part/spellcheck.php");?>
<?php 
if(trim(getPermalink()->splice(2)) == ""){
header("location:/");
exit;
}?>
<div class="body-content col-md-7 col-md-offset-2" style="margin-top: -60px">
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

<a href="<?=permalink_control($value->packid)?>" style="text-decoration: none;">

<div class="panel panel-default art-ls" ctl="" data="0" cat="<?=$word?>" style="padding: 10px;padding-top: 20px;padding-bottom: 20px;margin-bottom: 5px">
	<table width="100%" style="margin:-15px;margin-left: 0px;">
		<tr>
			<td style="width: 120px;padding: 0px;padding-left: 0px"><img style="border-radius: 5px;" width="100%" data-original="<?=screenshot($value->icon,150)?>" src="/views/themes/playtostore/mobile/img/big.svg"></td>
			<td valign="top" style="padding-left: 10px"><b style="font-size: 18px;margin-top: 5px;color: #666;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?=limitSTR($value->title,250)?></b>
			<p style="margin-top: 6px;font-size: 15px;color:#666">Developer : <span style="color:  #0ba9c3"><?=limitSTR($value->developer,200)?></span></p>
			<p style="color:#666;font-size: 15px;margin-top:45px"><?=$value->size?>  <span style="float: right;"><span class="fa fa-star" style="font-size: 15px"></span><?=$value->raiting?></span></p>
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
<div class="col-md-12">
<div id="cat-more" onClick="more_genre(3)" style="text-align: center;padding: 20px;padding-bottom: 10px;"><img src="<?="/views/".themeConfig()."img/ovalo.svg"?>" width="30"></div>
</div>
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
<div class="col-md-3 right-cat-boxs" style="margin-top: -45px">
	  <?php 
  $ads = advertise()->desktop_300_250;
  if(!empty(trim($ads))){
  echo "<div style='margin-top:0px;margin-bottom:20px;' ><center>".$ads."</center></div>";
  }
  ?>
  <H2 style="font-size: 22px;color:#666;margin-bottom: 20px;margin-top:20px;">Populare Genre</H2>
	<div class="panel panel-default" style="border-radius: 0px">
	<ul class="index-category index-category-b cicon" >

                <?php
                $sub_cat = @connectDB()->bindQuery("SELECT * FROM category ORDER BY RAND() LIMIT 20");                                    
                foreach ($sub_cat as $key => $cat_name) { ?>
                <li class="m-cat" style="padding-left: 5px"><a href="<?php echo getPermalink()->homeUrl()?>/<?=$cat_name->categori?>/<?=urlGen($cat_name->name)?>"><i class="<?=urlGen($cat_name->name)?>"></i><?=$cat_name->name?></a></li>  
                <?php }
                ?>
                
            </ul>
    </div>
    <div style="height: 5px"></div>
  <H2 style="font-size: 22px;color:#666;margin-bottom: 20px;margin-top:20px;">Top Developer</H2>
  <a href="/developer" class="view-more" style="text-decoration: none;margin-top:-45px;margin-right:0px;padding: 6px;font-size:13px">View More</a>
  <?php 
$developer = connectDB()->bindQuery("SELECT * FROM developer ORDER BY id ASC LIMIT 5");
$nums = 1;
foreach($developer as $key => $vals){ ?>
<?php 
if($nums == 4){
$ads = advertise()->desktop_300_250;
if(!empty(trim($ads))){
  echo "<div style='margin-top:10px;margin-bottom:10px;'>".$ads."</div>";
}
}
?>
<div>
<a href="/developer/<?=$vals->dev_url?>" style="text-decoration: none;">
<div style="margin-top: 10px;background: #fff;padding-bottom: 15px;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);">
  <img data-original="<?=screenshot($vals->dev_banner,400)?>" src="/views/themes/playtostore/mobile/img/big-lebar.svg" width="100%" height="180">
<table width="100%" style="margin-top: 10px">
<tr>
<td style="width: 85px" valign="top">
  <img data-original="<?=screenshot($vals->dev_icon,100)?>" src="/views/themes/playtostore/mobile/img/big.svg" style="width:85px;height: 85px;border-radius: 100%;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);margin-top: 5px;margin-left:15px">
</td>
<td valign="top" style="padding-left: 10px">
  <div style="height: 100px;overflow: hidden;">
  <h3 style="font-size: 16px;margin-top: 5px;color:#434343"><?=$vals->dev_name?></h3>
  <p style="font-size: 14px;color:#434343"><?=limitSTR($vals->dev_short_desc,80)?></p>
</div>
</td>
</tr>
</table>
</div>
</a>
</div>
<?php 
$nums++;
} ?>
</div>
<?php

require_once(SERVER."/views/".themeConfig()."part/footer.php");?>