<?php require_once(SERVER."/views/".themeConfig()."part/header.php");?>
<div class="body-content">
<!-- courasel -->
 <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol style="display: none;" class="carousel-indicators">
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
    <div style="background: rgba(0,0,0.9,0.5);width: 100%;height: 250px;position: absolute;opacity: 0.4"></div>

      <img src="<?=screenshot(json_decode($vals->screenshoot)[0],300)?>" alt="<?=$vals->title?>" style="width:100%;height:200px">
      <div class="carousel-caption">
        <h3 style="font-size:18px;"><?=$vals->title?></h3>
        <p style="font-size:11px;"><?=htmlspecialchars_decode($vals->shortdesc)?></p>
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
if($list_key == 2){
$ads = advertise()->mobile_responsive;
if(!empty(trim($ads))){
	echo "<div style='margin-top:10px;'>".$ads."</div>";
}
}
if($list_key == 5){
$ads = advertise()->mobile_box;
if(!empty(trim($ads))){
	echo "<div style='margin-top:10px;'>".$ads."</div>";
}
}
?>
<div class="artikel-list" style="height: 240px;overflow: hidden;">
<h2 class="text-head"><?=$list_order[2]." ".ucwords($list_order[0])?></h2>
<p class="text-head-desc">Explore The <?=$list_order[2]." ".$list_order[0]?>  in here</p>
<a href="<?="/".$list_order[0]."/".$list_order[3]?>" class="view-more" style="text-decoration: none;">View More</a>
<div style="overflow-y: scroll;">
<div class="list-container">
<ul class="cont-list">
<?php 
$query = connectDB()->bindQuery("SELECT * FROM application WHERE category1='".$list_order[0]."' ".$list_order[1]." LIMIT 10");
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
<?php } ?>

</div>
<?php require_once(SERVER."/views/".themeConfig()."part/footer.php");?>