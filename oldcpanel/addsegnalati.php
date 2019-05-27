<? 
session_start();
include "./config.php";
include "./pagebase.inc.php";
include cpanel."c_links.php";

$dbms = new c_mysql;
$dbms->ConnectSQL();
$dbms->Set_DB("freescience");
$testo=ereg_replace("[\\]\"","\"",$testo);
$query="insert into segnalati (testo) values('".urlencode($testo)."')";
$dbms->Exec_Query($query);

$page="<center><h2>Aggiunto a segnalati</h2> <br> <br>
".$testo."
</center>";

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
