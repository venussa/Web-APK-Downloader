<?php



$keyword = trim(getPermalink()->splice(2));
$natural = str_replace("-", " ", $keyword);
$keyword = explode("-",$keyword);
$calculate = count($keyword);
$word = trim(getPermalink()->splice(2));

if(is_file(SERVER."/views/cookie/".$word."-0.txt")){
$get = implode("",file(SERVER."/views/cookie/".$word."-0.txt"));
$ex = explode(",",$get);
foreach ($ex as $key => $value) {
	if(!empty($value)){
		$result_search[] = $value;		
	}
}

}else{

$dina = app_list_order_search($word,0);
foreach ($dina as $key => $value) {
	$app_check = connectDB()->Query("SELECT * FROM application WHERE packid='".$value->package_name."' ");
	$app_check = connectDB()->rowCount($app_check);
	if($app_check == 0){
	get_api_data($value->package_name,false,"","");
	}
	$result_search[] = $value->package_name;
	$op = fopen(SERVER."/views/cookie/".$word."-0.txt","a+");
	$fw = fwrite($op, $value->package_name.",");
	fclose($op);

}
}

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