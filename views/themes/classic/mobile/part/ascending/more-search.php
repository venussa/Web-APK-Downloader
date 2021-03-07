<?php

$try = @connectDB()->Query("SELECT * FROM application WHERE id < ".POST('last_id')." and 
        (title like '%".POST('keyword')."%' or 
        packid like '%".POST('keyword')."%' or 
        description like '%".POST('keyword')."%' or 
        developer like '%".POST('keyword')."%') ORDER BY id DESC");
$check = @connectDB()->rowCount($try);

$execute = @connectDB()->bindQuery("SELECT * FROM application WHERE 
        id < ".POST('last_id')." and (title like '%".POST('keyword')."%' or 
        packid like '%".POST('keyword')."%' or 
        description like '%".POST('keyword')."%' or 
        developer like '%".POST('keyword')."%' ) ORDER BY id DESC LIMIT ".show_limit_category());

    foreach($execute as $key => $val){ ?>        
 <li class="search-dl" id="<?=$val->id?>">
    <dl >
        <a class="dd" href="<?=permalink_control($val->packid)?>">
            <div class="l"><img class="lazy" src="<?=screenshot($val->icon,60)?>"></div>
            <div class="r">
                <p class="p1"><?=$val->title?></p>
                <div class="stars"><span title="<?=$val->title?> average rating <?=$val->raiting?>" style="width:<?=raitingPersen($val->raiting)?>"></span></div>
                <p class="p2"><?=$val->developer?></p>
            </div>
        </a>
    </dl>
</li>
<?php }
?>
<dl id="load_here" style="display: none;"></dl>
<?php
if($check > show_limit_category()){
echo "<need/>";
}else{
echo "<noneed/>";
}
?>