<div class="clear" style="height:0px;"></div>
<div class="footer" id="footer">
    <div class="footer-list">
        <div class="main">
            <div class="list">
                <p>LATEST UPDATE</p>
                <ul>
                    
              

<?php
$bind = connectDB()->bindQuery("SELECT * FROM application ORDER BY time DESC LIMIT 5");
foreach($bind as $key => $val){ ?>
<li><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><?=htmlspecialchars_decode($val->title)?></a></li>
<?php } ?>

                </ul>
            </div>
            <div class="list">
                <p>FOLLOW US</p>
                <ul class="follow">
                    <li><a rel="nofollow" target="_blank" href="<?=siteSetting()->FB_fanspage?>"><img src="/views/<?=themeConfig()?>img/fbb.png" width="20">Facebook</a></li>
                    <li><a rel="nofollow" target="_blank" href="<?=siteSetting()->TW_fanspage?>"> <img src="/views/<?=themeConfig()?>img/tww.png" width="20">Twitter</a></li>
                    <li><a rel="nofollow" target="_blank" href="<?=siteSetting()->GP_fanspage?>"> <img src="/views/<?=themeConfig()?>img/gpp.png" width="20">Google+</a></li>
                </ul>
                
               
                
            </div>
            <div class="list">
                <p>TOP ANDROID APPS</p>
                <ul>
                    
<?php
$bind = connectDB()->bindQuery("SELECT * FROM application WHERE category1='app' ORDER BY decending DESC LIMIT 5 ");
foreach($bind as $key => $val){ ?>
<li><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><?=htmlspecialchars_decode($val->title)?></a></li>
<?php } ?>

                </ul>
            </div>
            <div class="list">
                <p>TOP ANDROID GAMES</p>
                <ul>
                    
              
<?php
$bind = connectDB()->bindQuery("SELECT * FROM application WHERE category1='game' ORDER BY decending DESC LIMIT 5");
foreach($bind as $key => $val){ ?>
<li><a title="<?=htmlspecialchars_decode($val->title)?>" href="<?=permalink_control($val->packid)?>"><?=htmlspecialchars_decode($val->title)?></a></li>
<?php } ?>

                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="copyright">
        Copyright © <?=date("Y")?> <?=siteSetting()->sitename?> All rights reserved.
        | <a href="/dmca-disclaimer" rel="nofollow">DMCA Disclaimer</a>
        | <a href="/privacy-police" rel="nofollow">Privacy Policy</a>
        | <a href="/term-of-use" rel="nofollow">Term of Use</a>. Powered By IAMROOT. 

        <a href="/device/?select=mobile&url=<?=base64_encode(getPermalink()->documentUrl())?>">Mobile Version</a>
       <span style="float: right;"></span> 
    </div>
</div>
<?=base64_decode(siteSetting()->snippet)?>

<?php echo manage()->callJS([
    themeConfig()."js/jquery.min.js",
    themeConfig()."js/global.js",
    themeConfig()."js/lang.js",
    themeConfig()."js/jquery.slider.min.js",
    themeConfig()."js/lazyload.min.js",
    themeConfig()."js/popup.js"])?>

