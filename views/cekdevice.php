<?php
if(GET('select')=="desktop"){
	$_SESSION['device'] = "desktop";
	
}elseif(GET('select')=="mobile"){
	$_SESSION['device'] = "mobile";
	
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Redirecting ... </title>
<meta name="robots" content="noindex" />
<?php echo "<script>window.location='".base64_decode(GET('url'))."';</script>"; ?>
</head>
<body></body>
</html>
