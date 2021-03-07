<?php


if(!empty($_FILES['icon']['name'])){
	$gets = explode(".",$_FILES['icon']['name']);
	$last_ext = $gets[count($gets)-1];
	if($last_ext !== "zip") {
		echo "<script>alert('Invalid Themes');</script>";
	}else{
	$cek_theme = connectDB()->Query("SELECT * FROM themes WHERE name='".$gets[0]."'");	
	$rows = connectDB()->rowCount($cek_theme);
	if($rows == 0){
		move_uploaded_file($_FILES['icon']['tmp_name'], SERVER."/views/themes/".$_FILES['icon']['name']);
		
		$zip = new ZipArchive;
			$res = $zip->open(SERVER."/views/themes/".$_FILES['icon']['name']);
			if ($res === TRUE) {
			  $zip->extractTo(SERVER."/views/themes/");
			  $zip->close();
			  connectDB()->Query("insert into themes (name,status) values('".$gets[0]."','0')");
			  echo "<script>alert('Success');</script>";
			} else {
			  echo "<script>alert('Failed');</script>";	
			}
			@unlink(SERVER."/views/themes/".$_FILES['icon']['name']);
	}else{
		echo "<script>alert('already exist');</script>";
	}
}
}

?>

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
	<center>
<div style="background: #fff;width: 500px;border:1px #e2e2e3 solid;border-radius:0px;padding:10px;">
	<center>
<form method="POST" action="" enctype="multipart/form-data">
<table width="100%">
	<tr>
	<td colspan="3" style="padding:10px;"><h4 align="center">Upload Theme</h4></td>
	</tr>
	<tr>
		<td >
		<button style="cursor: pointer;padding:10px;background: #e2e2e3;border:1px #ccc solid;border-right: transparent;color:#666;width: 50px;" id="fake-file-button-browse" type="button" class="btn btn-default">
			<span class="fa fa-file"></span>
		</button>
	</td>
	<td>

	<input type="file" name="icon" id="files-input-upload" style="display:none" required>
	<input  style="padding:10px;width: 370px;margin-left:-10px;border:1px #ccc solid;border-left: transparent;background: #fff" type="text" id="fake-file-input-name" disabled="disabled" placeholder="File not selected" class="form-control" required>
</td>
<td>
	<button style="margin-left:-50px;padding:10px;background: #24cd77;border:1px #24cd77 solid;color:#fff;cursor: pointer; " type="submit" class="btn btn-default">
			Upload
		</button>
</td>
</tr>
</table>
<br>
<small style="color:#ccc;font-size: 10px;">Keep support smartplay and soon, we will create more theme with good design and more user experience</small>
</form>
<br>
</center>
<script>
document.getElementById('fake-file-button-browse').addEventListener('click', function() {
    document.getElementById('files-input-upload').click();
});

document.getElementById('files-input-upload').addEventListener('change', function() {
    document.getElementById('fake-file-input-name').value = this.value;
    
    document.getElementById('fake-file-button-upload').removeAttribute('disabled');
});
</script>
</div>
</center>
<br>
<hr style="border:transparent;border-bottom: 1px #e2e2e3 solid;" />
<br>
<?php
$theme = connectDB()->bindQuery("SELECT * FROM themes ORDER BY id DESC");
foreach($theme as $key => $val){
?>
<?php
if($val->status == 1){
	$style = "border:2px #24cd77 solid;";
}else{
	$style = "border:1px #e2e2e3 solid;";
}

?>
<div id="cont-them-<?=$val->id?>" class="cont-theme" style="background: #fff;width: 32%;margin-right:1.33%;float:left;<?=$style?>border-radius:10px;">
<img class="box-theme" src="<?=getPermalink()->homeUrl()."/views/themes/".$val->name."/thumbnail.png"?>" style="width:100%;height:200px;border-bottom:1px #e2e2e3 solid;border-radius:10px 10px 0 0;">
<?php
if($val->status == 1){
	$style = "background: #24cd77;border:1px #24cd77 solid;";
}else{
	$style = "background: #ff0000;border:1px #ff0000 solid;";
}

?>
<h4 style="padding: 10px;"><?=ucwords($val->name)?> Theme <span style="float: right;">
	<button id="tm-<?=$val->id?>" class="alsom" onClick="set_themes(<?=$val->id?>,'<?=$val->name?>','apply')" style="padding: 3px;border-radius: 5px;<?=$style?>margin-top:-10px;cursor:pointer"><i style="color:#fff;font-size: 18px; cursor: pointer;" class="fa fa-eye"></i></span></button>
	</h4>

</div>

<?php } ?>
</div>