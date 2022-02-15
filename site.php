<meta name="robots" content="noindex" />
<body oncontextmenu="return false">
<script>
document.onkeydown = function(e) {
return false;
}
</script>
<?php
$apiUser = "SITE-PRO-API-USERNAME-HERE"; // Site.Pro API Username
$apiPass = "SITE-PRO-API-PASSWORD-HERE"; // Site.Pro API Password
$tldapi = "http://your-builder-domain-here.com" // if you are using on-premises type your builder domain else type https://site.pro
$data = array("type" => "external", "username" => $_POST['username'], "password" => $_POST['password'], "domain" => $_POST['domain'], "baseDomain" => $_POST['domain'], "apiUrl" => "ftpupload.net", "uploadDir" => $_POST['dir']);
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
<br><?php echo $jsan->error->message ?></br>
<br><a href="sitebuild.php?username=<?php echo $_POST['username'] ?>&password=<?php echo $_POST['password'] ?>">Go Back</a></br>
<br><a href="<?php echo $jsan->url; ?>">Proceed</a></br>
<?php else: ?>
<script>location.href = "<?php echo $jsan->url; ?>"</script>
<?php endif ?>
