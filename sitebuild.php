<meta name="robots" content="noindex" />
<script type="module" async>history.pushState({},{},"sitebuild.php");</script>
<body oncontextmenu="return false">
<script>
document.onkeydown = function(e) {
return false;
}
</script>
<?php
require_once __DIR__.'/modules/autoload.php';
require_once __DIR__.'/modules/UserInfo/UserInfo.php';
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
<input id="username" name="username" value="<?php echo $_GET['username'] ?>" hidden></input>
<input id="password" name="password" value="<?php echo $_GET['password'] ?>" hidden></input>
</form>