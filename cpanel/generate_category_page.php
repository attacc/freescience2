<?php

include("books.inc.php");
include("c_links.php");
include('simple_html_dom.php');


if(!isset($_GET['id_cat'])) { echo "Error not valid ID_CAT"; die; }


if(!is_numeric($_GET['id_cat'])) 
{ echo "Error not valid ID_CAT"; die; }
else
{ $id_cat=$_GET['id_cat']; }


$html = file_get_html_rn("../templates/category_template.html");

# WRITE PAGE ON DISK

#$cat_name=str_replace(' ', '_',trim($arr["titolo"]));
$cat_name="category";
$fp = fopen('../books/'.$cat_name."_".$arr["id_links"].".html", 'w');
fwrite($fp,$html);
fclose($fp);
print($html)
?>
