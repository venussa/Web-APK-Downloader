<?php getFile("part/header") ?>
<div class="header">
    
    <div id="slideBox" class="slideBox">
    
    
    <div class="bd">
        <div class="tempWrap" style="overflow:hidden; position:relative;">
            <ul style="width: 2800px; position: relative; overflow: hidden; padding: 0px; margin: 0px; transition-duration: 0ms; transform: translate(-400px, 0px) translateZ(0px);">
                <?php 
                $bind = @connectDB()->bindQuery("SELECT * FROM application WHERE category1='game' ORDER BY rank DESC LIMIT 5");
                foreach($bind as $key => $val) { 
                $ss = json_decode($val->screenshoot);
                    ?>
                <li style="display: table-cell; vertical-align: top; width: 400px;">
                    <a title="<?=$val->title?>APK" href="<?=permalink_control($val->packid)?>">
                       <div class="lazygb_banner" style="display: block; background-image: url(<?=screenshot($ss[0],450)?>);">
                       </div>
                        
                            
                    </a>
                </li>
<?php } ?>
            </ul></div>
    </div>
    <div class="bg"></div>
    <div class="hd" style="margin-top: 10px;">
        <ul><li class="on">1</li><li class="">2</li><li class="">3</li><li class="">4</li><li class="">5</li></ul>
    </div>
    
</div>
    <div class="navigation">
        <ul>
            <li>
                <a href="/game">
                    <div class="icon" style="background: #F2B258;"><img src="/views/<?=themeConfig()?>img/games.png" width="20"></div>
                    <div class="text">Hot Games</div>
                </a>
            </li>
            <li>
                <a href="/app">
                    <div class="icon" style="background: #FA8484;"><img src="/views/<?=themeConfig()?>img/apps.png" width="20"></div>
                    <div class="text">Hot Apps</div>
                </a>
            </li>
            <li>
                <a href="/game/?sort=new">
                    <div class="icon" style="background: #5EC9F3"><img src="/views/<?=themeConfig()?>img/category.png" width="20"></div>
                    <div class="text">Update</div>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="indexmain">
    <div style="margin-bottom: 10px;">  
    <center>
    <?=advertise()->mobile_responsive?>
</center>
  </div>
    <div class="box-title">
        <div class="tit1"><span class="gbg"></span> Games</div>
        <div class="more"><a href="/game">More</a><span class="arrow-right"></span></div>
    </div>
    <div class="cl"></div>
    
<div class="box" style=" overflow: hidden">
    <div class="box-scroll">
        <div class="bs-s" style="transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; transform: translate(0px, 0px) translateZ(0px);">
<?php
$bind = @connectDB()->bindQuery("SELECT * FROM application WHERE category1='game' ORDER BY id DESC LIMIT 10");
foreach($bind as $key => $val){ 
?>
            <a title="<?=$val->title?>" href="<?=permalink_control($val->packid)?>">
    <dl>
        <dt><img class="lazy1" data-original="<?=screenshot($val->icon,60)?>" src="/views/<?=themeConfig()?>img/big.svg" style="display: inline;"></dt>
        <dd class="d1"><?=$val->title?></dd>
        <dd class="d3">
            <div class="stars"><span title="<?=$val->title?> average rating <?=$val->raiting?>" style="width:<?=raitingPersen($val->raiting)?>"></span></div>
        </dd>
    </dl>
</a>
<?php } ?>

        </div>
    </div>
    <div class="box-scroll-l"></div>
</div>

    <div class="box-title">
        <div class="tit1"><span class="abg"></span> Apps</div>
        <div class="more"><a href="/app">More</a><span class="arrow-right"></span></div>
    </div>
    <div class="cl"></div>
    
<div class="box" style=" overflow: hidden">
    <div class="box-scroll">
        <div class="bs-s" style="transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; transform: translate(0px, 0px) translateZ(0px);">
