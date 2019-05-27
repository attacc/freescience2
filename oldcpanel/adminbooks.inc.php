<?

include cpanel."c_links.php";
include cpanel."libmodbooks.php";
include cpanel."libcat.php";
$page=$stylecss;

$getcampi[]="it";
$getcampi[]="en";
$getcampi[]="pagine";
$getcampi[]="img";
$links = new c_links($language,$pagename);
$linkstmp = new c_links($language,"tmpbooks");

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
$cat_att = $links->GetNameMore($id);
if($cat_att[0] == -1) { $page.="Categoria non esistente."; }

//Prendo link
$arr=$links->GetAllLinks($getcampi,$id,$order="id_links");
$arrtmp=$linkstmp->GetAllLinks($getcampi,$id,$order="id_links");

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
	$page.=' 	
        <table width=90%><tr>
        <td align=left><b>Related Topics</b><br>';
for($i=1;$i<=3;$i++)
{
	if($cat_att[$i]!=0) {
		  	$rel_name   = $links->GetNameMore($cat_att[$i]);
			$rel_father = $links->GetName($rel_name[4]);
	$page.='<a href="gestione.php?pagename=books&id='.$cat_att[4].'">'.$rel_father.'</a> -> ... -> <a href="gestione.php?pagename=books&id='.$cat_att[$i].'">'.$rel_name[0].'</a><br>';
#	$page.=$rel_father.' -> ... -> <a href="gestione.php?pagename=books&id='.$cat_att[$i].'">'.$rel_name[0].'</a><br>';
#	$page.='<a href="gestione.php?pagename=books&id='.$cat_att[$i].'">'.$rel_father.' -> ... -> '.$rel_name[0].'</a><br>';
	}	
}
	#$rel=showrelated($cat_att);
	#if($rel!="") $page.='
	# <b>'.RELATED.'</b><br>
	#  '.$rel;
	  $page.='</td>   
	 <td align=right>
	 <a href="gestione.php?id='.
	 $cat_padre["id"].'&pagename='.$pagename.'"> '.$cat_padre_nome.'</a> -> '.$cat_att[0].' <br><br>
	</td></tr></table>';
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
$sot="";
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
	$link_p.=adminsiti($arr);
	$link_p.=adminsiti($arrtmp);
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
  <form action="insrel.php" method="post">';

if($cat_att[1]!=0) 
$page.='<input type=text name="rel1" maxlenght=4 value="'.$cat_att[1].'"><br>';
  else
$page.='<input type=text name="rel1" maxlenght=4><br>';
if($cat_att[2]!=0) 
$page.='<input type=text name="rel2" maxlenght=4 value="'.$cat_att[2].'"><br>';
  else
$page.='<input type=text name="rel2" maxlenght=4><br>';
if($cat_att[3]!=0) 
$page.='<input type=text name="rel3" maxlenght=4 value="'.$cat_att[3].'"><br>';
  else
$page.='<input type=text name="rel3" maxlenght=4><br>';

$page.='
<input type="hidden" name="codpadre" value="'.$id	.'">
 <input type="hidden" name="pagename" value="'.$pagename.'">
<input type="submit">
</form>
 
 </td></tr></tale>';

  $dbmstmp = new c_mysql;
  $dbmstmp->ConnectSQL();
  $dbmstmp->Set_DB("freescience_info_1");
  $query="SELECT data FROM tmpbooks ORDER by id_links DESC LIMIT 1";
  $dbmstmp->Exec_Query($query);
  $n=$dbmstmp->ReturnNum();
  if($n==0) {
    $page.='<center><font color=green><b>BOOKS CACHE EMPTY!!!!!!!!!</b></font></center><br>';
  }
  else {
    $data=$dbmstmp->ReturnResult(0,"data");
    $page.='<center><font color=green><b>LAST DATE:</b></font>'.date('d-m-Y', $data).' - <font color=green><b>TODAY: </b></font>'.mktime(0,0,0,date('m'),date('j'),date('Y')).'</center><br>';
  }
  $page.='<center><a href="inserisci.php?pagename='.$pagename.'&categ='.$id.'">'.ADD.'&nbsp;'.$singolo.'</a></center>';
?>
