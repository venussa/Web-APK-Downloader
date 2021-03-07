<body style="background: #f5f5f5">

<?php
session_start();
error_reporting(0);
set_time_limit(0);

if(isset($_POST['con_db'])){
	
	$conn = mysqli_connect(trim($_POST['database_host']),trim($_POST['username']),trim($_POST['password']),trim($_POST['database']));
	if($conn == true){
		
		$_SESSION['host'] = trim($_POST['database_host']);
		$_SESSION['user'] = trim($_POST['username']);
		$_SESSION['pass'] = trim($_POST['password']);
		$_SESSION['db'] = trim($_POST['database']);
		$respon = true;
		header("location:/install");
	exit;

	}else{

		$respon = false;
		$show_respon = '<div style="background:#f8d7da;color:#666;padding:10px;border-radius:5px;" class="alert alert-warning" role="alert">
                            Connection To Database Error
                            </div>';

	}
	
}

if(!isset($_SESSION['user'])){
?>

<title>Step 1 > Smartplay Installation Wizard</title>
<center style="font-family: sans-serif;">
	
<div style="background: #fff;border:0px #e2e2e3 solid;border-radius: 10px;padding: 10px;width: 500px;box-shadow: 0px 0px 1px rgba(0,0,0,.13) ,0px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);">
	<img src="logo.png" width="200"><br>
	<small style="color: #ccc">* Input valid data for connecting to database</small>
<br>
<br>

<div style="margin-left:15%;border-radius: 100%;width: 50px;height:50px;border:1px #24cd77 solid;background: #24cd77;color:#fff;box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);float:left"><h1 style="margin-top: 6px;">1</h1></div>
<div style="margin-left:20%;border-radius: 100%;width: 50px;height:50px;border:1px #e2e2e3 solid;background: #fff;color:#666;box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);float:left"><h1 style="margin-top: 6px;">2</h1></div>
<div style="margin-left:20%;border-radius: 100%;width: 50px;height:50px;border:1px #e2e2e3 solid;background: #fff;color:#666;box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);float:left"><h1 style="margin-top: 6px;">3</h1></div>
<div style="border:1px #e2e2e3 solid;height:3px;border-radius: 5px;margin-top:25px;"></div>
<br>
<br>
<?=@$show_respon?>
	<form method="POST" action="">
		<table style="width: 100%">
			<tr>
				<td style="width: 150px;padding: 5px;padding-top: 20px;" valign="top"><h4>Database Name</h4><small style="color:#ccc;margin-top: -10px;font-size: 10px">* first you mjust creat database in your web control panel</small></td>
				<td style="padding: 20px" valign="top"><input autocomplete="off" type="text" name="database" style="width: 100%;padding:10px;border: 1px #e2e2e3 solid;" placeholder="Mysql Database Name ..."></td>
			</tr>
			<tr>
				<td style="width: 150px;padding: 5px;padding-top: 20px;" valign="top"><h4>MySQL Username</h4><small style="color:#ccc;margin-top: -10px;font-size: 10px">* Type Your MySQL Username</small></td>
				<td style="padding: 20px" valign="top"><input autocomplete="off" type="text" name="username" style="width: 100%;padding:10px;border: 1px #e2e2e3 solid;" placeholder="Mysql Username ..."></td>
			</tr>
			<tr>
				<td style="width: 150px;padding: 5px;padding-top: 20px;" valign="top"><h4>MySQL Password</h4><small style="color:#ccc;margin-top: -10px;font-size: 10px">* Type Your MySQL Password</small></td>
				<td style="padding: 20px" valign="top"><input autocomplete="off" type="password" name="password" style="width: 100%;padding:10px;border: 1px #e2e2e3 solid;" placeholder="Mysql Password ..."></td>
			</tr>
			<tr>
				<td style="width: 150px;padding: 5px;padding-top: 20px;" valign="top"><h4>MySQL Host</h4><small style="color:#ccc;margin-top: -10px;font-size: 10px">* Type Your MySQL Hostname</small></td>
				<td style="padding: 20px" valign="top"><input autocomplete="off" type="text" name="database_host" style="width: 100%;padding:10px;border: 1px #e2e2e3 solid;" placeholder="Mysql Hostname ..." value="localhost">
					<br><br><hr style="border:transparent;border-bottom: 1px #e2e2e3 solid;" /><br>
					<button name="con_db" style="background: #24cd77;padding:10px;border:1px #24cd77 solid;color:#fff;width: 200px;">Next Step</button>
				</td>
			</tr>

		</table>
		
	</form>
</div>
</center>
	<?php
}



