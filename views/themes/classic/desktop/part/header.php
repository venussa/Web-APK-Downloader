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
	<?php echo manage()->callCSS([themeConfig()."css/popup.css"])?>
	<?php 
    if(empty(getPermalink()->splice(1))){
    require_once(SERVER."/views/".themeConfig()."sheet/css.php");
    }else{
    if(getPermalink()->splice(1) == "game" or getPermalink()->splice(1) == "app" or getPermalink()->splice(1) == "developer"){
    require_once(SERVER."/views/".themeConfig()."sheet/css3.php");
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

<div class="header">
    <div class="head">
        <div class="logo" style="position: relative;">
            <a title="" href="<?php echo getPermalink()->homeUrl()?>"><img alt="" src="<?=siteSetting()->logo?>" srcset="" width="150"></a>
        </div>
        <div class="top-menu">
            <ul class="nav_menu">
              <li class="nav_menu-item">
                    <div class="top-search">
                        <form class="formsearch" onSubmit="return conf_search(this)">
                            <div class="search-left"><input class="autocomplete" onkeyup="go_search(this)" autocomplete="off" title="Enter App Name, Package Name, Package ID" type="text" size="40" placeholder="Search..." required="">
                            <input autocomplete="off" id="slugy" value="<?=getPermalink()->splice(2)?>" style="display: none;">
                            </div>
                            <div class="search-right"><input class="si" type="submit" value=""></div>
                        </form>
                    </div>
                </li>
                <!-- <li class="nav_menu-item"><a href="javascript:void(0)" class="nav-p"><i class="icon-other"></i> OTHER</a>
                    <ul class="nav_submenu">
                        <li class="nav_submenu-item">
                            <div class="menu_list">
                                <div class="menu_body">
                                    <ul>
                                        <li><a href="<?php echo getPermalink()->homeUrl()?>/last-update">Lastest Update</a></li>
                                        <li><a href="<?php echo getPermalink()->homeUrl()?>/new-update">New Version</a></li>
                                    </ul>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li> -->
               
                <li class="nav_menu-item"><a title="hot android app apk" href="<?php echo getPermalink()->homeUrl()?>/app" class="nav-a"><i class="icon-apps"></i> APPS</a></li>
                <li class="nav_menu-item"><a title="hot android game apk" href="<?php echo getPermalink()->homeUrl()?>/game" class="nav-g"><i class="icon-games"></i> GAMES</a></li>
                 <li class="nav_menu-item"><a href="javascript:void(0)" class="nav-t"><i class="icon-other"></i> DICOVER</a>
                    <ul class="nav_submenu" style="width: 1000px;margin-left: -560px">
                        <li class="nav_submenu-item">
                            <div class="menu_list">
                                <div class="menu_body">
                                	 <ul class="index-category index-category-b cicon" >

                <?php
                $sub_cat = @connectDB()->bindQuery("SELECT * FROM category ORDER BY name ASC LIMIT 30");                                    
                foreach ($sub_cat as $key => $cat_name) { ?>
                <li style="width: 20%;float: left;background: transparent;"><a href="<?php echo getPermalink()->homeUrl()?>/<?=$cat_name->categori?>/<?=urlGen($cat_name->name)?>"><i class="<?=urlGen($cat_name->name)?>"></i><?=$cat_name->name?></a></li>  
                <?php }
                ?>
                
            </ul>
                                 
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

