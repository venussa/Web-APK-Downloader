<?php
if(empty(trim(getPermalink()->splice(2)))) : header("location:/"); exit; endif;
?>
<?php getFile("part/header") ?>
<span style="color:transparent;"><?=require_once(SERVER."/views/".themeConfig()."part/spellcheck.php");?></span>
<div class="main" style="margin-top:20px;">
<!--left-->
	<div class="left">
<div style="margin-bottom: 17px;">  
    <center>
    <?=advertise()->desktop_720_90?>
</center>
  </div>
		<div class="box">
			
          
            
			<div class="search-results">
				<div class="search-bg">
				<form  onSubmit="return conf_search(this)" class="formsearch" >
					<span class="text-box">
					<input class="autocomplete" autocomplete="off" title="Enter App Name, Package Name, Package ID" name="q" value="<?=htmlspecialchars($natural)?>" placeholder="Enter App Name, Package Name, Package ID" required="" type="text" onkeyup="go_search(this)">
					</span>
					<input autocomplete="off" id="slugy1" value="<?=getPermalink()->splice(2)?>" style="display: none;">
                    <span class="text-btn" title="Search APK">
					<input class="si" value="" type="submit">
					</span>
                    <input id="hidregion" name="region" value="<??>" type="hidden">
				</form>
				</div>
				<div class="search-text">
                    <span><?=$found?></span> search results found.
                    
                   
                    
                </div>
              
			</div>
            <div id="search-res">
    <?php
    if($response == false){
    echo "<h1 align=\"center\" style=\"padding:200px;\" >Not Found</h1>";
    }else{
    foreach($execute as $key => $val){ ?>        
<dl class="search-dl" id="<?=$val->id?>">
    <dt><a title="<?=$val->title?>" target="_blank" href="<?=permalink_control($val->packid)?>">
    	<img src="<?=screenshot($val->icon,90)?>" style="display: inline;">
    </a></dt>
    <dd>
        <p class="search-title"><a title="<?=$val->title?>" target="_blank" href="<?=permalink_control($val->packid)?>"><?=$val->title?></a></p>
        <div class="stars"><span title="<?=$val->title?> average rating <?=$val->raiting?>" style="width:<?=raitingPersen($val->raiting)?>"></span></div>
        <p>Developer: <a href="/developer/<?=$val->devurl?>"><?=$val->developer?></a></p>
        <p><a style="background-color: #24cd77" target="_blank" class="more-down" href="<?=permalink_control($val->packid)?>">Read More</a></p>
    </dd>
</dl>
<?php }
?>
<dl id="load_here" style="display: none;"></dl>
<?php
} ?>

</div>
            
			<div class="clear"></div>
		</div>
        
       <?php
       if($found > show_limit_category()){ ?>
        <a class="loadmores" onClick="search_more(this)" keyword="<?=$word?>" href="javascript:void(0)">Show More</a>
        <?php } ?>
        
	</div>
	<!--left-->
	<!--right-->
	<div class="right">
        <div class="box" style="margin-bottom: 12px;">
        <div class="title">
                Follow <?=siteSetting()->sitename?>
            </div>
            <div class="bd" style="padding: 5px;">
                <table width="100%">
                    <tr>
                        <td style="text-align: center;padding: 5px;"><a rel="nofollow" target="_blank" style="color:#666" href="<?=siteSetting()->FB_fanspage?>"><img src="/views/<?=themeConfig()?>img/fbb.png" width="30"><br>Facebook</a></td>
                        <td style="text-align: center;padding: 5px;"><a rel="nofollow" target="_blank" style="color:#666" href="<?=siteSetting()->TW_fanspage?>"> <img src="/views/<?=themeConfig()?>img/tww.png" width="30"><br>Twitter</a></td>
                        <td style="text-align: center;padding: 5px;"><a rel="nofollow" target="_blank" style="color:#666" href="<?=siteSetting()->GP_fanspage?>"> <img src="/views/<?=themeConfig()?>img/gpp.png" width="30"><br>Google+</a></td>
                    </tr>
                </table>
                 
                    
                    
            </div>
       </div> 

 <div style="margin-top: 10px;margin-bottom: 10px;">
         <?=advertise()->desktop_300_250?>
</div>
   
        
 <div class="box index_tab index_r_tab">
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
                $bind = connectDB()->bindQUery("SELECT* FROM application WHERE category1='game' ORDER BY rank DESC  LIMIT 10");
                foreach($bind as $key => $val){
                
                 ?>
                <li>
    <div class="day_list_number"><?=($key+1)?></div>
    <dl>
        <dt><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>">
            <img alt="<?=htmlspecialchars_decode($val->title)?>" data-original="<?php echo screenshot($val->icon,60)?>" src="<?=getPermalink()->homeUrl()?>/views/<?=themeConfig()?>img/big.svg"></a></dt>
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
                $bind = connectDB()->bindQUery("SELECT* FROM application WHERE category1='app' ORDER BY rank DESC  LIMIT 10");
                foreach($bind as $key => $val){
                 ?>
              <li>
    <div class="day_list_number"><?=($key+1)?></div>
    <dl>
        <dt><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>">
            <img alt="<?=htmlspecialchars_decode($val->title)?>" data-original="<?php echo screenshot($val->icon,60)?>" src="<?=getPermalink()->homeUrl()?>/views/<?=themeConfig()?>img/big.svg"></a></dt>
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
         <div style="margin-top: 10px;margin-bottom: 10px;">
         <?=advertise()->desktop_300_250?>
     </div>
    
	</div>
	<!--right-->
	<div class="clear"></div>
</div>
<!--main-->


<div class="clear" style="height:0px;"></div>

<?php getFile("part/footer") ?>