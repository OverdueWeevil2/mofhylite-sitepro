<meta name="robots" content="noindex" />
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
$sql = mysqli_query($connect,"SELECT * FROM `hosting_account` WHERE `account_username`='".$_POST['username']."' AND `account_for`='".$ClientInfo['hosting_client_key']."'");
$AccountInfo = mysqli_fetch_assoc($sql);
if(mysqli_num_rows($sql)>0){
	echo "";
}
else{
	die("You are not authorized to access this page.");
}
?>
<?php
$apiUser = "SITE-PRO-API-USERNAME-HERE"; // Site.Pro API Username
$apiPass = "SITE-PRO-API-PASSWORD-HERE"; // Site.Pro API Password
$tldapi = "http://your-builder-domain-here.com"; // if you are using on-premises type your builder domain else type https://site.pro
$apiLicense = ""; // License ID
$apiBrand = ""; // Brand ID
$data = array("type" => "external", "username" => $_POST['username'], "password" => $AccountInfo['account_password'], "domain" => $_POST['domain'], "baseDomain" => $_POST['domain'], "apiUrl" => "ftpupload.net", "uploadDir" => $_POST['dir']);
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

// Add ip
$data1 = array("action" => "add", "licenseId" => $apiLicense, "brandId" => $apiBrand, "ip" => gethostbyname($AccountInfo['account_domain']));
$data_string1 = json_encode($data1);

$ch1 = curl_init($tldapi . '/api/ipList');
curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch1, CURLOPT_POSTFIELDS, $data_string1);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_USERPWD, $apiUser.':'.$apiPass);
$headers1 = array(
    'Content-type: application/json',
);
curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers1);

$result1 = curl_exec($ch1);

$jsan = json_decode($result);
?>
<?php if ($jsan->error != null): ?>
<br><?php echo $jsan->error->message ?></br>
<?php else: ?>
<script>location.href = "<?php echo $jsan->url; ?>"</script>
<?php endif ?>
<?php require_once __DIR__.'/includes/Footer.php'; ?>
