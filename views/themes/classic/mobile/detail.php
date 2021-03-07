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


<div class="main page-q" data-type="pkg" data-pkg="com.mobile.legends">
    
    <?php if(!empty(POST('download'))){  ?>

    <div class="details-title">
<a href="<?=getPermalink()->homeUrl()?>">Home</a> » <a href="<?=getPermalink()->homeUrl()."/$result->category1"."/".urlGen($category->name)?>"><?=$result->category2?></a> » <a href="<?=getPermalink()->documentUrl()?>"><?=htmlspecialchars($result->title) ?></a> » <span>Download</span>
    </div>
    <div style="margin-bottom: 10px;">  
    <center>
    <?=advertise()->mobile_responsive?>
</center>
  </div>
    <div class="details" style="padding: 10px;">
    	<center>
            <span style="display: none;" id="hidden-frame"></span>
    <p style="font-size: 20px;" id="tex-please">Downloading ...</p>
    <img src="<?=screenshot($result->icon,100)?>" width="100" style="margin-top: 20px;margin-bottom:20px;">
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

    <?php }else{ ?> 
    <div class="details-title">
       <a href="<?=getPermalink()->homeUrl()?>">Home</a> » <a href="<?=getPermalink()->homeUrl()."/".$result->category1."/".urlGen($category->name)?>"><?=$result->category2?></a> » <span><?=htmlspecialchars($result->title) ?>
    </div>
    <div class="details">
        <div class="p10">
        <dl>
            <dt><img data-original="<?=screenshot($result->icon,65)?>" src="/views/<?=themeConfig()?>img/big.svg"></dt>
            <dd>
                <div class="p1">
                    <h1><?=htmlspecialchars($result->title) ?></h1>
                </div>
                <p class="details-sdk"><span><?=($result->version) ?></span> for Android</p>
                <p><a href="<?=manage()->homeUrl()?>/developer/<?=$result->devurl?>"><span><?=($result->developer) ?></span></a></p>
                
                <div class="details-safe">
                    <a rel="nofollow" title="<?=htmlspecialchars($result->title) ?> safe verified" href="javascript:void(0)">
                        <svg width="19" height="19" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M-1-1h21v21H-1z"></path><g><g fill="#FFF" stroke="null"><path d="M18.017 4.423l-.025-.58-.577-.06c-2.217-.227-4.124-1.055-5.332-1.71C10.76 1.36 9.957.687 9.95.68L9.515.314 9.082.68c-.008.006-.81.678-2.134 1.394-1.208.654-3.115 1.482-5.332 1.71l-.577.06-.026.578C1.01 4.526.917 7 1.87 9.992c.562 1.768 1.373 3.35 2.412 4.706 1.304 1.702 2.968 3.044 4.944 3.988l.29.138.29-.138c1.975-.944 3.64-2.286 4.943-3.988 1.038-1.355 1.85-2.938 2.41-4.705.954-2.994.86-5.467.857-5.57zm-8.502 12.91c-1.65-.84-3.044-1.99-4.152-3.43-.943-1.226-1.684-2.664-2.2-4.274-.633-1.97-.775-3.726-.804-4.588.89-.132 1.788-.354 2.68-.662.873-.302 1.74-.687 2.58-1.144.853-.463 1.502-.906 1.895-1.196.394.29 1.043.733 1.895 1.196.84.457 1.708.842 2.58 1.144.893.308 1.793.53 2.682.663-.027.853-.166 2.584-.79 4.543-.514 1.62-1.254 3.064-2.198 4.296-1.11 1.45-2.51 2.608-4.17 3.45z"></path><path d="M13.173 6.516l-.936.936-3.49 3.49-1.768-1.77-.242-.24-.474.475-.475.475 2.957 2.958 5.375-5.375z"></path></g></g></svg>
                        <span class="details-safe-text">Verification passed</span>
                    </a>
                </div>
                
            </dd>
        </dl>
        </div>
        <div class="down-warp">
            <div class="down" id="down_btns">
                
                    
                        
                             <form method="POST" action="" >
                                        <input type="text" name="download" value="<?=$result->packid?>" style="display: none;">
                                        <button style="border:transparent;display: block;background: #24cd77;color: #fff;border: 1px solid #24cd77;border-radius: 4px;text-align: center;height: 34px;line-height: 34px;font-size: 1.4rem;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;width: 100%;" class=" da" title="Download <?=htmlspecialchars_decode($result->title)?> apk">Download APK<span class="fsize">(<span><?=sizeGen($result->size)?></span>)</span></button>
                                    </form>
                            
                        
                    
                
                </div>
        </div>
        <div style="margin-bottom: 10px;">  
    <center>
    <?=advertise()->mobile_responsive?>
</center>
  </div>
            

            
        
      
        <div class="details-tabs">
            <ul>
                <li>
                    
                    <a href="#comment" id="details-to-bottom" title="average: <?=$result->raiting?> out of 5">
                        <span class="average"><?=$result->raiting?></span>/<span class="best">5</span>
                        <div class="details-stars">
                            <div class="stars">
                                <span title="<?=$result->title?> average rating <?=$result->raiting?>" style="width:<?=raitingPersen($result->raiting)?>"></span>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#download">
                    	<?php
                    	$download = explode("-",$result->download);
                    	?>
                        <span style="font-size: 15px;"><?=trim($download[0])?> +</span>
                        <div class="details-to-comments">Downloaded</div>
                    </a>
                </li>
            </ul>
            <div class="cl"></div>
        </div>
        <div class="share-btn">
           <a href="#share" onClick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?=getPermalink()->documentUrl()?>','share','toolbar=0,status=0,width=550,height=400')"><img src="/views/<?=themeConfig()?>img/fbb.png" height="33" width="33" style="border-radius: 5px;"></a>
                <a href="#share" onClick="window.open('https://twitter.com/home?status=<?=$result->title?> <?=getPermalink()->documentUrl()?>','share','toolbar=0,status=0,width=550,height=400')"><img src="/views/<?=themeConfig()?>img/tww.png" height="33" width="33" style="border-radius: 5px;"></a>
                <a href="#share" onClick="window.open('https://plus.google.com/share?url=<?=getPermalink()->documentUrl()?>','share','toolbar=0,status=0,width=550,height=400')"><img src="/views/<?=themeConfig()?>img/gpp.png" height="33" width="33" style="border-radius: 5px;"></a>
        </div>
        
        <div class="screenbox">
            <div class="screen" id="screen">
                <div class="b" style="transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; transform: translate(0px, 0px) translateZ(0px);">
                	  <?php 
                     foreach(json_decode($result->screenshoot) as $ay => $img) {  ?>
                    <a href="<?php echo screenshot($img,700)?>" target="_blank" class="acolorbox" title="$result->title?> poster" data-width="0" data-height="0" style="width: auto;">
                        <img src="<?php echo screenshot($img,300)?>" style="display: block;height:250px;">
                    </a>
                    <?php } ?>
                  
                </div>
            </div>
        </div>
        <div class="describe" id="describe" style="height: auto; max-height: none;">
            <div class="description">
                 <h2>The description of <?=nl2br($result->title)?></h2>
                <div>
                	<?=nl2br($result->description)?>
                </div>
            </div>
        </div>
        
        
         <?php if(!empty($result->whatsnew)){ ?>
                    
                    <div class="whatnew">
                    	<?php
                    	
                    		echo nl2br($result->whatsnew);
                    	
                    	?>

                    </div>


                    <?php
                    }
                    ?>
        
       <?php
       if(!empty(trim($result->youtube))){
                    
                    ?>
        
        <div class="details-tube">
            <h2><?=$result->title?> official Trailer</h2>
            <div class="tube-cont">
               <?php echo "<iframe style=\"border:1px transparent solid;\" src=\"".str_replace("autoplay=1","autoplay=0",$result->youtube)."\" width=\"100%\" height=\"250\"></iframe>";?>
            </div>
        </div>
        <?php }?>
        
        <div class="additional">
            <p>
                <span><strong>Category:</strong></span>
                <span><a title="Download more <?=$result->category2?> <?=$result->category1?>" href="<?=manage()->homeUrl()."/".$category->categori."/".$category->url?>"><span>Free</span> <span><?=$result->category2." ".$result->category1?></span></a></span>
            </p>
            <p>
                <span><strong>Publish Date:</strong></span>
                
                <span><?=$result->date?></span>
                
            </p>
            <p>
                <span><strong>Latest Version:</strong></span>
                <span><?=$result->version?> <a href="javascript:void(0)" onClick="reqUpdate('<?=$result->packid?>')" title="request update"><img src="/views/<?=themeConfig()?>img/requestupdate.png"  height="15"/></a></span>
            </p>
            <p>
                <span><strong>Get it on:</strong></span>
                
                <span><a class="ga"  title="Get <?=htmlspecialchars_decode($result->title) ?> on Google Play" rel="nofollow" href="https://play.google.com/store/apps/details?id=<?=$result->packid?>" target="_blank"><img alt="Get <?=htmlspecialchars_decode($result->title) ?> on Google Play" src="/views/<?=themeConfig()?>img/gp_logo.png" height="14"></a></span>
                
            </p>
            <p>
                <span><strong>Requirements:</strong></span>
                <span>Android <?=$result->minsdk?></span>
            </p>
          
        </div>
    </div>
    <?php } ?>
    
        
        
            
    
   
    
    
   <div style="margin-bottom: 10px;">  
    <center>
    <?=advertise()->mobile_box?>
