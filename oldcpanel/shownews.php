<?
include "newscat.php";

function ShowNews($arr,$topics)
{
	global $langdat;
	for($i=0;$i<count($arr["id"]);$i++)
	{
$news.='
<tr>
<td colspan="2">&nbsp;</td>
</tr>
<tr>
<td class="height" colspan="2"></td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
</tr> 
<tr>
<td>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td>
<a href="'.$arr["link"][$i].'" class=linktesto2>&nbsp;&nbsp;'.$arr["titolo"][$i].'</a> </td>
</tr><tr>
   <td>
   <font color="#000000" size="1">Posted on '.$arr["data"][$i].'</font>
   <font color="#000000" size="1">('.SEND.' <a href="send.php?id='.$arr["id"][$i].'"><img src="images/friend.gif" border="0" alt="'.SEND.'" title="'.SEND.'" width="16" height="11"></a> )</font>
    </td></tr>
<tr>
 <td>
<table border="0" cellpadding="3" cellspacing="0" width="100%">
 <tr valign="top"><td>';
 
if($arr["image"][$i]=="")
$news.='
 <a href="news.php?topic='.$arr["tipo"][$i].'">
 <img src="images/topics/'.$topics["image"][$arr["tipo"][$i]].'" border="0" Alt="'.$topics[$langdat][$arr["tipo"][$i]].'" align="right" height="62">
 </a>';
else
$news.='
<img src="copertine/'.$arr["image"][$i].'" border="0" Alt="'.$arr["titolo"][$i].'" align="right" height="62">';
$news.='</td>
 <td width="80%" class=testo>'.$arr["testo"][$i].'</td><td>
</tr></table>
</td>
</tr></table>
</td></tr>

';
}
return $news;
}
