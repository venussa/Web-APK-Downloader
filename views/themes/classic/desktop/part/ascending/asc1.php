<ul class="category-template" id="pagedata">
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

$get_list = @connectDB()->bindQuery($start." LIMIT ".show_limit_category());
}else{
$start = "SELECT * FROM application WHERE devurl='".getPermalink()->splice(2)."' ".$comand;
$get_list = @connectDB()->bindQuery($start." LIMIT ".show_limit_category());
}

foreach($get_list as $go => $show){
$sum[] = 1;
if(GET('sort')=="rating") {
            $ratings = @$show->decending;
            $last_id = @$show->decending;
        }else{
if(empty(GET('sort'))) {
$last_id = @$show->decending;
}else{
$last_id = @$show->decending;
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
<li style="display: none;" id="new-data"></li>
            </ul>

            <div class="clear"></div>
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
        
        <a class="loadmores" cat="<?=$varcat?>" cat1="<?=getPermalink()->splice(1)?>" sort="<?=$sort?>" page="<?=$ratings?>" onClick="loadmore(this)">Show More</a>
        