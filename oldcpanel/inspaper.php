<? 
session_start();
include "./config.php";
include "./pagebase.inc.php";
include cpanel."c_links.php";

$page='<center><h2>Inserisci articoli</h2></center> 
<br> 
 <form action="addpaper.php">
<table width=\"80%\" border=1>

	<tr><td align="center" bgcolor="'.$color.'">Titolo </td>
  	  <td> <input type="text" name="titolo" value="" size="40" maxlength="128" tabindex="3" ></td></tr>

	<tr><td align="center" bgcolor="'.$color.'">Autore </td>
  	  <td> <input type="text" name="autore" value="" size="40" maxlength="128" tabindex="3" ></td></tr>

	<tr><td align="center" bgcolor="'.$color.'">Url </td>
  	  <td> <input type="text" name="url" value="" size="40" maxlength="128" tabindex="3" ></td></tr>

	  
<tr><td align="center" bgcolor="'.$color.'">Testo</td>
  	  <td><textarea name="testo" rows="7" cols="40" wrap="virtual" dir="ltr"
               tabindex="5"></textarea>
        </td></tr>
	    <table> 

	   <center><input type="submit"  value="SUBMIT"> &nbsp;&nbsp;&nbsp;&nbsp;
<input type="reset" value="Reset!">
</form></center>';

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
