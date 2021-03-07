<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '1767214706626391','b9b55039f39d719c8812902943482b33' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('https://dikertas.com/verify/facebook/index.php');
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
$request = new FacebookRequest( $session, 'GET', '/me' );
$request1 = new FacebookRequest( $session, 'GET', '/me/picture?redirect=false&height=200' );
  $response = $request->execute();
  $response1 = $request1->execute();
  // get response
  $gambar = $response1->getGraphObject();
  $fbpic = $gambar->getProperty('url');
  
  $graphObject = $response->getGraphObject();
  $fbid = $graphObject->getProperty('id'); 
  $fbfullname = $graphObject->getProperty('name');
  $fbemail = $graphObject->getProperty('email');
  $fblink = $graphObject->getProperty('link');

$_SESSION['user'] = "fb-".$fbid;
$_SESSION['fb_id'] = $fbid;
$_SESSION['fb_name'] = $fbfullname;
$_SESSION['fb_email'] = $fbemail;
$_SESSION['fb_link'] = $fblink;
$_SESSION['fb_pic'] = $fbpic;
$_SESSION['logwith'] = "facebook";
header("location: /dk-admin/auth/user");
} else {
  $loginUrl = $helper->getLoginUrl();
 header("Location: ".$loginUrl);
}
?>