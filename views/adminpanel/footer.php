<div class="clear" style="height:0px;"></div>
</div>
</div>
<div class="copyright" style="background: #fff;border-top: 1px #e2e2e3 solid;">
        Copyright © SmartPlay. All rights reserved. Powered By IAMROOT
       <span style="float: right;"></span> 
    </div>
<?php echo manage()->callJS([
    "themes/classic/desktop/js/jquery.min.js",
    "themes/classic/desktop/js/global.js",
    "themes/classic/desktop/js/lang.js",
    "themes/classic/desktop/js/jquery.slider.min.js",
    "themes/classic/desktop/js/lazyload.min.js",
    "themes/classic/desktop/js/popup.js",
])?>

    <?php echo manage()->callJS([
            
            
            "adminpanel/js/Chart.bundle.js",
            "adminpanel/js/utils.js",
            "adminpanel/js/taginput.js",
            "adminpanel/js/jui/jquery-ui.min.js",
            
            
            
            
        ]);

    if((getPermalink()->splice(3)=="other-setting") or (getPermalink()->splice(2)=="manual-post")){

     echo manage()->callJS([ "adminpanel/js/tinymce/js/tinymce/tinymce.js"]);
    }

        ?>

<script type="text/javascript">
    <?php
if((getPermalink()->splice(3)=="other-setting") or (getPermalink()->splice(2)=="manual-post")){ ?>
tinymce.init({
  selector: '.textarea',
  plugins: ['codesample','autolink','image','link','lists','hr','paste'],
  codesample_languages: [
        {text: 'HTML/XML', value: 'markup'},
        {text: 'JavaScript', value: 'javascript'},
        {text: 'CSS', value: 'css'},
        {text: 'PHP', value: 'php'},
        {text: 'OTHER', value: 'php'},
        
    ],
  paste_as_text: true,
  
  toolbar: ['bold italic underline | numlist bullist | link | paste | codesample '],
  menubar: "codesample",
  default_link_target: "_blank",
  setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }
    });

    function cks(){
        tinymce.init({
  selector: '.textarea1',
  plugins: ['codesample','autolink','image','link','lists','hr','paste'],
  codesample_languages: [
        {text: 'HTML/XML', value: 'markup'},
        {text: 'JavaScript', value: 'javascript'},
        {text: 'CSS', value: 'css'},
        {text: 'PHP', value: 'php'},
        {text: 'OTHER', value: 'php'},
        
    ],
  paste_as_text: true,
  
  toolbar: ['bold italic underline | numlist bullist | link | paste | codesample '],
  menubar: "codesample",
  default_link_target: "_blank",
  setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }
    });
    }
    <?php } ?>
    
    function action_login(a){
        $.ajax({
        type : "POST" ,
        url : "",
        data : $(a).serialize(),
        beforeSend : function(){
        $("#log-result").html('<div style="background:#e2e2e3;color:#666;padding:10px;border-radius:5px;border:1px #e2e2e3 solid;" class="alert alert-danger" role="alert">'+
        '<img src="/views/adminpanel/css/ovalo.svg" width="25"> <strong>Please</strong> wait ...</div>');
        },
        success : function(even){
            $("#log-result").html(even);
        }
    });
        return false;
    }

    function action_recover(a){
        $.ajax({
        type : "POST" ,
        url : "",
        data : $(a).serialize(),
        beforeSend : function(){
        $("#log-result-2").html('<div style="background:#e2e2e3;color:#666;padding:10px;border-radius:5px;border:1px #e2e2e3 solid;" class="alert alert-danger" role="alert">'+
        '<img src="/views/adminpanel/css/ovalo.svg" width="25"> <strong>Please</strong> wait ...</div>');
        },
        success : function(even){
            if(even.indexOf('<sukses/>') !== -1){
            alert("Success");
            back_log();
            }else{
            $("#log-result-2").html(even);
            }
        }
    });
        return false;
    }


    function load_genre(){
        if($(".kontainer-genre").css("display") == "none"){
        $(".kontainer-genre").css({
            "width" : ($("#cats-1").width() + $("#cats-2").width() + 18) + "px",
        });
        $(".kontainer-genre").show();
        }else{
        $(".kontainer-genre").hide();
        }
    }

    $(".main").css({
            "min-height" : $(window).height()-($(".copyright").height()*2.8)+"px",
    });
    $("#img-log").css({
    
    "height" : ($(window).height()-$(".header").height()-$(".copyright").height())+"px",
    "top" : $(".header").height()+"px",
});
    

    function fill_genre(a){
        $("#cats-1").val(a);
        $(".kontainer-genre").hide();
    }

    function delete_key_data(a){
        $("#tag-key-"+$(a).attr("data")).fadeOut();
        $("#hide-key").val(
            $("#hide-key").val()
            .replace($(a).attr("text")+",","")
            .replace($(a).attr("text"),"")
            .replace("&amp;","&")
            );
    }
    function load_keyword(a){
        if($(a).val() !== ""){
        $(".tag-result").show();
        var text = $(a).val().split(",");
        var load = "";
        if($(a).val().indexOf(",") !== -1){
        for(var i = text.length-1; i >= 0; i--){
            if(text[i] !== ""){
            load += "<button onClick='return delete_key_data(this)' data='"+i+"' text='"+text[i]+"' type='button' id='tag-key-"+i+"' style='padding:5px;background:#f5f5f5;color:#666;border:1px #e2e2e3 solid;border-radius:5px;margin-right:3px;margin-bottom:3px;'>"+text[i]+"&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-times' style='color:#666;font-size:11px;' ></i></button>";
            }   
        }
        $(".tag-result").html(load);
        }else{
        load += "<button  onClick='return delete_key_data(this)' text='"+$(a).val()+"' data='nuls' type='button' id='tag-key-nuls' style='padding:5px;background:#f5f5f5;color:#666;border:1px #e2e2e3 solid;border-radius:5px;margin-right:3px;margin-bottom3:px;'>"+$(a).val()+"&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-times' style='color:#666;font-size:11px;'></i></button>";
        $(".tag-result").html(load);
        }
        }else{
            $(".tag-result").hide();
            $(".tag-result").html("");
        }

        
    }

    $$.initIndex();
    
    $$.initVersions();

    function show_pops(id){
        if($("#pops-"+id).css('display') == "none"){
        $("#pops-"+id).fadeIn();
        $("#poys-"+id).hide();
        $("#loys-"+id).show();
        }else{
        $("#pops-"+id).fadeOut();
        $("#loys-"+id).show();
        $("#poys-"+id).hide();
        }
     
    }

    function updateApp(a,id,act){
        if($("#hotmod").val() == "no"){
            var extern = "&selfimg=true";
        }else{
            var extern = "";
        }

        $.ajax({
            type : "POST",
            url : "/webmaster/update-application",
            data : "appid="+a+"&act="+act+""+extern,
            beforeSend : function(){
                $("#poys-"+id).html("<img src='/views/adminpanel/css/ovalo.svg' width='14' > Please Wait ...");
                $("#loys-"+id).hide();
                $("#poys-"+id).show();

            },
            success : function(event){
                if(event.indexOf("<yeay/>") !== -1 ){
                
                $("#poys-"+id).html("<i class='fa fa-check-circle' style='color:#24cd77'></i> Success ....");
                $("#loys-"+id).hide();
                $("#reg-up-"+id).delay(3000).fadeOut();
                $("#pops-"+id).delay(3000).fadeOut();


                $("#"+id+"-l").show();
                $("#"+id).hide();
                $("#"+id+"-l").hide();
                $("#"+id).show();
                $("#"+id+"-t").html("Already Publish");
                $("#"+id+"-t").css({
                    "color" : "#fff",
                    "border" : "1px #24cd77 solid",
                    "background" : "#24cd77",
                });
                $("#msg-"+id).html('');
                $("#dina-"+id).html('<a href="javascript:void(0)" class="trash-'+id+'" onClick="del_apps_other(\''+id+'\',\''+id+'\')" style="border:1px #de0303 solid;border-radius:5px;background: #fff;border:1px #de0303 solid;padding: 7px;"><i style="font-size: 15px;color: #de0303" class="fa fa-trash"></i></a>');

                $("#drop-"+id).html("Update Each App");
                $("#drop-"+id+"-2").html("Update All In Developer");
                $("#drop-"+id).attr("onClick","updateApp('"+a+"','"+id+"','each')");
                $("#drop-"+id+"-2").attr("onClick","updateApp('"+a+"','"+id+"','all')");
                $("#edit-"+id).html('<a id="drop-'+id+'-3" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="go_edit1(\''+a+'\')" data-toggle="modal" data-target=".bs-example-modal-sms">Edit Post</a>');

                }else{
                $("#reg-up-"+id).delay(3000).fadeOut();
                $("#pops-"+id).delay(3000).fadeOut();
                $("#poys-"+id).html("<i class='fa fa-times-circle' style='color:#ff0000'></i> Failed ...");
                $("#loys-"+id).hide();
                }
            },
         error: function(xhr, statusText, err){
                $("#reg-up-"+id).delay(3000).fadeOut();
                $("#pops-"+id).delay(3000).fadeOut();
                $("#poys-"+id).html("<i class='fa fa-times-circle' style='color:#ff0000'></i> Failed ...");
                $("#loys-"+id).hide();
         }

        });
        return false;
    }

    function updateApp2(a,id,act){
        if(confirm("if you using auto publish, this post will be automatic mode ( automatic update ). are you sure ?") == true){

        if($("#hotmod").val() == "no"){
            var extern = "&selfimg=true";
        }else{
            var extern = "";
        }

        $.ajax({
            type : "POST",
            url : "/webmaster/update-application",
            data : "appid="+a+"&act="+act+""+extern,
            beforeSend : function(){
                $("#poys-"+id).html("<img src='/views/adminpanel/css/ovalo.svg' width='14' > Please Wait ...");
                $("#loys-"+id).hide();
                $("#poys-"+id).show();

            },
            success : function(event){
                if(event.indexOf("<yeay/>") !== -1 ){
                
                $("#poys-"+id).html("<i class='fa fa-check-circle' style='color:#24cd77'></i> Success ....");
                $("#loys-"+id).hide();
                $("#reg-up-"+id).delay(3000).fadeOut();
                $("#pops-"+id).delay(3000).fadeOut();


                $("#"+id+"-l").show();
                $("#"+id).hide();
                $("#"+id+"-l").hide();
                $("#"+id).show();
                $("#"+id+"-t").html("Already Publish");
                $("#"+id+"-t").css({
                    "color" : "#fff",
                    "border" : "1px #24cd77 solid",
                    "background" : "#24cd77",
                });
                $("#msg-"+id).html('');
                $("#dina-"+id).html('<a href="javascript:void(0)" class="trash-'+id+'" onClick="del_apps_other(\''+id+'\',\''+id+'\')" style="border:1px #de0303 solid;border-radius:5px;background: #fff;border:1px #de0303 solid;padding: 7px;"><i style="font-size: 15px;color: #de0303" class="fa fa-trash"></i></a>');

                $("#drop-"+id).html("Update Each App");
                $("#drop-"+id+"-2").html("Update All In Developer");
                $("#drop-"+id).attr("onClick","updateApp('"+a+"','"+id+"','each')");
                $("#drop-"+id+"-2").attr("onClick","updateApp('"+a+"','"+id+"','all')");

                $("#edit-"+id).html('<a id="drop-'+id+'-3" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="go_edit1(\''+a+'\')" data-toggle="modal" data-target=".bs-example-modal-sms">Edit Post</a>');

                }else{
                $("#reg-up-"+id).delay(3000).fadeOut();
                $("#pops-"+id).delay(3000).fadeOut();
                $("#poys-"+id).html("<i class='fa fa-times-circle' style='color:#ff0000'></i> Failed ...");
                $("#loys-"+id).hide();
                }
            },
            error: function(xhr, statusText, err){
                $("#reg-up-"+id).delay(3000).fadeOut();
                $("#pops-"+id).delay(3000).fadeOut();
                $("#poys-"+id).html("<i class='fa fa-times-circle' style='color:#ff0000'></i> Failed ...");
                $("#loys-"+id).hide();
         }

        });
    }
        return false;
    }


     function addNew(a,b,c){
        if($("#hotmod").val() == "no"){
            var extern = "&selfimg=true";
        }else{
            var extern = "";
        }

        $.ajax({
            type : "POST",
            url : "/webmaster/add-new-data",
            data : "list-pack-id="+a+"&date_post="+c+"&del"+extern,
            beforeSend : function(){
                $("#"+b+"-l").show();
                $("#"+b).hide();
            }, 
            success : function(event){
                if(event.indexOf('<sukses/>') !== -1){
                $("#"+b+"-l").hide();
                $("#"+b).show();
                $("#"+b+"-t").html("Already Publish");
                $("#"+b+"-t").css({
                    "color" : "#fff",
                    "border" : "1px #24cd77 solid",
                    "background" : "#24cd77",
                });
                $("#msg-"+b).html('');
                $("#dina-"+b).html('<a href="javascript:void(0)" class="trash-'+b+'" onClick="del_apps_other(\''+a+'\',\''+b+'\')" style="border:1px #de0303 solid;border-radius:5px;background: #fff;border:1px #de0303 solid;padding: 7px;"><i style="font-size: 15px;color: #de0303" class="fa fa-trash"></i></a>');
                $("#drop-"+b).html("Update Each App");
                $("#drop-"+b+"-2").html("Update All In Developer");
                $("#drop-"+b).attr("onClick","updateApp('"+a+"','"+b+"','each')");
                $("#drop-"+b+"-2").attr("onClick","updateApp('"+a+"','"+b+"','all')");
                $("#edit-"+b).html('<a id="drop-'+b+'-3" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="go_edit1(\''+a+'\')" data-toggle="modal" data-target=".bs-example-modal-sms">Edit Post</a>');
                }else{
                $("#"+b+"-l").hide();
                $("#"+b).hide();
                $("#"+b+"-t").html("Failed Add Content");
                $("#"+b+"-t").css({
                    "color" : "#fff",
                    "border" : "1px #de0303 solid",
                    "background" : "#de0303",
                });
                }
            unbulks(a,b);
            },
            error: function(xhr, statusText, err){
                    $("#"+b+"-l").hide();
                    $("#"+b).hide();
                    $("#"+b+"-t").html("Failed Add Content");
                    $("#"+b+"-t").css({
                    "color" : "#fff",
                    "border" : "1px #de0303 solid",
                    "background" : "#de0303",
                });
                }
        });
        return false;
    }

    function hotlink(arg) {
        if($("#hotmod").val() == "yes"){
        if(confirm("All Image will be save In your server storage, are you sure ?")==true){
        $("#hotmod").val("no");
        $(arg).html("Hotlink disable");
        $(arg).css({
            "background" : "#f5f5f5",
        });
        }
        }else{
        $(arg).css({
            "background" : "#edfaec",
        });
        $(arg).html("Hotlink Active");
        $("#hotmod").val("yes");
        }
    }
     function addNew2(a,b,c){
        if(confirm("if you using auto publish, this post will be automatic mode ( automatic update ). are you sure ?") == true) {

        if($("#hotmod").val() == "no"){
            var extern = "&selfimg=true";
        }else{
            var extern = "";
        }

        $.ajax({
            type : "POST",
            url : "/webmaster/add-new-data",
            data : "list-pack-id="+a+"&date_post="+c+"&del"+extern,
            beforeSend : function(){
                $("#"+b+"-l").show();
                $("#"+b).hide();
            }, 
            success : function(event){
                if(event.indexOf('<sukses/>') !== -1){
                $("#"+b+"-l").hide();
                $("#"+b).show();
                $("#"+b+"-t").html("Already Publish");
                $("#"+b+"-t").css({
                    "color" : "#fff",
                    "border" : "1px #24cd77 solid",
                    "background" : "#24cd77",
                });
                $("#msg-"+b).html('');
                $("#dina-"+b).html('<a href="javascript:void(0)" class="trash-'+b+'" onClick="del_apps_other(\''+a+'\',\''+b+'\')" style="border:1px #de0303 solid;border-radius:5px;background: #fff;border:1px #de0303 solid;padding: 7px;"><i style="font-size: 15px;color: #de0303" class="fa fa-trash"></i></a>');
                $("#"+b+"-t").attr("onClick","addNew('"+a+"','"+b+"','')");
                $("#drop-"+b).html("Update Each App");
                $("#drop-"+b+"-2").html("Update All In Developer");
                $("#drop-"+b).attr("onClick","updateApp('"+a+"','"+b+"','each')");
                $("#drop-"+b+"-2").attr("onClick","updateApp('"+a+"','"+b+"','all')");
                $("#edit-"+b).html('<a id="drop-'+b+'-3" style="color:#666" class="dropdown-item" href="javascript:void(0)" onClick="go_edit1(\''+a+'\')" data-toggle="modal" data-target=".bs-example-modal-sms">Edit Post</a>');
                }else{
                $("#"+b+"-l").hide();
                $("#"+b).hide();
                $("#"+b+"-t").html("Failed Add Content");
                $("#"+b+"-t").css({
                    "color" : "#fff",
                    "border" : "1px #de0303 solid",
                    "background" : "#de0303",
                });
                }
            unbulks(a,b);
            },
            error: function(xhr, statusText, err){
                    $("#"+b+"-l").hide();
                    $("#"+b).hide();
                    $("#"+b+"-t").html("Failed Add Content");
                    $("#"+b+"-t").css({
                    "color" : "#fff",
                    "border" : "1px #de0303 solid",
                    "background" : "#de0303",
                });
                }
        });
    }
        return false;
    }

     function auto_pub(a,b,c){
        $.ajax({
            type : "POST",
            url : "/webmaster/add-new-data",
            data : "list-pack-id="+a+"&date_post="+c,
            beforeSend : function(){
                
            }, 
            success : function(event){
               console.log("success");
            }
        });
        return false;
    }

    function load_more(data,key){
        $.ajax({
            type : "POST",
            url : "",
            data : "name_cat="+data+"&key="+key+"&ajax_",
            beforeSend : function(){
            $(".loadmores").html("Please Wait ...");
            },
            success : function(even){
            $("#new-result").replaceWith(even);
            $(".loadmores").attr("onClick","load_more('"+data+"',"+(key+1)+")");
            $(".loadmores").html("Show More");
            }
        });
    }

    function load_more_my(){
        $.ajax({
            type : "POST",
            url : "",
            data : "id="+$(".last-id:last").attr("data")+"&ajax_",
            beforeSend : function(){
            $(".loadmores").html("Please Wait ...");
            },
            success : function(even){
            $("#new-result").replaceWith(even);
            
            $(".loadmores").html("Show More");
            }
        });
    }

    function load_more_search(data,key,hl){
        $.ajax({
            type : "POST",
            url : "",
            data : "name_search="+data+"&key="+key+"&hl="+hl+"&ajax_",
            beforeSend : function(){
            $(".loadmores").html("Please Wait ...");
            },
            success : function(even){
            $("#new-result").replaceWith(even);
            $(".loadmores").attr("onClick","load_more_search('"+data+"',"+(key+13)+",'"+hl+"')");
            $(".loadmores").html("Show More");
            }
        });
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

    function search_pack(a){
        $("#slugs").val(slugify($(a).val()));
    }
    function enter_search(){
        window.location = "/webmaster/post/search/"+$("#slugs").val()+$("#slugs-2").val();
        return false;
    }

    function game_show(){
        $(".game-icon").animate({
            "margin-top" : "0px"
        });
        $(".app-icon").animate({
            "margin-top" : "-1000px"
        });
    }

    function app_show(){
        $(".game-icon").animate({
            "margin-top" : "-1000px"
        });
        $(".app-icon").animate({
            "margin-top" : "0px"
        });
    }


     var MONTHS = [];

    var config = {
            type: 'line',
            data: {
                labels: [<?php
                for($i = 0; $i<24;$i++){
                    $jums[] = "'".$i.":00 - ".$i.":59'";
                }
                echo implode(",",$jums);
                ?>],
                datasets: [{
                    label : "Visitors",
                    backgroundColor: window.chartColors.yellow,
                    borderColor: window.chartColors.yellow,
                    data: <?php
    for($i=1;$i<24;$i++){
        if($i <= date("H")+1){
        if(strlen($i)==1) $h = "0".$i;
        else $h = $i;
        $data = connectDB()->Query("SELECT * FROM track WHERE date='".date('Y-m-d')."' and hour='".$h."' ");
        $row = connectDB()->rowCount($data);
        $show = connectDB()->Fetch($data);
        $ex = explode("/",$show['track']);
        if($row == 0){
        $imp[] = "0";
        }else{
        $imp[] = "".@$ex[0]."";
        }
    }
    }
    echo "[".@implode(",",$imp)."]";
    $imp = null;
    
    ?>,
                    fill: false,
                },{
                    label : "One Day Ago",
                    backgroundColor: window.chartColors.red,
                    borderColor: window.chartColors.red,
                    data: <?php
    for($i=0;$i<24;$i++){
        
        if(strlen($i)==1) $h = "0".$i;
        else $h = $i;
        $data = connectDB()->Query("SELECT * FROM track WHERE date='".date('Y-m-d',strtotime("-1 days"))."' and hour='".$h."' ");
        $row = connectDB()->rowCount($data);
        $show = connectDB()->Fetch($data);
        $ex = explode("/",$show['track']);
        if($row == 0){
        $imp[] = "0";
        }else{
        $imp[] = "".@$ex[0]."";
        }
    
    }
    echo "[".@implode(",",$imp)."]";
    $imp = null;
    
    ?>,
 
                    fill: false,
                },{
                    label : "Page Views",
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: <?php
    for($i=0;$i<24;$i++){
        if($i <= date("H")){
        if(strlen($i)==1) $h = "0".$i;
        else $h = $i;
        $data = connectDB()->Query("SELECT * FROM track WHERE date='".date('Y-m-d')."' and hour='".$h."' ");
        $row = connectDB()->rowCount($data);
        $show = connectDB()->Fetch($data);
        $ex = explode("/",$show['track']);
        if($row == 0){
        $imp[] = "0";
        }else{
        $imp[] = "".@$ex[1]."";
        }
    }
    }
    echo "[".@implode(",",$imp)."]";
    $imp = null;
    
    ?>,
                    fill: false,
                },
                ]
            },
            options: {
                responsive: true,
                
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [],
                    yAxes: []
                }
            }
        };

        window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myLine = new Chart(ctx, config);
        };

        document.getElementById('randomizeData').addEventListener('click', function() {
            config.data.datasets.forEach(function(dataset) {
                dataset.data = dataset.data.map(function() {
                    return randomScalingFactor();
                });

            });

            window.myLine.update();
        });

        var colorNames = Object.keys(window.chartColors);
        document.getElementById('addDataset').addEventListener('click', function() {
            var colorName = colorNames[config.data.datasets.length % colorNames.length];
            var newColor = window.chartColors[colorName];
            var newDataset = {
                label: 'Dataset ' + config.data.datasets.length,
                backgroundColor: newColor,
                borderColor: newColor,
                data: [],
                fill: false
            };

            for (var index = 0; index < config.data.labels.length; ++index) {
                newDataset.data.push(randomScalingFactor());
            }

            config.data.datasets.push(newDataset);
            window.myLine.update();
        });

        document.getElementById('addData').addEventListener('click', function() {
            if (config.data.datasets.length > 0) {
                var month = MONTHS[config.data.labels.length % MONTHS.length];
                config.data.labels.push(month);

                config.data.datasets.forEach(function(dataset) {
                    dataset.data.push(randomScalingFactor());
                });

                window.myLine.update();
            }
        });

        document.getElementById('removeDataset').addEventListener('click', function() {
            config.data.datasets.splice(0, 1);
            window.myLine.update();
        });

        document.getElementById('removeData').addEventListener('click', function() {
            config.data.labels.splice(-1, 1); // remove the label first

            config.data.datasets.forEach(function(dataset) {
                dataset.data.pop();
            });

            window.myLine.update();
        });

