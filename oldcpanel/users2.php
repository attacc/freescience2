<? 
session_start();
include "./config.php";
include "./pagebase.inc.php";
include cpanel."c_links.php";
include "./adminusers.php";

$campi[]="email";

$dbms = new c_mysql;
$dbms->ConnectSQL();
$dbms->Set_DB("freescience");

$query="SELECT ".$campi[0];
for($i=1;$i<count($campi);$i++)
       $query.=",".$campi[$i];
$query.= " FROM users ORDER by id";

$dbms->Exec_Query($query);
$n=$dbms->ReturnNum();
 if($n == 0)
  {
    $arr=-1;
  }
  else  for($i=0;$i<$n;$i++)
   for($j=0;$j<count($campi);$j++)
        $arr[$campi[$j]][]=urldecode($dbms->ReturnResult($i,$campi[$j]));

$page="<center><h2>Users</h2></center> <br>"; 

$temp="";
for($i=0;$i<count($arr["email"]);$i++)
{
$temp.=$arr["email"][$i]+",";
echo $arr["email"][$i].",";
if($i%20==0) echo "<br>";
}

$page.=$temp;
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
$pagina->Set_Title("FreeScience - NewsLetter");

$pagina->ShowPage();
?>
