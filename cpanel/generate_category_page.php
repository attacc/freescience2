<?php

include("books.inc.php");
include("c_links.php");
include('simple_html_dom.php');
include('show_categories.php');

if(!isset($_GET['id_cat'])) { echo "Error not valid ID_CAT"; die; }


if(!is_numeric($_GET['id_cat'])) 
{ echo "Error not valid ID_CAT"; die; }
else
{ $id_cat=$_GET['id_cat']; }


$html = file_get_html_rn("../templates/category_template.html");



$links = new c_links("en","books");
$cat_father=$links->GetParent($id_cat);

$cat_name="category";
$cat_name= $links->GetName($id_cat);

$cat_list = $links->GetSubCatShort($id_cat);

$text="";
#$text=show_cat($cat_list);

$html->find('title',0)->innertext  = 'Freescience.info: '.$cat_name;
$html->find('div[class=cat_title]',0)->innertext  = $cat_name;
$html->find('span[class=categories_php]',0)->innertext  = $text;


# WRITE PAGE ON DISK

$fp = fopen('../categories/'.$cat_name."_".$id_cat.".html", 'w');
fwrite($fp,$html);
fclose($fp);
print($html)
?>