<?php
$bind = @connectDB()->bindQuery("SELECT * FROM application WHERE category1='app' ORDER BY id DESC LIMIT 10");
foreach($bind as $key => $val){ 
?>
            <a title="<?=$val->title?>" href="<?=permalink_control($val->packid)?>">
    <dl>
        <dt><img class="lazy1" data-original="<?=screenshot($val->icon,60)?>" src="/views/<?=themeConfig()?>img/big.svg" style="display: inline;"></dt>
        <dd class="d1"><?=$val->title?></dd>
        <dd class="d3">
            <div class="stars"><span title="<?=$val->title?> average rating <?=$val->raiting?>" style="width:<?=raitingPersen($val->raiting)?>"></span></div>
        </dd>
    </dl>
</a>
<?php } ?>

        </div>
    </div>
    <div class="box-scroll-l"></div>
</div>
<div style="margin-bottom: 10px;margin-top:10px;">  
    <center>
    <?=advertise()->mobile_responsive?>
</center>
  </div>

    <div class="box-title">
        <div class="tit1"><span class="tbg"></span> Update Games</div>
        <div class="more"><a href="/game/?sort=new">More</a><span class="arrow-right"></span></div>
    </div>
    <div class="cl"></div>
    
<div class="box" style=" overflow: hidden">
    <div class="box-scroll">
        <div class="bs-s" style="transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; transform: translate(0px, 0px) translateZ(0px);">
<?php
$bind = @connectDB()->bindQuery("SELECT * FROM application WHERE category1='game' ORDER BY time DESC LIMIT 10");
foreach($bind as $key => $val){ 
?>
            <a title="<?=$val->title?>" href="<?=permalink_control($val->packid)?>">
    <dl>
        <dt><img class="lazy1" data-original="<?=screenshot($val->icon,60)?>" src="/views/<?=themeConfig()?>img/big.svg" style="display: inline;"></dt>
        <dd class="d1"><?=$val->title?></dd>
        <dd class="d3">
            <div class="stars"><span title="<?=$val->title?> average rating <?=$val->raiting?>" style="width:<?=raitingPersen($val->raiting)?>"></span></div>
        </dd>
    </dl>
</a>
<?php } ?>

        </div>
    </div>
    <div class="box-scroll-l"></div>
</div>

    <div class="box-title">
        <div class="tit1"><span class="tbg"></span> Update Apps</div>
        <div class="more"><a href="/app/?sort=new">More</a><span class="arrow-right"></span></div>
    </div>
    <div class="cl"></div>
    
<div class="box" style=" overflow: hidden">
    <div class="box-scroll">
        <div class="bs-s" style="transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; transform: translate(0px, 0px) translateZ(0px);">
<?php
$bind = @connectDB()->bindQuery("SELECT * FROM application WHERE category1='app' ORDER BY time DESC LIMIT 10");
foreach($bind as $key => $val){ 
?>
            <a title="<?=$val->title?>" href="<?=permalink_control($val->packid)?>">
    <dl>
        <dt><img class="lazy1" data-original="<?=screenshot($val->icon,60)?>" src="/views/<?=themeConfig()?>img/big.svg" style="display: inline;"></dt>
        <dd class="d1"><?=$val->title?></dd>
        <dd class="d3">
            <div class="stars"><span title="<?=$val->title?> average rating <?=$val->raiting?>" style="width:<?=raitingPersen($val->raiting)?>"></span></div>
        </dd>
    </dl>
</a>
<?php } ?>

        </div>
    </div>
    <div class="box-scroll-l"></div>
</div>
 
    <div class="box" style="overflow: hidden;display: none;">
    <div class="index-topic-wrap">
        <div class="index-scroll-topic-wrap" style="transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; transform: translate(0px, 0px) translateZ(0px);">
   
        </div>
    </div>
</div>



    <div class="ad-box" style="max-width: 640px; margin: 0 auto 10px auto;">
        
    </div>
</div>
<?php getFile("part/footer") ?>
