<?
session_start();
include "./config.php";
include "./pagebase.inc.php";
include "./c_mysql.php";

$dbms = new c_mysql;
$dbms->ConnectSQL();
$dbms->Set_DB("freescience_info_1");

$namedb=$_GET["pagename"];

$query="DELETE FROM $namedb WHERE id_links = '".$_GET['idlink']."' LIMIT 1 ";

$dbms->Exec_Query($query);

$page="<h2><center> Cencellato $namedb numero ".$_GET['idlink']." </center></h2>";
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

