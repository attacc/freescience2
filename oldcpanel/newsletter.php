<? 
$google='
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-781484-2";
urchinTracker();
</script>

<script type="text/javascript"><!--
google_ad_client = "pub-2496472530545325";
google_ad_width = 120;
google_ad_height = 600;
google_ad_format = "120x600_as";
google_ad_type = "text_image";
google_ad_channel ="";
google_color_border = "FFFFFF";
google_color_bg = "FFFFFF";
google_color_link = "0000FF";
google_color_text = "000000";
google_color_url = "008000";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
';

$google_small='<script type="text/javascript"><!--
google_ad_client = "pub-2496472530545325";
google_ad_width = 705;
google_ad_height = 17;
google_ad_format = "728x15_0ads_al";
google_ad_channel ="";
google_color_border = "FFFFFF";
google_color_bg = "DDDDDD";
google_color_link = "000080";
google_color_text = "000080";
google_color_url = "008000";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
  </script>';

session_start();
include "./config.php";
include "./pagebase.inc.php";
include cpanel."c_links.php";
include "./readtopics.php";

$campi[]="id";
$campi[]="data";
$campi[]="lingua";
$campi[]="titolo";
$campi[]="testo";
$campi[]="tipo";
$campi[]="link";
$campi[]="active";

$dbms = new c_mysql;
$dbms->ConnectSQL();
$dbms->Set_DB("freescience_info_1");

if(!isset($_GET['limit'])) 
{ 
$limit=10;
}
else
{
$limit=$_GET['limit'];
}

$query="SELECT ".$campi[0];
for($i=1;$i<count($campi);$i++)
       $query.=",".$campi[$i];
$query.= " FROM news ORDER by id DESC LIMIT ".$limit;

$dbms->Exec_Query($query);
$n=$dbms->ReturnNum();
 if($n == 0)
  {
    $arr=-1;
  }
  else  for($i=0;$i<$n;$i++)
   for($j=0;$j<count($campi);$j++)
        $arr[$campi[$j]][]=urldecode($dbms->ReturnResult($i,$campi[$j]));

$topics=readtopics();

$query="SELECT COUNT(*) FROM newsletter WHERE lingua='1' ";
$dbms->Exec_Query($query);
$numero=$dbms->ReturnResult(0,0)+1;

$testobase="<table border=0>";
for($i=0;$i<$n;$i++)
{
	if(strlen($arr['testo'][$i])>200) 
	$arr['testo'][$i]=substr($arr['testo'][$i],0,200).'. . . . .';
	
	$testobase.="<tr><td><b>".$topics["it"][$arr["tipo"][$i]]." :</b><a href=\"".$arr['link'][$i]."\">".$arr['titolo'][$i]."</a></b>
	<br><font size=-1> 
   ".$arr['testo'][$i]."</font></td></tr>
   ";
}

$nltesto='      

	<center><h2>* * *  FreeScience.info Newsletter Numero '.$numero.' del '.date('j-m-y').' * * *</h2> </center>   <br>  
'.$testobase.'</table>';
$page="<center><h2>Newsletter</h2><br>";
$page.='<form action="invia.php" method=post>
<input type=text name="subject" value="FreeScience.info Newsletter Numero '.$numero.'" size=80><br><br>
<textarea name="testo" rows="50" cols="80" wrap="virtual" dir="ltr" tabindex="5">'.$nltesto.'</textarea><br>
<b>Test Email</b> <input type="radio" name="test" value="1">
<b>Newsletter Normale</b> <input type="radio" name="test" value="0" checked ><br>
<br>
<input type="submit"  value="Invia"> &nbsp;&nbsp;&nbsp;&nbsp;
<input type="reset" value="Reset!">
</form>
</center>';
$pagina=new f_template();
$pagina->Set_Color("white");
$pagina->Set_link("#0000cc");
$pagina->Set_Description($description);
$pagina->Set_Keywords(LIBRI.",".LIBRO.",".SCIENCE.",freescience,gratis,free");
$pagina->Set_top("top.html");
$pagina->Set_menu("menu.php");
$pagina->Set_Page($page);
$pagina->Set_bottom($bottom);
$pagina->Set_Title("FreeScience - ".LIBRI);

$pagina->ShowPage();
?>
