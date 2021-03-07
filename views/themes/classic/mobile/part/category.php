<?php getFile("part/header"); ?>

<div class="main">
    
        
      
        <div style="margin-bottom: 10px;">  
    <center>
    <?=advertise()->mobile_responsive?>
</center>
  </div>
    
    <div class="box-title">
        <div class="tit1"><span class="<?php
        if(getPermalink()->splice(1)=="game"){
        echo "g";
        }elseif(getPermalink()->splice(1)=="app"){
        echo "a";
        }else{
        echo "t";
        }
        ?>bg"></span> 
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
      <?php
        if(empty(getPermalink()->splice(2))){
            $varcat = "";
            $str_cat = getPermalink()->splice(1);
        }else{
              $varcat = "/".getPermalink()->splice(2);
              $str_cat = getPermalink()->splice(1)."/".getPermalink()->splice(2);
         }


        if(empty(GET('sort'))) $active1 = 'selected'; 
        else if(!empty(GET('sort'))):
            if(GET('sort')=="new") $active2 = 'selected'; 
                if(GET('sort')=="rating") $active3 = 'selected'; 
        endif;
        ?>

        </div>
        
                    
        <div class="sorting">
            <div class="select">
     <form action="/redirect" method="post">
    <input type="text" name="cats" value="<?=$str_cat?>" style="display: none;" >
     <select style="border:1px #ccc solid;border-radius:3px;background-color:#fff;" name="category" onchange="this.form.submit();">
    <?php
if(empty(GET('sort'))){ ?>
<option>Newest</option>
<option>Updated</option>
<option>Rating</option>
<?php }else{
if(GET('sort') == "new"){ ?>
<option>Updated</option>
<option>Newest</option>
<option>Rating</option>
<?php }elseif(GET('sort') == "rating"){ ?>
<option>Rating</option>
<option>Updated</option>
<option>Newest</option>
    <?php }
}
    ?>
     
     </select>
         </form>
            </div>
        </div>
        
    </div>
    <div class="cl"></div>
    <div class="box" style="background: #fff">

<?php 

if(GET('sort')=="rating"){
require_once(SERVER."/views/".themeConfig()."part/ascending/asc1.php");
 }else{
  require_once(SERVER."/views/".themeConfig()."part/ascending/asc2.php"); 
} ?>   

     
    
</div>
<?php getFile("part/footer") ?>