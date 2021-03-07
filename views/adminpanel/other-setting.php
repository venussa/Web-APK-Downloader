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
<?php $bind = connectDB()->bindQuery("SELECT * FROM setting");
foreach($bind as $key => $value);?>

<div class="box">
<div class="bd">    

    <form method="POST" action="">
    <div class="bg-white" style="padding: 15px;margin-bottom:10px;margin-top: 0px">
        <h4 style="padding: 5px;padding-left: 0px;font-size: 20px;">Primary Setting</h4>
    <small style="color:#ccc">* Setting dmca, privacy policy an term of use of your site</small>
    </div>
    <table width="100%">
        <tr><td valign="top" style="padding: 10px;width: 200px"><h4>DMCA Discaimer</h4><br>
        <small style="color:#ccc">* Type your site rules or copyright to saving your content</small>
        </td>
        <td style="padding: 10px"> <textarea style="padding:6px;border:1px #e2e2e3 solid;width: 97%;height: 300px;" class="textarea form-control" name="dmca"><?=$value->dmca?></textarea></td>
        </tr>

        <tr><td valign="top" style="padding: 10px;width: 200px"><h4>Privacy Policy</h4><br>
        <small style="color:#ccc">* Type your site rules or copyright to saving your content</small>
        </td>
        <td style="padding: 10px"> <textarea style="padding:6px;border:1px #e2e2e3 solid;width: 97%;height: 300px;" class="textarea form-control" name="privacy"><?=$value->privacy?></textarea></td>
        </tr>

        <tr><td valign="top" style="padding: 10px;width: 200px"><h4>Term Of Use</h4><br>
        <small style="color:#ccc">* Type your site rules or copyright to saving your content</small>
        </td>
        <td style="padding: 10px"> <textarea style="padding:6px;border:1px #e2e2e3 solid;width: 97%;height: 300px;" class="textarea form-control" name="tos"><?=$value->tos?></textarea></td>
        </tr>

         <tr><td valign="top" style="padding: 10px;width: 200px"><h4>Crawl Setting (Robots.txt)</h4><br>
        <small style="color:#ccc">* Setting about crawler to block private page from index</small>
        </td>
        <td style="padding: 10px"> <textarea style="padding:6px;border:1px #e2e2e3 solid;width: 98.5%;height: 300px;" class="form-control" name="robot"><?=$value->robot?></textarea></td>
        </tr>
        <tr><td valign="top" style="padding: 10px;width: 200px"></td><td  style="padding: 10px;">
        
        <hr style="border: transparent;border-bottom: 1px #e2e2e3 solid;" />
        <br><button type="submit" name="save" class="btn btn-info" style="background: #24cd77;color:#fff;padding: 10px;width: 200px;border:1px #24cd77 solid"> Save Change</button><br><br></td></tr>
    </table>
 
</form>

</div>
</div>

<?php
if(isset($_POST['save'])){

    $data = [
        "dmca" => str_replace("'","`",$_POST['dmca']),
        "privacy" => str_replace("'","`",$_POST['privacy']),
        "tos" => str_replace("'","`",$_POST['tos']),
        "robot" => str_replace("'","`",$_POST['robot']),
    ];
    foreach($data as $Key => $val){
        if($Key == "robot"){
            $fill .= $Key."='".$val."'";
        }else{
            $fill .= $Key."='".$val."',";
        }
    }

    connectDB()->Query("UPDATE setting SET ".$fill);
    echo "<script>window.location='';</script>";

}

?>
</div>