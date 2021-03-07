<?=getFile("part/header");?>
<div class="main" style="margin-top:20px;">
    <div class="left floatr">
  
        <div style="margin-bottom: 17px;">  
    <center>
    <?=advertise()->desktop_720_90?>
</center>
  </div>
        <div class="box">
            <div class="title tlong">
                <?php
            if(getPermalink()->splice(1)!=="developer"){
            if(empty(getPermalink()->splice(2))){
            echo ucwords(getPermalink()->splice(1));
            }else{
            $get_name = connectDB()->Query("SELECT * FROM category WHERE url='".getPermalink()->splice(2)."' ");
            $echo_name = $get_name->fetch();
            echo ucwords($echo_name['categori'])." » ".ucwords($echo_name['name']);
            }
        }else{
            if(empty(getPermalink()->splice(2))){
            header("location:/notfound");
            }else{
            echo ucwords(str_replace("-"," ",getPermalink()->splice(2)));
            }
        }

?>
                
                <div class="sorting">
                    <div>Sort by:</div>
                    <ul class="sorting">
        <?php
        if(empty(getPermalink()->splice(2))){
            $varcat = "";
        }else{
              $varcat = "/".getPermalink()->splice(2);
         }


        if(empty(GET('sort'))) $active1 = 'selected'; 
        else if(!empty(GET('sort'))):
            if(GET('sort')=="new") $active2 = 'selected'; 
                if(GET('sort')=="rating") $active3 = 'selected'; 
        endif;
        ?>
                        <li><a href="<?="/".getPermalink()->splice(1).$varcat?>" class="<?=$active1?>">Newest</a></li>
                        <li><a href="<?="/".getPermalink()->splice(1).$varcat."/?sort="?>new" class="<?=$active2?>">Updated</a></li>
                        <li><a href="<?="/".getPermalink()->splice(1).$varcat."/?sort="?>rating" class="<?=$active3?>">Rating</a></li>
                    </ul>
                </div>
                
            </div>
            
                
<?php 

if(GET('sort')=="rating"){
require_once(SERVER."/views/".themeConfig()."part/ascending/asc1.php");
 }else{
  require_once(SERVER."/views/".themeConfig()."part/ascending/asc2.php"); 
} ?>   
    </div>
    <div class="right floatl" id="nav-kanan">
        <div class="box">
    <div class="title menu_head2">Category</div>
    <div class="menu_list">
        <p class="menu_head1"> <a title="hot android game apk" href="<?=getPermalink()->homeUrl()."/"?>game"><i class="category-icon-g"></i> Games</a></p>
        <div>
            <ul class="index-category cicon">
                 <?php
                $sub_cat = @connectDB()->bindQuery("SELECT * FROM category WHERE categori='game'");                                    
                foreach ($sub_cat as $key => $cat_name) { ?>
                <li ><a href="<?php echo getPermalink()->homeUrl()?>/<?=$cat_name->categori?>/<?=urlGen($cat_name->name)?>"><i class="<?=urlGen($cat_name->name)?>"></i><?=$cat_name->name?></a></li>  
                <?php }
                ?>
                
            </ul>
            <div class="clear"></div>
        </div>
        <p class="menu_head1" style="margin-bottom:0px;border-top:1px solid #eee;"><a title="hot android app apk" href="<?=getPermalink()->homeUrl()."/"?>app"><i class="category-icon-a"></i> Apps</a></p>
        <div>
            <ul class="index-category cicon">
                 <?php
                $sub_cat = @connectDB()->bindQuery("SELECT * FROM category WHERE categori='app'");                                    
                foreach ($sub_cat as $key => $cat_name) { ?>
                <li><a href="<?php echo getPermalink()->homeUrl()?>/<?=$cat_name->categori?>/<?=urlGen($cat_name->name)?>"><i class="<?=urlGen($cat_name->name)?>"></i><?=$cat_name->name?></a></li>  
                <?php }
                ?>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
</div>

<div style="margin-top: 10px;margin-bottom: 10px">
 <?=advertise()->desktop_300_250?>
</div>

    </div>
    <div id="btn-nav-kanan" class="clear"></div>
</div>

<div class="clear" style="height:0px;"></div>

<?=getFile("part/footer")
?>