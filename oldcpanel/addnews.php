<?
session_start();
include "../language/it.php";
include "./config.php";
include "./pagebase.inc.php";
include "./c_mysql.php";
include "./news.inc.php";

$dbms = new c_mysql;
$dbms->ConnectSQL();
$dbms->Set_DB("freescience_info_1");

$data=date('y-m-j');
$active=1;

$query="insert into news (data,lingua,titolo,testo,tipo,link,active) VALUES ('$data','".$_GET["lingua"]."','".$_GET["titolo"]."','".$_GET["testo"]."','".$_GET["tipo"]."','".$_GET["link"]."','1')";

$dbms->Exec_Query($query);

$bottom=" ";

$page="<center><h2>News</h2> <br>
	<b>aggiunto</b><br> <br>
	<b>data    </b>".$data."<br>
	<b>lingua  </b>".$lingua."<br>
	<b>titolo  </b>".$titolo."<br>
	<b>testo  </b>".$testo."<br>
	<b>tipo  </b>".$tipo."<br>
	<b>link  </b>".$link."<br>
	<b>active </b> ".$active."<br>
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

