<? 
session_start();
include "./config.php";
include "./pagebase.inc.php";
include cpanel."c_links.php";

$page="<center><h2>Aggiunti a Segnalati</h2><br>";
$page.='<form action="addsegnalati.php" method=post>
<textarea name="testo" rows="8" cols="80" wrap="virtual" dir="ltr" tabindex="5">
</textarea><br><br>
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