function date_picker(a){
    $("#date-"+a).datepicker({
    dateFormat : 'yy/mm/dd'   
    }); 


}
function date_pickers(){
    $("#date").datepicker({
    dateFormat : 'yy/mm/dd'   
    }); 


}


function bulks(a,b){
    
    $("#bulks").append(a+"="+b+"/");
    $(".bulk-"+b).attr("onClick","unbulks('"+a+"','"+b+"')");
    $(".bulk-"+b).css({
        "color" : "#24cd77"
    });
}

function unbulks(a,b){
    $("#bulks").html($("#bulks").html().replace(a+"="+b+"/",""));
    $(".bulk-"+b).attr("onClick","bulks('"+a+"','"+b+"')");   
    $(".bulk-"+b).css({
        "color" : "#f1f1f1"
    });
}

function fill_date(a){
    $("#date"+a).click();
}

function save_date(a,b){
    $.ajax({
        type : "POST",
        url : "",
        data : "package_name="+a+"&date="+$("#date-"+a).val(),
        success : function(e){
            if(e.indexOf("<invalid/>") !== -1){
                addNew(b,a,$("#date-"+a).val());
                $("#msg-"+a).html('');
                close_date(a);
            }else{
            $("#msg-"+a).html('<i class="fa fa-clock-o" style="font-size: 13px;"></i> Will Publish On '+$("#date-"+a).val());
            close_date(a);
            }
        }
    });
}

