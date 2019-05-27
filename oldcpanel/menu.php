<?
$siteurl="../index.php";
$listtitle="FreeScience.info";
include "./databases.php";
$conta=count($db["pagename"]);
for($i=0;$i<$conta;$i++)
{
$list["nome"][$i]=$db["nome"][$i];
$list["link"][$i]="gestione.php?pagename=".$db["pagename"][$i];
}
$list["nome"][$conta]="Segnalationi";
$list["link"][$conta]="index.php?contents=contact.php";
$list["nome"][$conta+1]="Statistics";
$list["link"][$conta+1]="../mybbclone/counter_process.php";
$list["nome"][$conta+2]="Update";
$list["link"][$conta+2]="update.php";
$list["nome"][$conta+3]="Topics";
$list["link"][$conta+3]="topics.php";
$list["nome"][$conta+4]="News";
$list["link"][$conta+4]="news.php";
$list["nome"][$conta+5]="Utenti";
$list["link"][$conta+5]="users.php";
$list["nome"][$conta+6]="NewsLetter";
$list["link"][$conta+6]="newsletter.php";
$list["nome"][$conta+7]="NewsLetter-en";
$list["link"][$conta+7]="newsletteren.php";
$list["nome"][$conta+8]="Segnalati";
$list["link"][$conta+8]="segnalati.php";
$list["nome"][$conta+9]="Articoli";
$list["link"][$conta+9]="inspaper.php";



$mpage='
 <style fprolloverstyle>A:hover {color: red;}
</style>
<STYLE type=text/css>A {
        TEXT-DECORATION: none
}
</STYLE>
<script src="menu.js" type="text/javascript" language="javascript"></script>

<table border=2 cellspacing=2 width="99%" text="#000000" link="#00008B" vlink="#9900CC" alink="#CC0000" bgcolor="#0666ff"  bordercolor="#0000FF">
<td align="center" valign="middle" bgcolor="navy" ><font size="2" face="Copperplate Gothic Bold" color="white">
<b>'.$listtitle.'</b></td></tr> ';

$tmp="";

for($i=0;$i<count($list["nome"]);$i++)
{
$tmp.='<tr  onmouseover="setPointer(this, \'0666ff\')" onmouseout="setPointer(this, \'white\')" align=LEFT valign=CENTER> 
    <td align="center" valign="middle" bgcolor="white" ><font size="2" face="Copperplate Gothic Bold" color="#FFFFFF">
<b><a href="'.$list["link"][$i].'">
    '.$list["nome"][$i].'</a></b></td></tr> ';
}

$mpage.=$tmp;
$mpage.='</table>';
$menu=$mpage;
?>
