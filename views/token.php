    <?php 
		
	$data = file_get_contents('https://graph.facebook.com/v2.10/oauth/access_token?grant_type=fb_exchange_token&client_id=1631796250236570&client_secret=0ccbaf40ddffe2f4ac517e1eb1834f03&fb_exchange_token='.trim(implode(null,file(SERVER."/config/token.txt"))));
  $show = json_decode($data);
	if(isset($show->access_token)){
  
    $op = fopen(SERVER."/config/token.txt","w+");
    $fw = fwrite($op,$show->access_token);
    fclose($op);
    echo "<table style='width:300px;' border='1'><tr><td>access token : </td><td>".$show->access_token."</td></tr><tr><td>exprired</td><td>2 Mounth</td></tr></table>";
	}else{
	echo "failed";
		}