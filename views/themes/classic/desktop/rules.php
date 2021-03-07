<?php getFile("part/header") ?>
<div class="main" style="padding-top:20px;">
	<div style="margin-bottom: 17px;">  
    <center>
    <?=advertise()->desktop_720_90?>
</center>
  </div>
<div class="box" style="padding: 10px">
	<?php 
	$data = getPermalink()->splice(1);
	echo siteSetting()->$data;
	?>
</div>
</div>
<?php getFile("part/footer") ?>