function save_date_bulk(a,b){
    $.ajax({
        type : "POST",
        url : "",
        data : "package_name="+a+"&date="+$("#date").val(),
        success : function(e){
            if(e.indexOf("<invalid/>") !== -1){
                addNew(b,a,$("#date").val());
                $("#msg-"+a).html('');
                close_date(a);
            }else{
            $("#msg-"+a).html('<i class="fa fa-clock-o" style="font-size: 13px;"></i> Will Publish On '+$("#date").val());
            close_date(a);
            }
            unbulks(b,a);
        }
    });
}

function set_date(a){
    $("#kot-box-"+a).show();
    $("#boxs-"+a).hide();
    $("."+a).attr("onClick","close_date('"+a+"')");
    date_picker(a);
}

function close_date(a){
    $("#kot-box-"+a).hide();
    $("#boxs-"+a).show();
    $("."+a).attr("onClick","set_date('"+a+"')");
}

function bulk_date(){
    $(".options").hide();
    $("#sch-id").fadeIn();
    date_pickers();
}
function close_bulk(){
    $(".options").fadeIn();
    $("#sch-id").hide();
}
function bulk_publish(){
    var data = $("#bulks").html();
    if(data == ""){
    alert("No App Selected");
    }else{
    var split = data.split("/");
    for(var i = 0; i < split.length; i++){
        if(split[i] !== ""){
        var dats = split[i].split("=");
        var pack = dats[0]; 
        var uniq = dats[1];
        addNew(pack,uniq,'');
        }
    }
    }
}
function bulk_save_date(){
    var data = $("#bulks").html();
    if(data == ""){
    alert("No App Selected");
    }else{
    var split = data.split("/");
    for(var i = 0; i < split.length; i++){
        if(split[i] !== ""){
        var dats = split[i].split("=");
        var pack = dats[0]; 
        var uniq = dats[1];
        save_date_bulk(uniq,pack);
        }
    }
    close_bulk();
    }   
}
function bulks_all(){
    $(".indibulks").click();
}

