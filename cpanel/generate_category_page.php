<?php

include("books.inc.php");
include("c_links.php");
include('simple_html_dom.php');


if(!isset($_GET['id'])) { echo "Error not valid ID"; die; }


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
$html->find('span[class=link_php]',0)->innertext = '<a href="'.$arr["url"].'">'.$arr["url"].'</a>';
if($arr["img"]=="") {
  $image_html='<a href="'.$arr["url"].'"><image src="../images/small_logo.png"></a>';
}
else
{
  if(file_exists('../copertine/'.$arr["img"])) {
     $image_html='<a href="'.$arr["url"].'"><image src="../copertine/'.$arr["img"].'"></a>';
  }
  else
  {
   $image_html='<a href="'.$arr["url"].'"><image src="../images/small_logo.png"></a>';
  }
}
$html->find('span[class=image_php]',0)->innertext = $image_html;


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
$html->find('p[class=description]',0)->innertext = $arr["en"];



# RELATED BOOKS
#
$arr2=$links->GetActive($getcampi,$arr['id_categoria'],'id_links');
$related="";
for($i=0;$i<count($arr2['id_links']);$i++)
{
    if($arr2['id_links'][$i]!=$arr['id_links'])
    {
        $book_name=str_replace(' ', '_',trim($arr2["titolo"][$i]));
        $book_link=$book_name."_".$arr2["id_links"][$i].".html";
        $related.='<li><a href="'.$book_link.'">'.$arr2['titolo'][$i].'</a></li>';
    }
}
$html->find('span[class=related_php]',0)->innertext = $related;



# WRITE PAGE ON DISK

$book_name=str_replace(' ', '_',trim($arr["titolo"]));
$fp = fopen('../books/'.$book_name."_".$arr["id_links"].".html", 'w');
fwrite($fp,$html);
fclose($fp);
print($html)
?>
