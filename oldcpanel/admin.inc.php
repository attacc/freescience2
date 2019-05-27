<?

include cpanel."c_links.php";
include cpanel."libmodsiti.php";
include cpanel."libcat.php";
$page=$stylecss;

if($language=="ru")
$links = new c_links("en",$pagename);
else
$links = new c_links($language,$pagename);

if(!isset($_GET['id']))
{
 $id=$links->GetIdCategoria($pagename,-1);
}
else $id=$_GET['id'];
//Dati padre
$cat_padre=$links->GetParent($id);
if($cat_padre==-1) {
  $cat_padre_nome=" non esistente";
  $cat_padre= $id;
} else {
  $cat_padre_id = $cat_padre;
  $cat_padre_nome = $links->GetName($cat_padre["id"]);
}

//Prendo informazioni categoria attuale
$cat_att = $links->GetName($id);
if($cat_att == -1) { $page.="Categoria non esistente."; }

//Prendo link
$arr=$links->GetAllLinks($getcampi,$id,$order="id_links");

//Sottocategorie
$sotto = $links->GetSubCat2($id);

//Costruisco il tutto

$page.= '
<center>
<DIV align=center>
<DIV class=para2 align=center>
	<P><b>'.$cat_att.'</b></P></DIV>
<DIV class=para1 align=center>
	<P>'.$title.' <font size=-1><i>FreeScience</i></font></P></DIV>
</DIV>
</center>';
if($cat_padre["id"]!=-1)
{
	$page.=' <a href="gestione.php?id='.
	$cat_padre["id"].'&pagename='.$pagename.'"> '.$cat_padre_nome.'</a> -> '.$cat_att.' <br><br>';
	$searchtml="";
}
else
{
 $searchtml='
 <center>
 <form action="../search.php"> <font color=navy><b> '.CERCAIN.'&nbsp;'.$title.' </b> </font><br>
 <input type="hidden" name="pagename" value="'.$pagename.'">
 <input type="text" name="testo" size=40 maxlengh=40> &nbsp; <input type="submit" value="'.SUBMIT.'">
  </form>';
}
if($sotto==-1) { $sot="<br><br>"; }
else {
	$sot.="<center>
	       <table width=\"100%\" border=0 cellspacing=5 link=\"#0000FF\" 
	                                      vlink=\"#9900CC\" alink=\"#CC0000\">";
	$sot.=admincat($sotto);
	$sot.="</table></center><br>\n";
        $page.=$sot; 
	$page.=$searchtml;

}

if($arr==-1) {  $link_p = "<br><br>"; }
else {
	$link_p="<table  width=\"100%\">";
	
	switch ($pagename)
	{
	case 'software':
	$link_p.=adminsoft($arr);
	break;
	case 'links':
	$link_p.=adminlink($arr);
	break;
	default:
	$link_p.=adminsiti($arr);
	}
	$link_p.="</table>";
     }

$page.=$link_p.'<br><table width=90%>
<tr><td><br> <form action="inscat.php" method="post">
 <input type="hidden" name="codpadre" value="'.$id	.'">
 <input type="hidden" name="pagename" value="'.$pagename.'">
 Nome nuova categoria:<br>
 en<input type=text name="enname" maxlenght=32><br>

  it <input type=text name="itname" maxlenght=32><br>
 <input type="submit">
 </form></td><td>
 Related<br>
  <form action="insrel.php" method="post">
<input type=text name="rel1" maxlenght=4><br>
<input type=text name="rel2" maxlenght=4><br>
<input type=text name="rel3" maxlenght=4><br>
<input type="hidden" name="codpadre" value="'.$id	.'">
 <input type="hidden" name="pagename" value="'.$pagename.'">
<input type="submit">
</form>
 
 </td></tr></tale>';
$page.='<center><a href="inserisci.php?pagename='.$pagename.'&categ='.$id.'">'.ADD.'&nbsp;'.$singolo.'</a></center>';
?>
