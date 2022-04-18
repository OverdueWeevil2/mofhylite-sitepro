<meta name="robots" content="noindex" />
<?php
$PageInfo = ['title'=>'Site Builder','rel'=>''];
require_once __DIR__.'/includes/Connect.php';
require_once __DIR__.'/handler/AreaHandler.php';
require_once __DIR__.'/includes/Header.php';
require_once __DIR__.'/handler/CookieHandler.php';
require_once __DIR__.'/handler/ValidationHandler.php';
require_once __DIR__.'/handler/HostingHandler.php';
require_once __DIR__.'/modules/autoload.php';
require_once __DIR__.'/modules/UserInfo/UserInfo.php';
require_once __DIR__.'/includes/Navbar.php';
require_once __DIR__.'/includes/Sidebar.php';
$sql = mysqli_query($connect,"SELECT * FROM `hosting_account` WHERE `account_username`='".$connect->real_escape_string($_GET['username'])."' AND `account_for`='".$ClientInfo['hosting_client_key']."'");
if(mysqli_num_rows($sql)>0){
}
else{
	die("You are not authorized to access this page.");
}
?>
<?php
if(!$AccountInfo['account_status']=='1'){
die('Your account status is NOT Active!');
}
?>
<form action="site.php" method="POST">
<label>Domain:</label>
<select id="domain" name="domain">
<?php
use \InfinityFree\MofhClient\Client;
$client = Client::create();
$request = $client->getUserDomains(['username' => $_GET['username']]);
$response = $request->send();
$res = $response->getDomains();
foreach($res as $domain){
		echo "<option>" . $domain . "</option>";
}
?>
</select>
<br></br>
<label>Upload Dir:</label>
<select id="dir" name="dir">
<option>/htdocs</option>
<?php
foreach($res as $domain){
		echo "<option>/" . $domain . "/htdocs</option>";
}
?>
</select>
<br></br>
<input type="submit" value="Go to Site Builder"></input>
<input id="username" name="username" value="<?php echo htmlentities($_GET['username'], ENT_QUOTES); ?>" hidden></input>
</form>
<?php require_once __DIR__.'/includes/Footer.php'; ?>
