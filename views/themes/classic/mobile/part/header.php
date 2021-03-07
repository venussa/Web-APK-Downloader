<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=metaData()->title?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta itemprop="name" content="<?=SERVER("HTTP_HOST")?>">   
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="keywords" content="<?=metaData()->keyword?>">
        <meta name="description" content="<?=metaData()->description?>">
        <meta property="og:image" content="<?=str_replace("=s180","=s300",metaData()->image)?>">
        <meta property="og:url" content="<?=getPermalink()->documentUrl()?>">
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="<?=metaData()->title?>" />
        <meta property="og:description"   content="<?=metaData()->description?>" />
        <meta content='follow, all' name='Googlebot-Image'/>
        <meta content='all, index, follow' name='yahoobot'/>
        <meta content='all, index, follow' name='bingbot'/>
        <meta content='follow, all' name='alexabot'/>
        <meta content='follow, all' name='msnbot'/>
        <meta content='Global' name='Distribution'/>
        <meta content='global' name='target'/>
        <meta content='never' name='expires'/>
        <meta content='always' name='revisit'/>
        <meta content='general' name='rating'/>
        <meta content='all' name='audience'/>
        <meta content='follow, all' name='Slurp'/>
        <meta content='follow, all' name='ZyBorg'/>
        <meta content='follow, all' name='Scooter'/>
        <meta content='ALL' name='SPIDERS'/>
        <meta content='ALL' name='WEBCRAWLERS'/>
        <meta content='en' name='language'/>
        <meta content='10' name='pagerank?'/>
        <meta content='no-cache' http-equiv='cache-control'/>
        <meta content='no-cache' http-equiv='pragma'/>
        <meta content='Google, Aeiwi, Alexa, AllTheWeb, AltaVista, AOL Netfind, Anzwers, Canada, DirectHit, EuroSeek, Excite, Overture, Go, HotBot. InfoMak, Kanoodle, Lycos, MasterSite, National Directory, Northern Light, SearchIt, SimpleSearch, WebsMostLinked, WebTop, What-U-Seek, AOL, Yahoo, WebCrawler, Infoseek, Excite, Magellan, LookSmart, CNET, Googlebot' name='search engines'/>  


        <link rel="canonical" href="<?=getPermalink()->documentUrl()?>" />
        <link rel="alternate" href="<?=getPermalink()->documentUrl()?>" hreflang="x-default" />
        <link rel="alternate" href="<?=getPermalink()->documentUrl()?>" hreflang="en" />
        <link rel="alternate" href="<?=getPermalink()->documentUrl()?>" hreflang="pt" />
        <link rel="alternate" href="<?=getPermalink()->documentUrl()?>" hreflang="zh-CN" />
        <link rel="alternate" href="<?=getPermalink()->documentUrl()?>" hreflang="id" />
        <link rel="alternate" href="<?=getPermalink()->documentUrl()?>" media="only screen and (max-width: 640px)" />
        



	<link rel="shortcut icon" href="<?=siteSetting()->icon?>">
    <?php echo manage()->callCSS([
    themeConfig()."css/photoswipe.css",
    ])?>	
  <?php 
    if(empty(getPermalink()->splice(1))){
    require_once(SERVER."/views/".themeConfig()."sheet/css.php");
    }else{
    if(getPermalink()->splice(1) == "game" or getPermalink()->splice(1) == "app" or getPermalink()->splice(1) == "developer"){
    require_once(SERVER."/views/".themeConfig()."sheet/css.php");
    }elseif(getPermalink()->splice(1) == "search"){
    require_once(SERVER."/views/".themeConfig()."sheet/css4.php");
    }else{
    require_once(SERVER."/views/".themeConfig()."sheet/css2.php");
    }
    }
    ?>
    <?=base64_decode(siteSetting()->snippet1)?>
</head>
<body onLoad="return update_start()">

    <div class="shadow" id="shadow" onclick="closeMenu()"></div>
<div class="menu" id="menu">
    <div class="menu-btn menu-btn-close" onclick="closeMenu()">
        <div class="bar_1"></div>
        <div class="bar_2"></div>
        <div class="bar_3"></div>
    </div>
    <div class="menu-body" id="menu-body">
       
        <div class="menu-info">
            <ul class="menu-group menu-border">
                <li>
                    <a href="/">
                        <div class="menu-layer">
                            <span class="menu-icon menu-icon-home"></span>
                            <span class="menu-text">Home</span>
                        </div>
                    </a>
                </li>
                 <li>
                    <a href="/game">
                        <div class="menu-layer">
                            <span class="menu-icon menu-icon-game"></span>
                            <span class="menu-text">Games</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/app">
                        <div class="menu-layer">
                            <span class="menu-icon menu-icon-app"></span>
                            <span class="menu-text">Apps</span>
                        </div>
                    </a>
                </li>
                
            </ul>
        
            <ul class="menu-group">
                <li class="menu-lang-li">
                    <a href="javascript:void(0)" id="change_language">
                        <div class="menu-only-text">Discover</div>
                        <div class="menu-lang menu-lang-down"></div>
                    </a>
                </li>
                
                
                
                <?php
                $sub_cat = @connectDB()->bindQuery("SELECT * FROM category ORDER BY name ASC LIMIT 30");                                    
                foreach ($sub_cat as $key => $cat_name) { ?>
                <li class="menu-locals">
                    <a href="<?php echo getPermalink()->homeUrl()?>/<?=$cat_name->categori?>/<?=urlGen($cat_name->name)?>" class="on" hreflang="en" >
                    <div class="menu-only-text" style="color:#666"> <?=$cat_name->name?></div>
                    </a>
                </li>
                
                <?php }
                ?>

                
               
            </ul>
           
        </div>
    </div>
</div>

<div class="nav" style=""> 
    <div class="n" id="flow-s"  style="">
       <div class="menu-btn" onclick="openMenu()">
            <div class="bar_1"></div>
            <div class="bar_2"></div>
            <div class="bar_3"></div>
        </div>
        <div class="c">
            <ul class="nowrap">
                <li>
                    <a title="<?=siteSetting()->sitename?>" class="logo" href="/"><img style="margin-left: 20px;" src="<?=siteSetting()->logo2?>" height="30"></a></li>
            </ul>
        </div>
        <div class="r">
            <a href="javascript:void(0)" title="Search APK" onClick="s_show()">
                <img src="/views/<?=themeConfig()?>img/menu_search.png" alt="Search APK" width="20px" height="20px" style="margin-left:-10px;">
            </a>
        </div>
    </div>
<div class="n" id="flow-s-h" style="display: none;">
<table width="100%" style="margin-top: -2px;">
    <tr>
        <td style="width: 30px"><button style="border:transparent;background: transparent;" onClick="s_hide()" type="button"><img src="/views/<?=themeConfig()?>img/left.png" alt="Back APK" width="20" height="20" style="margin-left:3px;margin-top:-3px;"></button></td>
        <form class="formsearch" onSubmit="return conf_search(this)">
        <td><input type="text" style="width: 100%;padding: 9px;border: 1px #ccc solid;border:transparent;" onkeyup="go_search(this)" placeholder="Enter App Name, Package Name, Package ID" required="">
<input autocomplete="off" id="slugy" value="<?=getPermalink()->splice(2)?>" style="display: none;">
        </td>
        <td style="width: 60px"><button style="border:transparent;background: transparent;" type="submit"><img src="/views/<?=themeConfig()?>img/menu_search.png" alt="Search APK" width="20" height="20" style="margin-left:27px;margin-top:-3px;"></button></td>
    </form>
    </tr>
</table>
</div> 
</div>
