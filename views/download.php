<?php

if(!empty(GET('id')) and !empty(GET('storage'))){
if(@$_SESSION['download'] == GET('id')){
    
    $file = base64_decode(GET('storage'));
    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.android.package-archive');
    header("Content-Transfer-Encoding: binary");
    header('Content-Disposition: attachment; filename='.GET('id').'_'.siteSetting()->sitename.'.apk');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;


}else{
echo "Not Allowed";
}
}
exit;