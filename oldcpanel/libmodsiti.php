<?

$stylecss="
<STYLE type=text/css>BODY {
}
.para1 {
	MARGIN-TOP: -40px; FONT-SIZE: 20px; MARGIN-LEFT: 100px; COLOR: #0080ff; LINE-HEIGHT: 35px; MARGIN-RIGHT: 5px; FONT-FAMILY: font2, Arial; TEXT-ALIGN: center 
}
.para2 {
	MARGIN-TOP: 15px; FONT-SIZE: 40px; MARGIN-LEFT: 15px; COLOR: navy;  LINE-HEIGHT: 40px; MARGIN-RIGHT: 50px; FONT-FAMILY: font1, Verdana,Arial, Helvetica, ; TEXT-ALIGN: center
}
</STYLE>";


function adminsiti($arr)
{
global $id,$pagename;
for($i = 0;$i<count($arr["id_links"]);$i++)
	{
	if($arr["active"][$i]==0)
	$link_p .= '<tr>
		<td width="100%" align=\"left\" bgcolor="#ffcc00">';
	else 
	$link_p .= '<tr>
		<td width="100%" align=\"left\">';
	$link_p.='
	<table><tr><td width="95%">
	<b><font size=-1><font face="verdana" color="navy">
	<a href="'.$arr["url"][$i].'" target="_blank">'.$arr["titolo"][$i].'</a></font></b>
        <br> <b>'.AUTORE.': 
	</b><i>'.$arr["autore"][$i].'</i>
        <b>'.LINGUA.':</b> <img src="'.pathflag.$arr["langue"][$i].'.png" height=13> 
	<b> '.FORMATO.':</b>
        '.$arr["formato"][$i].'
	<br>
	'.$arr["descrizione"][$i].'
	</font>
	</td>
	<td bgcolor="#96ea8c">
	<a href="attiva.php?pagename='.$pagename.'&idlink='.$arr["id_links"][$i].'&active=1&id='.$id.'"><b> A </b></a></td>
	<td bgcolor="#96ea8c">
	<a href="attiva.php?pagename='.$pagename.'&idlink='.$arr["id_links"][$i].'&active=0&id='.$id.'"><b> D </b></a></td>
	<td bgcolor="#96ea8c">
	<a href="modifica.php?pagename='.$pagename.'&idlink='.$arr["id_links"][$i].'&id='.$id.'"><b> M </b></a></td>
	<td bgcolor="#96ea8c">
	<a href="elimina1.php?pagename='.$pagename.'&idlink='.$arr["id_links"][$i].'&id='.$id.'"><b> E </b></a></td>
	</tr></table>
	</td></tr>';
	}
	return $link_p;
}


function adminsoft($arr)
{
global $id,$pagename;

for($i = 0;$i<count($arr["id_links"]);$i++)
	{
	if($arr["active"][$i]==0)
	$link_p .= '<tr>
		<td width="100%" align=\"left\" bgcolor="#ffcc00">';
	else 
	$link_p .= '<tr>
		<td width="100%" align=\"left\">';
	$link_p.='<table><tr><td width="95%">
<b><font face="verdana" color="navy">
<a href="'.$arr["url"][$i].'" target="_blank">'.$arr["titolo"][$i].'</a></font></b>
        	<br><b>'.AUTORE.': 
		</b>'.$arr["autore"][$i].'
        	<b> '.LINGUA.': </b>';

$lingue_div = explode(" ",$arr["multilangue"][$i]);
for ($j=0;$j<count($lingue_div);$j++)
  {
   $templing.='<img src="../flags/'.$lingue_div[$j].'.png" height=13> ';
 }
  $link_p.=$templing.' '.OS.': ';

$formati_div = explode(" ",$arr["os"][$i]);
for ($j=0;$j<count($formati_div);$j++)
  {
   $tempsoft.='<img src="../os/'.$formati_div[$j].'.png"> ';
 }
        $link_p.=$tempsoft.'<br>'.$arr["descrizione"][$i].'
			  <td bgcolor="#96ea8c">
	<a href="attiva.php?pagename='.$pagename.'&idlink='.$arr["id_links"][$i].'&active=1&id='.$id.'"><b> A </b></a></td>
	<td bgcolor="#96ea8c">
	<a href="attiva.php?pagename='.$pagename.'&idlink='.$arr["id_links"][$i].'&active=0&id='.$id.'"><b> D </b></a></td>
	<td bgcolor="#96ea8c">
	<a href="modifica.php?pagename='.$pagename.'&idlink='.$arr["id_links"][$i].'&id='.$id.'"><b> M </b></a></td>
	<td bgcolor="#96ea8c">
	<a href="elimina1.php?pagename='.$pagename.'&idlink='.$arr["id_links"][$i].'&id='.$id.'"><b> E </b></a></td>
	</tr></table>
 </td></tr>';
	$tempsoft="";
	$templing="";

   }
	return $link_p;
}

function adminlink($arr)
{
global $id,$pagename;

for($i = 0;$i<count($arr["id_links"]);$i++)
	{
		if($arr["active"][$i]==0)
	$link_p .= '<tr>
		<td width="100%" align=\"left\" bgcolor="#ffcc00">';
	else 
	$link_p .= '<tr>
		<td width="100%" align=\"left\">';
	$link_p.='<table><tr><td width="95%">
<b><font face="verdana" color="navy">
<a href="'.$arr["url"][$i].'" target="_blank">'.$arr["titolo"][$i].'</a></font></b>
        	<br>
        	<b> '.LINGUA.': </b>';

$lingue_div = explode(" ",$arr["multilangue"][$i]);
for ($j=0;$j<count($lingue_div);$j++)
  {
   $templing.='<img src="../flags/'.$lingue_div[$j].'.png" height=13>';
 }
  $link_p.=$templing.'<br>'.$arr["descrizione"][$i].'
			   	<td bgcolor="#96ea8c">
	<a href="attiva.php?pagename='.$pagename.'&idlink='.$arr["id_links"][$i].'&active=1&id='.$id.'"><b> A </b></a></td>
	<td bgcolor="#96ea8c">
	<a href="attiva.php?pagename='.$pagename.'&idlink='.$arr["id_links"][$i].'&active=0&id='.$id.'"><b> D </b></a></td>
	<td bgcolor="#96ea8c">
	<a href="modifica.php?pagename='.$pagename.'&idlink='.$arr["id_links"][$i].'&id='.$id.'"><b> M </b></a></td>
	<td bgcolor="#96ea8c">
	<a href="elimina1.php?pagename='.$pagename.'&idlink='.$arr["id_links"][$i].'&id='.$id.'"><b> E </b></a></td>
	</tr></table>

			   </td></tr>';
	$templing="";

   }
	return $link_p;
}



?>