function del_apps(a,b){
    if(confirm("Are you sure want to delete it ?") == true){
    $.ajax({
        type : "POST",
        url : "",
        data : "del_pack_id="+a,
        beforeSend : function(){
            $(".trash-"+b).html('<img src="/views/adminpanel/css/ovalo.svg" width="20">');
        },
        success : function(event){
            $(".trash-"+b).html('<i style="font-size: 15px;color: #de0303" class="fa fa-trash"></i>');
            $(".delip-"+b).fadeOut();
            $("#drop-"+b).html("Publish Each App");
            $("#drop-"+b+"-2").html("Publish All In Developer");
            $("#drop-"+b).attr("onClick","updateApp('"+a+"','"+b+"','each')");
            $("#drop-"+b+"-2").attr("onClick","updateApp('"+a+"','"+b+"','all')");
            $("#"+b+"-t").attr("onClick","addNew('"+a+"','"+b+"','')");

            $("#edit-"+b).html('');

            unbulks(a,b);
        }
    });
    }
}
function del_apps_other(a,b){
    if(confirm("Are you sure want to delete it ?") == true){
    $.ajax({
        type : "POST",
        url : "",
        data : "del_pack_id="+a,
        beforeSend : function(){
            $(".trash-"+b).html('<img src="/views/adminpanel/css/ovalo.svg" width="20">');
        },
        success : function(event){
            $(".trash-"+b).hide();
            $(".trash-"+b).html('<i style="font-size: 15px;color: #de0303" class="fa fa-trash"></i>');
            $("#"+b+"-l").hide();
            $("#"+b).hide();
                $("#"+b+"-t").html("Publish");
                $("#"+b+"-t").css({
                    "color" : "#24cd77",
                    "border" : "1px #24cd77 solid",
                    "background" : "#fff",
                });
                $("#drop-"+b).html("Publish Each App");
                $("#drop-"+b+"-2").html("Publish All In Developer");
                $("#drop-"+b).attr("onClick","updateApp('"+a+"','"+b+"','each')");
                $("#drop-"+b+"-2").attr("onClick","updateApp('"+a+"','"+b+"','all')");
                $("#"+b+"-t").attr("onClick","addNew('"+a+"','"+b+"','')");
                $("#edit-"+b).html('');
                unbulks(a,b);
        }
    });
    }
}
function del_apps_bulk_other(a,b){
    
   $.ajax({
        type : "POST",
        url : "",
        data : "del_pack_id="+a,
        beforeSend : function(){
            $(".trash-"+b).html('<img src="/views/adminpanel/css/ovalo.svg" width="20">');
        },
        success : function(event){
            $(".trash-"+b).hide();
            $(".trash-"+b).html('<i style="font-size: 15px;color: #de0303" class="fa fa-trash"></i>');
            $("#"+b+"-l").hide();
            $("#"+b).hide();
                $("#"+b+"-t").html("Publish");
                $("#"+b+"-t").css({
                    "color" : "#24cd77",
                    "border" : "1px #24cd77 solid",
                    "background" : "#fff",
                });
            $("#drop-"+b).html("Publish Each App");
            $("#drop-"+b+"-2").html("Publish All In Developer");
            $("#drop-"+b).attr("onClick","updateApp('"+a+"','"+b+"','each')");
            $("#drop-"+b+"-2").attr("onClick","updateApp('"+a+"','"+b+"','all')");
            $("#"+b+"-t").attr("onClick","addNew('"+a+"','"+b+"','')");
            $("#edit-"+b).html('');
                unbulks(a,b);
        }
    });
 
}
function del_apps_bulk(a,b){
    
    $.ajax({
        type : "POST",
        url : "",
        data : "del_pack_id="+a,
        beforeSend : function(){
            $(".trash-"+b).html('<img src="/views/adminpanel/css/ovalo.svg" width="20">');
        },
        success : function(event){
            $(".trash-"+b).html('<i style="font-size: 15px;color: #de0303" class="fa fa-trash"></i>');
            $(".delip-"+b).fadeOut();
            $("#"+b+"-t").attr("onClick","addNew('"+a+"','"+b+"','')");
            $("#drop-"+b).html("Publish Each App");
            $("#drop-"+b).attr("onClick","updateApp('"+a+"','"+b+"','each')");
            $("#drop-"+b+"-2").attr("onClick","updateApp('"+a+"','"+b+"','all')");
            $("#drop-"+b+"-2").html("Publish All In Developer");
            $("#edit-"+b).html('');
            unbulks(a,b);
        }
    });
 
}
function bulk_delete(){
    if(confirm("Are you sure want to delete it ?") == true){
        var data = $("#bulks").html();
    if(data == ""){
    alert("No App Selected");
    }else{
    var split = data.split("/");
    for(var i = 0; i < split.length; i++){
        if(split[i] !== ""){
        var dats = split[i].split("=");
        var pack = dats[0]; 
        var uniq = dats[1];
        del_apps_bulk(pack,uniq);
        }
    }
    
    }
    }
}

