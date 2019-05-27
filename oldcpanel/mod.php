<?
$pagename=$_GET['pagename'];
$id=$_GET['id'];
$id_links=$_GET['id_links'];
$id_categoria=$_GET['id_categoria'];

include "./config.php";
include "valoricampi.php";
include cpanel."c_links.php";
include $pagename.".inc.php";
$getcampi[]="active";
$getcampi[]="data";
if($pagename=="books")
{
$getcampi[]="it";
$getcampi[]="en";
$getcampi[]="pagine";
$getcampi[]="img";
}
$language="it";
$links = new c_links($language,$pagename);

for($j=0;$j<count($campi);$j++)
  	{
	switch($campi[$j])
	{
	case "formato":
	  for($i=0;$i<count($formati);$i++)
	  {
	    if(isset($_GET[$formati[$i]]))
            {
	    if(!isset($abcd))
	     {
	     $_GET['formato'].=$formati[$i];
	     $abcd=1;
	     }
	    else
	    {
	    $_GET['formato'].=",".$formati[$i];
	    }
	  }
	 }
	break;
	case "os":
	for($i=0;$i<count($opsys);$i++)
  	{
	if(isset($_GET[$opsys[$i]]))
	$_GET['os'].=$opsys[$i]." ";

	}
		break;
	case "multilangue":
	for($i=0;$i<count($lingue);$i++)
  	if(isset($_GET[$lingue[$i]]))
		 $_GET['multilangue'].=$lingue[$i]." ";
	break;
	}
}

for($i=0;$i<count($getcampi);$i++)
{
$valori[$i]=$_GET[$getcampi[$i]];
}
$links->Update($id_links,$getcampi,$valori);
header("location:gestione.php?pagename=".$pagename."&id=".$id_categoria);
?>
