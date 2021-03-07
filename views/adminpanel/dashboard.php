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
		<div style="width: 24%;float: left;padding-right: 5px;">
				<div style="background:#fff;border: 1px #e2e2e3 solid;border-bottom: 1px transparent solid;border-radius: 5px 5px 0 0;padding: 10px;">
				<table width="100%">
					<tr>
						<td style="padding: 5px;padding-left:0px;text-align: center;"><i class="fa fa-globe" style="margin-left:-25px;font-size: 50px;"></i></td>
						<td style="padding: 5px"><b style="float:right;font-size: 30px;"><?=Visitor()->online?></b></td>
					</tr>
					<tr>
						<td colspan="2"><span style="float: right;">Online Visitor</span></td>
					</tr>
				</table>
				</div>
				<div style="background: #24cd77;border-radius: 0 0 5px 5px;padding: 10px;color:#fff">Time Visit <span class="pull-right"><?=SESSION('time')?> Min</span></div>
				</div>


			<div style="width: 24%;float: left;padding-right: 5px;">
				<div style="background:#fff;border: 1px #e2e2e3 solid;border-bottom: 1px transparent solid;border-radius: 5px 5px 0 0;padding: 10px;">
				<table width="100%">
					<tr>
						<td style="padding: 5px;padding-left:0px;text-align: center;"><i class="fa fa-users" style="margin-left:-25px;font-size: 50px;"></i></td>
						<td style="padding: 5px"><b style="float:right;font-size: 30px;"><?=Visitor()->thisday?></b></td>
					</tr>
					<tr>
						<td colspan="2"><span style="float: right;">Visitor This Day</span></td>
					</tr>
				</table>
				</div>
				<div style="background: #24cd77;border-radius: 0 0 5px 5px;padding: 10px;color:#fff">One Day Ago <span class="pull-right"><?=Visitor()->thispersen?></span></div>
				</div>


			<div style="width: 24%;float: left;padding-right: 5px;">
				<div style="background:#fff;border: 1px #e2e2e3 solid;border-bottom: 1px transparent solid;border-radius: 5px 5px 0 0;padding: 10px;">
				<table width="100%">
					<tr>
						<td style="padding: 5px;padding-left:0px;text-align: center;"><i class="fa fa-gamepad" style="margin-left:-15px;font-size: 50px;"></i></td>
						<td style="padding: 5px"><b style="float:right;font-size: 30px;"><?=artikel()['all_game']?></b></td>
					</tr>
					<tr>
						<td colspan="2"><span style="float: right;">Total Games</span></td>
					</tr>
				</table>
				</div>
				<div style="background: #24cd77;border-radius: 0 0 5px 5px;padding: 10px;color:#fff">Total Category <span class="pull-right"><?=artikel()['count_game']?></span></div>
				</div>


			<div style="width: 26%;float: left;padding: 0px;">
				<div style="background:#fff;border: 1px #e2e2e3 solid;border-bottom: 1px transparent solid;border-radius: 5px 5px 0 0;padding: 10px;">
				<table width="100%">
					<tr>
						<td style="padding: 5px;padding-left:0px;text-align: center;"><i class="fa fa-cubes" style="margin-left:-25px;font-size: 50px;"></i></td>
						<td style="padding: 5px"><b style="float:right;font-size: 30px;"><?=artikel()['all_app']?></b></td>
					</tr>
					<tr>
						<td colspan="2"><span style="float: right;">Total Apps</span></td>
					</tr>
				</table>
				</div>
				<div style="background: #24cd77;border-radius: 0 0 5px 5px;padding: 10px;color:#fff">Total Category <span class="pull-right"><?=artikel()['count_app']?></span></div>
				</div>



		<div class="box" style="margin-top:160px;">
			
			<div class="bd" style="padding: 20px;">
				
				<canvas id="canvas"></canvas>
			</div>
		</div>

		<div class="box">
			<div class="title"><i class="fa fa-bell-o"></i> Request Update From Visitor</div>
			<div class="bd" style="padding: 5px;">
				<table id="tech-companies-1" class="table  table-striped" width="100%">
                                            
                                            <tbody>
                                            
                                            	<?php
                                            	$get = connectDB()->Query("SELECT * FROM updateapps ORDER BY id DESC LIMIT 10");
                                            	$hits = connectDB()->rowCount($get);
                                            	$nos = 1;
                                            	while($show = connectDB()->Fetch($get)){
                                            		?>
                                            		<tr class="reg-up" id="reg-up-<?=$show['id']?>" update="<?=$show['id']?>" style="<?php if($nos % 2 == 1) echo "background: #edfaec"; $nos++?>">
                                            		<td  style="padding: 10px;"><?=$show['packid']?></td>
                                            		<td style="padding: 10px;"><?=$show['hit']?></td>
                                            		<td style="padding: 10px;"><?=$show['date']?></td>
                                            		<td style="padding: 10px;"><?=manage()->timeHistory($show['time'])?></td>
                                            		<td style="padding: 10px;text-align: center;">
                                            			<div class="btn-group m-b-10">
                                        
                                        <button style="background: #24cd77;padding: 10px;border:transparent;color: #fff;border-radius: 3px;" type="button" class=" btn-<?=$show['id']?> btn btn-default" onClick="show_pops(<?=$show['id']?>)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Update <span class="mdi mdi-chevron-down "></span>
                                        </button> 
                                        <div class="dropdown-menu" id="pops-<?=$show['id']?>" x-placement="bottom-start" style="box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);position: absolute;text-align: left;background: #fff;padding: 10px;border:1px #e2e2e3 solid;border-radius: 5px;margin-top: -60px;margin-left: -70px;display: none"> 
                                        	<span id="loys-<?=$show['id']?>">
                                            <a style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=$show['packid']?>',<?=$show['id']?>,'each')" data-toggle="modal" data-target=".bs-example-modal-sms">Each App</a><br>
                                            <a style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="updateApp('<?=$show['packid']?>',<?=$show['id']?>,'all')" data-toggle="modal" data-target=".bs-example-modal-sms">All In Developer</a>
                                            </span>
                                            <span id="poys-<?=$show['id']?>"></span>
                                        </div>
                                    </div>
                                            			</td>
                                            	</tr>
                                            		<?php
                                            	}
                                            	?>
                                            	<tr id="placa" style="display: none;"></tr>
                                            
                                            
                                            </tbody>
                                        </table>
                                        <?php if($hits !== 0){ ?>
                                        <!-- <center><a href="javascript:void(0)" onClick="upPages()" style="color:#666">Show More <i class="mdi mdi-chevron-double-down "></i></a></center> -->
                                        <?php }else{ ?>
                                        <center><h3 style="padding: 20px;color:#666">Not Found</h3></center>
                                        <?php } ?>
			</div>
		</div>


	</div>




	<div class="right">
		<div class="box">
			<div class="title"><i class="fa fa-television"></i> Top Keyword</div>
			<div class="bd" style="padding: 5px;">
				<small style="color:#666;margin-top: 10px;margin-bottom:10px ">Tracking Populare keyword who search in website</small>

				<table id="tech-companies-1" class="table  table-striped" style="width: 100%;margin-top: 20px;">
                                           
                                            <tbody>
                                            
                                            	<?php
                                            	$get = connectDB()->Query("SELECT * FROM keyword ORDER BY rank DESC LIMIT 5");
                                            	$rowcount = connectDB()->rowCount($get);
                                            	$nos = 1;
                                            	while($show = connectDB()->Fetch($get)){
                                            		$rank = @connectDB()->Query("SELECT SUM(count) as count FROM keyword");
													$rank = $rank->fetchColumn();
													$persen = $show['count'] * 100 / $rank;
                                            		?>
                                            		<tr class="reg-up" update="<?=$show['id']?>" style="<?php if($nos % 2 == 1) echo "background: #edfaec";?> ">
                                            		<td  style="padding: 10.5px;"><?=$show['name']?></td>
                                            		<td  style="padding: 10.5px;"><?=substr($persen,0,5)?> %</td>
                                            	</tr>
                                            		
                                            		<?php
                                            		$nos++;
                                            	}
                                            	?>
                                            	
                                            
                                            
                                            </tbody>
                                        </table>
                                        <?php if($rowcount == 0){ ?>
                                       <center><h5 style="padding: 20px;color:#666">Not Found</h5></center>
                                       <?php } ?>
			</div>
		</div>

		 <div class="box index_tab index_r_tab" >
            <div class="title">
                <ul class="thd">
                    <li><a title="Hot Games" href="<?php echo getPermalink()->homeUrl()?>/game/?sort=rating">Hot »</a></li>
                    <li style="display: none"><a title="Hot Apps" href="<?php echo getPermalink()->homeUrl()?>/app/?sort=rating">Hot »</a></li>
                </ul>
                <ul class="hd hdr">
                    <li class="on"><a href="javascript:void(0)" title="Hot Games">Games</a></li>
                    <li><a href="javascript:void(0)" title="Hot Apps">Apps</a></li>
                </ul>
            </div>
            <div class="bd">
                <ul class="day_list">
                    
                    



 
                    
                   <?php 
                $bind = connectDB()->bindQUery("SELECT* FROM application WHERE category1='game' ORDER BY rank DESC  LIMIT 5");
                foreach($bind as $key => $val){
                
                 ?>
                <li>
    <div class="day_list_number"><?=($key+1)?></div>
    <dl>
        <dt><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>">
            <img alt="<?=htmlspecialchars_decode($val->title)?>" data-original="<?php echo screenshot($val->icon,75)?>" src="<?=getPermalink()->homeUrl()?>/views/<?=themeConfig()?>img/big.svg"></a></dt>
        <dd class="title-dd">
            <a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><?=htmlspecialchars_decode($val->title)?></a></dd>
        <dd><?=$val->version?></dd>
        <dd><?=$val->date?></dd>
        <dd class="down"><a rel="nofollow" class="" title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>">Download APK</a></dd>
    </dl>
</li>
                <?php } ?>

                

                    <div class="day_list_more"><a href="<?php echo getPermalink()->homeUrl()?>/game/?sort=rating">More »</a></div>
                </ul>
                <ul class="day_list" style="display: none;">
                    
                    

  <?php 
                $bind = connectDB()->bindQUery("SELECT* FROM application WHERE category1='app' ORDER BY rank DESC  LIMIT 5");
                foreach($bind as $key => $val){
                
                 ?>
              <li>
    <div class="day_list_number"><?=($key+1)?></div>
    <dl>
        <dt><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>">
            <img alt="<?=htmlspecialchars_decode($val->title)?>" data-original="<?php echo screenshot($val->icon,75)?>" src="<?=getPermalink()->homeUrl()?>/views/<?=themeConfig()?>img/big.svg"></a></dt>
        <dd class="title-dd">
            <a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><?=htmlspecialchars_decode($val->title)?></a></dd>
        <dd><?=$val->version?></dd>
        <dd><?=$val->date?></dd>
        <dd class="down"><a rel="nofollow" class="" title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>">Download APK</a></dd>
    </dl>
</li>
                <?php } ?>



                    <div class="day_list_more"><a href="<?php echo getPermalink()->homeUrl()?>/app/?sort=rating">More »</a></div>
                </ul>
            </div>
            <div class="clear"></div>
        </div>



	</div>

</div>