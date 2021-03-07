<?php getFile("part/header"); 
$bind = @connectDB()->bindQuery("SELECT * FROM application WHERE packid='".GET('id')."'");
if(!$bind): echo "<script>window.location = '/';</script>";; exit; endif;
foreach($bind as $key => $result) ;



$cats = connectDB()->bindQuery("SELECT * FROM category WHERE name='".$result->category2."' ");
foreach($cats as $key1 => $category) ;

$_SESSION['packid'] = $result->packid;
$_SESSION['title'] = $result->title;
$_SESSION['version'] = $result->version;

?>
<div class="main page-q" data-type="pkg" data-pkg="<?=$result->packid?>" style=" margin-top:20px;">
	<div class="left">
      
        <?php
        if(!empty(POST('download'))){ 
            
               
            
            ?>
             <div style="margin-bottom: 17px;">  
    <center>
    <?=advertise()->desktop_720_90?>
</center>
  </div>
<div class="box" >
    <div class="title bread-crumbs"><a href="<?=getPermalink()->homeUrl()?>">Home</a> » <a href="<?=getPermalink()->homeUrl()."/".$result->category1."/".urlGen($category->name)?>"><?=$result->category2?></a> » <a href="<?=getPermalink()->documentUrl()?>"><?=htmlspecialchars($result->title) ?></a> » <span>Download</span>

            <span style="float: right;">
                <a href="#share" onClick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?=getPermalink()->documentUrl()?>','share','toolbar=0,status=0,width=550,height=400')"><img src="/views/<?=themeConfig()?>img/fbb.png" height="33" width="33" style="border-radius: 5px;"></a>
                <a href="#share" onClick="window.open('https://twitter.com/home?status=<?=$result->title?> <?=getPermalink()->documentUrl()?>','share','toolbar=0,status=0,width=550,height=400')"><img src="/views/<?=themeConfig()?>img/tww.png" height="33" width="33" style="border-radius: 5px;"></a>
                <a href="#share" onClick="window.open('https://plus.google.com/share?url=<?=getPermalink()->documentUrl()?>','share','toolbar=0,status=0,width=550,height=400')"><img src="/views/<?=themeConfig()?>img/gpp.png" height="33" width="33" style="border-radius: 5px;"></a>
            </span>
            </div>
            <div style="padding: 10px;">
                <center>
     <span style="display: none;" id="hidden-frame"></span>           
    <p style="font-size: 20px;" id="tex-please" >Please Wait ...</p>
    <img src="<?=screenshot($result->icon,110)?>" width="150" style="margin-top: 20px;margin-bottom:20px;">
    <br><label style="font-size: 20px;"><?=$result->title?></label>
    
    <p style="color: #24cd77;font-size: 17px;margin-top:20px;"><?=GET("id").".apk"?>
        </p>
       <span id="cdn-load"></span>
        <div id="download-btn" style="padding: 20px;display: none;">
            <?php 
            $color = ["#457fca" => "#fff","#c2e59c" => "#666","#ed8f03" => "#fff"];
            $num = 0;
            foreach($color as $key => $download){
                
            
            
                echo "<a id='dl-".$num."' style='cursor:pointer;border-radius:5px;box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);padding:10px;background:".array_keys($color)[$num].";border:1px ".array_keys($color)[$num]." solid;margin:5px;color:".$color[array_keys($color)[$num]]."' onClick='download_now(".$num.")' ><span id='lodink-".$num."' style='display:none;'><img src='/views/adminpanel/css/oval.svg' width='18'></span> SERVER ".($num+1)."</a>";
            
            $num++;
            }
            ?>    
            
        </div>
        <p style="margin-top: 5px;" id="not-load-btn">If download doesn't start, click this <a onClick="show_dial()" href="#download"><span id="loading-down" style="display: none;"><img src="/views/<?=themeConfig()?>img/ovalo.svg" width="20"></span> link</a> to download</p>
        
</center>
</div>
</div>
 <div style="margin-bottom: 17px;">  
    <center>
    <?=advertise()->desktop_720_90?>
</center>
  </div>
        <?php }else{ ?> 
		<div class="box">
			<div class="title bread-crumbs"><a href="<?=getPermalink()->homeUrl()?>">Home</a> » <a href="<?=getPermalink()->homeUrl()."/".$result->category1."/".urlGen($category->name)?>"><?=$result->category2?></a> » <span><?=htmlspecialchars($result->title) ?></span>

            <span style="float: right;">
                <a href="#share" onClick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?=getPermalink()->documentUrl()?>','share','toolbar=0,status=0,width=550,height=400')"><img src="/views/<?=themeConfig()?>img/fbb.png" height="33" width="33" style="border-radius: 5px;"></a>
                <a href="#share" onClick="window.open('https://twitter.com/home?status=<?=$result->title?> <?=getPermalink()->documentUrl()?>','share','toolbar=0,status=0,width=550,height=400')"><img src="/views/<?=themeConfig()?>img/tww.png" height="33" width="33" style="border-radius: 5px;"></a>
                <a href="#share" onClick="window.open('https://plus.google.com/share?url=<?=getPermalink()->documentUrl()?>','share','toolbar=0,status=0,width=550,height=400')"><img src="/views/<?=themeConfig()?>img/gpp.png" height="33" width="33" style="border-radius: 5px;"></a>
            </span>
            </div>
			<dl class="ny-dl ny-dl-n">
				<dt>
                    <div class="icon"><img src="<?php echo screenshot($result->icon,110)?>"></div>
                </dt>
                <dd>
                    <div class="title-like">
                        <h1><?=htmlspecialchars_decode($result->title) ?></h1>
                    </div>
                    <div class="details-sdk"><span><?=$result->version?> </span>for Android</div>
                    
                    <div class="details-rating">
                        <div class="stars" title="average: <?=$result->raiting?> out of 5">
                            <span style="width:<?=raitingPersen($result->raiting)?>"></span>
                        </div>
                        <div class="rating-info">
                            <span class="rating"><span class="average"><?=$result->raiting?></span>/<span class="best">5</span></span>
                            
                        </div>
                    </div>
                    <div class="details-author">
                        <p><a title="Get more from <?=$result->developer?>" href="<?=manage()->homeUrl()?>/developer/<?=$result->devurl?>"><span><?=$result->developer?></span></a></p>
                    </div>
                    <div class="ny-down">
                        
                            
                                
                                    
                                    <form method="POST" action="" style="float: left;">
                                        <input type="text" name="download" value="<?=$result->packid?>" style="display: none;">
                                        <button style="border:transparent;cursor: pointer;" class=" da" title="Download <?=htmlspecialchars_decode($result->title)?> apk">Download APK<span class="fsize">(<span><?=sizeGen($result->size)?></span>)</span></button>
                                    </form>
                                    <img alt="Cyber Strike safe verified" src="/views/<?=themeConfig()?>img/icon-verified_v2.png" width="16" style="margin-top:10px;margin-left:10px;">
                                
                            
                        
                        
                            
                            
                        
                    </div>
                    
                </dd>
            </dl>
            
                

                
            
            
            
        
            <div class="describe">
                 <div style="margin-bottom: 17px;">  
    <center>
    <?=advertise()->desktop_720_90?>
</center>
  </div>
                <div class="describe-line"></div>
                <div class="describe-img">
                <div id="slide-box">
                    <div class="det-pic-out">
                        <ul class="pa det-pic-list" style="left: 0px;">
                            <li class="amagnificpopup">
                                <?php 
                                foreach(json_decode($result->screenshoot) as $ay => $img) { 
                              
                                	?>
                                <a target="_blank" style="" href="<?php echo screenshot($img,700)?>" title="<?=htmlspecialchars_decode($result->title)?>">
                                    <img src="<?php echo screenshot($img,400)?>" height="355">
                                </a>
                                <?php } ?>
                                
                                
                            </li>
                        </ul>
                    </div>
                    <a href="javascript:void(0)" class="det-pic-control" id="prev" go=""></a>
                    <a href="javascript:void(0)" class="det-pic-control go" id="next" go=""></a>
                </div>
                </div>
                <div class="describe-line"></div>
                
                	
                <div id="describe">
                    <div class="description">
                    <h2>The description of <?=nl2br(convert_charset()->toUTF8($result->title))?></h2>
                    <div class="content"><?=nl2br(convert_charset()->toUTF8($result->description))?>
                    <?php if(!empty($result->whatsnew)){ ?>
                    <h2 style="margin-top: 20px;margin-bottom: 4px;">What Is New</h2>
                    <div style="padding: 10px;margin-bottom:20px;background: #eee;color:#666;border-radius: 10px;margin-top: 20px;">
                    	<?php
                    	
                    		echo nl2br(convert_charset()->toUTF8($result->whatsnew));
                    	
                    	?>
                    </div>
                    <?php
                    }
                    if(!empty(trim($result->youtube))){
                    echo "<br><br><h2>".nl2br($result->title)." Official Trailer</h2><hr style=\"border:1px #ccc solid\"/><br>";
                    echo "<iframe style=\"border:1px transparent solid;\" src=\"".str_replace("autoplay=1","autoplay=0",$result->youtube)."\" width=\"100%\" height=\"500\"></iframe>";
                    }?>
                    </div>
                    
                    
                    </div>
                </div>
                <div class="showmore_trigger" style="display: block;">
                    <div class="show-more-end"></div>
                    <span>Show More</span>
                </div>
                <script type="text/javascript">var description_translation = '';</script>
                
            </div>
			<div class="clear"></div>
            <div class="describe-line"></div>
            <div class="additional">
                <ul>
                    <li>
                        <p><strong>Category:</strong></p>
                        <p><a title="Download more <?=$result->category2?> <?=$result->category1?>" href="<?=manage()->homeUrl()."/".$category->categori."/".$category->url?>"><span>Free</span> <span><?=$result->category2." ".$result->category1?></span></a></p>
                    </li>
                    <li>
                        <p><strong>Latest Version:</strong></p>
                        <p><?=$result->version?> <a href="javascript:void(0)" onClick="reqUpdate('<?=$result->packid?>')" title="request update"><img src="/views/<?=themeConfig()?>img/requestupdate.png"  height="15"/></a></p>
                    </li>
                    <li>
                        <p><strong>Publish Date:</strong></p>
                        
                        <p><?=$result->date?></p>
                        
                    </li>
                    <li>
                        <p><strong>Get it on:</strong></p>
                        
                        <p><a class="ga"  title="Get <?=htmlspecialchars_decode($result->title) ?> on Google Play" rel="nofollow" href="https://play.google.com/store/apps/details?id=<?=$result->packid?>" target="_blank"><img alt="Get <?=htmlspecialchars_decode($result->title) ?> on Google Play" src="/views/<?=themeConfig()?>img/gp_logo.png" height="16"></a></p>
                        
                    </li>
                    <li>
                        <p><strong>Requirements:</strong></p>
                        <p><?=$result->minsdk?></p>
                    </li>
                    
                </ul>
            </div>
            <div class="clear"></div>
		</div>
        
      <div style="margin-bottom: 17px;">  
    <center>
        
    <?=advertise()->desktop_720_90_artikel?>
</center>
  </div>      
              
<?php } ?>            
        
        

        

        
        
