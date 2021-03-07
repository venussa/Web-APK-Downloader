<?php if(isset($_POST['q'])){ ?>

<?php
$data = @connectDB()->bindQuery("SELECT * FROM application WHERE title like '%".$_POST['q']."%' LIMIT 10 ");
if($data){
foreach($data as $key => $val){ ?>
<a  style="color:#434343;text-decoration: none;" href="<?=permalink_control($val->packid)?>"><li class="ellipsis" style="list-style-type: none;padding: 10px;"><?=$val->title?></li></a>
<?php }

}else{ ?>
<li style="list-style-type: none;padding: 10px;">Not Found</li>
<?php }  ?>

<?php } ?>