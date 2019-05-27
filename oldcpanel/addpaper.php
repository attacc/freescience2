<?
session_start();
include "../language/it.php";
include "./config.php";
include "./pagebase.inc.php";
include "./c_mysql.php";
include "./news.inc.php";

$dbms = new c_mysql;
$dbms->ConnectSQL();
$dbms->Set_DB("freescience");

$data=date('y-m-j');
$active=1;


$query="insert into papers (data,titolo,testo,autore,url) VALUES ('$data','$titolo','$testo','$autore','$url')";

$dbms->Exec_Query($query);

$bottom=" ";

$page="<center><h2>Paper</h2> <br>
	<b>aggiunto</b><br> <br>
	<b>data    </b>".$data."<br>
	<b>titolo  </b>".$titolo."<br>
	<b>autore  </b>".$autore."<br>
	<b>testo  </b>".$testo."<br>
	<b>url  </b>".$url."<br>
</center>";
	
$pagina=new f_template();
$pagina->Set_Color("white");
$pagina->Set_link("#0000cc");
$pagina->Set_Description($description);
$pagina->Set_Keywords(NEWS.",".LIBRO.",".SCIENCE.",freescience,gratis,free");
$pagina->Set_top("top.html");
$pagina->Set_menu("menu.php");
$pagina->Set_Page($page);
$pagina->Set_bottom($bottom);
$pagina->Set_Title("FreeScience - ".NEWS);

$pagina->ShowPage();

?>

