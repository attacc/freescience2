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
if($arr == -1)
{
    echo " Book not found!! ";
    die;
}
$catname=$links->GetName($arr["id_categoria"]);
if($arr["cat2"]!=0) $catname2=$links->GetName($arr["cat2"]);

$html = file_get_html_rn("../templates/book_template.html");

$html->find('title',0)->innertext  = 'Freescience.info: '.$arr["titolo"];
$html->find('h2[class=title_php]',0)->innertext  = $arr["titolo"];
$html->find('span[class=lang_php]',0)->innertext = $arr["langue"];
$html->find('span[class=format_php]',0)->innertext = strtolower($arr["formato"]);
if($arr["pagine"]!=0) $html->find('span[class=pages_php]',0)->innertext = $arr["pagine"];
if($arr["year"]!=0)  $html->find('span[class=year_php]',0)->innertext = $arr["year"];
$html->find('span[class=link_php]',0)->innertext = 'Category: <a href="'.$arr["url"].'">'.$arr["url"].'</a>';


$cat_page=str_replace(' ', '_',trim($catname));
$cat_page="../categories/".$cat_page.'_'.$arr["id_categoria"].".html";
$html->find('span[class=cat1_php]',0)->innertext = '<a href="'.$cat_page.'">'.$catname.'</a>';
if($arr["cat2"]!=0) {
$cat_page2=str_replace(' ', '_',trim($catname2));
$cat_page2="../categories/".$cat_page2.'_'.$arr["cat2"].".html";
$html->find('span[class=cat2_php]',0)->innertext = '<a href="'.$cat_page2.'">'.$catname2.'</a>';
}


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
