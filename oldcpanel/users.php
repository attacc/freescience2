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

$query="SELECT ".$campi[0];
for($i=1;$i<count($campi);$i++)
       $query.=",".$campi[$i];
$query.= " FROM newsletter_users ORDER by id";

$dbms->Exec_Query($query);
$n=$dbms->ReturnNum();
 if($n == 0)
  {
    $arr=-1;
  }
  else  for($i=0;$i<$n;$i++)
   for($j=0;$j<count($campi);$j++)
        $arr[$campi[$j]][]=urldecode($dbms->ReturnResult($i,$campi[$j]));

$page="<center><h2>Users</h2></center> <br> <table width=\"80%\" border=1 align=center>
<tr align=center><td>N</td><td> <b>Nome</b> </td><td><b> Email</b> </td><td> <b>Password</b> </td><td><b> Tipo </b></td><td> <b>Lingua</b> </td><td><b> A/D</b> </td><td> <b>Cancella</b></td><tr>";
$page.=AdminUsers($arr);
$page.="</table>";
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
$pagina->Set_Title("FreeScience - NewsLetter");

$pagina->ShowPage();
?>
