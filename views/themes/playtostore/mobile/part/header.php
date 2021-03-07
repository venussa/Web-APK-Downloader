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
        <meta property="og:site_name" content="<?=SERVER("HTTP_HOST")?>" />
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

	<?php echo 
	manage()->callCSS([
		themeConfig()."css/jquery-ui.min.css",
		themeConfig()."css/font-awesome.min.css",
		themeConfig()."css/bootstrap.min.css",
		themeConfig()."css/bootstrap-theme.min.css",
		themeConfig()."css/style.css?v=2",
	])?>
	<?=base64_decode(siteSetting()->snippet1)?>
</head>
<body>
<?php
if(@getPermalink()->splice(1) == "search"){
	if(!empty(@getPermalink()->splice(2))){
		$dbx = convert_charset()->toUTF8(str_replace("-"," ",@getPermalink()->splice(2)));
		$dsp = "display:none;";
		$dsp1 = "";
	}
}else{
		$dbx = "";
		$dsp1 = "display:none;";
		$dsp = "";
}
?>
<div class="header-background" style="height: 65px;position: fixed;width: 100%;margin-top: 0px;z-index:1">
<div class="panel panel-default panel-header" >
	<table width="100%" id="menu-top">
		<tr>
			<td style="width: 30px;cursor: pointer;" onClick="open_menu()"><i class="fa fa-bars bars-menu" style="font-size: 20px;color:#666"></i></td>
			<td ><h4 onClick="show_search_form()" id="placeholder-form" style="color:#a7a8a7;margin-top:10px;<?=$dsp?>"><?=siteSetting()->sitename?></h4>
			<input type="text" id="hiden-form" onClick="show_search_forms()" onchange="return filter_search(this)" onKeyup="return typehead_search(this)" style="<?=$dsp1?>border: transparent;background: transparent;padding:10px" name="q" value="<?=$dbx?>">
			</td>
			<td style="width: 20px;"><img style="margin-right: 5px;display: none;" class="acn-ss" src="<?="/views/".themeConfig()."img/ovalo.svg"?>" width="20"><i class="fa fa-search icn-ss" style="margin-left: -20px;font-size: 20px;color:#666;"></i></td>
		</tr>
	</table>
</div>
</div>

<div class="header-background-bottom" style="position: fixed;width: 100%;margin-top:65px;z-index:1">
	<table width="100%">
		<tr>
			<?php
			if(!empty(GET('id'))){
			$que = connectDB()->Query("SELECT * FROM application WHERE packid='".GET('id')."' ");
			$que = connectDB()->Fetch($que);
			$dtn = $que['category1'];
			}else{
			$dtn = getPermalink()->splice(1);
			}
			?>
			<td style="<?php if($dtn == "game") echo "border-bottom: 2px #0ba9c3 solid";?>"><a href="/game" style="text-decoration: none" class="href-wrap"><i class="game-icon" style="width: 25px;height: 25px;margin-top:-2px;position: absolute;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);border-radius: 100%"></i> <span style="margin-left:32px">Game</span></a></td>
			<td style="<?php if($dtn == "app") echo "border-bottom: 2px #0ba9c3 solid";?>"><a href="/app" style="text-decoration: none" class="href-wrap"><i class="app-icon" style="width: 25px;height: 25px;margin-top:-2px;position: absolute;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);border-radius: 100%"></i> <span style="margin-left:32px">Apps</span></a></td>
			<td style="<?php if($dtn == "developer") echo "border-bottom: 2px #0ba9c3 solid";?>"><a href="/developer/" style="text-decoration: none" class="href-wrap"><i class="other-icon" style="width: 25px;height: 25px;margin-top:-2px;position: absolute;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);border-radius: 100%"></i> <span style="margin-left:32px">Developer</span></a></td>
		</tr>
	</table>