function bulk_delete_other(){
    if(confirm("Are you sure want to delete it ?") == true){
        var data = $("#bulks").html();
    if(data == ""){
    alert("No App Selected");
    }else{
    var split = data.split("/");
    for(var i = 0; i < split.length; i++){
        if(split[i] !== ""){
        var dats = split[i].split("=");
        var pack = dats[0]; 
        var uniq = dats[1];
        del_apps_bulk_other(pack,uniq);
        }
    }
    
    }
    }
}


function klik(s){
    $("#img"+s).click();
    }

    $("#img").change(function () { 
        readURL(this,'');   
    });
    $("#imgs").change(function () { 
        readURL(this,'s');   
    });
    $("#imgss").change(function () { 
        readURL(this,'ss');   
    });
    $("#imgsss").change(function () { 
        readURL(this,'sss');   
    });

    function readURL(input,s) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_upload_preview'+s).attr('src', e.target.result);
                $('#image_upload_preview'+s).fadeIn();
                $("#bts"+s).hide();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

function show_lang(){
    if($("#bendera").css("display") == "none"){
    $("#bendera").show();
    }else{
    $("#bendera").hide();
    }
}

function filter_negara(a,b){
    
    $("#slugs-2").val("/?hl="+$(a).attr("r"));
    $(".tmplag").html('<span class="flag '+$(a).attr("r").toLowerCase()+'" ></span>');
    $("#bendera").hide();
}

function set_themes(a,b,c){
    $.ajax({
        type : "POST",
        url : "",
        data : "theme="+b+"&theme_id="+a+"&apply="+c,
        beforeSend : function(){

        },
        success : function(even){
            if(even.indexOf("<mati/>") !== -1){
            $("#tm-"+a).css({
                "background" : "#FF0000",
                "border"    : "1px #FF0000 solid",
            });
            $("#cont-them-"+a).css({
                "border" : "2px #e2e2e3 solid",
            });
            }

            if(even.indexOf("<hidup/>") !== -1){
            $(".alsom").css({
                "background" : "#FF0000",
                "border"    : "1px #FF0000 solid",
            });
            $("#tm-"+a).css({
                "background" : " #24cd77",
                "border"    : "1px  #24cd77 solid",
            });
            $(".cont-theme").css({
                "border" : "2px #e2e2e3 solid",
            });
            $("#cont-them-"+a).css({
                "border" : "2px #24cd77 solid",
            });

            }
        }
    });
}

