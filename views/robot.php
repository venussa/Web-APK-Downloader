<?php

function urlset($ault){
	$data = '<url>
		<loc>'.$ault.'</loc>
		<lastmod>'.date("Y-m-d").'</lastmod>
		<changefreq>weekly</changefreq>
		<priority>0.8</priority>
		</url>
		';
	return $data;
}

if(getPermalink()->splice(1) !== "robots.txt") echo '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="/views/main.xsl"?>
';

$limits = 100;
if(getPermalink()->splice(1) == "sitemap.xml"){
header('Content-type: application/xml');
$map[] = '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

	
    $map[] = '
	<sitemap>
    <loc>'.getPermalink()->homeUrl().'/sitemap/default.xml</loc>
    <lastmod>'.date("Y-m-d").'</lastmod>
    </sitemap>
    ';     
	

	
	$select = connectDB()->bindQuery("SELECT * FROM category ORDER BY name ASC");
    foreach($select as $key => $val){
	$date = date("Y-m-d");
	
        
		$query = connectDB()->Query("SELECT * FROM application WHERE category2='".$val->name."' ");
		$scount = connectDB()->rowCount($query);
		
		$partdev = $scount / $limits;
		$limiter = $scount - ((int) $partdev * $limits) ;


		if($scount < $limits){
		$date = date("Y-m-d");        
		$map[] = '
		<sitemap>
	    <loc>'.getPermalink()->homeUrl().'/sitemap/genre/'.$val->url.'_1.xml</loc>
	    <lastmod>'.$date.'</lastmod>
	    </sitemap>
	    ';   
		}else{

		for($i = 1; $i <= (int) $partdev ; $i++){
		$date = date("Y-m-d");        
		$map[] = '
		<sitemap>
	    <loc>'.getPermalink()->homeUrl().'/sitemap/genre/'.$val->url.'_'.$i.'.xml</loc>
	    <lastmod>'.$date.'</lastmod>
	    </sitemap>
	    ';   
		}

		if($limiter < $limits){
		$date = date("Y-m-d");        
		$map[] = '
		<sitemap>
	    <loc>'.getPermalink()->homeUrl().'/sitemap/genre/'.$val->url.'_'.$i.'.xml</loc>
	    <lastmod>'.$date.'</lastmod>
	    </sitemap>
	    ';   
		}
		}
		}
	

$map[] = "</sitemapindex>";

echo implode("",$map);
}elseif(getPermalink()->splice(1) == "sitemap"){
header('Content-type: application/xml');
if(empty(getPermalink()->splice(3))){
if(getPermalink()->splice(2) == "genre.xml"){

$select = connectDB()->bindQuery("SELECT * FROM category ORDER BY name ASC");

$map[] = '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

foreach($select as $key => $val){
$date = date("Y-m-d");
	
        
	$map[] = '
	<sitemap>
    <loc>'.getPermalink()->homeUrl()."/sitemap/genre/".$val->url.'.xml</loc>
    <lastmod>'.$date.'</lastmod>
    </sitemap>
    ';   
}
$map[] = "</sitemapindex>";
echo implode(" ", $map);
}elseif(getPermalink()->splice(2) == "developer.xml"){

$select = connectDB()->Query("SELECT id FROM developer");
$scount = connectDB()->rowCount($select);
$partdev = $scount / $limits;

$map[] = '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

$limiter = $scount - ((int) $partdev * $limits);

if($scount < $limits){
		$date = date("Y-m-d");        
		$map[] = '
		<sitemap>
	    <loc>'.getPermalink()->homeUrl().'/sitemap/developer/developer_1.xml</loc>
	    <lastmod>'.$date.'</lastmod>
	    </sitemap>
	    ';   
}else{

	for($i = 1; $i <= (int) $partdev ; $i++){
		$date = date("Y-m-d");        
		$map[] = '
		<sitemap>
	    <loc>'.getPermalink()->homeUrl().'/sitemap/developer/developer_'.$i.'.xml</loc>
	    <lastmod>'.$date.'</lastmod>
	    </sitemap>
	    ';  
	}
	if($limiter < $limits){
		$date = date("Y-m-d");        
		$map[] = '
		<sitemap>
	    <loc>'.getPermalink()->homeUrl().'/sitemap/developer/developer_'.($i).'.xml</loc>
	    <lastmod>'.$date.'</lastmod>
	    </sitemap>
	    ';  
	}
}


$map[] = "</sitemapindex>";
echo implode(" ", $map);
}elseif(getPermalink()->splice(2) == "default.xml"){
		$urls = [
			getPermalink()->homeUrl(),
			getPermalink()->homeUrl()."/game",
			getPermalink()->homeUrl()."/app",
			getPermalink()->homeUrl()."/developer"
		];
		$map[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0" xmlns:xhtml="http://www.w3.org/1999/xhtml">';
		foreach($urls as $def => $ault){
			
		$map[] = urlset($ault);
	}
	$map[] = "</urlset>";
	echo implode("",$map);
	}
}else{
if(getPermalink()->splice(2) == "developer"){
	$offset = explode("_",$_SERVER['REQUEST_URI']);
	$offset = str_replace(".xml","",$offset[count($offset)-1]);
	$offset = (((int) $offset) - 1) * $limits;
	$bind_dev = connectDB()->bindQuery("SELECT * FROM developer LIMIT $offset,$limits");

	$map[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0" xmlns:xhtml="http://www.w3.org/1999/xhtml">';

	foreach($bind_dev as $key => $val){
	$map[] = urlset(getPermalink()->homeUrl().'/developer/'.$val->dev_url);
	}

$map[] = "</urlset>";
}else{

////////////// genre ////////////////
    
	$vars = explode("/",$_SERVER['REQUEST_URI']);
		$vars = str_replace(".xml","",$vars[count($vars)-1]);
		$under = explode("_",$vars);
		$pure_url = $under[0];
		$under = $under[count($under)-1];
		$ctrl = connectDB()->Query("SELECT * FROM category WHERE url='".$pure_url."'");
		$ctrl = connectDB()->Fetch($ctrl);

		if(getPermalink()->splice(2) == "genre"){
		
		if(is_numeric($under)){
		
		$offset = (((int) $under) - 1) * $limits;		
		
		$bind_dev = connectDB()->bindQuery("SELECT * FROM application WHERE category2='".$ctrl['name']."' LIMIT $offset,$limits");
		$map[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xmlns:mobile="http://www.google.com/schemas/sitemap-mobile/1.0" xmlns:xhtml="http://www.w3.org/1999/xhtml">';

		foreach($bind_dev as $key => $val){
		
		$map[] = urlset(permalink_control($val->packid));

		}
		$map[] = "</urlset>";

		}
}


////////////// genre ////////////////
}
echo implode("",$map);


}
}elseif(getPermalink()->splice(1) == "robots.txt"){
header('Content-Type:text/plain');
$bot = connectDB()->bindQuery("SELECT * FROM setting");	
foreach($bot as $key => $val);
echo $val->robot;
}








