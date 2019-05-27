<? 
session_start();
$language="it";
include("pagebase.inc.php");
include "./config.php";
include pathlang.$language.".php";
$bottom=" ";
include "./mainadmin.php";

$pagina=new f_template();
$pagina->Set_Color("white");
$pagina->Set_sfondo("sfondo_1.jpg");
$pagina->Set_link("#0000cc");
$pagina->Set_Top("top.html");
$pagina->Set_Description("");
$pagina->Set_Keywords("");
$pagina->Set_Title("");
$pagina->Set_Menu("menu.php");
$pagina->Set_Page($main);
$pagina->Set_Bottom($bottom);
$pagina->ShowPage();
?>
