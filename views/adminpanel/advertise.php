<?php
if(isset($_POST['save_ads'])){
  if(empty($_POST['desktop1'])) $desktop1 = "";
  else $desktop1 = base64_encode($_POST['desktop1']);

  if(empty($_POST['desktop2'])) $desktop2 = "";
  else $desktop2 = base64_encode($_POST['desktop2']);

  if(empty($_POST['desktop3'])) $desktop3 = "";
  else $desktop3 = base64_encode($_POST['desktop3']);

  if(empty($_POST['mobile1'])) $mobile1 = "";
  else $mobile1 = base64_encode($_POST['mobile1']);

  if(empty($_POST['mobile2'])) $mobile2 = "";
  else $mobile2 = base64_encode($_POST['mobile2']);

  connectDB()->Query("UPDATE advertise SET desktop1='".$desktop1."', desktop2='".$desktop2."',desktop3='".$desktop3."', mobile1='".$mobile1."',mobile2='".$mobile2."' ");
  echo "<script>window.location='';</script>";

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
  <div class="box" >
    <div class="bd" style="padding: 15px;">
      <h4 style="padding: 5px;padding-left: 0px;font-size: 20px;">Advertise Setting</h4>
    <small style="color:#ccc">* Add your advertise script at here to get more monetize</small>
<?php
$bind = connectDB()->bindQuery("SELECT * FROM setting");
foreach($bind as $key => $value);

?>
<form method="POST" action="" enctype="multipart/form-data">

<table width="100%" style="margin-top: 20px;">
  <tr>
    <td style="width: 200px;">
      <h4>Desktop 720 * 90</h4><br>
    <small style="color: #ccc">Show at all page in website</small>
    </td>
      <td style="padding:10px;">
  <textarea class="form-control" name="desktop1" style="padding:6px;border:1px #e2e2e3 solid;width: 97%;height:100px;"><?=advertise()->desktop_720_90?></textarea>
    </td>
  </tr>

  <tr>
    <td style="width: 200px;">
       <h4>Desktop 720 * 90</h4><br>
    <small style="color: #ccc">Show only in post page at bottom position</small>
    </td>
      <td style="padding:10px;">
  <textarea class="form-control" name="desktop3" style="padding:6px;border:1px #e2e2e3 solid;width: 97%;height:100px;"><?=advertise()->desktop_720_90_artikel?></textarea>
    </td>
  </tr>

  <tr>
    <td style="width: 200px;">
       <h4>Desktop 300 * 250</h4><br>
    <small style="color: #ccc">Show at all pages in website</small>
    </td>
      <td style="padding:10px;">
  <textarea class="form-control" name="desktop2" style="padding:6px;border:1px #e2e2e3 solid;width: 97%;height:100px;"><?=advertise()->desktop_300_250?></textarea>
    </td>
  </tr>

  <tr>
    <td style="width: 200px;">
       <h4>Mobile Responsive</h4><br>
    <small style="color: #ccc">Show at all pages in website</small>
    </td>
      <td style="padding:10px;">
  <textarea class="form-control" name="mobile1" style="padding:6px;border:1px #e2e2e3 solid;width: 97%;height:100px;"><?=advertise()->mobile_responsive?></textarea>
    </td>
  </tr>

    <tr>
    <td style="width: 200px;">
       <h4>Mobile Square</h4><br>
    <small style="color: #ccc">Show at all pages in website</small>
    </td>
      <td style="padding:10px;">
  <textarea class="form-control" name="mobile2" style="padding:6px;border:1px #e2e2e3 solid;width: 97%;height:100px;"><?=advertise()->mobile_box?></textarea>
  <Br><br>
  <hr style="border: transparent;border-bottom: 1px #e2e2e3 solid;" />
  <br>
  <button type="submit" name="save_ads"  class="btn btn-info" style="background: #24cd77;color:#fff;padding: 10px;width: 200px;border:1px #24cd77 solid"> Save Change</button>
    </td>
  </tr>

</table>




</form>

<br>
</div>
</div>
</div>