if(isset($_SESSION['user']) and (!isset($_SESSION['db_sukses']))){ 
if(isset($_POST['con_user'])){
	$conn = mysqli_connect($_SESSION['host'],$_SESSION['user'],$_SESSION['pass'],$_SESSION['db']);
	$source = "https://api.dload-apk.com/api/install.php?user=".trim($_POST['mem_user'])."&password=".trim($_POST['mem_pass'])."&license=".trim($_POST['mem_code'])."&key=".trim($_POST['smart_api']);
	
	$get_data = file_get_contents($source);

	if(!empty(trim($get_data))){
	$command = explode(";",str_replace("&amp;","&",$get_data));
	foreach($command as $os => $val){
		if(mysqli_query($conn,trim($val.";"))) {
			$feed = true;
		}else{
			$feed = false;
			
		}

	}
 
	mysqli_query($conn,"UPDATE connect SET user='".trim($_POST['mem_user'])."', password='".trim($_POST['mem_pass'])."', license_code='".trim($_POST['mem_code'])."' ");
	mysqli_query($conn, "UPDATE setting SET api='".trim($_POST['smart_api'])."' ");
	mysqli_query($conn, "INSERT INTO comment (for_id,text,date,time,name,user_id,status) VALUES ('0','','0','','','','') ");

	$code = '<?php
use connect\query\connDB;

// connect to pdo database
function PDOconnect(){
	// call class connDB
	$database = new connDB();

	// mysql config auth
	$database->host = (\''.$_SESSION['host'].'\');
	$database->user = (\''.$_SESSION['user'].'\');
	$database->pass = (\''.$_SESSION['pass'].'\');
	$database->dbms = (\''.$_SESSION['db'].'\');

	// run connection
	try{
	$db = new PDO(\'mysql:host=\'.$database->host.\';dbname=\'.$database->dbms,$database->user, $database->pass);
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	return $db;
	}catch (Exception $e){
	
		header(\'location:/install\');
		exit;
	
	exit;
	}
}
?>
';

	$op = fopen($_SERVER['DOCUMENT_ROOT']."/config/dbconfig.php","w+");
	$fw = fwrite($op,$code);
	fclose($op);
	
	$_SESSION['db_sukses'] = true;
	header("location:/install");
	exit;
}else{
	$show_respon = '<div style="background:#f8d7da;color:#666;padding:10px;border-radius:5px;" class="alert alert-warning" role="alert">
                            Verification Failed
                            </div>';
}
}
?>

<title>Step 2 > Smartplay Installation Wizard</title>
<center style="font-family: sans-serif;">
	
<div style="background: #fff;border:0px #e2e2e3 solid;border-radius: 10px;padding: 10px;width: 500px;box-shadow: 0px 0px 1px rgba(0,0,0,.13) ,0px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);">
	<img src="logo.png" width="200"><br>
	<small style="color: #ccc">* Input valid data for connecting to Api Server</small>
<br>
<br>

<div style="margin-left:15%;border-radius: 100%;width: 50px;height:50px;border:1px #e2e2e3 solid;background: #fff;color:#666;box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);float:left"><h1 style="margin-top: -15px;"><h1 style="margin-top: 6px;">1</h1></div>
<div style="margin-left:20%;border-radius: 100%;width: 50px;height:50px;border:1px #24cd77 solid;background: #24cd77;color:#fff;box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);float:left"><h1 style="margin-top: 6px;">2</h1></div>
<div style="margin-left:20%;border-radius: 100%;width: 50px;height:50px;border:1px #e2e2e3 solid;background: #fff;color:#666;box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);float:left"><h1 style="margin-top: 6px;">3</h1></div>
<div style="border:1px #e2e2e3 solid;height:3px;border-radius: 5px;margin-top:25px;"></div>
<br>
<br>
<?=@$show_respon?>
	<form method="POST" action="">
		<table style="width: 100%">
			<tr>
				<td style="width: 150px;padding: 5px;padding-top: 20px;" valign="top"><h4>Email</h4><small style="color:#ccc;margin-top: -10px;font-size: 10px">* Your mail must registered</small></td>
				<td style="padding: 20px" valign="top"><input autocomplete="off" type="text" name="mem_user" style="width: 100%;padding:10px;border: 1px #e2e2e3 solid;" placeholder="Registered Email ..."></td>
			</tr>
			<tr>
				<td style="width: 150px;padding: 5px;padding-top: 20px;" valign="top"><h4>Key Secret</h4><small style="color:#ccc;margin-top: -10px;font-size: 10px">* Contact Seller To Get Key Secret</small></td>
				<td style="padding: 20px" valign="top"><input autocomplete="off" type="text" name="mem_pass" style="width: 100%;padding:10px;border: 1px #e2e2e3 solid;" placeholder="Key Secret ..."></td>
			</tr>
			<tr>
				<td style="width: 150px;padding: 5px;padding-top: 20px;" valign="top"><h4>License Code</h4><small style="color:#ccc;margin-top: -10px;font-size: 10px">* Contact Seller To Get License Code</small></td>
				<td style="padding: 20px" valign="top"><input autocomplete="off" type="text" name="mem_code" style="width: 100%;padding:10px;border: 1px #e2e2e3 solid;" placeholder="License Code ..."></td>
			</tr>
			<tr>
				<td style="width: 150px;padding: 5px;padding-top: 20px;" valign="top"><h4>SmartPlay API KEY</h4><small style="color:#ccc;margin-top: -10px;font-size: 10px">* Important for doing al activity</small></td>
				<td style="padding: 20px" valign="top"><input autocomplete="off" type="text" name="smart_api" style="width: 100%;padding:10px;border: 1px #e2e2e3 solid;" placeholder="Smartplay API Key ...">
					<br><br><hr style="border:transparent;border-bottom: 1px #e2e2e3 solid;" /><br>
					<button name="con_user" style="background: #24cd77;padding:10px;border:1px #24cd77 solid;color:#fff;width: 200px;">Next Step</button>
				</td>
			</tr>

		</table>
		
	</form>
</div>
</center>

<?php
}
if(isset($_SESSION['db_sukses'])){ 
if(isset($_POST['con_admin'])){
	$conn = mysqli_connect($_SESSION['host'],$_SESSION['user'],$_SESSION['pass'],$_SESSION['db']);
	if(trim($_POST['admin_pass']) == trim($_POST['admin_pass1'])){
		
		$q = mysqli_query($conn,"UPDATE user SET name='".trim($_POST['admin_user'])."', user='".trim($_POST['admin_user'])."' , pass='".md5(trim($_POST['admin_pass']))."',email='".trim($_POST['admin_email'])."',pin='".trim($_POST['admin_pin'])."'");
		session_destroy();
		unlink($_SERVER['DOCUMENT_ROOT']."/install/index.php");
		unlink($_SERVER['DOCUMENT_ROOT']."/install/logo.png");
		rmdir($_SERVER['DOCUMENT_ROOT']."/install");
		header("location:/webmaster");
		exit;

	}else{
		$show_respon = '<div style="background:#f8d7da;color:#666;padding:10px;border-radius:5px;" class="alert alert-warning" role="alert">
                            Password Didn\'t Match
                            </div>';
	}
}
?>	
<title>Step 3 > Smartplay Installation Wizard</title>
<center style="font-family: sans-serif;">
	
<div style="background: #fff;border:0px #e2e2e3 solid;border-radius: 10px;padding: 10px;width: 500px;box-shadow: 0px 0px 1px rgba(0,0,0,.13) ,0px 1px 1px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);">
	<img src="logo.png" width="200"><br>
	<small style="color: #ccc">* Setting admin panel access</small>
<br>
<br>

<div style="margin-left:15%;border-radius: 100%;width: 50px;height:50px;border:1px #e2e2e3 solid;background: #fff;color:#666;box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);float:left"><h1 style="margin-top: -15px;"><h1 style="margin-top: 6px;">1</h1></div>
<div style="margin-left:20%;border-radius: 100%;width: 50px;height:50px;border:1px #e2e2e3 solid;background: #fff;color:#666;box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);float:left"><h1 style="margin-top: 6px;">2</h1></div>
<div style="margin-left:20%;border-radius: 100%;width: 50px;height:50px;border:1px #24cd77 solid;background: #24cd77;color:#fff;box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);float:left"><h1 style="margin-top: 6px;">3</h1></div>
<div style="border:1px #e2e2e3 solid;height:3px;border-radius: 5px;margin-top:25px;"></div>
<br>
<br>
<?=@$show_respon?>
	<form method="POST" action="">
		<table style="width: 100%">
			<tr>
				<td style="width: 150px;padding: 5px;padding-top: 20px;" valign="top"><h4>Username</h4><small style="color:#ccc;margin-top: -10px;font-size: 10px">* username for accessing admin panel</small></td>
				<td style="padding: 20px" valign="top"><input autocomplete="off" type="text" name="admin_user" style="width: 100%;padding:10px;border: 1px #e2e2e3 solid;" placeholder="Username ..."></td>
			</tr>
			<tr>
				<td style="width: 150px;padding: 5px;padding-top: 20px;" valign="top"><h4>Password</h4></td>
				<td style="padding: 20px" valign="top"><input autocomplete="off" type="password" name="admin_pass" style="width: 100%;padding:10px;border: 1px #e2e2e3 solid;" placeholder="Password ..."></td>
			</tr>
			<tr>
				<td style="width: 150px;padding: 5px;padding-top: 20px;" valign="top"><h4>Retype Password</h4></td>
				<td style="padding: 20px" valign="top"><input autocomplete="off" autocomplete="off" type="password" name="admin_pass1" style="width: 100%;padding:10px;border: 1px #e2e2e3 solid;" placeholder="Retype Password ..."></td>
			</tr>
			<tr>
				<td style="width: 150px;padding: 5px;padding-top: 20px;" valign="top"><h4>Email</h4><small style="color:#ccc;margin-top: -10px;font-size: 10px">* Please use registered Email</small></td>
				<td style="padding: 20px" valign="top"><input autocomplete="off" type="text" name="admin_email" style="width: 100%;padding:10px;border: 1px #e2e2e3 solid;" placeholder="Registered Email ..."></td>
			</tr>
			<tr>
				<td style="width: 150px;padding: 5px;padding-top: 20px;" valign="top"><h4>Security PIN</h4><small style="color:#ccc;margin-top: -10px;font-size: 10px">* Use pin for password reset if u forget password</small></td>
				<td style="padding: 20px" valign="top"><input autocomplete="off" type="text" name="admin_pin" style="width: 100%;padding:10px;border: 1px #e2e2e3 solid;" placeholder="Security Pin ...">
					<br><br><hr style="border:transparent;border-bottom: 1px #e2e2e3 solid;" /><br>
					<button name="con_admin" style="background: #24cd77;padding:10px;border:1px #24cd77 solid;color:#fff;width: 200px;">Finish</button>
				</td>
			</tr>

		</table>
		
	</form>
</div>
</center>

<?php }
?>
</body>