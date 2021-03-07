<?php
$keyword = getPermalink()->splice(2);
$natural = str_replace("-", " ", $keyword);
$keyword = explode("-",$keyword);
$calculate = count($keyword);


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

for($i = 0; $i < $calculate ; $i++){
	$join = @$keyword[$i]." ".@$keyword[$i+1]." ".@$keyword[$i+2];
	$try = @connectDB()->Query("SELECT * FROM application WHERE 
		title like '%".$join."%' or 
		packid like '%".$join."%' or 
		description like '%".$join."%' or 
		developer like '%".$join."%'");
	$check = @connectDB()->rowCount($try);
	if($check > 0){
	$word = $join;
	$found = @connectDB()->Query("SELECT * FROM application WHERE 
		title like '%".$word."%' or 
		packid like '%".$word."%' or 
		description like '%".$word."%' or 
		developer like '%".$word."%'");
	$found = @connectDB()->rowCount($found);
	$response = true;
	break;
	}else{
	$join = str_replace(" ","",@$keyword[$i]." ".@$keyword[$i+1]." ".@$keyword[$i+2]);
	$try = @connectDB()->Query("SELECT * FROM application WHERE 
		title like '%".$join."%' or 
		packid like '%".$join."%' or 
		description like '%".$join."%' or 
		developer like '%".$join."%'");
	$check = @connectDB()->rowCount($try);
	if($check > 0){
	$word = $join;
	$found = @connectDB()->Query("SELECT * FROM application WHERE 
		title like '%".$word."%' or 
		packid like '%".$word."%' or 
		description like '%".$word."%' or 
		developer like '%".$word."%'");
	$found = @connectDB()->rowCount($found);
	$response = true;
	break;
	}else{
	$found = 0;
	$response = false;
	}
	}
}
if($response == false){
for($i = 0; $i < $calculate ; $i++){
	$join = @$keyword[$i]." ".@$keyword[$i+1];
	$try = @connectDB()->Query("SELECT * FROM application WHERE 
		title like '%".$join."%' or 
		packid like '%".$join."%' or 
		description like '%".$join."%' or 
		developer like '%".$join."%'");
	$check = @connectDB()->rowCount($try);
	if($check > 0){
	$word = $join;
	$found = @connectDB()->Query("SELECT * FROM application WHERE 
		title like '%".$word."%' or 
		packid like '%".$word."%' or 
		description like '%".$word."%' or 
		developer like '%".$word."%'");
	$found = @connectDB()->rowCount($found);
	$response = true;
	break;
	}else{
	$join = str_replace(" ","",@$keyword[$i]." ".@$keyword[$i+1]);
	$try = @connectDB()->Query("SELECT * FROM application WHERE 
		title like '%".$join."%' or 
		packid like '%".$join."%' or 
		description like '%".$join."%' or 
		developer like '%".$join."%'");
	$check = @connectDB()->rowCount($try);
	if($check > 0){
	$word = $join;
	$found = @connectDB()->Query("SELECT * FROM application WHERE 
		title like '%".$word."%' or 
		packid like '%".$word."%' or 
		description like '%".$word."%' or 
		developer like '%".$word."%'");
	$found = @connectDB()->rowCount($found);
	$response = true;
	break;
	}else{
	$found = 0;
	$response = false;
	}
	}
}
}
if($response == false){
	for($i = 0; $i < $calculate ; $i++){
	$join = @$keyword[$i];
	$try = @connectDB()->Query("SELECT * FROM application WHERE 
		title like '%".$join."%' or 
		packid like '%".$join."%' or 
		description like '%".$join."%' or 
		developer like '%".$join."%'");
	$check = @connectDB()->rowCount($try);
	if($check > 0){
	$word = $join;
	$found = @connectDB()->Query("SELECT * FROM application WHERE 
		title like '%".$word."%' or 
		packid like '%".$word."%' or 
		description like '%".$word."%' or 
		developer like '%".$word."%'");
	$found = @connectDB()->rowCount($found);
	$response = true;
	break;
	}else{
	$join = str_replace(" ","",trim(@$keyword[$i]));
	$try = @connectDB()->Query("SELECT * FROM application WHERE 
		title like '%".$join."%' or 
		packid like '%".$join."%' or 
		description like '%".$join."%' or 
		developer like '%".$join."%'");
	$check = @connectDB()->rowCount($try);
	if($check > 0){
	$word = $join;
	$found = @connectDB()->Query("SELECT * FROM application WHERE 
		title like '%".$word."%' or 
		packid like '%".$word."%' or 
		description like '%".$word."%' or 
		developer like '%".$word."%'");
	$found = @connectDB()->rowCount($found);
	$response = true;
	break;
	}else{
	$found = 0;
	$response = false;
	}
	}
}
}

$execute = @connectDB()->bindQuery("SELECT * FROM application WHERE 
		title like '%".$word."%' or 
		packid like '%".$word."%' or 
		description like '%".$word."%' or 
		developer like '%".$word."%' ORDER BY id DESC LIMIT ".show_limit_category());
