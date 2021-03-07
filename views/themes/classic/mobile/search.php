<?php
if(empty(trim(getPermalink()->splice(2)))) : header("location:/"); exit; endif;
?>
<?php getFile("part/header") ?>
<span style="color:transparent;display: none;"><?=require_once(SERVER."/views/".themeConfig()."part/spellcheck.php");?></span>
<div class="main">
    
    
    <div class="search-box">
        <div class="info"><span><?=$found?></span> search results found.</div>
        
    
    </div>

    <div class="list">
        <ul id="search-res">
             <?php
    if($response == false){
    echo "<h1 align=\"center\" style=\"padding:200px;color:#666\" >Not Found</h1>";
    }else{
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
} ?>





</ul>
    </div>
    
   
    <?php
       if($found > show_limit_category()){ ?>
        <a class="loadmore" onClick="search_more(this)" keyword="<?=$word?>" href="javascript:void(0)">Show More</a>
        <?php } ?>
        
    
    
</div>
<?php getFile("part/footer") ?>