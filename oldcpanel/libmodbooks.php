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
$link_p="";
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
	<b> '.PAGINE.':</b>
        '.$arr["pagine"][$i].'
	<b> '.CLICK.':</b>
        '.$arr["click"][$i].'
	<br>
	'.$arr["it"][$i].'<br>
	<font color=red>'.$arr["en"][$i].'</font>
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
?>

