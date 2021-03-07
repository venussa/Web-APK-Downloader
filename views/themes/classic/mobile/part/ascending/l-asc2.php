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
$rowCount = @connectDB()->Query($start);
$rowCount = @connectDB()->rowCount($rowCount);    
$get_list = @connectDB()->bindQuery($start." LIMIT ".show_limit_category());
}else{
$start = "SELECT * FROM application WHERE ".$table." < ".POST('page')." and devurl='".POST('cat')."' ".$comand;
$rowCount = @connectDB()->Query($start);
$rowCount = @connectDB()->rowCount($rowCount);    
$get_list = @connectDB()->bindQuery($start." LIMIT ".show_limit_category());
}



?>

	<?php
foreach(@$get_list as $go => $show){ 
    $sum[] = 1;
    $scount = $rowCount;
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
    <a title="<?=$show->title?>" href="<?=permalink_control($show->packid)?>">
        <dt><img src="<?php echo screenshot($show->icon,60)?>" style="display: inline;"></dt>
        <dd class="d1"><?=$show->title?></dd>
        <dd class="d3">
            <div class="stars"><span title="<?=$show->title?> average rating <?=$show->raiting?>" style="width:<?=raitingPersen($show->raiting)?>"></span></div>
        </dd>
    </a>
</li>
<?php }  ?>
<?php 
if($scount > show_limit_category()){
echo "<need/>";
}else{
echo "<noneed/>";
}
?>
<li style="display: none;" id="new-data"></li>
