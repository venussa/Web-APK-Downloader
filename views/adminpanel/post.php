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
	<div class="left floatr">
	<div class="box" >
            <div class="title tlong">
               <?php 
               if(!empty(getPermalink()->splice(3))){
					if(getPermalink()->splice(3) !== "search"){
						echo "<i class=\"fa fa-cube\"></i> Explore ".ucwords(str_replace("_", " ", str_replace("and","&",getPermalink()->splice(3))));
					}elseif(getPermalink()->splice(3) == "search"){
						echo "<i class=\"fa fa-search-plus\"></i> Search Result";
					}
				}else{
						echo "<i class=\"fa fa-cubes\"></i> My Apps";
					}
               ?>
            
            <div class="sorting" style="margin-top: 0px;width: 550px">
            <form method="POST" action="" onSubmit="return enter_search()">
            	<table width="100%">
            		<tr>
                        <td class="options">
                            <i class="fa fa-check-circle" style="color:#f1f1f1;cursor: pointer;" onClick="bulks_all()"></i>
                            <button type="button" onClick="bulk_publish()" style="width: 63%;padding: 10px;border:1px #24cd77 solid;background: #24cd77;color:#fff;cursor: pointer;">Publish</button>
                            
                            <button type="button" onClick="bulk_delete<?php if(!empty(getPermalink()->splice(3))) echo "_other";?>()" style="padding: 10px;border:1px #de0303 solid;background: #fff;color:#fff;cursor: pointer;"><i class="fa fa-trash" style="font-size: 15px;color: #de0303"></i></button>
                        </td>
                        <td class="options">
                            <button type="button" onClick="bulk_date()" style="width: 100%;padding: 10px;border:1px #e2e2e3 solid;background: #f4f4f4;color:#fff;cursor: pointer;"><i class="fa fa-calendar" style="color:#666"></i></button>
                        </td>

                        <td id="sch-id" style="display: none;">
                            <button type="button" onClick="close_bulk()" style="width: 15%;padding: 10px;border:1px #e2e2e3 solid;background: #f4f4f4;color:#666;cursor: pointer;"><i class="fa fa-chevron-left"></i></button>
                            <input autocomplete="off" readonly="" onClick="date_pickers()" id="date" type="text" name="" style="width:50%;padding: 10px;border:1px #e2e2e3 solid;" placeholder="Set Schedule ">
                            <button type="button" onClick="bulk_save_date()" style="width: 20%;padding: 10px;border:1px #e2e2e3 solid;background: #f4f4f4;color:#666;cursor: pointer;">Save</button>
                        </td>
                       
            			<td style="width: 270px;">
            	<input autocomplete="off" id="source-slugs" onKeyup="return search_pack(this)" style="width:100%;padding: 10px;border:1px #e2e2e3 solid;" type="text" name="q" placeholder="Type Here ..." value="<?=str_replace("-"," ",getPermalink()->splice(4))?>">
                <input autocomplete="off" type="text" id="slugs" name="" value="<?=@getPermalink()->splice(4)?>" style="display: none;">
                <?php if(!empty(GET('hl'))){$hl="/?hl=".GET('hl');$sehl = GET('hl');}else{$hl="";$sehl="us";}?>
            	<input autocomplete="off" type="text" id="slugs-2" name="" value="<?=$hl?>" style="display: none;">
            </td>
            
            <td >
             <button type="button" onClick="show_lang()" id="sel-con" style="margin-top:-15px;margin-left:-40px;padding: 0px;position:absolute;border:transparent;background: transparent;color:#666;cursor: pointer;"><span class="regions f32 tmplag"><span class=" flag <?=strtolower($sehl)?>" ></span></span></button>
              </td>
            
            <td style="width: 50px;">
            <button type="submit" style="width: 100%;padding: 10px;border:1px #24cd77 solid;background: #24cd77"><i style="color:#fff;cursor: pointer;" class="fa fa-search-plus"></i> </button>
            </td>
            </tr>
            </table>
        </form>


     


        <span style="padding: 10px;display: none;" id="bulks"></span>
            </div>
        </div>

            
   <span style="color:#fff"><?=require_once(SERVER."/views/adminpanel/flags.php");?></span>
<ul class="category-template" id="pagedata">
	

