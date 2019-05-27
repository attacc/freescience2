<?
function readtopics()
{

$dbms = new c_mysql;
$dbms->ConnectSQL();
$dbms->Set_DB("freescience");

	
$query="select id,it,en,image FROM topics";

$dbms->Exec_Query($query);
$n=$dbms->ReturnNum();

if($n != 0)
  {
    for($i=0;$i<$n;$i++)
        {
	$id=urldecode($dbms->ReturnResult($i,"id"));
         $topics["en"][$id]=urldecode($dbms->ReturnResult($i,"en"));
         $topics["it"][$id]=urldecode($dbms->ReturnResult($i,"it"));
         $topics["image"][$id]=urldecode($dbms->ReturnResult($i,"image"));
//	echo " topic ".$topics["image"][$id]."  ".$id." <br> ";
        }
 }

 return $topics;	
}

?>
