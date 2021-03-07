<?php
switch((POST('category'))) {
	
	case "Newest":
	header("location:/".POST('cats')."/");
	break;

	case "Updated":
	header("location:/".POST('cats')."/?sort=new");
	break;

	case "Rating":
	header("location:/".POST('cats')."/?sort=rating");
	break;
}