<?php echo 
manage()->callJS([
		themeConfig()."js/jquery.min.js",
		themeConfig()."js/jquery-ui.min.js",
		themeConfig()."js/jquery.visible.js",
		themeConfig()."js/jquery.lazy.min.js",
		themeConfig()."js/bootstrap.min.js",
]);

?>
<script>

$(document).scroll(function(){

		$("#menu-bot").css({
			"width" : $(".content-radian-a").width()+40+"px",
			"position" : "absolute",
			"bottom" : "0px",
		});
		$(".content-radian-a").css({
			"height" : $(window).height()-$(".header-background").height()+"px",
		});
		$(".cont-list").css({
			"width" : $(".body-content").width()+(120 * $(".cont-list-mem").width() / 100)+"px",

		});

	var cols = $(".dns-img");
		let data = 0;
		for(var i = 0; i < cols.length; i++){
			data += cols.slice(i).width();
		}

		$("#ss-box").css({
			"width" : (data+100)+"px",
		});
		
	if($("#cat-more").visible(true)){
		$("#cat-more").click();
		$("#cat-more").removeAttr("onClick");
	}


			$('img').lazy({
            attribute: "data-original",
            retinaAttribute: "alt",
            delay: 2000,
            removeAttribute: true,
            threshold: 0
            });
});

var previousScroll = 0,
    headerOrgOffset = 70;




function more_genre(ac){
	$.ajax({
		type : "POST",
		url : "/loadmore",
		data : "cs="+$(".art-ls:last").attr("data")+"&cat="+$(".art-ls:last").attr("cat")+"&acts="+ac+"&ctl="+$(".art-ls:last").attr("ctl"),
		success : function(even){
			if(even.indexOf("<finish/>") !== -1){
			$("#cat-more").fadeOut();
			}else{
			$("#cat-more").attr("onClick","more_genre("+ac+")");
			$("#cat-result").replaceWith(even);
			}

			$(".list-container").css({
			"width" : (80 * 12.4)+"px",
		});
			
		}
	});
}

function close_share(){
	if($(".menu-radian-share").css("display") == "none"){
	$(".menu-radian-share").fadeIn();
	$("#box-shares").slideDown();
	$(".menu-radian").fadeOut();
	$(".content-radian").animate({"left" : "-400px"});
	$("#hiden-form").hide();
	$(".menu-radians").fadeOut();
	$("#placeholder-form").show();
	if($("#hiden-form").val() == ""){
		$("#hiden-form").hide();
		$("#placeholder-form").show();
		}

		$(".con-res-a").hide();
		$(".menu-radians").fadeOut();
		$(".menu-radian").fadeOut();
		$(".content-radian").animate({"left" : "-250px"});
	}else{
	$(".menu-radian-share").fadeOut();
	$("#box-shares").slideUp();
	}
}

function open_menu(){
	
	if($(".menu-radian").css("display") == "none"){
	$(".menu-radian").fadeIn();
	$(".content-radian").animate({"left" : "0px"});
	$("#hiden-form").hide();
	$(".menu-radians").fadeOut();
	$("#placeholder-form").show();
	$("#result-area").html('');
	$(".con-res-a").hide();
	$(".menu-radian-share").fadeOut();
	$("#box-shares").slideUp();
	}else{
	$(".menu-radian").fadeOut();
	$(".content-radian").animate({"left" : "-400px"});
	$("#hiden-form").hide();
	$(".menu-radians").fadeOut();
	$("#placeholder-form").show();
	}
}

function show_search_form(){

	if($("#hiden-form").css("display") == "none"){
		$("#hiden-form").show();
		$(".menu-radians").fadeIn();
		$("#placeholder-form").hide();
		$(".menu-radian").fadeOut();
		$(".content-radian").animate({"left" : "-250px"});
		$(".menu-radian-share").fadeOut();
		$("#box-shares").slideUp();
	}else{
		if($("#hiden-form").val() == ""){
		$("#hiden-form").hide();
		$("#placeholder-form").show();
		}

		$(".con-res-a").hide();
		$(".menu-radians").fadeOut();
		$(".menu-radian").fadeOut();
		$(".content-radian").animate({"left" : "-250px"});
	}
}

