<?php require_once(SERVER."/views/".themeConfig()."part/header.php");?>
<div class="body-content col-md-10 col-md-offset-2" style="padding: 20px;padding-top: 10px;margin-top: -57px">
<div style="background: #fff;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);padding: 15px;border-radius: 0px">

	<?php 
	$data = getPermalink()->splice(1);
	echo "<span style='font-size:15px;font-family:sans-serif;line-height: 25px;color:#666'>".siteSetting()->$data."</span>";
	?>

</div>
</div>
<?php require_once(SERVER."/views/".themeConfig()."part/footer.php");?>