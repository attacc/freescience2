<? 

include "./config.php";
include "./pagebase.inc.php";
include cpanel."c_links.php";
$pagename=$_GET['pagename'];
$id=$_GET['id'];
$idlink=$_GET['idlink'];

if(!isset($pagename))
	die ("Error!!");

$language="it";
include pathlang.$language.".php";
include cpanel.$pagename.".inc.php";


$links = new c_links($language,$pagename);

$arr=$links->GetALink($idlink);

include "./modifica.inc.php";

$getcampi[]="active";
$getcampi[]="data";

$page='<center><br> 
   <h2><font color=navy>Modifica &nbsp;'.$singolo.'</font></h2> 
   <form action="mod.php" ONSUBMIT="return validateForm(this)">
   <input type="hidden" name="cod" value="1">
   <input type="hidden" name="pagename" value="'.$pagename.'">
   <input type="hidden" name="id_categoria" value="'.$categ.'">
   <table border="0">
    <tr>
        <th bgcolor="#D0DCE0">'.CAMPO.'</th>
        <th bgcolor="#D0DCE0">'.VALORE.'</th>
    </tr>
   ';
    $page.=modcampi($campi);
$page.="
</table><br>
<input type=\"submit\"  value=\"".SUBMIT."\"> &nbsp;&nbsp;&nbsp;&nbsp;
<input type=\"reset\" value=\"Reset!\">
</form></center>";


$pagina=new f_template();
$pagina->Set_Color("white");
$pagina->Set_link("#0000cc");
$pagina->Set_Description($description);
$pagina->Set_Keywords($keywords);
$pagina->Set_top("top.html");
$pagina->Set_menu("menu.php");
$pagina->Set_Page($page);
$pagina->Set_bottom($bottom);
$pagina->Set_Title("FreeScience - ".$title);

$pagina->ShowPage();
?>
