<?php
	$url = "https://www.apkmonk.com/app/com.stove.epic7.google/";
	$data = file_get_contents($url);
	$ex = explode('id="download_button"',$data);
	$link = explode('href="',$ex[1]);
	$link = explode('"',$link[1]);
	$data = file_get_contents($link[0]);
	$down = explode('<script type="text/javascript">',$data);
	$down = explode('</script>',$down[1]);
	$down = $down[0];
	$pkg = explode("$.get('/down_file/',",$down);
	$pkg = explode(").done",$pkg[1]);
	$pkg = $pkg[0];
	$data = json_decode($pkg);
	$build = "https://www.apkmonk.com/down_file/?pkg=".$data->pkg."&key=".$data->key;
	$data = file_get_contents($build);
	$json = json_decode($data);
	echo $json->url;