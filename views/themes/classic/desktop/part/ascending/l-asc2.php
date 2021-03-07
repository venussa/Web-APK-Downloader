<?php
if(!empty(POST('cat'))){
$cat2 = "and category2='".POST('cat')."'";
}else{
$cat2 = null;
}
if(empty(POST('sort'))) {
$comand = 'ORDER BY id DESC';
}else{
    if(POST('sort') == 'new')$comand = 'ORDER BY time DESC';
    if(POST('sort') == 'rating') $comand = 'ORDER BY decending DESC';
}

if(POST('sort')=='rating'){
$table = "decending";
}else{
if(empty(POST('sort'))){
$table = "id";
}else{
$table = "time";
}
}

if(POST('cat1')!=="developer"){
$start = "SELECT * FROM application WHERE ".$table." < ".POST('page')." and category1='".POST('cat1')."' ".$cat2." ".$comand;

$get_list = @connectDB()->bindQuery($start." LIMIT ".show_limit_category());
}else{
$start = "SELECT * FROM application WHERE ".$table." < ".POST('page')." and devurl='".POST('cat')."' ".$comand;
  
$get_list = @connectDB()->bindQuery($start." LIMIT ".show_limit_category());
}

if($get_list){
    $respi = 1;
}else{
    $respi = 0;
}

?>

	<?php
foreach(@$get_list as $go => $show){ 
    $sum[] = 1;
    
	if(POST('sort')=="rating") {
            $rating = @$show->decending;
        }else{
if(empty(POST('sort'))) {
$last_id = @$show->id;
}else{
$last_id = @$show->time;
}
        }
 ?>

<li class="reglist" id="<?=$last_id?>">
    <div class="category-template-img">
        <a title="<?=$show->title?>" target="_blank" href="<?=permalink_control($show->packid)?>">
           <img class="lazy" src="<?php echo screenshot($show->icon,90)?>" style="display: inline;"></a>
        </div>
    <div class="category-template-title">
        <a target="_blank" title="<?=$show->title?>" href="<?=permalink_control($show->packid)?>"><?=$show->title?></a>
    </div>
    <div class="stars" style="margin: 0 auto;">
        <span title="<?=$show->title?> average rating <?=$show->raiting?>" style="width:<?=raitingPersen($show->raiting)?>"></span>
    </div>
    <div class="category-template-down">
        <a rel="nofollow" class="" title="Download <?=$show->title?>" href="<?=permalink_control($show->packid)?>">Download APK</a>
    </div>
</li>
<?php }  ?>
<?php 
if($respi == 1){
echo "<need/>";
}else{
echo "<noneed/>";
}
?>
<li style="display: none;" id="new-data"></li>
