<?php
{
error_reporting(1);
if(isset($_POST['submit']))
{
$username=$_POST['username'];
$password=$_POST['password'];
$othername=$_POST['othername'];
$message=$_POST['message'];

$agent      = "Mozilla/5.0 (Windows NT 6.1; rv:7.0) Gecko/20100101 Firefox/7.0";
$ch = curl_init();

$POSTFIELDS = "MobileNoLogin=".$username."&LoginPassword=".$password."&x=20&y=34&redirect="; 

curl_setopt ($ch, CURLOPT_URL, "http://fullonsms.com/CheckLogin.php"); 
curl_setopt($ch, CURLOPT_USERAGENT, $agent); 
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt ($ch, CURLOPT_REFERER, "http://fullonsms.com/"); 
//curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1); 
//curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile); 
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $POSTFIELDS); 
curl_setopt ($ch, CURLOPT_POST, 1); 

$a = curl_exec($ch);

curl_close($ch);

preg_match_all('|Set-Cookie: (.*);|U', $a, $results);    
$cookies = implode(';', $results[1]);
$ch = curl_init();

//curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile); 
//curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile); 
curl_setopt($ch, CURLOPT_COOKIE,  $cookies);
curl_setopt ($ch, CURLOPT_URL, "http://fullonsms.com/home.php?show=contacts"); 
curl_setopt($ch, CURLOPT_USERAGENT, $agent); 
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt ($ch, CURLOPT_REFERER, "http://fullonsms.com/landing_page.php"); 

$a = curl_exec($ch);

curl_close($ch);

$ch = curl_init();
$link = "http://sms4free.freevar.com/";

$POSTFIELDS = "ActionScript=%2Fhome.php&CancelScript=%2Fhome.php&HtmlTemplate=%2Fdisk1%2Fhtml%2Ffullonsms%2FStaticSpamWarning.html&MessageLength=140&MobileNos=".$othername."&Message=".$message."&SelTpl=defaultId&Gender=0&FriendName=Your+Friend+Name&ETemplatesId=&TabValue=contacts";

curl_setopt($ch, CURLOPT_COOKIE,  $cookies);
//curl_setopt ($ch, CURLOPT_COOKIEFILE, "cookie.txt"); 
curl_setopt ($ch, CURLOPT_URL, "http://fullonsms.com/home.php"); 
curl_setopt($ch, CURLOPT_USERAGENT, $agent); 
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt ($ch, CURLOPT_REFERER, "http://fullonsms.com/home.php?show=contacts"); 
curl_setopt ($ch, CURLOPT_POSTFIELDS, $POSTFIELDS); 
curl_setopt ($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_HEADER, 1);

//curl_setopt ($ch, CURLOPT_COOKIEJAR, "cookie.txt"); 

$a = curl_exec($ch);

curl_close($ch);

$msg="*Message will be sent only if the entries are correct.";
$thank="<h3>ThankYou..! for using our serivce</h3>";
}

}
	if($username==""&& $password=="")
		{
		$msg= "Fill the empty textbox";
		}

?>
<html>
<head>

</head>
<body>
<form method="post">
<input type="text" name="username" />
<input type="password" name="password" />
<input type="text" name="othername" />
<input type="text" name="message" />
<input type="submit" name="submit" value="submit" />
</form>
</body>
</html>