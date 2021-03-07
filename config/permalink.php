<?php
// call permalink class
use connect\uriconf\permalink;

// creat new method
$permalink = new permalink;

// register permaink
$permalink->declarate_space(array(
	"cusTom" 		 => "detail",//

	"game" 			 => "part/category",
	"app"			 => "part/category",
	"developer"		 => "part/category",

	"loadmore" 		 => "part/loadmore",
	
	"notfound"		 => "",

	"search"		 => "search",

	"start"			 => "force",

	"download"		 => "download",

	"search_more"	 => "part/ascending/more-search",

	"dmca-disclaimer"=> "rules",
	"privacy-police" => "rules",
	"term-of-use"	 => "rules",

	"webmaster"	 => "adminpanel/index",

	"device"		 => "cekdevice",

	"redirect"		 => "redirect",

	"robots.txt" 	=> "robot",
	"sitemap"		=> "robot",
	"sitemap.xml" 	=> "robot",
	"search.json"   => "typehead",
	"schejule" => "schejule",
	"debug" => "debug",
	
	"fb-token" => "token",

),themeConfig(),array("webmaster","device","download","robots.txt","sitemap","sitemap.xml","schejule","debug","fb-token"));