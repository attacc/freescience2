<? 
session_start();
include "./config.php";
include "./pagebase.inc.php";
include "./c_mysql.php";

$dbms = new c_mysql;
$dbms->ConnectSQL();
$dbms->Set_DB("freescience");


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


$page="<center><h2>Topics</h2></center> <br>";
$tpage="<table cellspacing=\"1\"><tr>";
for($j=0;$j<count($topics["id"]);$j++)
{
    if($j%6==0)
   $tpage.=' </tr> <tr> <td align="center"> <img src="../images/topics/'.$topics["image"][$j].'"><br><b>'.$topics["it"][$j].'</b><br><a href="delgeneric.php?id='.$topics["id"][$j].'&namedb=topics"> D</a></td> ';
   else
    $tpage.=' <td><td align="center"> <img src="../images/topics/'.$topics["image"][$j].'"><br><b>'.$topics["it"][$j].'</b><br><a href="delgeneric.php?id='.$topics["id"][$j].'&namedb=topics"> D</a></td> ';
 }
$tpage.="</tr></table>";

$page.=$tpage;

$page.='<center>
	<form action="addtopics.php">
	IT<input type="text" name="it" size="30"><br>
        EN<input type="text" name="en" size="30"><br>
        Image<input type="text" name="image" size="30"><br>
	<br>
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
