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
<div class="left">
<div class="box" style="padding: 10px;">
	
		<h4 style="color:#666;font-size: 17px;margin-bottom: 7px;margin-top: 20px;">Bulk Post With Package Name / Playstore Url</h4>
		<span id="alert" style="font-size: 10px;color:#ccc">* You can input many package name or playstore url, for doing bulk post. Use break line ( enter button ) for spliting every items</span>
		<textarea id="bulk-form" name="data_bulk" style="width: 97%;border: 1px #e2e2e3 solid;padding: 10px;height: 300px;font-family: " ></textarea>
		<button style="border: 1px #ccc solid;margin-right:5px;background: #f5f5f5;color:#666;padding: 10px;border-radius: 0px;margin-top: 10px;cursor: pointer;" type="submit" onClick="return reset_form()">Reset</button><button style="border: 1px #24cd77 solid;background: #24cd77;color:#fff;padding: 10px;border-radius: 0px;width: 200px;margin-top: 10px;cursor: pointer;" type="submit" id="iml" onClick="return start_bulk_post(this)"><img src="/views/adminpanel/css/oval.svg" id="iml" width="18" style="display: none;"> Bulk Start</button>
   
	
</div>
</div>
<div class="right">
<div class="box" style="padding: 10px;">
<h4 style="color:#666;font-size: 17px;margin-bottom: 7px;margin-top: 20px;">Log Results</h4>
 <span id="alert" style="font-size: 10px;color:#ccc">* This box will showing log proccess </span>

<div id="log-result" style="height: 292px;padding: 10px;border:1px #e2e2e3 solid;overflow-y: scroll;">

</div>
<div id="con-prog" data="0" style="height:20px;margin-top: 10px;width:100%;border-radius: 5px;background: #edfaec;margin-bottom: 10px;">
      <div id="progbar" style="height:20px;background: #24cd77;color:#fff;width: 0px;border-radius: 5px;color:transparent;">.</div>
      <span id="repsen" style="float: right;margin-top: -23px;padding: 5px;font-size: 10px;color:#666">0 %</span>
    </div>
    <span><img src="/views/adminpanel/css/ceklis.png" width="11"> 
      <span id="true-res" style="color:transparent;">0</span></span>
    <span style="margin-left: 10px"><i class="fa fa-times" style="color:#DC143C;font-size: 13px;margin-top: 2px"></i> 
      <span id="false-res" style="color:transparent;">0</span>
    </span>
    <span style="margin-left: 10px"><i class="fa fa-arrow-circle-o-up" style="color:#0ba9c3;font-size: 13px;margin-top: 2px"></i> 
      <span id="up-res" style="color:transparent;">0</span>
    </span>
    <span style="float: right;font-size: 10px;" id="all-count"><span id="onloading" style="color: transparent;">0</span><span id="all-load" style="color:transparent;"></span></span>
</div>
</div>
</div>
</div>