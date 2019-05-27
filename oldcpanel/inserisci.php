<? 

session_start();
include "./config.php";
include "./pagebase.inc.php";

$pagename=$_GET['pagename'];
$categ=$_GET['categ'];

if(!isset($pagename))
	die ("Error!!");

if(!isset($language)) $language="en";
include "../language/".$language.".php";
include $pagename.".inc.php";
include "./inserisci.inc.php";


$page='<center><br> 
   <h2><font color=navy>'.ADD.'&nbsp;'.$singolo.'</font></h2> 
   <form action="addgeneric.php" ONSUBMIT="return validateForm(this)">
   <input type="hidden" name="cod" value="1">
   <input type="hidden" name="pagename" value="'.$pagename.'">
   <input type="hidden" name="id_categoria" value="'.$categ.'">
  <table>
  <tr><td>
  <table border="0">
    <tr>
        <th bgcolor="#D0DCE0">'.CAMPO.'</th>
        <th bgcolor="#D0DCE0">'.VALORE.'</th>
    </tr>
   ';
    $page.=showcampo($campi);
$page.='
</table>
</td> </tr></table>
<br>
<input type="submit"  value="'.SUBMIT.'"> &nbsp;&nbsp;&nbsp;&nbsp;
<input type="reset" value="Reset!">
</form></center>';


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
