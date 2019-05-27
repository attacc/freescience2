<? 
session_start();
include "./config.php";
include "./pagebase.inc.php";
include cpanel."c_links.php";

$dbms = new c_mysql;
$dbms->ConnectSQL();
$dbms->Set_DB("freescience_info_1");

$query="select id,it,en,image FROM topics";

$dbms->Exec_Query($query);
$n=$dbms->ReturnNum();
if($n != 0)
  {
    for($i=0;$i<$n;$i++)
        {
         $topics["id"][]=urldecode($dbms->ReturnResult($i,"id"));
         $topics["en"][]=urldecode($dbms->ReturnResult($i,"en"));
         $topics["it"][]=urldecode($dbms->ReturnResult($i,"it"));
         $topics["image"][]=urldecode($dbms->ReturnResult($i,"image"));
        }
 }


$page='<center><h2>Inserisci News</h2></center> 
<br> 
 <form action="addnews.php">
<table width=\"80%\" border=1>
<tr><td align="center" bgcolor="'.$color.'">Testo</td>
  	  <td><textarea name="testo" rows="7" cols="40" wrap="virtual" dir="ltr"
               tabindex="5"></textarea>
        </td></tr>
	<tr><td align="center" bgcolor="'.$color.'">Titolo </td>
  	  <td> <input type="text" name="titolo" value="" size="40" maxlength="64" tabindex="3" ></td></tr>';
	 $page.='<tr><td align="center" bgcolor="'.$color.'">Tipo </td>
	    <td><table><tr>'; 
 for($j = 0; $j<count($topics["id"]);$j++)
   {
    if($j%6==0) 
   $page.='</tr><tr><td><input type="radio" name="tipo" value="'.$topics["id"][$j].'">
         	<img src="../images/topics/'.$topics["image"][$j].'"></td>';
   else 
    $page.='<td><input type="radio" name="tipo" value="'.$topics["id"][$j].'">
         	<img src="../images/topics/'.$topics["image"][$j].'"></td>';
   }
	 $page.='</tr></table></td></tr>
	 <tr><td align="center" bgcolor="'.$color.'">Link</td>
  	  <td>  <input type="text" name="link" value="" size="40" maxlength="64" tabindex="3" ></td></tr>
 <tr><td align="center" bgcolor="'.$color.'">Lingua</td>
  	  <td> It <input type="radio" name="lingua" value="1"><br>
  	   En <input type="radio" name="lingua" value="0"><br></td></tr></table>
	   <input type="submit"  value="SUBMIT"> &nbsp;&nbsp;&nbsp;&nbsp;
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