<?php
if(!empty(getPermalink()->splice(3))){
	if(getPermalink()->splice(3) !== "search"){
        $get_app = app_list_order(getPermalink()->splice(3),1);
        $noms = 1;
        foreach($get_app as $keys => $show){ 
        $schs = connectDB()->Query("SELECT * FROM date_conf WHERE package_name='".$show->package_name."' ");
        $sch = connectDB()->Fetch($schs);
        $rs = connectDB()->rowCount($schs);
        if($rs !== 0){
            $date_ms = "<i class=\"fa fa-clock-o\" style=\"font-size: 13px;\"></i> Will Publish On ".$sch['date'];
        }else{
            $date_ms = null;
        }

        $noms++;
        	?>

	<li class="reglist" >
    <div class="category-template-img">
        <a title="<?=$show->title?>" href="javascript:void(0)">
            <i class="indibulks fa fa-check-circle bulk-<?=str_replace(".","-",$show->package_name)?>" style="float: right;color:#f1f1f1;font-size: 18px;" onClick="bulks('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>')"></i>
           <img class="lazy" src="<?=$show->icon?>" style="display: inline;width: 90px;height: 90px;"></a>
           <i class="fa fa-caret-down <?=str_replace(".","-",$show->package_name)?>" style="cursor: pointer;" onClick="set_date('<?=str_replace(".","-",$show->package_name)?>')"></i>
        </div>
    <div id="kot-box-<?=str_replace(".","-",$show->package_name)?>" style="display: none;background: #f1f1f1;border: 1px #e2e2e3 solid;padding: 10px;">
        <h4>Set Schedule</h4><br>
        <table style="width:100%">
            <tr>
                <td>

        <input autocomplete="off" type="text" readonly="" value="<?=@$sch['date']?>" placeholder="Click Here" style="cursor:pointer;width:100%;padding: 10px;border:1px #e2e2e3 solid;" onClick="date_picker('<?=str_replace(".","-",$show->package_name)?>')" id="date-<?=str_replace(".","-",$show->package_name)?>">
    </td>
    <td style="width: 40px;"><button onClick="save_date('<?=str_replace(".","-",$show->package_name)?>','<?=str_replace(".",".",$show->package_name)?>')" style="cursor: pointer;width: 100%;padding: 10px;border:1px #24cd77 solid;background: #24cd77;color:#fff">Save</button></td>
</tr>
</table>
    </div>
    <div id="boxs-<?=str_replace(".","-",$show->package_name)?>" style="" >
    <div class="category-template-title">
        <a title="<?=$show->title?>" href=#"><?=$show->title?></a>
    </div>
   
    <div class="category-template-down" style="margin-bottom: 5px;">
        <?php
        $ceks = connectDB()->Query("SELECT * FROM application WHERE packid='".trim($show->package_name)."' ");
        $reqs = connectDB()->Fetch($ceks);
        $mode = explode("/",$reqs['directdownload']);
        $mode = @$mode[1];
        $ceks = connectDB()->rowCount($ceks);
        ?>
        
        <span style="display: none;" id="<?=str_replace(".","-",$show->package_name)?>-l"><img src="/views/adminpanel/css/ovalo.svg" width="20" style="margin-right:5px;"></span>
         <?php
        if($mode == "manual"){ ?>
        <a rel="nofollow" class="" id="<?=str_replace(".","-",$show->package_name)?>-t" title="<?=$show->title?>" href="javascript:void(0)" onClick="addNew2('<?=$show->package_name?>','<?=str_replace(".","-",$show->package_name)?>','')" style="border:1px #24cd77 solid;border-radius:5px;<?php if($ceks == 1) echo "background:#24cd77;color:#fff;"; else echo "color:#24cd77;";?>padding: 7px;"><?php if($ceks == 1) echo "Already Publish"; else echo "Publish";?></a>

    <?php }else{ ?>
        <a rel="nofollow" class="" id="<?=str_replace(".","-",$show->package_name)?>-t" title="<?=$show->title?>" href="javascript:void(0)" onClick="addNew('<?=$show->package_name?>','<?=str_replace(".","-",$show->package_name)?>','')" style="border:1px #24cd77 solid;border-radius:5px;<?php if($ceks == 1) echo "background:#24cd77;color:#fff;"; else echo "color:#24cd77;";?>padding: 7px;"><?php if($ceks == 1) echo "Already Publish"; else echo "Publish";?></a>
    <?php } ?>

         <a href="javascript:void(0)" id="btn-<?=str_replace(".","-",$show->package_name)?>" onClick="show_pops('<?=str_replace(".","-",$show->package_name)?>')" style="border:1px #e2e2e3 solid;border-radius:5px;background:#e2e2e3;color:#666;padding: 7px;"><i class="fa fa-caret-down"></i></a>

         <div class="dropdown-menu" id="pops-<?=str_replace(".","-",$show->package_name)?>" x-placement="bottom-start" style="box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);position: absolute;text-align: left;background: #fff;padding: 10px;border:1px #e2e2e3 solid;border-radius: 5px;margin-top: -120px;margin-left: 20px;display: none"> <i class="fa fa-times" style="cursor: pointer;float: right" onClick="show_pops('<?=str_replace(".","-",$show->package_name)?>')" ></i>
            <?php if($ceks == 0){ ?>
            
                                            <span id="loys-<?=str_replace(".","-",$show->package_name)?>">
                                            <a id="drop-<?=str_replace(".","-",$show->package_name)?>" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>','each')" data-toggle="modal" data-target=".bs-example-modal-sms">Publish Each App</a><br>
                                            <a id="drop-<?=str_replace(".","-",$show->package_name)?>-2" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>','all')" data-toggle="modal" data-target=".bs-example-modal-sms">Publish All In Developer</a><br>
                                            <span id="edit-<?=str_replace(".","-",$show->package_name)?>"></span>
                                            </span>
                                            <span id="poys-<?=str_replace(".","-",$show->package_name)?>"></span>
                                        
        <?php }else{ ?>                                        
         <?php if($mode !== "manual"){ ?>
                                            <span id="loys-<?=str_replace(".","-",$show->package_name)?>">
                                            <a id="drop-<?=str_replace(".","-",$show->package_name)?>" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>','each')" data-toggle="modal" data-target=".bs-example-modal-sms">Update Each App</a><br>
                                            <a id="drop-<?=str_replace(".","-",$show->package_name)?>-2" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>','all')" data-toggle="modal" data-target=".bs-example-modal-sms">Update All In Developer</a><br>
                                            <span id="edit-<?=str_replace(".","-",$show->package_name)?>">
                                             <a id="drop-<?=str_replace(".","-",$show->package_name)?>-3" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="go_edit1('<?=$show->package_name?>')" data-toggle="modal" data-target=".bs-example-modal-sms">Edit Post</a>
                                            </span>
                                            </span>
                                            <span id="poys-<?=str_replace(".","-",$show->package_name)?>"></span>
                                        
        <?php }else{ ?>
                                            <span id="loys-<?=str_replace(".","-",$show->package_name)?>">
                                            <a id="drop-<?=str_replace(".","-",$show->package_name)?>" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp2('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>','each')" data-toggle="modal" data-target=".bs-example-modal-sms">Update Each App</a><br>
                                            <a id="drop-<?=str_replace(".","-",$show->package_name)?>-2" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp2('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>','all')" data-toggle="modal" data-target=".bs-example-modal-sms">Update All In Developer</a><br>
                                            <span id="edit-<?=str_replace(".","-",$show->package_name)?>">
                                             <a id="drop-<?=str_replace(".","-",$show->package_name)?>-3" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="go_edit2('<?=$show->package_name?>')" data-toggle="modal" data-target=".bs-example-modal-sms">Edit Post</a>
                                            </span>
                                            </span>

                                            <span id="poys-<?=str_replace(".","-",$show->package_name)?>"></span>
        <?php }
         } ?>
        </div>
        <span id="dina-<?=str_replace(".","-",$show->package_name)?>">
        <?php if($ceks !== 0){ ?>
            <a href="javascript:void(0)" class="trash-<?=str_replace(".","-",$show->package_name)?>" onClick="del_apps_other('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>')" style="border:1px #de0303 solid;border-radius:5px;background: #fff;border:1px #de0303 solid;padding: 7px;"><i style="font-size: 15px;color: #de0303" class="fa fa-trash"></i></a>
        <?php }?>
    </span>
    </div>
    <span style="color:#ccc;font-size: 10px;" id="msg-<?=str_replace(".","-",$show->package_name)?>"><?=$date_ms?></span>
</div>
</li>

<?php } 
}elseif(getPermalink()->splice(3) == "search") {

$get_app = app_list_order_search(getPermalink()->splice(4),0);
        $noms = 1;
        foreach($get_app as $keys => $show){ 
        
        $schs = connectDB()->Query("SELECT * FROM date_conf WHERE package_name='".$show->package_name."' ");
        $sch = connectDB()->Fetch($schs);
        $rs = connectDB()->rowCount($schs);
        if($rs !== 0){
            $date_ms = "<i class=\"fa fa-clock-o\" style=\"font-size: 13px;\"></i> Will Publish On ".$sch['date'];
        }else{
            $date_ms = null;
        }

        $noms++;
        	?>

	<li class="reglist" >
    <div class="category-template-img">
        <a title="<?=$show->title?>" href="javascript:void(0)">
            <i class="indibulks fa fa-check-circle bulk-<?=str_replace(".","-",$show->package_name)?>" style="float: right;color:#f1f1f1;font-size: 18px;" onClick="bulks('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>')"></i>
           <img class="lazy" src="<?=$show->icon?>" style="display: inline;width: 90px;height: 90px;"></a>
           <i class="fa fa-caret-down <?=str_replace(".","-",$show->package_name)?>" style="cursor: pointer;" onClick="set_date('<?=str_replace(".","-",$show->package_name)?>')"></i>
        </div>
    <div id="kot-box-<?=str_replace(".","-",$show->package_name)?>" style="display: none;background: #f1f1f1;border: 1px #e2e2e3 solid;padding: 10px;">
        <h4>Set Schedule</h4><br>
        <table style="width:100%">
            <tr>
                <td>

        <input autocomplete="off" type="text" readonly="" value="<?=@$sch['date']?>" placeholder="Click Here" style="cursor:pointer;width:100%;padding: 10px;border:1px #e2e2e3 solid;" onClick="date_picker('<?=str_replace(".","-",$show->package_name)?>')" id="date-<?=str_replace(".","-",$show->package_name)?>">
    </td>
    <td style="width: 40px;"><button onClick="save_date('<?=str_replace(".","-",$show->package_name)?>','<?=str_replace(".",".",$show->package_name)?>')" style="cursor: pointer;width: 100%;padding: 10px;border:1px #24cd77 solid;background: #24cd77;color:#fff">Save</button></td>
</tr>
</table>
    </div>
    <div id="boxs-<?=str_replace(".","-",$show->package_name)?>" style="" >
    <div class="category-template-title">
        <a title="<?=$show->title?>" href=#"><?=$show->title?></a>
    </div>
   
    <div class="category-template-down" style="margin-bottom: 5px;">
    	<?php
    	$ceks = connectDB()->Query("SELECT * FROM application WHERE packid='".trim($show->package_name)."' ");
    	$reqs = connectDB()->Fetch($ceks);
        $mode = explode("/",$reqs['directdownload']);
        $mode = @$mode[1];
        $ceks = connectDB()->rowCount($ceks);
    	?>
     
        <span style="display: none;" id="<?=str_replace(".","-",$show->package_name)?>-l"><img src="/views/adminpanel/css/ovalo.svg" width="20" style="margin-right:5px;"></span>
           <?php
        if($mode == "manual"){ ?>
        <a rel="nofollow" class="" id="<?=str_replace(".","-",$show->package_name)?>-t" title="<?=$show->title?>" href="javascript:void(0)" onClick="addNew2('<?=$show->package_name?>','<?=str_replace(".","-",$show->package_name)?>','')" style="border:1px #24cd77 solid;border-radius:5px;<?php if($ceks == 1) echo "background:#24cd77;color:#fff;"; else echo "color:#24cd77;";?>padding: 7px;"><?php if($ceks == 1) echo "Already Publish"; else echo "Publish";?></a>

    <?php }else{ ?>
        <a rel="nofollow" class="" id="<?=str_replace(".","-",$show->package_name)?>-t" title="<?=$show->title?>" href="javascript:void(0)" onClick="addNew('<?=$show->package_name?>','<?=str_replace(".","-",$show->package_name)?>','')" style="border:1px #24cd77 solid;border-radius:5px;<?php if($ceks == 1) echo "background:#24cd77;color:#fff;"; else echo "color:#24cd77;";?>padding: 7px;"><?php if($ceks == 1) echo "Already Publish"; else echo "Publish";?></a>
    <?php } ?>

         <a href="javascript:void(0)" id="btn-<?=str_replace(".","-",$show->package_name)?>" onClick="show_pops('<?=str_replace(".","-",$show->package_name)?>')" style="border:1px #e2e2e3 solid;border-radius:5px;background:#e2e2e3;color:#666;padding: 7px;"><i class="fa fa-caret-down"></i></a>

         <div class="dropdown-menu" id="pops-<?=str_replace(".","-",$show->package_name)?>" x-placement="bottom-start" style="box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);position: absolute;text-align: left;background: #fff;padding: 10px;border:1px #e2e2e3 solid;border-radius: 5px;margin-top: -120px;margin-left: 20px;display: none"> <i class="fa fa-times" style="cursor: pointer;float: right" onClick="show_pops('<?=str_replace(".","-",$show->package_name)?>')" ></i>
            <?php if($ceks == 0){ ?>
            
                                            <span id="loys-<?=str_replace(".","-",$show->package_name)?>">
                                            <a id="drop-<?=str_replace(".","-",$show->package_name)?>" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>','each')" data-toggle="modal" data-target=".bs-example-modal-sms">Publish Each App</a><br>
                                            <a id="drop-<?=str_replace(".","-",$show->package_name)?>-2" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>','all')" data-toggle="modal" data-target=".bs-example-modal-sms">Publish All In Developer</a><br>
                                            <span id="edit-<?=str_replace(".","-",$show->package_name)?>"></span>
                                            </span>
                                            <span id="poys-<?=str_replace(".","-",$show->package_name)?>"></span>
                                        
        <?php }else{ ?>                                        
         <?php if($mode !== "manual"){ ?>
                                            <span id="loys-<?=str_replace(".","-",$show->package_name)?>">
                                            <a id="drop-<?=str_replace(".","-",$show->package_name)?>" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>','each')" data-toggle="modal" data-target=".bs-example-modal-sms">Update Each App</a><br>
                                            <a id="drop-<?=str_replace(".","-",$show->package_name)?>-2" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>','all')" data-toggle="modal" data-target=".bs-example-modal-sms">Update All In Developer</a><br>
                                            <span id="edit-<?=str_replace(".","-",$show->package_name)?>">
                                             <a id="drop-<?=str_replace(".","-",$show->package_name)?>-3" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="go_edit1('<?=$show->package_name?>')" data-toggle="modal" data-target=".bs-example-modal-sms">Edit Post</a>
                                            </span>
                                            </span>
                                            <span id="poys-<?=str_replace(".","-",$show->package_name)?>"></span>
                                        
        <?php }else{ ?>
                                            <span id="loys-<?=str_replace(".","-",$show->package_name)?>">
                                            <a id="drop-<?=str_replace(".","-",$show->package_name)?>" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp2('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>','each')" data-toggle="modal" data-target=".bs-example-modal-sms">Update Each App</a><br>
                                            <a id="drop-<?=str_replace(".","-",$show->package_name)?>-2" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp2('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>','all')" data-toggle="modal" data-target=".bs-example-modal-sms">Update All In Developer</a><br>
                                            <span id="edit-<?=str_replace(".","-",$show->package_name)?>">
                                             <a id="drop-<?=str_replace(".","-",$show->package_name)?>-3" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="go_edit2('<?=$show->package_name?>')" data-toggle="modal" data-target=".bs-example-modal-sms">Edit Post</a>
                                            </span>
                                            </span>

                                            <span id="poys-<?=str_replace(".","-",$show->package_name)?>"></span>
        <?php }
         } ?>
        </div>
        <span id="dina-<?=str_replace(".","-",$show->package_name)?>">
        <?php if($ceks !== 0){ ?>
            <a href="javascript:void(0)" class="trash-<?=str_replace(".","-",$show->package_name)?>" onClick="del_apps_other('<?=str_replace(".",".",$show->package_name)?>','<?=str_replace(".","-",$show->package_name)?>')" style="border:1px #de0303 solid;border-radius:5px;background: #fff;border:1px #de0303 solid;padding: 7px;"><i style="font-size: 15px;color: #de0303" class="fa fa-trash"></i></a>
        <?php }?>
    </span>
    </div>
    <span style="color:#ccc;font-size: 10px;" id="msg-<?=str_replace(".","-",$show->package_name)?>"><?=@$date_ms?></span>
</div>
</li>

<?php }
}
}else{ 
$get_data = connectDB()->bindQuery("SELECT * FROM application ORDER BY id DESC LIMIT 20");
foreach($get_data as $key => $show){ ?>
     <li class="reglist last-id delip-<?=str_replace(".","-",$show->packid)?>" data="<?=$show->id?>" >
    <div class="category-template-img">
        <a title="<?=$show->title?>" href="javascript:void(0)">
            <i class="indibulks fa fa-check-circle bulk-<?=str_replace(".","-",$show->packid)?>" style="float: right;color:#f1f1f1;font-size: 18px;" onClick="bulks('<?=str_replace(".",".",$show->packid)?>','<?=str_replace(".","-",$show->packid)?>')"></i>
           <img class="lazy" src="<?=$show->icon?>" style="display: inline;width: 90px;height: 90px;"></a>
           <i class="fa fa-caret-down <?=str_replace(".","-",$show->packid)?>" style="cursor: pointer;" onClick="set_date('<?=str_replace(".","-",$show->packid)?>')"></i>
        </div>
    <div id="kot-box-<?=str_replace(".","-",$show->packid)?>" style="display: none;background: #f1f1f1;border: 1px #e2e2e3 solid;padding: 10px;">
        <h4>Set Schedule</h4><br>
        <table style="width:100%">
            <tr>
                <td>

        <input autocomplete="off" type="text" readonly="" value="<?=@$sch['date']?>" placeholder="Click Here" style="cursor:pointer;width:100%;padding: 10px;border:1px #e2e2e3 solid;" onClick="date_picker('<?=str_replace(".","-",$show->packid)?>')" id="date-<?=str_replace(".","-",$show->packid)?>">
    </td>
    <td style="width: 40px;"><button onClick="save_date('<?=str_replace(".","-",$show->packid)?>','<?=str_replace(".",".",$show->packid)?>')" style="cursor: pointer;width: 100%;padding: 10px;border:1px #24cd77 solid;background: #24cd77;color:#fff">Save</button></td>
</tr>
</table>
    </div>
    <div id="boxs-<?=str_replace(".","-",$show->packid)?>" style="" >
    <div class="category-template-title">
        <a title="<?=$show->title?>" href=#"><?=$show->title?></a>
    </div>
   
    <div class="category-template-down" style="margin-bottom: 5px;">
        <?php
        $ceks = connectDB()->Query("SELECT * FROM application WHERE packid='".trim($show->packid)."' ");
        $reqs = connectDB()->Fetch($ceks);
        $mode = explode("/",$reqs['directdownload']);
        $mode = @$mode[1];
        $ceks = connectDB()->rowCount($ceks);

        ?>
        
        <span style="display: none;" id="<?=str_replace(".","-",$show->packid)?>-l"><img src="/views/adminpanel/css/ovalo.svg" width="20" style="margin-right:5px;"></span>

        <?php
        if($mode == "manual"){ ?>
        <a rel="nofollow" class="" id="<?=str_replace(".","-",$show->packid)?>-t" title="<?=$show->title?>" href="javascript:void(0)" onClick="addNew2('<?=$show->packid?>','<?=str_replace(".","-",$show->packid)?>','')" style="border:1px #24cd77 solid;border-radius:5px;<?php if($ceks == 1) echo "background:#24cd77;color:#fff;"; else echo "color:#24cd77;";?>padding: 7px;"><?php if($ceks == 1) echo "Already Publish"; else echo "Publish";?></a>

    <?php }else{ ?>
        <a rel="nofollow" class="" id="<?=str_replace(".","-",$show->packid)?>-t" title="<?=$show->title?>" href="javascript:void(0)" onClick="addNew('<?=$show->packid?>','<?=str_replace(".","-",$show->packid)?>','')" style="border:1px #24cd77 solid;border-radius:5px;<?php if($ceks == 1) echo "background:#24cd77;color:#fff;"; else echo "color:#24cd77;";?>padding: 7px;"><?php if($ceks == 1) echo "Already Publish"; else echo "Publish";?></a>
    <?php } ?>

         <a href="javascript:void(0)" id="btn-<?=str_replace(".","-",$show->packid)?>" onClick="show_pops('<?=str_replace(".","-",$show->packid)?>')" style="border:1px #e2e2e3 solid;border-radius:5px;background:#e2e2e3;color:#666;padding: 7px;"><i class="fa fa-caret-down"></i></a>

         <div class="dropdown-menu" id="pops-<?=str_replace(".","-",$show->packid)?>" x-placement="bottom-start" style="box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);position: absolute;text-align: left;background: #fff;padding: 10px;border:1px #e2e2e3 solid;border-radius: 5px;margin-top: -120px;margin-left: 20px;display: none"> <i class="fa fa-times" style="cursor: pointer;float: right" onClick="show_pops('<?=str_replace(".","-",$show->packid)?>')" ></i>
            <?php if($ceks == 0){ ?>
            
                                            <span id="loys-<?=str_replace(".","-",$show->packid)?>">
                                            <a id="drop-<?=str_replace(".","-",$show->packid)?>" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$show->packid)?>','<?=str_replace(".","-",$show->packid)?>','each')" data-toggle="modal" data-target=".bs-example-modal-sms">Publish Each App</a><br>
                                            <a id="drop-<?=str_replace(".","-",$show->packid)?>-2" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$show->packid)?>','<?=str_replace(".","-",$show->packid)?>','all')" data-toggle="modal" data-target=".bs-example-modal-sms">Publish All In Developer</a><br>
                                            <span id="edit-<?=str_replace(".","-",$show->packid)?>"></span>
                                            </span>
                                            <span id="poys-<?=str_replace(".","-",$show->packid)?>"></span>
                                        
        <?php }else{ ?>                                        
         <?php if($mode !== "manual"){ ?>
                                            <span id="loys-<?=str_replace(".","-",$show->packid)?>">
                                            <a id="drop-<?=str_replace(".","-",$show->packid)?>" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$show->packid)?>','<?=str_replace(".","-",$show->packid)?>','each')" data-toggle="modal" data-target=".bs-example-modal-sms">Update Each App</a><br>
                                            <a id="drop-<?=str_replace(".","-",$show->packid)?>-2" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=str_replace(".",".",$show->packid)?>','<?=str_replace(".","-",$show->packid)?>','all')" data-toggle="modal" data-target=".bs-example-modal-sms">Update All In Developer</a><br>
                                            <span id="edit-<?=str_replace(".","-",$show->packid)?>">
                                             <a id="drop-<?=str_replace(".","-",$show->packid)?>-3" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="go_edit1('<?=$show->packid?>')" data-toggle="modal" data-target=".bs-example-modal-sms">Edit Post</a>
                                            </span>
                                            </span>
                                            <span id="poys-<?=str_replace(".","-",$show->packid)?>"></span>
                                        
        <?php }else{ ?>
                                            <span id="loys-<?=str_replace(".","-",$show->packid)?>">
                                            <a id="drop-<?=str_replace(".","-",$show->packid)?>" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp2('<?=str_replace(".",".",$show->packid)?>','<?=str_replace(".","-",$show->packid)?>','each')" data-toggle="modal" data-target=".bs-example-modal-sms">Update Each App</a><br>
                                            <a id="drop-<?=str_replace(".","-",$show->packid)?>-2" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp2('<?=str_replace(".",".",$show->packid)?>','<?=str_replace(".","-",$show->packid)?>','all')" data-toggle="modal" data-target=".bs-example-modal-sms">Update All In Developer</a><br>
                                            <span id="edit-<?=str_replace(".","-",$show->packid)?>">
                                             <a id="drop-<?=str_replace(".","-",$show->packid)?>-3" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="go_edit2('<?=$show->packid?>')" data-toggle="modal" data-target=".bs-example-modal-sms">Edit Post</a>
                                            </span>
                                            </span>

                                            <span id="poys-<?=str_replace(".","-",$show->packid)?>"></span>
        <?php }
         } ?>
        </div>

        <span id="dina-<?=str_replace(".","-",$show->packid)?>">
        <a href="javascript:void(0)" class="trash-<?=str_replace(".","-",$show->packid)?>" onClick="del_apps('<?=str_replace(".",".",$show->packid)?>','<?=str_replace(".","-",$show->packid)?>')" style="border:1px #de0303 solid;border-radius:5px;background: #fff;border:1px #de0303 solid;padding: 7px;"><i style="font-size: 15px;color: #de0303" class="fa fa-trash"></i></a>
    </span>
    </div>
    <span style="color:#ccc;font-size: 10px;" id="msg-<?=str_replace(".","-",$show->packid)?>"><?=@$date_ms?></span>
