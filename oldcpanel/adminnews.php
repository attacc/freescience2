<?
include "../newscat.php";

function AdminNews($arr,$topics,$lang)
{
	global $newsnames;
	for($i=0;$i<count($arr["id"]);$i++)
	{
$news.='
<tr>
<td>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
 <tr>
 <td ><a href="'.$arr["link"][$i].'"><font class="boxtitle2" color="#363636"><b>'.$arr["titolo"][$i].'</b></font></a>
 </td></tr><tr>
   <td > <font color="#999999" size="1">'.$arr["data"][$i].'</font> </td></tr><tr>
<td>

 <font class="content" color="#505050">'.$arr["testo"][$i].'</font>
</td>
</tr></table>
<td align=center><b><a href="delgeneric.php?id='.$arr["id"][$i].'&namedb=news"> D</a></b></td>
<td align=center width="10%"><img src="../images/topics/'.$topics["image"][$arr["tipo"][$i]].'"></td>';

if($arr["lingua"][$i]==0) $news.='<td align=center width="10%"><img src="../flags/en.png" border=0></td>';
else $news.='<td align=center width="10%"><img src="../flags/it.png" border=0></td>';


if($arr["active"][$i]==0) $news.="<td align=center  bgcolor=\"#ffcc00\" >
<b><a href=\"activegeneric.php?namedb=news&active=1&id=".$arr["id"][$i]."\"> A</a> </b></td>";
else  $news.="<td align=center><b><a href=\"activegeneric.php?namedb=news&active=0&id=".$arr["id"][$i]."\">  A </a></b></td>";

$news.='</td></tr>';
}
return $news;
}
