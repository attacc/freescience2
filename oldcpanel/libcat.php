<?
function mostracat($sotto)
{
global $pagename;
$sot="";
for($j=0;$j<count($sotto["id"]);$j++)
  {
	if ($j%CATCOL == 0) //colonne de gauche
	 {
	   $sot.="<tr>";
	   if($j%CATLINCOL==0)
	      $sot.='<tr bgcolor="'.CATCOLOR.'">';
	}

	$sot.='<td width="33%" align="center">';
	
	if($sotto["links"][$j]>0)
		$figli='['.$sotto["links"][$j].']';
	else 	$figli='';
	
	if($sotto["figli"][$j]>0)
		$sot.='<b><a href="'.$pagename.'.php?id='.$sotto["id"][$j].'" class=links>
	              '.$sotto["nome"][$j].'</a></b>'.$figli.'</td>';
	else
	     $sot.='<a href="'.$pagename.'.php?id='.$sotto["id"][$j].'" class=links>
	           '.$sotto["nome"][$j].'</a>'.$figli.'</td>';

  }
	   return($sot);
}

function admincat($sotto)
{
global $pagename;
$sot="";
for($j=0;$j<count($sotto["id"]);$j++)
  {
	if ($j%CATCOL == 0) //colonne de gauche
	 {
	   $sot.="<tr>";
	   if($j%CATLINCOL==0)
	      $sot.='<tr bgcolor="'.CATCOLOR.'">';
	}

	$sot.='<td width="33%" align="center">';
	
	if($sotto["links"][$j]>0)
		$figli='('.$sotto["links"][$j].')';
	else 	$figli='';
	
	if($sotto["figli"][$j]>0)
		$sot.='<font color="navy"><b><a href="gestione.php?id='.$sotto["id"][$j].'&pagename='.$pagename.'">
	              '.$sotto["it"][$j].'-<font color=red>'.$sotto["en"][$j].'</font></a></b></font>'.$figli.'</td>';
	else
	     $sot.='<font color="navy"><a href="gestione.php?id='.$sotto["id"][$j].'&pagename='.$pagename.'">
	           '.$sotto["it"][$j].'-<font color=red>'.$sotto["en"][$j].'</font></a></font>'.$figli.'</td>';

  }
 // echo "Sono presenti ".count($sotto["id"]);
	   return($sot);
}

function showrelated($arr)
{
global $pagename,$language;
for($i=1;$i<count($arr);$i++)
 {
	if($arr[$i]!="")
	{
	$parti=explode(";",$arr[$i]);
	if($language=="it")
		$link=$parti[0];
	else
		$link=$parti[1];
	$page.='<a href="'.$pagename.'.php?id='.
	$parti[2].'">'.$link.'</a><br>'; 
	}
 } 
return $page;
}

function makerelated($rel,$pagename)
{
global $language;
$links = new c_links($language,$pagename);
$links->int_All($arr1,$arr2,$rel,"-> ");
return( $arr1.";".$arr2);
}
?>
