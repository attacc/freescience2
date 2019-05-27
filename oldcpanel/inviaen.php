<? 
session_start();
include "./config.php";
include "./pagebase.inc.php";
include cpanel."c_links.php";
include "./adminusers.php";

$campi[]="id";
$campi[]="nome";
$campi[]="email";
$campi[]="password";
$campi[]="tipo";
$campi[]="lingua";
$campi[]="active";

$dbms = new c_mysql;
$dbms->ConnectSQL();
$dbms->Set_DB("freescience_info_1");

$test=$_POST["test"];
$testo=$_POST["testo"];
$subject=$_POST["subject"];

$query="SELECT ".$campi[0];
for($i=1;$i<count($campi);$i++)
       $query.=",".$campi[$i];
#$query.= " FROM users WHERE lingua='1' ORDER by id";
$query.= " FROM newsletter_users WHERE lingua='0' ORDER by id";

$dbms->Exec_Query($query);
$n=$dbms->ReturnNum();
 if($n == 0)
  {
    $arr=-1;
  }
  else  for($i=0;$i<$n;$i++)
   for($j=0;$j<count($campi);$j++)
        $arr[$campi[$j]][]=urldecode($dbms->ReturnResult($i,$campi[$j]));

$query="insert into newsletter(testo, lingua, data, titolo)
			values('".urlencode(stripslashes($testo))."','0','".date('y-m-j')."','".$subject."')";
if($test==0) $dbms->Exec_Query($query);

$page="<center><h2>Invio NewsLetter</h2> <br> <br><table border=1 width=70%>";
$soggetto=$subject;
$up='<html>
<head>
<title>* * *  FreeScience.info Newsletter * * *</title>
</head>
<BODY  BGCOLOR="white" vlink="blue" link="blue">';

$down='<br><br><br>
If you do not want anymore receive this newsletter please write to newsletter@freescience.info<br>
</BODY></HTML>';
$intestazioni = "MIME-Version: 1.0\r\n";
$intestazioni.= "Content-type: text/html; charset=iso-8859-1\r\n";
$intestazioni.="From: FreeScience.info <newsletter@freescience.info>\r\n";
$testo=$up.$testo.$down;
$indirizzi="";

$testmail="claudio.attaccalite@gmail.com";
#$testmail="claudio.attaccalite@isen.iemn.univ-lille1.fr";

if($test==1) 
{
  mail($testmail,$soggetto,stripslashes($testo),$intestazioni);
 $page.='<tr><td> 0) </td><td> TEST MAIL  </td><td> '.$testmail.'  </td><td> Inviata  </td></tr> ';
 }
else
{
$headers = "MIME-Version: 1.0\n";
$headers .= "From: newsletter@freescience.info\n";
$headers .= "Reply-to: newsletter@freescience.info\n";
for($i=0;$i<$n;$i++)
	$headers .= "Bcc: ".$arr['email'][$i]."\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
mail("newsletter@freescience.info",$soggetto,stripslashes($testo),$headers);
for($i=0;$i<$n;$i++)
 $page.='<tr><td> '.($i+1).') </td><td>'.$arr['nome'][$i].'  </td><td> '.$arr['email'][$i].'  </td><td> Inviata  </td></tr> ';
}
$page.="</table></center>";

$pagina=new f_template();
$pagina->Set_Color("white");
$pagina->Set_link("#0000cc");
$pagina->Set_Description($description);
$pagina->Set_Keywords(LIBRI.",".LIBRO.",".SCIENCE.",freescience,gratis,free");
$pagina->Set_top("top.html");
$pagina->Set_menu("menu.php");
$pagina->Set_Page($page);
$pagina->Set_bottom($bottom);
$pagina->Set_Title("FreeScience - NewsLetter");

$pagina->ShowPage();
?>
