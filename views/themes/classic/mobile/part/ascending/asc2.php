        <ul class="box-wrap" id="pagedata">
            <?php 

if(!empty(getPermalink()->splice(2))){
$cek_cat = connectDB()->Query("SELECT * FROM category WHERE url='".getPermalink()->splice(2)."' ");
$cek_cat = connectDB()->Fetch($cek_cat);

$cat2 = "and category2='".$cek_cat['name']."'";
}else{
$cat2 = null;
}

if(empty(GET('sort'))) {
$comand = 'ORDER BY id DESC';
}else{
    if(GET('sort') == 'new')$comand = 'ORDER BY time DESC';
    if(GET('sort') == 'rating') $comand = 'ORDER BY decending DESC';
}
if(getPermalink()->splice(1)!=="developer"){
$start = "SELECT * FROM application WHERE category1='".getPermalink()->splice(1)."' ".$cat2." ".$comand;
$rowCount = @connectDB()->Query($start);
$rowCount = @connectDB()->rowCount($rowCount);
$get_list = @connectDB()->bindQuery($start." LIMIT ".show_limit_category());
}else{
$start = "SELECT * FROM application WHERE devurl='".getPermalink()->splice(2)."' ".$comand;
$rowCount = @connectDB()->Query($start);
$rowCount = @connectDB()->rowCount($rowCount);
$get_list = @connectDB()->bindQuery($start." LIMIT ".show_limit_category());
}

foreach($get_list as $go => $show){
$sum[] = 1;
if(GET('sort')=="rating") {
            $ratings = @$show->decending;
        }else{
if(empty(GET('sort'))) {
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
<li style="display: none;" id="new-data"></li>
            </ul>

              <div class="cl"></div>
    </div>
    
    
        <?php
        if(empty(getPermalink()->splice(2)))$varcat = ""; else $varcat = getPermalink()->splice(2);
        if(empty(GET('sort')))$sort = ""; else $sort = GET('sort');
        if(!empty(GET('sort')) and GET('sort')=="rating") {
            $rating = @$show->raiting;
        }else{
            $rating = @$show->id;
        }
        ?>
        <?php if($rowCount > show_limit_category()){ ?>

        <a class="loadmore" cat="<?=$varcat?>" cat1="<?=getPermalink()->splice(1)?>" sort="<?=$sort?>" page="<?=$ratings?>" onClick="loadmore(this)">Show More</a>
        <?php } ?>