</center>
  </div>

    <div class="box-block-title">
        <div class="more"><a href="<?=getPermalink()->homeUrl()?>/developer/<?=$result->devurl?>">More</a><span class="arrow-right"></span></div>
        <div class="tit">More From <?=$result->developer?></div>
    </div>
    <div class="cl"></div>
    
<div class="box" style=" overflow: hidden">
    <div class="box-scroll">
        <div class="bs-s" style="transition-timing-function: cubic-bezier(0.1, 0.57, 0.1, 1); transition-duration: 0ms; transform: translate(0px, 0px) translateZ(0px);">


  <?php 
                $bind = connectDB()->bindQUery("SELECT* FROM application WHERE developer='".$result->developer."' ORDER BY time DESC LIMIT 9");
                foreach($bind as $key => $val){
                
                 ?>
            <a title="<?=$val->title?>" href="<?=permalink_control($val->packid)?>">
    <dl>
        <dt><img alt="<?=$val->title?>" class="lazy1" data-original="<?=screenshot($val->icon,60)?>" src="/views/<?=themeConfig()?>img/big.svg" style="display: inline;"></dt>
        <dd class="d1"><?=$val->title?></dd>
        <dd class="d3">
            <div class="stars"><span title="<?=$val->title?> average rating <?=($val->raiting)?>" style="width:<?=raitingPersen($val->raiting)?>"></span></div>
        </dd>
    </dl>
</a>
                <?php } ?>



            
        </div>
    </div>
    <div class="box-scroll-l"></div>



 



   <div class="comment" style="padding: 10px;background: #fff;margin-top: 10px;">
<?php getFile("part/comment")?>
   </div>
</div>


    
    
</div>
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
<div class="mfp-hide mfp-with-anim ver-popup"></div>

<?php getFile("part/footer") ?>