<div class="footer">
   
    <div class="b">
        <p class="follow-wrap">
            <a class="follow fb" rel="nofollow" target="_blank" href="<?=siteSetting()->FB_fanspage?>"><span>Facebook</span></a>
            <a class="follow tw" rel="nofollow" target="_blank" href="<?=siteSetting()->TW_fanspage?>"><span>Twitter</span></a>
            <a class="follow glp" rel="nofollow" target="_blank" href="<?=siteSetting()->GP_fanspage?>"><span>Google+</span></a>
        </p>

        <p><a href="/dmca-disclaimer" rel="nofollow">DMCA Disclaimer</a> | <a href="/privacy-police">Privacy Policy</a> | <a href="/term-of-use" >Term Of Use</a></p>
        <p><?=siteSetting()->sitename?> &copy; <?=date("Y")." - ".(date("Y")+2)?></p>
        <p><a href="/device/?select=desktop&url=<?=base64_encode(getPermalink()->documentUrl())?>">Desktop Version</a></p>
    </div>
</div>
<div class="cl"></div>
<?=base64_decode(siteSetting()->snippet)?>
<?php echo manage()->callJS([
    themeConfig()."js/jquery.js",
    themeConfig()."js/iscroll.js",
    themeConfig()."js/global.js",
    themeConfig()."js/language.js",
    themeConfig()."js/jquery.lazyload.fix.min.js",
    themeConfig()."js/jquery.lazy.min.js",
    themeConfig()."js/touchslide.fix.min.js",
    themeConfig()."js/photoswipe.js",
    ])?>
<script>

     function loadmore(a){
        $.ajax({
            type : "POST",
            url : "/loadmore/",
            data : "cat="+$(a).attr('cat')+"&cat1="+$(a).attr('cat1')+"&sort="+$(a).attr('sort')+"&page="+$('.reglist').last().attr('id'),
            beforeSend : function(){
            $('.loadmore').html('Please Wait ...');
            },
            success : function(even){
                $("#new-data").replaceWith(even);
                
                if(even.indexOf('<need/>') == -1){
                $(".loadmore").remove();
                }else{
                $(".loadmore").replaceWith(' <a class="loadmore" cat="'+$(a).attr('cat')+'" cat1="'+$(a).attr('cat1')+'" sort="'+$(a).attr('sort')+'" page="'+$('.reglist:last').attr('id')+'" onClick="loadmore(this)">Show More</a>');
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
            $('.loadmore').html('Please Wait ...');
            },
            success : function(even){
                $("#load_here").replaceWith(even);
                
                if(even.indexOf('<need/>') == -1){
                $(".loadmore").remove();
                }else{
                $(".loadmore").replaceWith('<a class="loadmore" onClick="search_more(this)" keyword="'+$(a).attr("keyword")+'" href="javascript:void(0)">Show More</a>');
                }
                
            }
        });
        return false;
    }

    function s_show(){
        $("#flow-s-h").show();
        $("#flow-s").hide();
    }
    function s_hide(){
        $("#flow-s-h").hide();
        $("#flow-s").show();
    }
    $('img').lazy({
            attribute: "data-original",
            retinaAttribute: "alt",
            delay: 500,
            removeAttribute: true,
            effect: "fadeIn",
            effectTime: 2000,
            threshold: 0
            });

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


</script>
<script type="text/javascript">
    <?php if(empty(getPermalink()->splice(1))){
    ?>
    $$.initIndex();
    <?php
    }else{
    ?>
    $$.initDetails();
    $$.initVersions();
    <?php
    }
    ?>
    

    $.each(['','1','2','3','4'],function (i,t) {
        var id = '#slideBox'+t;
        if($(id).length > 0){
            $$.initTouchSlide(id,'.lazygb_banner');
        }
    });
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