<?
include "../newscat.php";

function AdminUsers($arr)
{
	for($i=0;$i<count($arr["id"]);$i++)
	{
$news.='
<tr align=center>
<td>'.($i+1).'</td>
<td>'.$arr["nome"][$i].'</td>
<td><a href="mailto:'.$arr["email"][$i].'">'.$arr["email"][$i].'</a></td>
<td> '.$arr["password"][$i].' </td>';

if($arr["tipo"][$i]==1) $news.='<td align=center width="10%">Text</td>';
else $news.='<td align=center width="10%">Html</td>';

if($arr["lingua"][$i]==0) $news.='<td align=center width="10%"><img src="../flags/en.png" border=0></td>';
else $news.='<td align=center width="10%"><img src="../flags/it.png" border=0></td>';


if($arr["active"][$i]==0) $news.="<td align=center  bgcolor=\"#ffcc00\" width=\"10%\">
<b><a href=\"activegeneric.php?namedb=newsletter_users&active=1&id=".$arr["id"][$i]."\"> A</a> </b></td>";
else  $news.="<td align=center><b><a href=\"activegeneric.php?namedb=newsletter_users&active=0&id=".$arr["id"][$i]."\">  A </a></b></td>";

$news.='</td>
<td align=center width=\"10%\"><b><a href="delgeneric.php?id='.$arr["id"][$i].'&namedb=newsletter_users"> D</a></b></td> </tr>';
}
return $news;
}