function yt_embed(a){
    if($(a).val() !== ""){
    $("#yt-embed").show();
    $("#yt-embed").html('<iframe src="'+$(a).val()+'" style="margin-top:10px;width: 98.5%;height: 200px;border:1px #e2e2e3 solid;"></iframe>');
    }else{
    $("#yt-embed").hide();
    }
}

function write_title(a){
    if($(a).val() !== ""){
    $("#title-desc").html($(a).val()+' - <?=siteSetting()->sitename?>');
    $("#url-desc").html('<?=getPermalink()->homeUrl()?>/'+slugify($(a).val())+"-apk"+$("#uniq-id").val());
    }else{
    $("#title-desc").html("");
    $("#url-desc").html("");
    }
}

function write_short_desc(a){
    if($(a).val().length <= 160){
    $("#desc-desc").html($(a).val());
    $(a).css({
        "border" : "1px #e2e2e3 solid",
    });
    }else{
    $(a).css({
        "border" : "1px #ff0000 solid",
    });
    $("#desc-desc").html($(a).val());
    }
    if($(a).val().length == 0){
    $("#length-hit").html("");
    }else{
    $("#length-hit").html(" ("+$(a).val().length+")");
    }
}


function typehead(a){
    $.ajax({
        type : "POST",
        data : "typehead="+$(a).val(),
        url : "",
        beforeSend : function(){
        $("#play-load").html('<img src="/views/adminpanel/css/ovalo.svg" width="18">');
        $("#play-load").show();
        },
        success : function(even){

    if($("#market-id").val() !== ""){
    
    
    $("#typehead").fadeIn();
    }else{
    $("#typehead").hide();
    }

        $("#play-load").html(''); 
        $("#play-load").hide();
        $("#typehead").html(even);
        }
    });
    return false;
}

function fill_post(a){
    
    $("#market-id").val(a);
    $("#klk-s").click();
    $("#typehead").hide();
    
    
}   

function word_check(a){
    if($(a).val() == ""){
        $("#typehead").hide();
    }
}

function cek_artikel(a){
    var a = "#market-id";

    var pack = $(a).val().split("id=");
    if($(a).val().indexOf("id=") !== -1){
        if(pack[1] !== "" ){
            if($(a).val().indexOf("&") !== -1){
            var pack2 = pack[1].split("&");
          
            if(pack2[0] !== ""){
        
                var package_name = pack2[0];
            }
            }else{
                var package_name = pack[1];                
            }
        }
    }else{
                var package_name = $(a).val();                
    }
    
    $.ajax({
        type : "POST",
        url : "",
        data : "ceks_ada="+package_name,
        beforeSend : function(){
        $("#play-load").show();
        $("#play-load").html('<img src="/views/adminpanel/css/ovalo.svg" width="18">');
        },
        success : function(even){
        if(even.indexOf("<editpub/>") !== -1){
        $("#waiting").html("Save Changes");
        get_playstore(a);
        }else if(even.indexOf("<failpub/>") !== -1){
        $("#play-load").html('<small style="font-size:10px;color:#ccc">Failed Get Data</small>');  
        $("#failed").fadeIn();
        $("#failed1").hide();
        }else  if(even.indexOf("<newpub/>") !== -1) {
        get_playstore(a);
        $("#waiting").html("Publish");
        }
        }
    });
}

function get_playstore(a){
    
    if($(a).val() !== ""){
    var a = "#market-id";

    var pack = $(a).val().split("id=");
    if($(a).val().indexOf("id=") !== -1){
        if(pack[1] !== "" ){
            if($(a).val().indexOf("&") !== -1){
            var pack2 = pack[1].split("&");
          
            if(pack2[0] !== ""){
        
                var package_name = pack2[0];
            }
            }else{
                var package_name = pack[1];                
            }
        }
    }else{
                var package_name = $(a).val();                
    }

    $.ajax({
        type : "POST",
        url : "",
        data : "json_req="+package_name,
        dataType : "json",
        beforeSend : function(){
        $("#play-load").show();
        $("#play-load").html('<img src="/views/adminpanel/css/ovalo.svg" width="18">');
        },
        success : function(even){

        var obj = JSON.parse(even);
        if(obj.code == 2){
        date_pickers();
        $(".mid2").val(package_name);
        $(".mid1").remove();
        $("#play-load").html('');
        $("#yt").val(obj.promo_video);
        $("#min-sdk").val(obj.min_sdk);
        $("#size").val(obj.size.replace("B",""));
        $("#version").val(obj.version);
        $("#developer").val(obj.developer);
        $("#cats-1").val(obj.category.replace("&amp;","&"));
        $("#hide-packid").val(obj.package_name);
        $("#hide-email").val(obj.email);
        $("#hide-icon").attr("src",obj.icon);
        $("#hide-rating").val(obj.rating);
        $("#uniq-id").val('/?id='+obj.package_name);
        $("#hide-website").val(obj.website);
        $("#hide-whatsnew").val(obj.what_is_new);
        $("#hide-dev-url").val(slugify(obj.developer));
        $("#hide-title").val(obj.title.replace("APK","")+" APK");
        $("#hide-desc").val(obj.short_desc);
        $("#hide-icon-data").val(obj.icon);
        $("#hide-down").val(obj.downloads);
        $("#hide-release").val(obj.date_release);

        var key_word = "";
        var ps = obj.keyword.split(",");
        for(var js = 0; js < ps.length; js++){
            if(js == (ps.length - 1)){
            key_word += ps[js].replace("&amp;","&");    
            }else{
            key_word += ps[js].replace("&amp;","&")+",";
            }
        }
        $("#hide-key").val(key_word);


         if($("#hide-key").val() !== ""){
        $(".tag-result").show();
        var text = obj.keyword.split(",");
        var load = "";
        if(obj.keyword.indexOf(",") !== -1){
        for(var i = text.length-1; i >= 0; i--){
            if(text[i] !== ""){
            load += "<button onClick='return delete_key_data(this)' data='"+i+"' text='"+text[i]+"' type='button' id='tag-key-"+i+"' style='padding:5px;background:#f5f5f5;color:#666;border:1px #e2e2e3 solid;border-radius:5px;margin-right:3px;margin-bottom:3px;'>"+text[i]+"&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-times' style='color:#666;font-size:11px;' ></i></button>";
            }   
        }
        $(".tag-result").html(load);
        }else{
        load += "<button  onClick='return delete_key_data(this)'  data='nuls' text='"+obj.keyword+"' type='button' id='tag-key-nuls' style='padding:5px;background:#f5f5f5;color:#666;border:1px #e2e2e3 solid;border-radius:5px;margin-right:3px;margin-bottom3:px;'>"+obj.keyword+"&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-times' style='color:#666;font-size:11px;' ></i></button>";
        $(".tag-result").html(load);
        }
        }


        if(obj.short_desc.length <= 160){
        $("#desc-desc").html(obj.short_desc);
        $("#hide-desc").css({
            "border" : "1px #e2e2e3 solid",
        });
        }else{
        $("#hide-desc").css({
            "border" : "1px #ff0000 solid",
        });
        $("#desc-desc").html(obj.short_desc);
        }
        if(obj.short_desc.length == 0){
        $("#length-hit").html("");
        }else{
        $("#length-hit").html(" ("+obj.short_desc.length+")");
        }

         if(obj.title !== ""){
        $("#title-desc").html(obj.title+' - <?=siteSetting()->sitename?>');
        $("#url-desc").html('<?=getPermalink()->homeUrl()?>/'+slugify(obj.title)+"-apk"+$("#uniq-id").val());
        }else{
        $("#title-desc").html("");
        $("#url-desc").html("");
        }
        

        $(".bos-xx").show();

        var ss = obj.screenshots;
        var img = "";
        
        for(var i = 0 ; i < ss.length; i++){
            img += "<div style='float:left'><img src='"+ss[i]+"' style='border:1px #e2e2e3 solid;' ></div>";
        }
        $("#save-ss").val(ss.join(","));
        $("#show-ss").html(img);
        

        if(obj.promo_video !== ""){
        $("#yt-embed").show();
        $("#yt-embed").html('<iframe src="'+obj.promo_video+'" style="margin-top:10px;width: 98.5%;height: 200px;border:1px #e2e2e3 solid;"></iframe>');
        }else{
        $("#yt-embed").hide();
        }

        $("#long-description").val(obj.description);
        
        $(".after-load").fadeIn();
        }
        
    }
    });
    }else{
        $("#play-load").html('');  
    }
}

