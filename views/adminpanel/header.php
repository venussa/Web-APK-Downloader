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
        <meta property="og:image" content="<?=metaData()->image?>">
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
        


    <style>
        .pil-gen:hover{
            background: #24cd77;
            color:#fff;
        }
        .pil-gen{
            background: #fff;
            color:#666;
        }
    </style>
	<link rel="shortcut icon" href="<?=siteSetting()->icon?>">
    <link rel="stylesheet" href="/views/adminpanel/css/font-awesome.min.css">
    <link rel="stylesheet" href="/views/adminpanel/js/jui/jquery-ui.min.css">
	<?php echo manage()->callCSS([themeConfig()."css/popup.css","adminpanel/css/taginput.css"])?>
	<?php if(getPermalink()->splice(2) == "post"){
        require_once(SERVER."/views/themes/classic/desktop/sheet/css3.php");
    }else{
        require_once(SERVER."/views/themes/classic/desktop/sheet/css.php");
    }
    ?>
</head>
<body>
<div class="tempat">
    <div id="ngisi">
<div class="header">
    <div class="head" >
        <div class="logo" style="position: relative;">
            <a title="" href="<?php echo getPermalink()->homeUrl()?>"><img alt="" src="<?=siteSetting()->logo?>" srcset="" width="150"></a>
        </div>
        <?php if(!empty($_SESSION['username'])){ ?>
        <div class="top-menu">
            <ul class="nav_menu">
            
               
                 <li class="nav_menu-item" <?php if(getPermalink()->splice(2) == "setting") { ?>style="background: #f5f5f5;border-top:2px  #24cd77 solid;" <?php } ?>><a href="javascript:void(0)" ><i class="fa fa-cogs" style="font-size: 25px;color: #24cd77"></i> SETTING</a>
                    <ul class="nav_submenu" style="width: 200px;margin-left: -10px;padding: 0px;">
                        <li class="nav_submenu-item"  style="padding: 0px;">
                            <div class="menu_list"  style="padding: 0px;">
                                <div class="menu_body" style="padding: 0px;">
                                	 <ul class="index-category index-category-b cicon" >
                                      <li style="width: 100%;background: transparent;">
                                        <a data-pjax="ngisi" href="/webmaster/setting/basic-setting"><b>BASIC SETTING</b></a>
                                    </li>    
                                    <li style="width: 100%;background: transparent;">
                                        <a data-pjax="ngisi" href="/webmaster/setting/other-setting"><b>PRIMARY PAGE</b></a>
                                    </li>   
                                    <li style="width: 100%;background: transparent;">
                                        <a data-pjax="ngisi" href="/webmaster/setting/permalink"><b>PERMALINK</b></a>
                                    </li>    
                                    <li style="width: 100%;background: transparent;">
                                        <a href="?log=out"><b>LOGOUT</b></a>
                                    </li>    
                                     </ul>
                                 
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="nav_menu-item" <?php if(getPermalink()->splice(2) == "advetise") { ?>style="background: #f5f5f5;border-top:2px  #24cd77 solid;" <?php } ?>><a data-pjax="ngisi" href="/webmaster/advertise" ><i class="fa fa-flag" style="font-size: 25px;color: #24cd77"></i> ADVERTISE</a></li>
                <li class="nav_menu-item" <?php if(getPermalink()->splice(2) == "themes") { ?>style="background: #f5f5f5;border-top:2px  #24cd77 solid;" <?php } ?>><a data-pjax="ngisi" href="/webmaster/themes" ><i class="fa fa-th-list" style="font-size: 25px;color: #24cd77"></i> THEMES</a></li>


                <li class="nav_menu-item" <?php if((getPermalink()->splice(2) == "post") or (getPermalink()->splice(2) == "manual-post")) { ?>style="background: #f5f5f5;border-top:2px  #24cd77 solid;" <?php } ?>><a href="javascript:void(0)" ><i class="fa fa-paper-plane" style="font-size: 25px;color: #24cd77"></i> POST</a>
                    <ul class="nav_submenu" style="width: 200px;margin-left: -10px;padding: 0px;">
                        <li class="nav_submenu-item"  style="padding: 0px;">
                            <div class="menu_list"  style="padding: 0px;">
                                <div class="menu_body" style="padding: 0px;">
                                     <ul class="index-category index-category-b cicon" >
                                      <li style="width: 100%;background: transparent;">
                                        <a data-pjax="ngisi" href="/webmaster/post"><b>APP EXPLORE</b></a>
                                    </li>    
                                    <li style="width: 100%;background: transparent;">
                                        <a data-pjax="ngisi" href="/webmaster/manual-post"><b>MANUAL POST</b></a>
                                    </li>    
                                    <li style="width: 100%;background: transparent;">
                                        <a data-pjax="ngisi" href="/webmaster/bulk-post"><b>BULK POST</b></a>
                                    </li>   

                                     </ul>
                                 
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>


                <li class="nav_menu-item" <?php if(getPermalink()->splice(2) == "dashboard") { ?>style="background: #f5f5f5;border-top:2px  #24cd77 solid;" <?php } ?>><a data-pjax="ngisi" href="/webmaster/dashboard" ><i class="fa fa-dashboard" style="font-size: 25px;color: #24cd77"></i> DASHBOARD</a></li>
            </ul>
        </div>
        <?php } ?>
    </div>
</div>

