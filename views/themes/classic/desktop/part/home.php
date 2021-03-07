
<div class="main" style="padding-top:20px;">
    <div class="left">
        
        <div class="box">
    
    
    <div class="index_banner">
        <div class="thd">
            <ul>
                <?php 
                $bind = connectDB()->bindQUery("SELECT* FROM application WHERE category1='game' ORDER BY rank DESC LIMIT 5");
                foreach($bind as $key => $val){
                if($val->no == 5) $display = "list-item"; else $display = "none";
                 ?>
                <li style="display: <?=$display?>;"><?=htmlspecialchars_decode($val->title) ?></li>
                <?php } ?>
                </ul>
        </div>
        <div class="hd">
            <ul>
                <li style="border-radius: 100%" class="on"></li>
                <li style="border-radius: 100%" class=""></li>
                <li style="border-radius: 100%" class=""></li>
                <li style="border-radius: 100%" class=""></li>
                <li style="border-radius: 100%" class=""></li>
            </ul>
        </div>
        <div class="bd">
            <div class="tempWrap" style="overflow: hidden; position: relative; width: auto;">
                <ul style="width: 4250px; left: -3400px; position: relative; overflow: hidden; padding: 0px; margin: 0px;">

                <?php 
                $bind = connectDB()->bindQUery("SELECT* FROM application WHERE category1='game' ORDER BY rank DESC  LIMIT 5");
                foreach($bind as $key => $val){
                if($val->no == 5) $display = "list-item"; else $display = "none";
                $banner = json_decode($val->screenshoot);
                 ?>
                <li style="float: left; width: 850px;">
                        <a title="<?=$val->title?>" href="<?=permalink_control($val->packid)?>">
                            <img src="<?php echo screenshot($banner[0],700)?>" style="height:478px">
                        </a>
                    </li>
                <?php } ?>

                    
             </ul></div>
        </div>
        <a class="prev" href="javascript:void(0)"></a>
        <a class="next" href="javascript:void(0)"></a>
    </div>
    
</div>
    </div>
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
       <div style="width: 100%;height:250px;">
       <?=advertise()->desktop_300_250?>
   </div>

       
    </div>
    <div class="clear"></div>

    
    <div class="right">
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
                if($val->no == 5) $display = "list-item"; else $display = "none";
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
                if($val->no == 5) $display = "list-item"; else $display = "none";
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
    </div>
    
    <div class="left">
        <div class="box index_tab">
            <div class="title">
                <ul class="thd">
                    <li><a href="<?php echo getPermalink()->homeUrl()?>/game">Games »</a> </li>
                    <li style="display: none"><a href="<?php echo getPermalink()->homeUrl()?>/app">Apps »</a></li>
                </ul>
                <ul class="hd hdl">
                    <li class="on"><a href="javascript:void(0)" title="Games">Games</a></li>
                    <li><a href="javascript:void(0)" title="Apps">Apps</a></li>
                </ul>
            </div>
            <div class="bd">
                <ul class="top-list sublist">
                    
                   <?php 
                $bind = connectDB()->bindQUery("SELECT* FROM application WHERE category1='game' ORDER BY id DESC LIMIT 12");
                foreach($bind as $key => $val){
                if($val->no == 5) $display = "list-item"; else $display = "none";
                 ?>
                <li class="w33">
    <dl>
        <dt><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><img alt="<?=htmlspecialchars_decode($val->title)?>" data-original="<?php echo screenshot($val->icon,60)?>" src="<?=getPermalink()->homeUrl()?>/views/<?=themeConfig()?>img/big.svg" style="display: inline;"></a></dt>
        <dd class="title-dd"><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><?=htmlspecialchars_decode($val->title)?></a></dd>
        
        <dd>
            <div class="stars"><span title="<?=htmlspecialchars_decode($val->title)?> average rating <?=$val->raiting?>" style="width:<?=raitingPersen($val->raiting)?>"></span></div>
        </dd>
        
        
        <dd><?=$val->date?></dd>
        
        <dd class="down"><a rel="nofollow" class="" title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>">Download APK</a></dd>
    </dl>
</li>
                <?php } ?>

                </ul>

                <ul class="top-list sublist">
                    
                  <?php 
                $bind = connectDB()->bindQUery("SELECT* FROM application WHERE category1='app' ORDER BY id DESC LIMIT 12");
                foreach($bind as $key => $val){
                if($val->no == 5) $display = "list-item"; else $display = "none";
                 ?>
                <li class="w33">
    <dl>
        <dt><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><img alt="<?=htmlspecialchars_decode($val->title)?>" data-original="<?php echo screenshot($val->icon,60)?>" src="<?=getPermalink()->homeUrl()?>/views/<?=themeConfig()?>img/big.svg" style="display: inline;"></a></dt>
        <dd class="title-dd"><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><?=htmlspecialchars_decode($val->title)?></a></dd>
        
        <dd>
            <div class="stars"><span title="<?=htmlspecialchars_decode($val->title)?> average rating <?=$val->raiting?>" style="width:<?=raitingPersen($val->raiting)?>"></span></div>
        </dd>
        
        
        <dd><?=$val->date?></dd>
        
        <dd class="down"><a rel="nofollow" class="" title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>">Download APK</a></dd>
    </dl>
</li>
                <?php } ?>

                </ul>
            </div>
            <div class="clear"></div>
        </div>
  <div style="margin-bottom: 17px;">  
    <center>
    <?=advertise()->desktop_720_90?>