function post_manual_data(a){

    $.ajax({
        type : "POST",
        url : "",
        data : $(a).serialize(),
        beforeSend : function(){
            $("#waiting").html("<img src='/views/adminpanel/css/ovalo.svg' width='20'> Under Proccess");
        },
        success : function(even){
            if(even.indexOf('<sukses/>') !== -1){
                alert("Success");
                window.location="/webmaster/manual-post/";
            }else{
            
                $("#failed1").show();
            
        }
    }
    });
    return false;
}

function go_edit1(a){
    if(confirm("if u using manual edit / manual post, automatic update in this this post will disable. are you sure ?") == true){
        window.location = "/webmaster/manual-post/?id="+a;
    }
}
function go_edit2(a){
        window.location = "/webmaster/manual-post/?id="+a;
}

function start_bulk_post(a){
    var tum = "";
    var data = $("#bulk-form").val().split("\n");
    for(var i = 0; i < data.length; i++){
        if(data[i] !== ""){
        if(i !== (data.length - 1)){
            tum += data[i]+",";
        }else{
            tum += data[i];
        }
        }
    }
    var spl = tum.split(",");
    $("#bulk-form").val(spl.join("\r"));
    $("#iml").html("Please Wait ...");
    $("#log-result").html("");
    $("#repsen").html("0 %");
        $("#progbar").animate({
            "width" : "0px",
        });
    $("#con-prog").attr("data","0");
    $("#progbar").css({
                "color" : "#666",
            });
    $("#repsen").css({
                "color" : "#666",
            });
    $("#bulk-form").attr("disabled","true");
    $("#true-res").css({
                "color" : "transparent",
                "font-size" : "10px",
            });
    $("#false-res").css({
                "color" : "transparent",
                "font-size" : "10px",
            });
    $("#up-res").css({
                "color" : "transparent",
                "font-size" : "10px",
            });
    $("#true-res").html("0");
    $("#false-res").html("0");
    $("#up-res").html("0");
$("#onloading").css({"color" : "transparent"});
    $("#all-load").css({"color" : "transparent"});
    
    var kumps = [];
    var inter = 1;
    for(var i = 0; i < data.length; i++){


    var pack = data[i].split("id=");
    if(data[i].indexOf("id=") !== -1){
        if(pack[1] !== "" ){
            if(data[i].indexOf("&") !== -1){
            var pack2 = pack[1].split("&");
          
            if(pack2[0] !== ""){
        
                var package_name = pack2[0];
            }
            }else{
                var package_name = pack[1];                
            }
        }
    }else{
                var package_name = data[i];                
    }
        if(package_name !== ""){
        
        kumps.push(package_name);
        inter += 3;

        }
    }
    post_bulk(kumps,"loads",1);
    return false;
}

