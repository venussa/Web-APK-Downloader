<?php require_once(SERVER."/views/".themeConfig()."part/header.php");?>
<div class="body-content" style="padding: 10px">
<div style="background: #fff;box-shadow: 0px 1px 4px rgba(0,0,0,.13) ,1px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);padding: 5px;border-radius: 5px">
	
	<?php 
	$data = getPermalink()->splice(1);
	echo "<span style='font-size:15px;font-family:sans-serif;line-height: 23.5px;color:#666'>".siteSetting()->$data."</span>";
	?>
	
</div>
</div>
<?php require_once(SERVER."/views/".themeConfig()."part/footer.php");?>