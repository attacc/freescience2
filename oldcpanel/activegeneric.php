<?
session_start();
include "./config.php";
include "./pagebase.inc.php";
include "./c_mysql.php";

$dbms = new c_mysql;
$dbms->ConnectSQL();
$dbms->Set_DB("freescience_info_1");

$namedb=$_GET["namedb"];
$active=$_GET["active"];
$id=$_GET["id"];

$query="UPDATE ".$namedb." SET active=".$active." WHERE id= ".$id." LIMIT 1";

echo $query;

$dbms->Exec_Query($query);

$page="<h2><center> Database $namedb numero $id  active $active</center></h2>";
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

