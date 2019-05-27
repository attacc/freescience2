<?
session_start();
include "./config.php";
include "valoricampi.php";
if(!isset($language))
$language="en";
include(pathlang.$language.".php");
include "c_mysql.php";

include $_GET['pagename'].".inc.php";

if($_GET['pagename']=="books") 
{ 
  $pagename="tmpbooks";
  $dbmstmp = new c_mysql;
  $dbmstmp->ConnectSQL();
  $dbmstmp->Set_DB("freescience_info_1");
  $query="SELECT data FROM tmpbooks ORDER by id_links DESC LIMIT 1";
  $dbmstmp->Exec_Query($query);
  $n=$dbmstmp->ReturnNum();
    
  if($n == 0) $data=mktime(0,0,0,date('m'),date('j'),date('Y'));   
  else 
  {
    $data=$dbmstmp->ReturnResult(0,"data");
    $data=$data+60*60*24;
  }
}
else 
{
$pagename=$_GET['pagename'];
$data=date('y-m-j');
}

include "c_links.php";
include "newscat.php";

$_GET["data"]=$data;
$links = new c_links($language,$pagename);
$numcampi=count($campi);

$ismulti=0;
$ityes=0;


for($j=0;$j<$numcampi;$j++)
  	{
	switch($campi[$j])
	{
	case "formato":
	  for($i=0;$i<count($formati);$i++)
	    if(isset($_GET[$formati[$i]]))
            {
	    if(!isset($abcd))
	     {
	     $insut[$j].=$_GET[$formati[$i]];
	     $abcd=1;
	     }
	    else
	    {
	    $insut[$j].=", ".$_GET[$formati[$i]];
	    }
	  }
	break;
	case "os":
	for($i=0;$i<count($opsys);$i++)
  	{
	if(isset($_GET[$opsys[$i]]))
	$insut[$j].=$_GET[$opsys[$i]]." ";

	}
		break;
	case "multilangue":
	for($i=0;$i<count($lingue);$i++)
  	if(isset($_GET[$lingue[$i]]))
	{
		 $insut[$j].=$_GET[$lingue[$i]]." ";
		 
	 if($_GET[$lingue[$i]]=="it") $ityes=1;
	 }
	$ismulti=1;
	break;
	case "it":
	$insut[$j]=addslashes($_GET[$campi[$j]]);
	$$campi[$j]=$_GET[$campi[$j]];
	case "en":
	$insut[$j]=addslashes($_GET[$campi[$j]]);
	$$campi[$j]=$_GET[$campi[$j]];
	break;
	default:
	$insut[$j]=$_GET[$campi[$j]];
	$$campi[$j]=$_GET[$campi[$j]];
	}
#	echo '<font color=navy>'.$campi[$j].' valore '.$insut[$j].'</font><br>';
    }
$links->NewLink($insut);

$newslang=0;
if($ismulti==1 && $ityes==1) $newslang=1; 

//echo " PAGENAME = ".$pagename." LANGUE = ".$langue;

if($pagename=="books")
{ 
	$descrizione=$_GET["en"];
	if($langue=="it") $descrizione=$_GET["it"];
}
if($pagename!="tmpbooks") {
if($_GET["langue"]=="it") $newslang=1; 
$linknews="http://www.freescience.info/go.php?pagename=".$pagename."&id=".$links->GetLastLink();
//$linknews="http://www.freescience.info/".$pagename.".php?id=".$_GET["id_categoria"];

$query="insert into news (data,lingua,titolo,testo,tipo,link,active,image) VALUES ('".$_GET["data"]."','$newslang','".$_GET["titolo"]."','".$descrizione."','".$tiponews[$pagename]."','".$linknews."','1','".$_GET["img"]."')";

echo $query;
mysql_query($query);
}
header("location:gestione.php?pagename=".$_GET['pagename']."&id=".$_GET['id_categoria']."");
?>

