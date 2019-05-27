<?
include "./config.php";
include cpanel."c_links.php";
$language="it";

$pagename=$_POST['pagename'];
$enname=$_POST['enname'];
$codpadre=$_POST['codpadre'];
$itname=$_POST['itname'];

$links = new c_links($language,$pagename);
//echo "id = ".$id."<br>";
//echo "codpadre = ".$codpadre."<br>";
//echo "itname = ".$itname."<br>";
//echo "enname = ".$enname."<br>";
$presenza=$links->GetIdCategoria($enname,$codpadre);
//echo " presenza ".$presenza;
if($presenza!= -2)
 {
  echo"<br><br> C'è già una categoria con questo nome e questo padre riprova "; 
 }
 else 
 {
  $links->InsertNewSubCat($enname,$itname,$codpadre);
  header("location:gestione.php?pagename=".$pagename."&id=".$codpadre);
//echo "sono qui";
}
?>