</div>
</li>
<?php }
}
?>
<li id="new-result" style="display: none;"></li>
</ul>
 

    </div>
    <?php
    if(!empty(getPermalink()->splice(3))){
	if(getPermalink()->splice(3) !== "search"){ ?>
    <a class="loadmores" onClick="load_more('<?=getPermalink()->splice(3)?>',2)" style="cursor: pointer;" >Show More</a>
    <?php }elseif(getPermalink()->splice(3) == "search"){ 
    if(!empty(GET('hl'))) {
        $hl = GET('hl');
    }else{
        $hl = "";
    }

        ?>
    <a class="loadmores" onClick="load_more_search('<?=getPermalink()->splice(4)?>',13,'<?=$hl?>')" style="cursor: pointer;" >Show More</a>
    <?php }
    }else{?>
    <a class="loadmores" onClick="load_more_my()" style="cursor: pointer;" >Show More</a>
    <?php } 
    ?> 
</div>
 <div class="right floatl" id="nav-kanan">
        <div class="box">
    <div class="title menu_head2">Category</div>
    <div class="menu_list">
        <p class="menu_head1" style="padding: 10px;"> Games</p>
        <div>
            <ul class="index-category cicon">
                 <?php

                $sub_cat = @connectDB()->bindQuery("SELECT * FROM category WHERE categori='game'");                                    
                foreach ($sub_cat as $key => $cat_name) { 
                
                if(($cat_name->categori) == "game"){
                $datay = str_replace("_and_editors","","/webmaster/post/".strtolower("game_".str_replace(" ","_",str_replace("&", "and", trim(str_replace("&amp;","&",$cat_name->name))))));
                $cewk = str_replace("_and_editors","",strtolower("game_".str_replace(" ","_",str_replace("&", "and", trim(str_replace("&amp;","&",$cat_name->name))))));
            }else{
                $datay = str_replace("_and_editors","","/webmaster/post/".strtolower(str_replace(" ","_",str_replace("&", "and", trim(str_replace("&amp;","&",$cat_name->name))))));
                $cewk = str_replace("_and_editors","",strtolower(str_replace(" ","_",str_replace("&", "and", trim(str_replace("&amp;","&",$cat_name->name))))));
            }
                	?>
                <li ><a href="<?=$datay?>"><i class="<?=urlGen($cat_name->name)?>"></i><?=$cat_name->name?></a></li>  
                <?php }
                ?>
                
            </ul>
            <div class="clear"></div>
        </div>
        <p class="menu_head1" style="padding: 10px;background: #f5f5f5"> Apps</p>
        <div>
            <ul class="index-category cicon">
                 <?php
                $sub_cat = @connectDB()->bindQuery("SELECT * FROM category WHERE categori='app'");                                    
                foreach ($sub_cat as $key => $cat_name) {

                if(($cat_name->categori) == "game"){
                $datay = str_replace("_and_editors","","/webmaster/post/".strtolower("game_".str_replace(" ","_",str_replace("&", "and", trim(str_replace("&amp;","&",$cat_name->name))))));
                $cewk = str_replace("_and_editors","",strtolower("game_".str_replace(" ","_",str_replace("&", "and", trim(str_replace("&amp;","&",$cat_name->name))))));
            }else{
                $datay = str_replace("_and_editors","","/webmaster/post/".strtolower(str_replace(" ","_",str_replace("&", "and", trim(str_replace("&amp;","&",$cat_name->name))))));
                $cewk = str_replace("_and_editors","",strtolower(str_replace(" ","_",str_replace("&", "and", trim(str_replace("&amp;","&",$cat_name->name))))));
            }
                	?>
                <li><a href="<?=$datay?>"><i class="<?=urlGen($cat_name->name)?>"></i><?=$cat_name->name?></a></li>  
                <?php }
                ?>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>

    </div>
</div>
</div>
