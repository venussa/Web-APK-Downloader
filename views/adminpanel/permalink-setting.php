<div class="main" style="padding-top:20px;">
<?php if((update_checker() == 1) and empty($_SESSION['latters_update'])){ 

        ?>
    <div class="update-notif" style="border:1px #e2e2e3 solid;padding: 20px;background: #edfaec;border-radius: 5px;margin-bottom: 10px;color:#666">
        Good News !, Some Update Was Found. Are you want to update this script now ?
         <span style="float: right;margin-top: -10px;">
          <button onClick="script_update()" style="cursor:pointer;padding: 10px;background: #24cd77;border:1px #24cd77 solid;border-radius: 5px;color:#fff"> Update Now</button> 
        <button onClick="update_latter()" style="cursor:pointer;padding: 10px;background: #f1f1f1;border:1px #e2e2e3 solid;border-radius: 5px;color:#666"> Update Latter</button>
    </span>
    </div>
<?php } ?>
<div class="box" style="padding: 10px">
	<h4 style="padding: 5px;padding-left: 0px;font-size: 20px;">Permalink Setting</h4>
    <small style="color:#ccc">* Setting your permalink with our recomend or your custom permalink, and it only applies to detail apps / post</small>
    <form method="POST" action="">
    <?php 
    $permalink_source = implode("",file(SERVER."/views/permalink.txt"));
    switch ($permalink_source) {
    	case 1:
    	$check1 = " checked='true' ";
    	$disabled = "readonly='true'";
    	break;

    	case 2:
    	$check2 = " checked='true' ";
    	$disabled = "readonly='true'";
    	break;

    	case 3:
    	$check3 = " checked='true' ";
    	$disabled = "readonly='true'";
    	break;

    	case 4:
    	$check4 = " checked='true' ";
    	$disabled = "readonly='true'";
    	break;

    	default:
    	$check5 = " checked='true' ";
    	$source_custom = $permalink_source;
    	$disabled = "";
    	break;
    	
  
    }
    ?>

    <table style="width: 100%;margin-top: 20px;">
    	<tr>
    		<td style="padding: 5px;width: 10px;"><input <?=@$check1?> type="checkbox" onClick="return cb(this)" class="cekbox" name="url1" value="1"></td><td style="padding: 5px;width: 200px;"> <h4>Plain</h4></td>
    		<td style="padding: 20px;"><span style="color:#666;background: #edfaec;padding: 10px;border-radius: 5px;"><?=getPermalink()->homeUrl()."/post-name/?id=package_name"?></span></td>
    	</tr>
    	<tr>
    		<td style="padding: 5px;width: 10px;"><input <?=@$check2?> type="checkbox" onClick="return cb(this)" class="cekbox" name="url2" value="2"></td><td style="padding: 5px;width: 200px;"> <h4>Day and name</h4></td>
    		<td style="padding: 20px;"><span style="color:#666;background: #edfaec;padding: 10px;border-radius: 5px;"><?=getPermalink()->homeUrl()."/post-name/".date("Y")."/".date("m")."/".date("d")."/?id=package_name"?></span></td>
    	</tr>
    	<tr>
    		<td style="padding: 5px;width: 10px;"><input <?=@$check3?> type="checkbox" onClick="return cb(this)" class="cekbox" name="url3" value="3"></td><td style="padding: 5px;width: 200px;"> <h4>Month and name</h4></td>
    		<td style="padding: 20px;"><span style="color:#666;background: #edfaec;padding: 10px;border-radius: 5px;"><?=getPermalink()->homeUrl()."/post-name/".date("m")."/".date("d")."/?id=package_name"?></span></td>
    	</tr>
    	<tr>
    		<td style="padding: 5px;width: 10px;"><input <?=@$check4?> type="checkbox" onClick="return cb(this)" class="cekbox" name="url4" value="4"></td><td style="padding: 5px;width: 200px;"> <h4>Id Numerik</h4></td>
    		<td style="padding: 20px;"><span style="color:#666;background: #edfaec;padding: 10px;border-radius: 5px;"><?=getPermalink()->homeUrl()."/post-name/".rand(100,200)."/?id=package_name"?></span></td>
    	</tr>
    	<tr>
    		<td valign="top" style="padding: 5px;padding-top:20px;width: 10px;"><input <?=@$check5?> onClick="return cb(this)" class="cekbox" type="checkbox" name="url5" value="5" ></td><td  valign="top" style="padding: 5px;padding-top:20px;width: 200px;"> <h4>Custom Permalink</h4></td>
    		<td style="padding: 20px;"><span style="color:#666;background: #edfaec;padding: 10px;border-radius: 5px;"><?=getPermalink()->homeUrl()?>/<input type="text" <?=$disabled?> id="cusuri" name="url-custom" style="width:300px;padding: 5px;border: 1px #e2e2e3 solid;margin: 5px;" value="<?=@$source_custom?>">/<?="?id=package_name"?></span><br><br><small style="color:#ccc">* Select your setting at bottom button</small><br><br>
    			<button class="act_url_show"  type="button"  style="cursor:pointer;padding: 10px;background: #f5f5f5;border: 1px #e2e2e3 solid;color:#666;border-radius: 5px">%Year%</button>
    			<button class="act_url_show"  type="button"  style="cursor:pointer;padding: 10px;background: #f5f5f5;border: 1px #e2e2e3 solid;color:#666;border-radius: 5px">%Month%</button>
    			<button class="act_url_show"  type="button"  style="cursor:pointer;padding: 10px;background: #f5f5f5;border: 1px #e2e2e3 solid;color:#666;border-radius: 5px">%Day%</button>
    			<button class="act_url_show"  type="button"  style="cursor:pointer;padding: 10px;background: #f5f5f5;border: 1px #e2e2e3 solid;color:#666;border-radius: 5px">%Post Id%</button>
    			<button class="act_url_show"  type="button"  style="cursor:pointer;padding: 10px;background: #f5f5f5;border: 1px #e2e2e3 solid;color:#666;border-radius: 5px">%Post Name%</button>
    			<button class="act_url_show"  type="button"  style="cursor:pointer;padding: 10px;background: #f5f5f5;border: 1px #e2e2e3 solid;color:#666;border-radius: 5px">%Category%</button>
    			<button class="act_url_show"  type="button"  style="cursor:pointer;padding: 10px;background: #f5f5f5;border: 1px #e2e2e3 solid;color:#666;border-radius: 5px">%Genre%</button>
    			<button class="act_url_show"  type="button"  style="cursor:pointer;padding: 10px;background: #f5f5f5;border: 1px #e2e2e3 solid;color:#666;border-radius: 5px">%Developer%</button>
    			<br><br>
    			<hr style="border: transparent;border-bottom: 1px #e2e2e3 solid;" />
    			<br>
    			<input type="text" name="hide_perm" id="hide_perm" style="display: none;">
    			<button type="submit" name="save_link_bro" class="btn btn-info" style="background: #24cd77;color:#fff;padding: 10px;width: 200px;border:1px #24cd77 solid"> Save Change</button>
    		</td>
    	</tr>
    </table>
</form>
</div>
</div>

<?php
if(isset($_POST['save_link_bro']) and !empty(trim($_POST['hide_perm']))) {
	
		if($_POST['hide_perm'] !== 5) {
			$op = fopen(SERVER."/views/permalink.txt","w+");
			$fw = fwrite($op,$_POST['hide_perm']);
			fclose($op);
		}
		if($_POST['hide_perm'] == 5){
			$op = fopen(SERVER."/views/permalink.txt","w+");
			$fw = fwrite($op,$_POST['url-custom']);
			fclose($op);
		}
	
	header("location:");
	exit;
}