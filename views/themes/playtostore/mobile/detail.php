<?php
if(empty(fetch_apps()->title)){
	require_once(SERVER."/404.php");
	exit;
}
 require_once(SERVER."/views/".themeConfig()."part/header.php");?>
<div class="body-content">
<?php if(empty(GET('dl'))){?>
<div style="background: url(<?=screenshot(json_decode(fetch_apps()->screenshoot) [0],500)?>);background-size: contain;width:100%;height:200px"></div>
<div style="background: url(/views/<?=themeConfig()?>img/bg.png);opacity:0.5;width: 100%;height: 200px;margin-top: -200px"></div>
<?php 
$lims = "margin-top:-60px;";
}?>
<div style="padding: 10px;<?=@$lims?>;position:relative">
<div style="background: #fff;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);padding: 10px;border-radius: 5px">
<?php 
if(!empty(GET('dl'))){ ?>

    <div style="margin-bottom: 10px;">  
    <center>
    <?=advertise()->mobile_responsive?>
</center>
  </div>
    <div class="details" style="padding: 10px;">
    	<center>
            <span style="display: none;" id="hidden-frame"></span>
    <p style="font-size: 20px;" id="tex-please">Downloading ...</p>
    <img data-original="<?=screenshot(fetch_apps()->icon,100)?>" src="/views/themes/playtostore/mobile/img/big.svg" width="100" style="margin-top: 20px;margin-bottom:20px;border-radius: 5px">
    <br><a href="<?=permalink_control(fetch_apps()->packid)?>" style="color:#434343"><label style="font-size: 20px;"><?=fetch_apps()->title?></label></a>
    <p style="color: #0ba9c3;font-size: 17px;margin-top:20px;"><?=GET("id").".apk"?>
        </p>
        <span id="cdn-load"></span>
        <div id="download-btn" style="padding-top: 20px;padding-bottom: 20px;display: none;">
            <?php 
            $color = ["#457fca" => "#fff","#c2e59c" => "#666","#ed8f03" => "#fff","#0ba9c3"=>"#fff"];
            $num = 0;
            foreach($color as $key => $download){
                
            
            
                echo "<span><a id='dl-".$num."' style='text-decoration:none;cursor:pointer;border-radius:5px;box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);padding:5px;background:".array_keys($color)[$num].";border:1px ".array_keys($color)[$num]." solid;margin:5px;color:".$color[array_keys($color)[$num]]."' onClick='download_now(".$num.")' ><span id='lodink-".$num."' style='display:none;'><img src='/views/adminpanel/css/oval.svg' width='18'></span> SERVER ".($num+1)."</a></span>";
                if(($num+1) % 2 == 0) echo "<br><br>";
            
            $num++;
            }
            ?>    
            
        </div>
        <p style="margin-top: 5px;" id="not-load-btn">If download doesn't start, click this <a onClick="show_dial()" style="color: #0ba9c3;text-decoration: none;" href="#download"><span id="loading-down" style="display: none;"><img src="/views/<?=themeConfig()?>img/ovalo.svg" width="20"></span> link</a> to download</p>
</center>
    </div>
      <div style="margin-bottom: 10px;">  
    <center>
    <?=advertise()->mobile_box?>
</center>
  </div>
<?php }elseif(empty(GET('dl'))){ ?>

<table width="100%">
	<tr>
		<td valign="top" style="width: 80px"><img style="border-radius: 5px" data-original="<?=screenshot(fetch_apps()->icon,100)?>" src="/views/themes/playtostore/mobile/img/big.svg" width="100%"></td>
		<td valign="top" style="padding: 10px">
			
			<h3 style="font-size: 15px;color:#434343;margin-top: -10px"><?=fetch_apps()->title?></h3>
			
			<p style="margin-top: -5px"><a style="text-decoration: none;color: #0ba9c3" href="<?=manage()->homeUrl()?>/developer/<?=fetch_apps()->devurl?>"><?=fetch_apps()->developer?></a></p>
			<p style="margin-top: 15px">
			<a href="/<?=(fetch_apps()->category1)?>" style="text-decoration: none;"><span class="catag"><?=fetch_apps()->category1?></span></a>
			<?php
			$ct  = connectDB()->Query("SELECT * FROM category WHERE name='".fetch_apps()->category2."' ");
			$ct = connectDB()->Fetch($ct);
			?>
			<a href="/<?=fetch_apps()->category1?>/<?=$ct['url']?>" style="text-decoration: none;"><span class="catag"><?=fetch_apps()->category2?></span></a>
			</p>
		</td>
	</tr>
</table>
<?php
if(!empty(fetch_apps()->size)){
	$size = fetch_apps()->size;
}else{
	$size = "Varies with device";
}
?>

<?php
$ads = advertise()->mobile_responsive;
if(!empty(trim($ads))){
	echo "<div style='margin-top:0px;'>".$ads."</div>";
}
?>

<a rel="nofollow" href="<?=getPermalink()->documentUrl()?>&dl=1" style="text-decoration: none;"><div class="catag-active" style="margin-top:10px;width: 100%;padding: 2px;text-align: center;"><h4 style="font-size: 14px">Download <?php if(!empty(fetch_apps()->size)) echo "( ".$size." )";?></h4></div></a>
<center style="margin-top: 20px" ><a style="text-decoration: none;color:#434343" href="https://play.google.com/store/apps/details?id=<?=fetch_apps()->packid?>"><small style="padding: 10px">Get It On &nbsp;&nbsp; <img src="/views/<?=themeConfig()?>img/gp_logo.png" width="85" style="margin-top:-2px;"></small></a></center>
<div style="border-top:1px #ccc solid;border-bottom:1px #ccc solid;margin-top: 30px">
	<table width="100%">
		<tr>
		<?php 
		$dl = preg_replace("([,+])","",fetch_apps()->download);
		if($dl > 999){
		if($dl > 999){
		$jmdl = ($dl / 1000)." K";
		}
		if($dl > 999999){
		$jmdl = ($dl / 1000000)." M";
		}
		if($dl > 999999999){
		$jmdl = ($dl / 1000000000)." B";
		}
		}else{
		$jmdl = $dl;
		}


		if(empty(fetch_apps()->raiting)){
			$rtng = rand(1,5)."+";
		}else{
			$rtng = fetch_apps()->raiting;
		}
		$minsdk = trim(preg_replace("([a-z])","",fetch_apps()->minsdk));
		if(is_numeric($minsdk)){
		$minsdk = $minsdk." +";
		}else{
		$minsdk = "-";
		}
		
		?>
			<td style="padding: 5px;text-align: center;width: 33.3%"><h4><?=$minsdk?></h4><p>Requirement</p></td>
			<td style="padding: 5px;text-align: center;width: 33.3%"><h4><?=$rtng?> / 5</h4> <p>Rating</p> </td>
			<td style="padding: 5px;text-align: center;width: 33.3%"><h4><?=$jmdl?></h4><p>Download</p></td>
		</tr>
	</table>
</div>

<div style="margin-top: 10px;overflow-y: scroll;width: 100%">
<div id="ss-box" style="width: 10000px">
	<?php 
	$background_dev = json_decode(fetch_apps()->screenshoot);
	foreach(json_decode(fetch_apps()->screenshoot) as $ay => $img) {
	if($ay > 0){  ?>
	<img class="dns-img" data-original="<?php echo screenshot($img,700)?>" src="/views/themes/playtostore/mobile/img/big-lebar.svg" style="height: 200px">
	<?php }
	}
	?>
</div>
</div>

<div id="art-af" style="margin-top:10px;text-align: center;display: none;">
<?=(fetch_apps()->shortdesc)?>
<p style="margin-top: 20px;"><a href="javascript:void(0)" style="color: #0ba9c3;text-decoration: none;" onClick="show_text()">View More</a></p>
</div>
<div id="art-bef" style="margin-top:10px;padding:1px;padding-top: 0px;border-top:1px #ccc solid;">
<h2 style="margin-bottom: 20px;font-size: 16px;font-weight:600"> The Description Of <?=fetch_apps()->title?></h2>
<?=nl2br(fetch_apps()->description)?>
</div>

<!--ratingbox-->
<div class="rating-box" style="width: 100%;border-top: 1px #ccc solid;padding-top: 20px;padding-bottom: 15px;margin-top:20px;">
	<table width="100%" >
		<tr>
			<td style="width: 150px"><center>
				<p style="font-size: 50px;font-weight: 100;font-family: 'Arial',monospace, sans-serif;color:#666"><?=$rtng?></p>
				<p style="margin-top: -20px;color:#666">
				<?php
				 for($i = 1; $i < 6; $i++){
				 if($i <= (int) $rtng){
				  ?>
				<i class="fa fa-star" style="font-size:13px"></i>
				<?php }elseif(($i <= (int) $rtng +1 ) and is_double((5 - $rtng))) { 
				?>
				<i class="fa fa-star-o" style="font-size:13px;position: absolute;margin-top:3.5px;"></i>
				<i class="fa fa-star-half" style="font-size:13px;margin-right:7px"></i>
				
			<?php }else{ ?>
				<i class="fa fa-star-o" style="font-size:13px"></i>
			<?php }
			} ?>
				</p>
				<p style="color:#666;font-size:12px;"><i class="fa fa-user-circle"></i> <?=number_format(fetch_apps()->total_raiting)?> total</p>
			</center>
			</td>
			
			<td >
				<div>
					<table width="100%" >
						<?php 
						foreach(json_decode(fetch_apps()->list_raiting) as $rat => $valrat){ 
						$persen = (int) str_replace(",", null, $valrat);
						$persen = (($persen / fetch_apps()->total_raiting) * 100)."%";
						$color = [
							5 => "#57bb8a",
							4 => "#9ace6a",
							3 => "#ffcf02",
							2 => "#ff9f02",
							1 => "#ff6f31",
							];
						?>
						<tr>
							<td style="padding: 5px;width: 20px"><?=$rat?></td>
							<td style="width: auto">
								<div style="float:left;width:<?=$persen?>">
									<div style="padding:5px;width: 100%;padding: 3px;background-color: <?=$color[$rat] ?>;color:#fff;text-align: right;height:20px"></div>
								</div>
								
							</td>
							
						</tr>
					<?php } ?>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div>
<!--raingbox-->


<?php 
$ads = advertise()->mobile_box;
if(!empty(trim($ads))){
	echo "<div style='margin-top:10px;'>".$ads."</div>";
}?>
<?php if(!empty(fetch_apps()->whatsnew)){ ?>
                    
                    <div style="margin-top:10px;border-top: 1px #ccc solid;padding: 2px">
					<h4>What Is New</h4>
                    	<?php
                    		echo nl2br((fetch_apps()->whatsnew));
                    	?>

                    </div>
                    <?php } ?>
                   <div style="margin-top:10px;border-top: 1px #ccc solid;padding: 2px;">
                   	<h4>More Information</h4>
                   	<table width="100%">
                   		<tr>
                   			<td style="padding: 2px">Size</td><td style="padding: 2px"> : </td><td style="padding:2px;padding-left: 10px"><?=fetch_apps()->size?></td>
                   		</tr>
                   		<tr>
                   			<td style="padding: 2px">Version </td><td style="padding: 2px"> : </td><td style="padding:2px;padding-left: 10px"><?=fetch_apps()->version?> <a href="javascript:void(0)" onClick="reqUpdate('<?=fetch_apps()->packid?>')" title="request update"><img style="margin-top:-2px;margin-left:5px" src="/views/<?=themeConfig()?>img/requestupdate.png"  height="15"/></a></td>
                   		</tr>
                   		<tr>
                   			<td style="padding: 2px">Developer </td><td style="padding: 2px"> : </td><td style="padding:2px;padding-left: 10px"><a style="color:#0ba9c3;text-decoration: none;" href="<?=manage()->homeUrl()?>/developer/<?=fetch_apps()->devurl?>"><?=fetch_apps()->developer?></a></td>
                   		</tr>
                   		<tr>
                   			<td valign="top" style="padding: 2px">Website </td><td valign="top" style="padding: 2px"> : </td><td style="padding:2px;padding-left: 10px" valign="top"><a target="_blank" style="color:#0ba9c3;text-decoration: none;" href="<?=fetch_apps()->website?>"><?=limitSTR(fetch_apps()->website,50)?></a></td>
                   		</tr>
                   		<tr>
                   			<td style="padding: 2px">Min SDK</td><td style="padding: 2px"> : </td><td style="padding:2px;padding-left: 10px"><?=fetch_apps()->minsdk?></td>
                   		</tr>
                   		<tr>
                   			<td style="padding: 2px">Date Published</td><td style="padding: 2px"> : </td><td style="padding:2px;padding-left: 10px"><?=fetch_apps()->date?></td>
                   		</tr>
                   	</table>
                   </div>
 <?php
       if(!empty(trim(fetch_apps()->youtube))){
                    
                    ?>
        
        <div style="margin-top:10px;border-top: 1px #ccc solid;padding: 2px;">
            <h4>Official Trailer</h4>
            <div id="thumb-you" style="background: #434343;width: 100%;height: 200px;">
            <img data-original="<?=screenshot(json_decode(fetch_apps()->screenshoot)[0],500)?>;" src="/views/themes/playtostore/mobile/img/big-lebar.svg" style="width:100%;height: 150px;margin-top:25px;">

			<div style="text-align: center;margin-top: -110px;margin-bottom:70px;" onClick="play_video()">
			<button style="width: 60px;border: transparent;background: #fff; height: 60px;border-radius: 100%;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);"><i class="fa fa-youtube-play" style="font-size: 30px;color: #d95134"></i></button>
			</div>
			</div>
               <?php echo "<iframe id=\"real-you\" style=\"border:1px transparent solid;display:none;\" src=\"".str_replace("autoplay=1","autoplay=0",fetch_apps()->youtube)."\" width=\"100%\" height=\"200\"></iframe>";?>
            
        </div>
        <?php } ?>
<?php } ?>
<div style="margin-top: 10px;">
<div style="padding-top: 20px">
<div style="height: 240px;overflow: hidden;margin-bottom: 10px;border-top: 1px #ccc solid;padding-top: 15px;">
<h2 style="margin-left: 1px" class="text-head">More From Developer</h2>
<p style="margin-left: 1px" class="text-head-desc">Show more from <?=fetch_apps()->developer?></p>
<a href="<?=manage()->homeUrl()?>/developer/<?=fetch_apps()->devurl?>" class="view-more" style="text-decoration: none;">View More</a>
<div style="background: url(<?php echo screenshot(fetch_apps()->dev_banner,450)?>);background-size:contain">
<div style="background: url(/views/<?=themeConfig()?>img/bg.png);opacity:0.5;width: 100%;height: 500px"></div>
<div style="overflow-y: scroll;margin-left: 0px;margin-top: -500px;position:relative;">
<div class="list-container">
<ul class="cont-list" >
	<li class="cont-list-mem" style="text-align: center;width: 180px;margin-top:5px">
		<a href="<?=manage()->homeUrl()?>/developer/<?=fetch_apps()->devurl?>" class="href-wrap" style="text-decoration: none;text-align: center;">
		<center>
		<?php if(empty(@fetch_apps()->dev_icon)) { ?>
		<div style="width: 60px;height: 60px;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);border-radius: 100%;background: #0ba9c3;padding: 5px;padding-left: 6px;padding-top: 10px;">
		<i class="fa fa-connectdevelop" style="font-size: 40px;color:#fff;"></i>
		</div>
	<?php }else{ ?>
	<img data-original="<?=screenshot(fetch_apps()->dev_icon,150)?>" src="/views/themes/playtostore/mobile/img/big.svg" style="width: 63px;height:63px;border-radius: 5px;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);">
	<?php } ?>
		<div class="limit-box" style="height: 52px;overflow: hidden;">
		<h3 style="font-size: 14px;text-align:center;color:#fff;"><?=limitSTR(strtoupper(fetch_apps()->developer),18)?></h3>
		</div>
		<span href="" style="padding: 5px;background: transparent;color: #fff;border:1px #fff solid;border-radius: 3px;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);">View More</span>

		</center>
		</a>
	</li>
