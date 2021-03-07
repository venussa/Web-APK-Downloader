<?php
if(POST('sort')=="rating"){
require_once(SERVER."/views/".themeConfig()."part/ascending/l-asc1.php");
 }else{
  require_once(SERVER."/views/".themeConfig()."part/ascending/l-asc2.php"); 
} ?>   

