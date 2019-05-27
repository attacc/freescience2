<?
include "./config.php";
include cpanel."c_links.php";
$language="it";
$links = new c_links($language,$_GET["pagename"]);
$links->ActiveLink($_GET["idlink"],$_GET["active"]);
header("location:gestione.php?pagename=".$_GET["pagename"]."&id=".$_GET["id"]);
?>
