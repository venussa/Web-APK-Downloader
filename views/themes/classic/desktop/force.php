<?php
if(!empty(SESSION('packid'))){
 header('Content-Type: application/vnd.android.package-archive');
 header('Content-Disposition: attachment; filename="'.urlGen(SESSION('title'))."-(v".SESSION('version').").".SERVER('HTTP_HOST').".apk".'"');
 readfile(directDownload(SESSION('packid')));
}