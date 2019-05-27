<? 
session_start();
include "./config.php";
include "./pagebase.inc.php";
include cpanel."c_links.php";
include "./adminnews.php";
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

$query="SELECT ".$campi[0];
for($i=1;$i<count($campi);$i++)
       $query.=",".$campi[$i];
$query.= " FROM news ORDER by id DESC LIMIT 15";

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

$page="<center><h2>News</h2></center> <br> <table width=\"80%\" border=1>";
$page.=AdminNews($arr,$topics,1);
$page.="</table>";

$page.='<br><br><center><b><a href="insnews.php"> Add news </a></b></center>';

$bottom=" ";

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
