<?php
if(isset($_POST['acts']) and ($_POST['acts']=="1")){
$command = "SELECT * FROM category WHERE id < ".$_POST['cs']." and categori='".$_POST['cat']."' ORDER BY id DESC LIMIT 10";
$anyone = connectDB()->Query("SELECT * FROM category WHERE id < ".$_POST['cs']." and categori='".$_POST['cat']."' ORDER BY id ASC");
$anyone = connectDB()->rowCount($anyone);
$list = connectDB()->bindQuery($command);
if($anyone !== 0){
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
<?php }else{
	echo "<finish/>";
}
}



////////////////////////////
if(isset($_POST['acts']) and ($_POST['acts']=="5")){ ?>
<?php 
$developer = connectDB()->bindQuery("SELECT * FROM developer WHERE id > ".$_POST['cs']." ORDER BY id ASC LIMIT 15");
$developer_row = connectDB()->Query("SELECT * FROM developer WHERE id > ".$_POST['cs']." ORDER BY id ASC LIMIT 15");
$cr = connectDB()->rowCount($developer_row);
if($cr !== 0){
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
<?php }else{ ?>
<finish/>
<div id="cat-result"></div>
<?php }
}
////////////////////////////////

if(isset($_POST['acts']) and ($_POST['acts']=="2")){

switch ($_POST['ctl']) {
	case "1":
	$specom = "ORDER BY id DESC";
	$clause = "id";
	$ctl = "1";
	break;

	case "2":
	$specom = "ORDER BY time DESC";
	$clause = "time";
	$ctl = "2";
	break;

	case "3":
	$specom = "ORDER BY decending DESC";
	$clause = "decending";
	$ctl = "3";
	break;
	
}
if(($_POST['cat'] == "game") or ($_POST['cat'] == "app")){
$nms = $_POST['cat'];
$claws = "category1";
}else{
$exc = explode("|",$_POST['cat']);

if($exc[1] !== "dev"){
$cls = @connectDB()->Query("SELECT * FROM category WHERE url='".$_POST['cat']."'");
$cls = @connectDB()->Fetch($cls);
$nms = $cls['name'];
$claws = "category2";
}else{
$nms = str_replace("-"," ",$exc[0]);
$claws = "developer";
}
}

$list = @connectDB()->bindQuery("SELECT * FROM application WHERE ".$clause." < ".$_POST['cs']." and ".$claws."='".$nms."' ".$specom." LIMIT 15");
if($list){
$nums = 1;
foreach ($list as $key => $value) { 
switch ($_POST['ctl']) {
	case "1":
	$specom = "ORDER BY id DESC";
	$clause = "id";
	$ctl = "1";
	$by = $value->id;
	break;

	case "2":
	$specom = "ORDER BY time DESC";
	$clause = "time";
	$ctl = "2";
	$by = $value->time;
	break;

	case "3":
	$specom = "ORDER BY decending DESC";
	$clause = "decending";
	$ctl = "3";
	$by = $value->decending;
	break;
	
}
?>
<?php
if($nums == 2){
$ads = advertise()->mobile_responsive;
if(!empty(trim($ads))){
	echo "<div style='margin-top:5px;margin-bottom:5px;'>".$ads."</div>";
}
}
?>
<a href="<?=permalink_control($value->packid)?>" style="text-decoration: none;">
<div class="panel panel-default art-ls" ctl="<?=$ctl?>" data="<?=$by?>" cat="<?=$_POST['cat']?>" style="padding: 10px;padding-top: 20px;padding-bottom: 20px;margin-bottom: 5px">
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
<?php 
$nums++;
}
}else{ 
echo "<finish/>";
} ?>
<div id="cat-result"></div>
<?php }



if(isset($_POST['acts']) and ($_POST['acts']=="3")){ 
$keyword = trim($_POST['cat']);
$natural = str_replace("-", " ", $keyword);
$keyword = explode("-",$keyword);
$calculate = count($keyword);
$word = trim($_POST['cat']);

if(is_file(SERVER."/views/cookie/".$word."-".($_POST['cs']+15).".txt")){
$get = implode("",file(SERVER."/views/cookie/".$word."-".($_POST['cs']+15).".txt"));
$ex = explode(",",$get);
foreach ($ex as $key => $value) {
	if(!empty($value)){
		$result_search[] = $value;		
	}
}

}else{



$dina = app_list_order_search($word,($_POST['cs']+15));
foreach ($dina as $key => $value) {
	$app_check = connectDB()->Query("SELECT * FROM application WHERE packid='".$value->package_name."' ");
	$app_check = connectDB()->rowCount($app_check);
	if($app_check == 0){
	get_api_data($value->package_name,false,"","");
	}
	$result_search[] = $value->package_name;
	$op = fopen(SERVER."/views/cookie/".$word."-".($_POST['cs']+15).".txt","a+");
	$fw = fwrite($op, $value->package_name.",");
	fclose($op);
}
}
?>
<?php
if(isset($result_search[0])){
	$resp = 1;
	for ($i = 0; $i < count($result_search); $i++) { ?>
	<?php
	if($i == 2){
	$ads = advertise()->mobile_box;
	if(!empty(trim($ads))){
		echo "<div style='margin-top:5px;margin-bottom:5px'>".$ads."</div>";
	}
	}
?>
	<?php
	$execute1 = @connectDB()->bindQuery("SELECT * FROM application WHERE packid='".$result_search[$i]."' ");
	foreach ($execute1 as $key => $value) { 
	if(!empty($value->title)){
	?>
<a href="<?=permalink_control($value->packid)?>" style="text-decoration: none;">
<div class="panel panel-default art-ls" ctl="" data="<?=($_POST['cs']+15)?>" cat="<?=$word?>" style="padding: 10px;padding-top: 20px;padding-bottom: 20px;margin-bottom: 5px">
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
<?php
}else{
$resp = "0";
echo "<finish/>";
}

?>

<?php }
?>