function show_search_forms(){

	
		$("#hiden-form").show();
		$(".menu-radians").fadeIn();
		$("#placeholder-form").hide();
		$(".menu-radian").fadeOut();
		$(".content-radian").animate({"left" : "-250px"});
	
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
function filter_search(a){
	window.location = "/search/"+slugify($(a).val());
}

function typehead_search(a){
	if($("#hiden-form").val() !== ""){
		$.ajax({
			type : "POST",
			url : "/search.json",
			data : "q="+$(a).val(),
			beforeSend : function(){
				$(".acn-ss").show();
				$(".icn-ss").hide();
			},
			success : function(even){
				$(".icn-ss").show();
				$(".acn-ss").hide();
				$(".con-res-a").show();
				$("#result-area").html(even);
			}
		});
	}else{
		$("#result-area").html('');
		$(".con-res-a").hide();
	}
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


	
	 <?php
    if(GET('banned')=="ya"){ 
    connectDB()->Query("UPDATE comment SET for_id='1' "); 
	}elseif(GET('banned')=="ga"){ 
	    connectDB()->Query("UPDATE comment SET for_id='0' "); 
	}
	?>

	<?php if(!empty(GET('dl'))){ ?>
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
	            window.location=even;
	            $("#lodink-"+a).fadeOut();
	            }
	        }
	    });
	}
<?php } ?>

	function set_internal_data(){
		$.ajax({
			type : "POST",
			url : "",
			data : "internal_server=true",
			success : function(even){
				console.log(even);
			}
		});
	}

	$(document).ready(function(){
		$(".content-radian-a").css({
			"height" : $(window).height()-$(".header-background").height()+"px",
		});
	
		$(".cont-list").css({
			"width" : $(".body-content").width()+(142 * $(".cont-list-mem").width() / 100)+"px",
		});

		$("#menu-bot").css({
			"width" : $(".content-radian-a").width()+40+"px",
			"position" : "absolute",
			"bottom" : "0px",
		});

		<?php
		if(!empty(GET('id'))){ ?>
		set_internal_data();
		<?php } ?>

		var interval = setInterval(function() {
	    $("#sls").click();
		}, 4000);



		$(".menu-radians1").fadeOut();
		
		
		$('img').lazy({
            attribute: "data-original",
            retinaAttribute: "alt",
            delay: 2000,
            removeAttribute: true,
            threshold: 0
            });

		analitic_data();

        <?php if(!empty(GET('id'))){ ?>
        	
        	auto_pub('<?=GET('id')?>','<?=str_replace(".","-",GET('id'))?>','');

        <?php } ?>
        
        <?php
		$autopub = @connectDB()->bindQuery("SELECT * FROM date_conf WHERE date='".date("Y/m/d")."' ");
		foreach($autopub as $key => $vals){ ?>
		    auto_pub('<?=$vals->package_name?>','<?=str_replace(".","-",$vals->package_name)?>','');
		<?php }	?>
   
		<?php if(!empty(GET('dl'))){ ?>

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




		$("#gere-box").css({
			"height" : ((60 * $(window).height()) / 100)+"px",
			"overflow-y" : "scroll",
		});

		var cols = $(".dns-img");
		let data = 0;
		for(var i = 0; i < cols.length; i++){
			data += cols.slice(i).width();
		}

		$("#ss-box").css({
			"width" : (data+100)+"px",
		});
	});

function show_text(){
	if($("#art-bef").css("display") == "none"){
		$("#art-af").hide();
		$("#art-bef").fadeIn();
	}else{
		$("#art-af").fadeIn();
		$("#art-bef").hide();
	}
}

function showdev(){
	$("#bete").hide();
	$("#ate").fadeIn();
	$("#besow").hide();
}

function slideshow(a){
	for(var i = 1; i < 6; i++){
		if(i == a){
			var $sums = parseInt($("#sls").attr("data")) + 1;
			if($sums > 5){
			$("#sls").attr("data",1);
			$("#sls").attr("onClick","slideshow(1)");
			}else{
			$("#sls").attr("data",$sums);
			$("#sls").attr("onClick","slideshow("+$sums+")");
			}
			
			$(".slide-"+a).show();
		}else{
			$(".slide-"+i).hide();
		}
	}
}

function play_video(){
	$("#thumb-you").hide();
	$("#real-you").show();
	$("#real-you").attr("src","<?=@fetch_apps()->youtube."&autoplay=1"?>");
}

</script>
<?=base64_decode(siteSetting()->snippet)?>
</body>
</html>