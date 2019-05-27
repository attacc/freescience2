<?
include "./config.php";
include cpanel."c_links.php";
include "./libcat.php";
$language="it";

$pagename=$_POST['pagename'];
$codpadre=$_POST['codpadre'];



$rel[1]=$_POST['rel1'];
$rel[2]=$_POST['rel2'];
$rel[3]=$_POST['rel3'];
$links = new c_links($language,$pagename);

if($rel[1]!="")
 {
   $relcampo="related1";
   $links->InsRelated($codpadre,$relcampo,$rel[1]); 
 }
 
if($rel[2]!="")
 {
   $relcampo="related2";
   $links->InsRelated($codpadre,$relcampo,$rel[2]);  
 }

if($rel[3]!="")
 {
   $relcampo="related3";
   $links->InsRelated($codpadre,$relcampo,$rel[3]);  
 }
header("location:gestione.php?pagename=".$pagename."&id=".$codpadre);

?>
