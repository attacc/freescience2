<?
  session_start();
  include "./config.php";
  include "valoricampi.php";
  if(!isset($language))
  $language="en";
  include(pathlang.$language.".php");
  include "books.inc.php";
  include "c_mysql.php";  
  include "c_links.php";
  include "newscat.php";

  $today=mktime(0,0,0,date('m'),date('j'),date('Y'));
  
  $pagename="tmpbooks";
  $dbmstmp = new c_mysql;
  $dbmstmp->ConnectSQL();
  $dbmstmp->Set_DB("freescience_info_1");
  $query="SELECT id_links FROM tmpbooks ORDER BY id_links LIMIT 1";
  $dbmstmp->Exec_Query($query);
  $n=$dbmstmp->ReturnNum();
  if($n!=0) 
  {
    $id_tmp  =$dbmstmp->ReturnResult(0,"id_links");   
    $links_tmp=new c_links($language,"tmpbooks");
    $arr     =$links_tmp->GetALink($id_tmp);

    unset($arr['id_links']);
    unset($arr['data']);
    
    $arr['active']=1;
    $arr['data']=date('y-m-j');
    $arr['it']=htmlspecialchars($arr['it']);
    $arr['en']=htmlspecialchars($arr['en']);

    for($j=1;$j<count($campi);$j++) $insut[$j]=$arr[$campi[$j]];
    $links = new c_links($language,"books");
    $links->NewLink($insut);
    
    // Delete from tmp

    $query="DELETE FROM tmpbooks WHERE id_links = '".$id_tmp."' LIMIT 1 ";
    $dbmstmp->Exec_Query($query);

   // Add news

    $newslang=0;
    $descrizione=$arr["en"];
    if($arr["langue"]=="it") 
    {
      $newslang=1;
      $descrizione=$arr["it"];
    }
    $linknews="http://freescience.info/go.php?pagename=books&id=".$links->GetLastLink();
    $query="insert into news (data,lingua,titolo,testo,tipo,link,active,image) VALUES ('".$arr["data"]."','$newslang','".$arr["titolo"]."','".$descrizione."','".$tiponews["books"]."','".$linknews."','1','".$arr["img"]."')";
   // echo $query;
    mysql_query($query);
    //
    echo "<h2> Book :<font color=blue>\"".$arr['titolo']."\"</font> moved in NEWS </h2><br>";
    //
  }
  else
  { echo "<font color=red><h1> BOOKS CACHE EMPTY !!!!!! </font></h1>"; }

   $links =  NULL;
   $dbmstmp= NULL;

?>