<div class="box">
	<div class="title">
        <div class="smalltit">More From <?=ucwords(strtolower($result->developer))?></div>
        <div class="more"><a title="Get more from <?=$result->developer?>" href="<?=getPermalink()->homeUrl()?>/developer/<?=$result->devurl?>">More »</a></div>
    </div>
    <ul class="top-list">
		
            


  <?php 
                $bind = connectDB()->bindQUery("SELECT* FROM application WHERE developer='".$result->developer."' ORDER BY time DESC LIMIT 9");
                foreach($bind as $key => $val){
                
                 ?>
               <li class="w33">
    <dl>
        <dt><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><img alt="<?=htmlspecialchars_decode($val->title)?>" data-original="<?php echo screenshot($val->icon,50)?>" src="<?=getPermalink()->homeUrl()?>/views/<?=themeConfig()?>img/big.svg" style="display: inline;"></a></dt>
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
	<div class="clear"></div>
</div>




        
       
        
        <div class="box" style="padding: 15px;">
<?php getFile("part/comment")?>
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
    <div style="margin-top: 10px;margin-bottom: 10px;">
         <?=advertise()->desktop_300_250?>
     </div>
        
 <div id="nav-kanan" class="box index_tab index_r_tab">
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
                $bind = @connectDB()->bindQUery("SELECT* FROM application WHERE category1='game' ORDER BY raiting DESC LIMIT 10");
                foreach($bind as $key => $val){
                
                 ?>
                <li>
    <div class="day_list_number"><?=($key+1)?></div>
    <dl>
        <dt><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>">
            <img alt="<?=htmlspecialchars_decode($val->title)?>" data-original="<?php echo screenshot($val->icon,50)?>" src="<?=getPermalink()->homeUrl()?>/views/<?=themeConfig()?>img/big.svg"></a></dt>
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
                $bind = @connectDB()->bindQUery("SELECT* FROM application WHERE category1='app' ORDER BY  raiting DESC LIMIT 10");
                foreach($bind as $key => $val){
                
                 ?>
              <li>
    <div class="day_list_number"><?=($key+1)?></div>
    <dl>
        <dt><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>">
            <img alt="<?=htmlspecialchars_decode($val->title)?>" data-original="<?php echo screenshot($val->icon,50)?>" src="<?=getPermalink()->homeUrl()?>/views/<?=themeConfig()?>img/big.svg"></a></dt>
        <dd class="title-dd">
            <a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><?=htmlspecialchars_decode($val->title)?></a></dd>
        <dd><?=$val->version?></dd>
        <dd><?=$val->date?></dd>
        <dd class="down"><a rel="nofollow" class="" title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>">Download APK</a></dd>
    </dl>
</li>
                <?php } ?>



                    <div  class="day_list_more"><a href="<?php echo getPermalink()->homeUrl()?>/app/?sort=rating">More »</a></div>
                </ul>
            </div>
            <div id="btn-nav-kanan" class="clear"></div>
        </div>
        
        

    </div>
	<div class="clear"></div>
</div>
<?php getFile("part/footer") ?>