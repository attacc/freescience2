<?
include "config.php";
include "c_links.php";

$pagename="books";
$language="en";
$links= new c_links($language,$pagename);

$gcampi[]="id_links";
$gcampi[]="id_categoria";
$gcampi[]="titolo";
$gcampi[]="cat2";

echo "**************  Advance Updating System ************<br>";
$arr=$links->GetLimit($gcampi,$order="id_links",0);
$nbooks=count($arr["id_links"]);
echo ">>>  Total number of books :".$nbooks."<br>";
echo "Updating fathers .. .... . . . . ... .<br>";

for($i=0;$i<$nbooks;$i++)
{
//  echo " Book-> ".$arr["titolo"][$i]."<br>";
  $links->int_All($father[0],$arr["id_categoria"][$i]);
  $name = $links->GetName($father[0]);
//  echo " Father1 = ".$name."<br>";
  $cat[0]="father1";
  $links->Update($arr["id_links"][$i],$cat,$father);
  if($arr["cat2"][$i]!=0) 
  {
  $links->int_All($father[0],$arr["cat2"][$i]);
  $name = $links->GetName($father[0]);
//  echo " Father2 = ".$name."<br>";
  $cat[0]="father2";
  $links->Update($arr["id_links"][$i],$cat,$father);
  }
}
echo " *************** Fathers books Done ***************** <br>";
$allcat=$links->GetAllCategoria();
for($i=0;$i<count($allcat["en"]);$i++)
{
 if($allcat["id_categoria"][$i]!=-1 && $allcat["id_categoria"][$i]!=1) {
 $links->int_All($catfather[0],$allcat["id_categoria"][$i]);
 }
 else $catfather[0]=-1;
 $cat[0]="father";
 $links->UpdateCat($allcat["id_categoria"][$i],$cat,$catfather);
}
echo " *************** Fathers Categeries Done ***************** <br>";

$gcampi[]="father1";
$gcampi[]="father2";
$arr=$links->GetLimit($gcampi,$order="id_links",0);

$arrcat=$links->GetSubCatShort(1);
echo " Principal Categories : ".count($arrcat["id"])." <br> ";

$mfile="menufile.php";
unlink($mfile);
$menufile=fopen($mfile,"w");
$data="<?\n";

for($i=0;$i<count($arrcat["id"]);$i++)
{
echo " id = ".$arrcat["id"][$i].", name = ".$arrcat["nome"][$i]." <br> ";
$data.='$maincat["id"][]="'.$arrcat["id"][$i]."\";\n";
$data.='$maincat["en"][]="'.$arrcat["en"][$i]."\";\n";
$data.='$maincat["it"][]="'.$arrcat["it"][$i]."\";\n";
$data.='$fname['.$arrcat["id"][$i].']="'.$arrcat["en"][$i]."\";\n";
}
$data.='$maincat["fr"][]="Biologie";
	$maincat["fr"][]="Chimie";
	$maincat["fr"][]="Informatique";
	$maincat["fr"][]="&Eacute;conomie-Finance";
	$maincat["fr"][]="Ing&eacute;nierie";
	$maincat["fr"][]="Mathematique";
	$maincat["fr"][]="M&eacute;dicine";
	$maincat["fr"][]="Miscellane&eacute;es";
	$maincat["fr"][]="Physique";';

$data.="\n?>";
fputs($menufile,$data);
fclose($menufile);
$data="";


$mainfile="novita.php";
$catfile="catfile.php";

unlink($mainfile);
$indexfile=fopen($mainfile,"w");
$data="<?\n";

for($j=0;$j<count($arrcat["id"]);$j++)
{
 $count=$i=0;
 echo " Categoria = ".$arrcat["id"][$j]."<br>";
 while($count<6 && $i<$nbooks)
 {
//  echo " father1 ".$arr["father1"][$i]."<br>";
  if($arr["father1"][$i]==$arrcat["id"][$j] || $arr["father2"][$i]==$arrcat["id"][$j])
  {
  echo " Libro ".$arr["titolo"][$i]." -> <br>";
  $data.='$nuovi['.$arrcat["id"][$j].'][]='.$arr["id_links"][$i].';'."\n";
  $count++;
  }
  $i++;
 }
}
$data.="\n?>";
fputs($indexfile,$data);
fclose($indexfile);




$arr=$links->GetLimit($gcampi,$order="id_links",0);
$nbooks=count($arr["id_links"]);
echo "**************  Total number of books :".$nbooks."<br>";


$counter=array();
for($i=0;$i<$nbooks;$i++) $counter[$i]=0;

 for($j=0;$j<$nbooks;$j++)
 {
  $links->check_father($arr["id_categoria"][$j],$counter);
  if($arr["cat2"][$j]!=0) 
  	$links->check_father($arr["cat2"][$j],$counter);
 }

$dbms = new c_mysql;
$dbms->ConnectSQL();
$dbms->Set_DB("freescience");
$query="select id_categoria,it,en FROM catbooks";

$dbms->Exec_Query($query);
$n=$dbms->ReturnNum();

if($n != 0)
  {
    for($i=0;$i<$n;$i++)
	{
   $cat["id_categoria"][]=urldecode($dbms->ReturnResult($i,"id_categoria"));
   $cat["it"][]=urldecode($dbms->ReturnResult($i,"it"));
   $cat["en"][]=urldecode($dbms->ReturnResult($i,"en"));
	}
 }

unlink($catfile);
$catfile=fopen($catfile,"w");
$catdata="<?\n";
$catdata.='$catcounter=array();'."\n";


for($i=0;$i<$n;$i++)
{
//	echo " Categoria: ".$cat["it"][$i]."--> books -> ".$counter[$cat["id_categoria"][$i]]." <br> ";
  if(isset($counter)) 
  $catdata.='$catcounter['.$cat["id_categoria"][$i].']='.$counter[$cat["id_categoria"][$i]].';'."\n";
  else
  $catdata.='$catcounter['.$cat["id_categoria"][$i].']=0;'."\n";

}
$catdata.="?>";
fputs($catfile,$catdata);
fclose($catfile);
?>
