<?php


$execute = @connectDB()->bindQuery("SELECT * FROM application WHERE 
        id < ".POST('last_id')." and (title like '%".POST('keyword')."%' or 
        developer like '%".POST('keyword')."%' ) ORDER BY id DESC LIMIT ".show_limit_category());

    foreach($execute as $key => $val){ ?>        
<dl class="search-dl" id="<?=$val->id?>">
    <dt><a title="<?=$val->title?>" target="_blank" href="<?=permalink_control($val->packid)?>">
        <img src="<?=screenshot($val->icon,90)?>" style="display: inline;">
    </a></dt>
    <dd>
        <p class="search-title"><a title="<?=$val->title?>" target="_blank" href="<?=permalink_control($val->packid)?>"><?=$val->title?></a></p>
        <div class="stars"><span title="<?=$val->title?> average rating <?=$val->raiting?>" style="width:<?=raitingPersen($val->raiting)?>"></span></div>
        <p>Developer: <a href="/developer/<?=$val->devurl?>"><?=$val->developer?></a></p>
        <p><a style="background-color: #24cd77" target="_blank" class="more-down" href="<?=permalink_control($val->packid)?>">Read More</a></p>
    </dd>
</dl>
<?php }
?>
<dl id="load_here" style="display: none;"></dl>
<?php
if($execute){
echo "<need/>";
}else{
echo "<noneed/>";
}
?>