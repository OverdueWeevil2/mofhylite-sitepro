<?php
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
$apiUser = "SITE-PRO-API-USERNAME-HERE"; // Site.Pro API Username
$apiPass = "SITE-PRO-API-PASSWORD-HERE"; // Site.Pro API Password
$tldapi = "http://your-builder-domain-here.com"; // if you are using on-premises type your builder domain else type https://site.pro
$data = array("type" => "external", "username" => $usernamme, "password" => $AccountInfo['account_password'], "domain" => $_POST['domain'], "baseDomain" => $_POST['domain'], "apiUrl" => "ftpupload.net", "uploadDir" => $_POST['dir']);
$data_string = json_encode($data);

$ch = curl_init($tldapi . '/api/requestLogin');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $apiUser.':'.$apiPass);
$headers = array(
    'Content-type: application/json',
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

$jsan = json_decode($result);
?>
<?php if ($jsan->error != null): ?>
<meta name="robots" content="noindex, nofollow, noarchive" />
<br><?php echo $jsan->error->message ?></br>
<?php else: ?>
<?php header("Location: " . $jsan->url); die; ?>
<?php endif ?>
<?php require_once __DIR__.'/includes/Footer.php'; ?>
