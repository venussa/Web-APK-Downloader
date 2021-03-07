<?php getFile("part/header") ?>
<div class="main">
	<div style="margin-bottom: 10px;">  
    <center>
    <?=advertise()->mobile_responsive?>
</center>
  </div>
<div class="details" style="padding: 10px">
	<?php 
	$data = getPermalink()->splice(1);
	echo siteSetting()->$data;
	?>
</div>
</div>
<?php getFile("part/footer") ?>