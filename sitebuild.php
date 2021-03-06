<meta name="robots" content="noindex, nofollow, noarchive" />
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
$usernamme = $_GET['username'];
$key = $ClientInfo['hosting_client_key'];
$sql = mysqli_query($connect,"SELECT * FROM `hosting_account` WHERE `account_username`='{$usernamme}' AND `account_for`='{$key}'");
$AccountInfo = mysqli_fetch_assoc($sql);
if(mysqli_num_rows($sql)>0){
	// Nothing
}
else{
	die("You are not authorized to access this page.");
}
?>
<?php
if ($AccountInfo['account_status']!='1') { die("<h1><strong>Fatal Error! Your account is not active!</strong></h1>"); }
?>
<form action="site.php" method="POST">
<label for="domain" class="form-control">Domain:</label>
<select id="domain" name="domain" class="form-control">
<?php
use \InfinityFree\MofhClient\Client;
$client = Client::create();
$request = $client->getUserDomains(['username' => $usernamme]);
$response = $request->send();
$res = $response->getDomains();
foreach($res as $domain){
		echo "<option class='form-control'>" . $domain . "</option>";
}
?>
</select>
<br></br>
<label for="dir" class="form-control">Upload Dir:</label>
<select id="dir" name="dir" class="form-control">
<option class='form-control'>/htdocs</option>
<?php
$conn = ftp_ssl_connect("ftpupload.net");
$login = ftp_login($conn, $usernamme, $AccountInfo['account_password']);
$files = ftp_mlsd($conn, "/");

foreach ($files as $file)
{ 
    if ($file["type"] == "dir" && ($file["name"] != "htdocs") && ($file["name"] != ".cpanel") && ($file["name"] != ".pki") && ($file["name"] != ".softaculous") && ($file["name"] != "mail"))
    {
		echo "<option class='form-control'>/".$file["name"]."/htdocs</option>";
    }
} 
?>
</select>
<br></br>
<input type="submit" value="Go to Site Builder" class="form-control"></input>
<input id="username" name="username" value="<?php echo htmlentities($usernamme, ENT_QUOTES); ?>" hidden></input>
</form>
<?php require_once __DIR__.'/includes/Footer.php'; ?>
