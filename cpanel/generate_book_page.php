<?php

include("books.inc.php");
include("c_links.php");
include('simple_html_dom.php');

if(!is_numeric($_GET['id'])) 
{ echo "Error not valid ID"; die; }
else
{ $id=$_GET['id']; }

$links = new c_links("en","books");
$arr=$links->GetALink($id);
$catname=$links->GetNameMore($arr["id_categoria"]);


$html = file_get_html("../book_template.html");

$html->find('title',0)->innertext  = 'Freescience.info: '.$arr["titolo"];
$html->find('h2[class=title_php]',0)->innertext  = $arr["titolo"];
$html->find('span[class=lang_php]',0)->innertext = $arr["langue"];
$html->find('span[class=format_php]',0)->innertext = $arr["formato"];
if($arr["pagine"]!=0) $html->find('span[class=pages_php]',0)->innertext = $arr["pagine"];
if($arr["year"]!=0)  $html->find('span[class=year_php]',0)->innertext = $arr["year"];
$html->find('span[class=link_php]',0)->innertext = '<a href="'.$arr["url"].'">'.$arr["url"].'</a>';

if($arr["linkautore"]!="") 
{
    $html->find('span[class=author_php]',0)->innertext = '<a href="'.$arr["linkautore"].'">'.$arr["autore"].'</a>';
}
else
{
    $html->find('span[class=author_php]',0)->innertext = $arr["autore"];
}
$book_name=str_replace(' ', '_',trim($arr["titolo"]));
$fp = fopen('../books/'.$book_name."_".$arr["id_links"].".html", 'w');
fwrite($fp,$html);
fclose($fp);
print($html)
?>