<?php 
$query = connectDB()->bindQuery("SELECT * FROM application WHERE developer='".fetch_apps()->developer."' LIMIT 1");
foreach($query as $list_query => $val){
?>
		<li class="cont-list-mem" >
		<a href="<?=permalink_control($val->packid)?>" class="href-wrap" style="text-decoration: none;">
		<img data-original="<?=screenshot($val->icon,150)?>" src="/views/themes/playtostore/mobile/img/big.svg" width="100%" class="icon-img lazy-icon" style="box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);">
		<div class="limit-box" style="height: 47px;overflow: hidden;">
		<h3 style="font-size: 12px;color:#fff;"><?=$val->title?></h3>
		</div>
		<small style="color:#a7a8a7" ><?php if(!empty($val->size)) echo manage()->wordLimit($val->size,2); else echo manage()->wordLimit("Varies With Device",2);?></small>
		</a>
	</li>
<?php } ?>
</ul>
</div>
</div>
</div>
</div>
<?php


$list_similar = array_unique(json_decode(fetch_apps()->smiliar));
if(!empty($list_similar[0])){

?>
<div style="height: 240px;overflow: hidden;margin-bottom: 10px;border-top: 1px #ccc solid;padding-top: 15px">
<h2 style="margin-left: 1px" class="text-head">Similar or Related</h2>
<p style="margin-left: 1px" class="text-head-desc">Search Related to This App</p>

<div style="overflow-y: scroll;margin-left: -15px">
<div class="list-container">
<ul class="cont-list">
<?php 
foreach ($list_similar as $key1 => $value1) {
if($value1 !== GET('id')){
$query = @connectDB()->bindQuery("SELECT * FROM application WHERE packid='".$value1."' ");
if($query){
foreach($query as $list_query => $val);
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
<?php } 
}
}?>
</ul>
</div>
</div>
</div>
<?php } ?>


<?php 
$ads = advertise()->mobile_box;
if(!empty(trim($ads))){
	echo "<div style='margin-top:20px;margin-bottom:15px'>".$ads."</div>";
}
echo "<div style='border-top:1px #ccc solid;padding-top:10px;padding-bottom:10px'>";
$comment = connectDB()->bindQuery("SELECT * FROM comment");
foreach ($comment as $key => $value) {
	echo base64_decode($value->status);
}
echo "</div>";
?>

</div>
</div>
</div>
</div>
</div>
<?php require_once(SERVER."/views/".themeConfig()."part/footer.php");?>