function post_bulk(a,b,c){
    
    var check_len = a.length;
    var last_pack = a[a.length - 1];
    var jons = a.join("/");
    var update = jons.replace("/"+last_pack,"");
    var update = update.split("/");
    var a = last_pack;
    var b = update;
    if((last_pack !== "") || (last_pack !== "undefined")){
    $.ajax({
        type : "POST",
        url : "",
        data : "bulk_pack_name="+a,
        beforeSend : function(){
        
        },
        success : function(even){
        if(even.indexOf("<success/>") !== -1){
            $("#log-result").prepend('<div style="margin-bottom:10px;padding: 10px;background: #f3f3f3;border:1px #e2e2e3 solid;color:#666;width: 93%;border-radius: 5px;margin-top: 3px;">'+a.substring(0, 25)+' ... <span style="float:right"><img src="/views/adminpanel/css/ceklis.png" width="18"></span></div>');
            
            $("#true-res").html((parseInt($("#true-res").html())+1));
            
        }
        if(even.indexOf("<fail/>") !== -1) {
            $("#log-result").prepend('<div style="margin-bottom:10px;padding: 10px;background: #f3f3f3;border:1px #e2e2e3 solid;color:#666;width: 93%;border-radius: 5px;margin-top: 3px;">'+a.substring(0, 25)+' ... <span style="float:right"><i class="fa fa-times" style="color:#DC143C;font-size:20px;"></i></span></div>');
            
            $("#false-res").html((parseInt($("#false-res").html())+1));

        }
        if(even.indexOf("<upt/>") !== -1){
            $("#log-result").prepend('<div style="margin-bottom:10px;padding: 10px;background: #f3f3f3;border:1px #e2e2e3 solid;color:#666;width: 93%;border-radius: 5px;margin-top: 3px;">'+a.substring(0, 25)+' ... <span style="float:right"><i class="fa fa-arrow-circle-o-up" style="color:#0ba9c3;font-size:20px;"></i></span></div>');
            
            $("#up-res").html((parseInt($("#up-res").html())+1));
        }

        $("#false-res").css({
                "color" : "#666",
                "font-size" : "10px",
            });
            $("#true-res").css({
                "color" : "#666",
                "font-size" : "10px",
            });
             $("#up-res").css({
                "color" : "#666",
                "font-size" : "10px",
            });

        let conts = $("#con-prog").attr("data");
        var hits = $("#bulk-form").val().split("\n");
        $("#repsen").html( parseInt((parseInt(conts) + 1) * 100 / hits.length )+" %");
        $("#progbar").animate({
            "width" : ((parseInt(conts) + 1) * 100 / hits.length )+"%",
        });
        if(parseInt((parseInt(conts) + 1) * 100 / hits.length ) == 100){
            $("#iml").html("Bulk Start");
            $("#bulk-form").removeAttr("disabled");
            $("#bulk-form").val('');
        }
        if(parseInt((parseInt(conts) + 1) * 100 / hits.length ) > 91){
            $("#repsen").css({
                "color" : "#fff",
            });
        }
        $("#con-prog").attr("data",parseInt(conts) + 1);
        $("#onloading").html((parseInt(conts) + 1));
        $("#onloading").css({"color" : "#666"});
        $("#all-load").css({"color" : "#666"});
        $("#all-load").html(" / "+hits.length);
        
        if(c !== 0){
        if(update.length !== 1  ){
        
        post_bulk(update,"loads",1);
        }else{
        if(check_len > 1){
        post_bulk(update,"loads",0);
        }
        }
        }

        },
         error: function(xhr, statusText, err){
     $("#log-result").prepend('<div style="margin-bottom:10px;padding: 10px;background: #f3f3f3;border:1px #e2e2e3 solid;color:#666;width: 93%;border-radius: 5px;margin-top: 3px;">'+a+' <span style="float:right"><i class="fa fa-times" style="color:#DC143C"></i></span></div>');
            
            $("#false-res").html((parseInt($("#false-res").html())+1));

            $("#false-res").css({
                "color" : "#666",
                "font-size" : "10px",
            });
            $("#true-res").css({
                "color" : "#666",
                "font-size" : "10px",
            });
            $("#up-res").css({
                "color" : "#666",
                "font-size" : "10px",
            });

        let conts = $("#con-prog").attr("data");
        var hits = $("#bulk-form").val().split("\n");
        $("#repsen").html( parseInt((parseInt(conts) + 1) * 100 / hits.length )+" %");
        $("#progbar").animate({
            "width" : ((parseInt(conts) + 1) * 100 / hits.length )+"%",
        });
        if(parseInt((parseInt(conts) + 1) * 100 / hits.length ) == 100){
            $("#iml").html("Bulk Start");
            $("#bulk-form").removeAttr("disabled");
            $("#bulk-form").val('');
        }
        if(parseInt((parseInt(conts) + 1) * 100 / hits.length ) > 91){
            $("#repsen").css({
                "color" : "#fff",
            });
        }
        $("#con-prog").attr("data",parseInt(conts) + 1);
        $("#onloading").html((parseInt(conts) + 1));
        $("#onloading").css({"color" : "#666"});
        $("#all-load").css({"color" : "#666"});
        $("#all-load").html(" / "+hits.length);
        
        if(c !== 0){
        if(update.length !== 1  ){
        
        post_bulk(update,"loads",1);
        }else{
        if(check_len > 1){
        post_bulk(update,"loads",0);
        }
        }
        }
    }
    });
}
    return false;
}

function reset_form(){
    $("#bulk-form").val('');
    $("#iml").html("Please Wait ...");
    $("#log-result").html("");
    $("#repsen").html("0 %");
        $("#progbar").animate({
            "width" : "0px",
        });
    $("#con-prog").attr("data","0");
    $("#progbar").css({
                "color" : "#666",
            });
    $("#repsen").css({
                "color" : "#666",
            });
    $("#true-res").css({
                "color" : "transparent",
                "font-size" : "10px",
            });
    $("#false-res").css({
                "color" : "transparent",
                "font-size" : "10px",
            });
    $("#true-res").html("0");
    $("#false-res").html("0");
    $("#onloading").css({"color" : "transparent"});
    $("#all-load").css({"color" : "transparent"});
}
function update_latter(){
    $.ajax({
        type : "POST" ,
        url : "",
        data : "latters_update=1",
        success : function(even){
            $(".update-notif").fadeOut();
        }
    });
    
}

function script_update(){
    $.ajax({
        type : "POST" ,
        url : "",
        data : "update_script=1",
        beforeSend : function(){
            $(".update-notif").replaceWith('<div class="update-notif" style="border:1px #e2e2e3 solid;padding: 20px;background: #f5f5f5;border-radius: 5px;margin-bottom: 10px;color:#666"><img src="/views/adminpanel/css/ovalo.svg" width="20"> Please wait ... </div>');
        },
        success : function(even){
            if(even.indexOf("<success/>") !== -1){
            $(".update-notif").replaceWith('<div class="update-notif" style="border:1px #24cd77 solid;padding: 20px;background: #24cd77;border-radius: 5px;margin-bottom: 10px;color:#fff">Success Update. Thx For Your Attention :)</div>');
            $(".update-notif").delay(3000).fadeOut();
            alert("Success Update. Thx For Your Attention :)");
            window.location = "";
            }else{
            $(".update-notif").replaceWith('<div class="update-notif" style="border:1px #c70b0b solid;padding: 20px;background: #c70b0b;border-radius: 5px;margin-bottom: 10px;color:#fff">Failled Update, Try it latter, Our Team will fixing this problem :(</div>');
            $(".update-notif").delay(3000).fadeOut();
            }
        }
    });
}

function forgot_pass(){
    $(".main").css({
            "min-height" : $(window).height()-($(".copyright").height()*2.8)+($("#login-1").height() / 3)+"px",
    });
    $("#img-log").css({
    
    "height" : ($(window).height()-$(".header").height()-$(".copyright").height())+($("#login-1").height()/3)+"px",
    "top" : $(".header").height()+"px",
});

    $("#login-1").hide();
    $("#login-2").fadeIn(1000);
}

function back_log(){

      $(".main").css({
            "min-height" : $(window).height()-($(".copyright").height()*2.8)+"px",
    });
    $("#img-log").css({
    
    "height" : ($(window).height()-$(".header").height()-$(".copyright").height())+"px",
    "top" : $(".header").height()+"px",
});

    $("#login-1").fadeIn(1000);   
    $("#login-2").hide();
    
}

function cb(a){
    if($(a).val() == "5"){
    $("#cusuri").removeAttr("readonly");
    $("#cusuri").attr("required","true");
    $(".act_url_show").attr("onClick","return cuslink(this)");
    }else{
    $("#cusuri").attr("readonly","true");
    $("#cusuri").removeAttr("required");
    $(".act_url_show").removeAttr("onClick");
    }
    $("#hide_perm").val($(a).val());
    $(a).attr("name","category");
    $('input.cekbox').not(a).removeAttr("name");
    $('input.cekbox').not(a).prop('checked', false);  
}

function cbs(a){
    $('input.cekbox').not(a).prop('checked', false);  
}

function cuslink(a){
    if($("#cusuri").val() !== ""){
    $("#cusuri").val($("#cusuri").val()+"/"+$(a).html());
    }else{
    $("#cusuri").val($(a).html());
    }
}
</script>


</body>
</html>