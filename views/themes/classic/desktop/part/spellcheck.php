<?php
$keyword = getPermalink()->splice(2);
$natural = str_replace("-", " ", $keyword);
$keyword = explode("-",$keyword);
$calculate = count($keyword);

$word = $natural;
$check = connectDB()->Query("SELECT * FROM keyword WHERE name ='".$natural."' ");
$post = connectDB()->Fetch($check);
$check = connectDB()->rowCount($check);
if($check == 0){
	connectDB()->Query("insert into keyword (name,count,rank) values ('".$natural."','1','0')");
}else{
	$rank = @connectDB()->Query("SELECT SUM(count) as count FROM keyword");
	$rank = $rank->fetchColumn();
	connectDB()->Query("UPDATE keyword SET count = (count + 1) , rank = ((count * 100 / ".$rank.") / 10)");
}

$com = "SELECT * FROM application WHERE 
		title like '%".$word."%' or 
		developer like '%".$word."%'";
$execute = @connectDB()->bindQuery($com." ORDER BY id DESC LIMIT ".show_limit_category());
$fond = connectDB()->Query($com);
$found = connectDB()->rowCount($fond);
if($execute){
	$response = true;
}else{
	$response = false;
}