</div>
<div class="menu-radian-share" onClick="close_share()" style="z-index:1"></div>
<div class="menu-radian" onClick="open_menu()" style="z-index:1"></div>
<div class="content-radian" style="left:-400px;z-index:1">
<div style="background: #0992a8;width: 100%;padding: 10px;padding-bottom: 7px;"><h3 align="left" style="color:#fff;margin-top: 15px;margin-left:0px;" >Menu</h3>
<i class="fa fa-times" onClick="open_menu()" style="color:#fff;float: right;font-size: 20px;margin-top: -33px;margin-right: 5px"></i>
</div>
<ul style="margin-left: -40px;">
	<li style="border-bottom: 1px #f5f5f5 solid;"><a href="/" style="text-decoration: none;color:#4c4b4c">
		<table width="100%">
			<tr>
				<td style="width: 40px"><div style="background: #09f;width: 40px;height:40px;padding: 8px"><i style="color: #fff;font-size: 25px" class="fa fa-home"></i></div></td>
				<td style="padding-left: 10px;"><h5 style="font-size: 16px;color:#4c4b4c">Home</h5></td>
				<td style="width:5px;"><div style="background: #09f;width: 100%;height: 40px;"></div></td>
			</tr>
		</table>
	</a></li>
	<li style="border-bottom: 1px #f5f5f5 solid;"><a href="/game" style="text-decoration: none;color:#4c4b4c">
		<table width="100%">
			<tr>
				<td style="width: 40px"><div style="background: #26d23e;width: 40px;height:40px;padding: 8px"><img style="margin-top:-3px;" width="25" src="/views/themes/playtostore/mobile/img/games.png"></div></td>
				<td style="padding-left: 10px;"><h5 style="font-size: 16px;color:#4c4b4c">Games</h5></td>
				<td style="width:5px;"><div style="background: #26d23e;width: 100%;height: 40px;"></div></td>
			</tr>
		</table>
		</a></li>
		<li style="border-bottom: 1px #f5f5f5 solid;"><a href="/app" style="text-decoration: none;color:#4c4b4c">
		<table width="100%">
			<tr>
				<td style="width: 40px"><div style="background: #e65d19;width: 40px;height:40px;padding: 8px"><img style="margin-top:-3px;" width="25" src="/views/themes/playtostore/mobile/img/apps.png"></div></td>
				<td style="padding-left: 10px;"><h5 style="font-size: 16px;color:#4c4b4c">Apps</h5></td>
				<td style="width:5px;"><div style="background: #e65d19;width: 100%;height: 40px;"></div></td>
			</tr>
		</table>
		</a></li>
		<li style="border-bottom: 1px #f5f5f5 solid;"><a href="/developer/" style="text-decoration: none;color:#4c4b4c">
		<table width="100%">
			<tr>
				<td style="width: 40px"><div style="background: #3b57a0;width: 40px;height:40px;padding: 8px"><i style="color: #fff;font-size: 23px;margin-left: -1.5px" class="fa fa-connectdevelop"></i></div></td>
				<td style="padding-left: 10px;"><h5 style="font-size: 16px;color:#4c4b4c">Developer</h5></td>
				<td style="width:5px;"><div style="background: #3b57a0;width: 100%;height: 40px;"></div></td>
			</tr>
		</table>
	</a></li>
	<?php
	for($i = 1;$i < 20;$i++){ ?>
	<li>
		<table width="100%">
			<tr>
				<td style="width: 40px"><div style="background: #f1f1f1;width: 40px;height:40px;padding: 8px"></div></td>
				<td style="padding-left: 10px;"></td>
				<td style="width:5px;"><div style="background: #f1f1f1;width: 100%;height: 40px;"></div></td>
			</tr>
		</table>
	</li>
<?php } ?>
	
</ul>
</div>
<div class="menu-radians" onClick="show_search_form()" style="z-index:1"></div>
<div class="menu-radians1" style="z-index:1"></div>
<div class="panel panel-default con-res-a" style="position: fixed;top:65px;width: 100%;display: none;width: 92%;left:4%;z-index:1">
	
		<ul style="margin-left: -40px;min-height:auto;max-height: 200px;overflow-y: scroll;" id="result-area">
			
		</ul>
	
</div>
<div style="height: 125px;z-index:1"></div>
<div id="box-shares" style="background: #fff;border-radius: 5px;width: 80%;padding: 10px;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);right: 10%;top:30%;position:fixed;display: none;text-align: center;z-index:1">
		<span onclick="close_share()" style="float: right;margin-top: -5px"><i style="font-size: 12px;font-size: 15px" class="fa fa-times"></i></span>
		<div style="padding-bottom: 20px">
			<h4 style="margin-bottom: 10px">Share It On : </h4>

		<a href="#share" onClick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?=getPermalink()->documentUrl()?>','share','toolbar=0,status=0,width=550,height=400')"><img src="/views/<?=themeConfig()?>img/fbb.png" height="33" width="33" style="border-radius: 5px;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);border-radius: 100%"></a>
       
        <a href="#share" onClick="window.open('https://twitter.com/home?status=<?=getPermalink()->documentUrl()?>','share','toolbar=0,status=0,width=550,height=400')"><img src="/views/<?=themeConfig()?>img/tww.png" height="33" width="33" style="border-radius: 5px;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);border-radius: 100%"></a>
        
        <a href="#share" onClick="window.open('https://plus.google.com/share?url=<?=getPermalink()->documentUrl()?>','share','toolbar=0,status=0,width=550,height=400')"><img src="/views/<?=themeConfig()?>img/gpp.png" height="33" width="33" style="border-radius: 5px;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);border-radius: 100%"></a>
		</div>
	</div>
	<button onClick="close_share()" style="right: 15px;bottom:15px;width: 40px;height: 40px;border-radius:100%;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);border:transparent;background:#0ba9c3;position: fixed;z-index:1"><i style="cursor: pointer;font-size: 22px;color:#fff;margin-left: -2px;" class="fa fa-share-alt"></i></button>