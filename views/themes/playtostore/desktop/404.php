<?php 
header("HTTP/1.0 404 Not Found");
require_once(SERVER."/views/".themeConfig()."part/header.php");?>
<div class="body-content col-md-10 col-md-offset-2" style="margin-top: -50px">
<img src="<?=getPermalink()->homeUrl()."/views/image/404.png"?>" width="100%" >
</div>
<?php require_once(SERVER."/views/".themeConfig()."part/footer.php");?>