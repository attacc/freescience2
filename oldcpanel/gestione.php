<? 
session_start();
include "./config.php";
include "./pagebase.inc.php";
if(!isset($language)) 
$language="en";
include(pathlang.$language.".php");

$getcampi[]="active";
$pagename=$_GET['pagename'];
include cpanel.$pagename.".inc.php";
if($pagename=="books")
	include "adminbooks.inc.php";
else 
	include "admin.inc.php";
$bottom=" ";

$pagina=new f_template();
$pagina->Set_Color("white");
$pagina->Set_link("#0000cc");
$pagina->Set_Description("administation");
$pagina->Set_Keywords(LIBRI.",".LIBRO.",".SCIENCE.",freescience,gratis,free");
$pagina->Set_top("top.html");
$pagina->Set_menu("menu.php");
$pagina->Set_Page($page);
$pagina->Set_bottom($bottom);
$pagina->Set_Title("FreeScience - ".LIBRI);

$pagina->ShowPage();
?>