</center>
  </div>
  
        <div class="box index_tab">
            <div class="title">
                <ul class="thd">
                    <li><a href="<?php echo getPermalink()->homeUrl()?>/game/?sort=new">Update Games »</a></li>
                    <li style="display: none"><a href="<?php echo getPermalink()->homeUrl()?>/app/?sort=new">Update Apps »</a></li>
                </ul>
                <ul class="hd hdl">
                    <li class="on"><a href="javascript:void(0)" title="Update Games">Games</a></li>
                    <li><a href="javascript:void(0)" title="Update Apps">Apps</a></li>
                </ul>
            </div>
            <div class="bd">
                <ul class="top-list sublist">
                    
                   <?php 
                $bind = connectDB()->bindQUery("SELECT* FROM application WHERE category1='game' ORDER BY time DESC LIMIT 12");
                foreach($bind as $key => $val){
                if($val->no == 5) $display = "list-item"; else $display = "none";
                 ?>
               <li class="w33">
    <dl>
        <dt><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><img alt="<?=htmlspecialchars_decode($val->title)?>" data-original="<?php echo screenshot($val->icon,60)?>" src="<?=getPermalink()->homeUrl()?>/views/<?=themeConfig()?>img/big.svg" style="display: inline;"></a></dt>
        <dd class="title-dd"><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><?=htmlspecialchars_decode($val->title)?></a></dd>
        
        <dd>
            <div class="stars"><span title="<?=htmlspecialchars_decode($val->title)?> average rating <?=$val->raiting?>" style="width:<?=raitingPersen($val->raiting)?>"></span></div>
        </dd>
        
        
        <dd><?=$val->date?></dd>
        
        <dd class="down"><a rel="nofollow" class="" title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>">Download APK</a></dd>
    </dl>
</li>
                <?php } ?>

                </ul>
                 <ul class="top-list sublist">
                    
                   <?php 
                $bind = connectDB()->bindQUery("SELECT* FROM application WHERE category1='app' ORDER BY time DESC LIMIT 12");
                foreach($bind as $key => $val){
                if($val->no == 5) $display = "list-item"; else $display = "none";
                 ?>
               <li class="w33">
    <dl>
        <dt><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><img alt="<?=htmlspecialchars_decode($val->title)?>" data-original="<?php echo screenshot($val->icon,60)?>" src="<?=getPermalink()->homeUrl()?>/views/<?=themeConfig()?>img/big.svg" style="display: inline;"></a></dt>
        <dd class="title-dd"><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><?=htmlspecialchars_decode($val->title)?></a></dd>
        
        <dd>
            <div class="stars"><span title="<?=htmlspecialchars_decode($val->title)?> average rating <?=$val->raiting?>" style="width:<?=raitingPersen($val->raiting)?>"></span></div>
        </dd>
        
        
        <dd><?=$val->date?></dd>
        
        <dd class="down"><a rel="nofollow" class="" title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>">Download APK</a></dd>
    </dl>
</li>
                <?php } ?>

                </ul>
            </div>
            <div class="clear"></div>
        </div>
       <div style="margin-bottom: 17px;">  
    <center>
        
    <?=advertise()->desktop_720_90?>
</center>
  </div>
    </div>
   
</div>