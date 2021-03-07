<?php require_once(SERVER."/views/".themeConfig()."part/header.php");?>
<div class="body-content col-md-7 col-md-offset-2" style="position: static;margin-top: -25px">
<div style="margin-top:-25px;margin-bottom: 10px">
 

 <!-- courasel -->
 <div  id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators" style="display: none;">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
    <li data-target="#myCarousel" data-slide-to="4"></li>
  </ol>

  <!-- Wrapper for slides -->
<div class="carousel-inner">
  	<?php 
        $num = 1;
        
				$developer = connectDB()->bindQuery("SELECT * FROM application WHERE category1='game' ORDER BY total_raiting DESC LIMIT 5 ");
				foreach($developer as $key => $vals){ ?>

	 
    <div class="item <?php if($key == 0) echo 'active'?>">
   <a href="<?=permalink_control($vals->packid)?>" style="text-decoration: none;">
    <div style="background: rgba(0,0,0.9,0.5);width: 100%;height: 400px;position: absolute;opacity: 0.4"></div>

      <img src="/views/themes/playtostore/mobile/img/big.svg" data-original="<?=screenshot(json_decode($vals->screenshoot)[0],600)?>" alt="<?=$vals->title?>" style="width:100%;height:400px">
      <div class="carousel-caption">
        <h3><?=$vals->title?></h3>
        <p><?=htmlspecialchars_decode($vals->shortdesc)?></p>
      </div>
  </a>
    </div>

            <?php $num++; } ?>
</div>
  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

        <!-- /courasel -->    
           
</div>
<?php
$list = [
	
	"1" => ["game","ORDER BY total_raiting DESC","Populare","?sort=rating"],
	"2" => ["app","ORDER BY total_raiting DESC","Populare","?sort=rating"],
	"3" => ["game","ORDER BY id DESC","Newest",""],
	"4" => ["app","ORDER BY id DESC","Newest",""],
	"5" => ["game","ORDER BY time DESC","Latest Update","?sort=new"],
	"6" => ["app","ORDER BY time DESC","Latest Update","?sort=new"],
];
foreach($list as $list_key => $list_order){ 
if(($list_key == 2) or ($list_key == 5)){
$ads = advertise()->desktop_720_90;
if(!empty(trim($ads))){
	echo "<div style='margin-top:10px;margin-bottom:10px;' class='col-md-12'><center>".$ads."</center></div>";
}
}

?>
<div class="artikel-list" style="height: auto;overflow: hidden;">
<h2 class="text-head"><?=$list_order[2]." ".ucwords($list_order[0])?></h2>
<p class="text-head-desc">Explore The <?=$list_order[2]." ".$list_order[0]?>  in here</p>
<a href="<?="/".$list_order[0]."/".$list_order[3]?>" class="view-more" style="text-decoration: none;margin-top:-70px;margin-right:-8px">View More</a>
<div >
<div class="list-container">
<ul class="cont-list" >
<?php 
$query = connectDB()->bindQuery("SELECT * FROM application WHERE category1='".$list_order[0]."' ".$list_order[1]." LIMIT 12");
foreach($query as $list_query => $val){
?>
		<li class="cont-list-mem" style="padding: 10px;padding-left: 0px;padding-right: 2%">
		<div class="app-box">
		<a href="<?=permalink_control($val->packid)?>" class="href-wrap" style="text-decoration: none;">
		<img data-original="<?=screenshot($val->icon,150)?>" src="/views/themes/playtostore/mobile/img/big.svg" width="100%" class="icon-img lazy-icon">
		<div class="limit-box" style="height: 49px;overflow: hidden;">
		<h3 style="font-size: 13px"><?=$val->title?></h3>
		</div>
		<small style="color:#a7a8a7" ><?php if(!empty($val->size)) echo manage()->wordLimit($val->size,2); else echo manage()->wordLimit("Varies With Device",2);?></small>
		</a>
	</div>
	</li>
<?php } ?>
</ul>
</div>
</div>
</div>
<?php } ?>
</div>
<div class="col-md-3" style="margin-top: -50px">
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
<?php require_once(SERVER."/views/".themeConfig()."part/footer.php");?>