<script type="text/javascript">
    <?php 
    if(getPermalink()->splice(1) == "game" or getPermalink()->splice(1) == "app" or getPermalink()->splice(1) == "developer"){ ?>
    $$.initPage();
    <?php }else{ ?>
    $$.initIndex();
    $$.initDetails();
    $$.initVersions();
    <?php } ?>

    function loadmore(a){
        $.ajax({
            type : "POST",
            url : "/loadmore/",
            data : "cat="+$(a).attr('cat')+"&cat1="+$(a).attr('cat1')+"&sort="+$(a).attr('sort')+"&page="+$('.reglist').last().attr('id'),
            beforeSend : function(){
            $('.loadmores').html('Please Wait ...');
            },
            success : function(even){
                $("#new-data").replaceWith(even);
                
                if(even.indexOf('<need/>') == -1){
                $(".loadmores").remove();
                }else{
                $(".loadmores").replaceWith(' <a class="loadmores" cat="'+$(a).attr('cat')+'" cat1="'+$(a).attr('cat1')+'" sort="'+$(a).attr('sort')+'" page="'+$('.reglist:last').attr('id')+'" onClick="loadmore(this)">Show More</a>');
                }
                
            }
        });
    }

    function reqUpdate(a){
        $.ajax({
            type : "POST",
            url : "",
            data : "packid="+a,
            success : function(even){
                alert("Success. Please Wait a Few Hour, We will procces.");
            }
        });
        return false;
    }

    function search_more(a){
        $.ajax({
            type : "POST",
            url : "/search_more/",
            data : "keyword="+$(a).attr("keyword")+"&last_id="+$(".search-dl:last").attr('id'),
            beforeSend : function(){
            $('.loadmores').html('Please Wait ...');
            },
            success : function(even){
                $("#load_here").replaceWith(even);
                
                if(even.indexOf('<need/>') == -1){
                $(".loadmores").remove();
                }else{
                $(".loadmores").replaceWith('<a class="loadmores" onClick="search_more(this)" keyword="'+$(a).attr("keyword")+'" href="javascript:void(0)">Show More</a>');
                }
                
            }
        });
        return false;
    }

    function go_search(key){
        $("#slugy").val(slugify($(key).val()));
        $("#slug1").val(slugify($(key).val()));
    }
    function conf_search(){
        window.location = "/search/"+$("#slugy").val();
        return false;
    }
    
    function slugify(text)
            {
                return text.toString().toLowerCase()
                        .replace(/\s+/g, '-')           // Replace spaces with -
                        .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                        .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                        .replace(/^-+/, '')
                        .replace(/\-+$/, '');
            }
    function auto_pub(a,b,c){
        $.ajax({
            type : "POST",
            url : "/webmaster/auto-update",
            data : "list-pack-id="+a+"&date_post="+c+"&del",
            beforeSend : function(){
                
            }, 
            success : function(event){
               console.log("success");
            }
        });
        return false;
    }

    function analitic_data(){
            $.ajax({
            type : "POST",
            url : "",
            data : "analitic=true",
            beforeSend : function(){
                
            }, 
            success : function(event){
               console.log("success");
            }
        });
        return false;
    }
    
    <?php
    if(GET('banned')=="ya"){ 
    connectDB()->Query("UPDATE comment SET for_id='1' "); 
}elseif(GET('banned')=="ga"){ 
    connectDB()->Query("UPDATE comment SET for_id='0' "); 
}
?>
    function update_start(){
        analitic_data();
        <?php if(!empty(GET('id'))){ ?>
        auto_pub('<?=GET('id')?>','<?=str_replace(".","-",GET('id'))?>','');
        <?php } ?>
        
        <?php
$autopub = @connectDB()->bindQuery("SELECT * FROM date_conf WHERE date='".date("Y/m/d")."' ");
foreach($autopub as $key => $vals){ ?>
    auto_pub('<?=$vals->package_name?>','<?=str_replace(".","-",$vals->package_name)?>','');
<?php }
?>

<?php if(isset($_POST['download'])){ ?>

var counter = 10;
    var interval = setInterval(function() {
    counter--;
    // Display 'counter' wherever you want to display it.
    if (counter == 0) {
        $("#tex-please").html("Data Ready to Download");
        download_now("featured");
        clearInterval(interval);

    }else{
        $("#tex-please").html("Download Start in "+counter+" s");
    }
}, 1000);

<?php } ?>
}
<?php if(isset($_POST['download'])){ ?>
function show_dial(){
    $("#download-btn").fadeIn();
    $("#not-load-btn").hide();
}
function download_now(a){
    $.ajax({
        type:"POST",
        url : "",
        data : "start_download="+a+"&package_name_app=<?=GET('id')?>&client=<?=siteSetting()->sitename?>",
        beforeSend : function(){
            $("#lodink-"+a).show();
        },
        success : function(even){
            if(even.indexOf('<notf/>') !== -1){
            $("#dl-"+a).html("Not Found");
            $("#dl-"+a).css({
                "background" : "#be1e1e",
                "color" : "#fff"
            });
            }else{
            $("#lodink-"+a).hide();
            $("#cdn-load").html("<iframe style='display:none;' src='"+even+"'></iframe>");
            $("#lodink-"+a).fadeOut();
            }
        }
    });
}
<?php } ?>

</script>


</body>
</html>