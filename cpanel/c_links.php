<?php

if(!isset($path))
	$path="./";


include $path."c_mysql.php";
$dbname="freescience_info_1";

class c_links {
	var $dbms;

Function c_links($lingua,$tablename)
 {
   global $dbname,$campi;
   $this->campi=$campi;
   $this->lingua=$lingua;
   $this->cattable="cat".$tablename;
   $this->tablename=$tablename;
   $this->numcampi=count($campi);
   $this->dbms= new c_mysql;
   $this->dbms->ConnectSQL();
   $this->dbms->Set_DB($dbname);
   $this->lingua=$lingua;
   $this->active=1;
 }

Function CheckExist($getcampi,$valori) 
{
//if(trim($nome=="" || trim($id_padre) == "" || !is_integer($id_padre)))
//	return -2;

$query = "SELECT id ";//.$getcampi[0];
$tempq.=$getcampi[0]." = '".urlencode(trim($valori[0]))."'";
   for($i=1;$i<count($getcampi);$i++)
	{
	$query.=",".$getcampi[$i];
	$tempq.=" AND ".$getcampi[$i]." = '".urlencode(trim($valori[$i]))."'";
	}
	
  $query.= " FROM ".$this->tablename." WHERE ".$tempq;
  $this->dbms->Exec_Query($query);
  if ($this->dbms->ReturnNum()==0) { return -2; } 
   else 
  return ($this->dbms->ReturnResult(0,0)); 
}

Function  GetSubCatShort($id_padre=-1)
 {
 $query="select id_categoria,en,it,father from ".$this->cattable."
	where id_padre = ".$id_padre." order by ".$this->lingua;
 $this->dbms->Exec_Query($query);
 # echo "query <br>".$query."<br>";
 $n = $this->dbms->ReturnNum();
// echo "Ci sono $n righe ";
if ($n == 0)
{
 return -1;
}

for($i = 0;$i<$n;$i++)
{
 $arr["id"][] = $this->dbms->ReturnResult($i,"id_categoria");
 $arr["nome"][] = urldecode($this->dbms->ReturnResult($i,$this->lingua));
 $arr["it"][] = urldecode($this->dbms->ReturnResult($i,"it"));
 $arr["en"][] = urldecode($this->dbms->ReturnResult($i,"en"));
 $arr["father"][] = urldecode($this->dbms->ReturnResult($i,"father"));
 }

//if($this->lingua=="en") $noit=" AND langue!='it'";
//else $noit=""; 
$noit="";
for($i = 0;$i<$n;$i++)
{

 $query="SELECT COUNT(*) FROM ".$this->cattable."
	where id_padre = ".$arr["id"][$i];
 $this->dbms->Exec_Query($query);
  $arr["figli"][] = $this->dbms->ReturnResult(0,0);
}

return $arr;
}//Fine f

Function  GetSubCatL($id_padre=-1)
 {
 $query="select id_categoria,".$this->lingua." from ".$this->cattable."
	where id_padre = ".$id_padre." order by ".$this->lingua;
 $this->dbms->Exec_Query($query);
 $n = $this->dbms->ReturnNum();
// echo "Ci sono $n righe ";
if ($n == 0)
{
 return -1;
}

for($i = 0;$i<$n;$i++)
{
 $arr["id"][] = $this->dbms->ReturnResult($i,"id_categoria");
 $arr["nome"][] = urldecode($this->dbms->ReturnResult($i,$this->lingua));
 }

//if($this->lingua=="en") $noit=" AND langue!='it'";
//else $noit=""; 
$noit="";
for($i = 0;$i<$n;$i++)
{

 $query="SELECT COUNT(*) FROM ".$this->cattable."
	where id_padre = ".$arr["id"][$i];
 $this->dbms->Exec_Query($query);
  $arr["figli"][] = $this->dbms->ReturnResult(0,0);
 
 $query="SELECT COUNT(*) FROM ".$this->tablename."
	where (id_categoria = ".$arr["id"][$i]." OR cat2 = ".$arr["id"][$i].") AND active=1 ".$noit;
 $this->dbms->Exec_Query($query);
  $arr["links"][] = $this->dbms->ReturnResult(0,0);
}

return $arr;
}//Fine funzione



Function  GetSubCat($id_padre=-1)
 {
 $query="select id_categoria,".$this->lingua." from ".$this->cattable."
	where id_padre = ".$id_padre." order by ".$this->lingua;
 $this->dbms->Exec_Query($query);
 $n = $this->dbms->ReturnNum();
// echo "Ci sono $n righe ";
if ($n == 0)
{
 return -1;
}

for($i = 0;$i<$n;$i++)
{
 $arr["id"][] = $this->dbms->ReturnResult($i,"id_categoria");
 $arr["nome"][] = urldecode($this->dbms->ReturnResult($i,$this->lingua));
 }

for($i = 0;$i<$n;$i++)
{

 $query="SELECT COUNT(*) FROM ".$this->cattable."
	where id_padre = ".$arr["id"][$i];
 $this->dbms->Exec_Query($query);
  $arr["figli"][] = $this->dbms->ReturnResult(0,0);
 
 $query="SELECT COUNT(*) FROM ".$this->tablename."
	where (id_categoria = ".$arr["id"][$i]." OR cat2 = ".$arr["id"][$i].") AND active=1";
 $this->dbms->Exec_Query($query);
  $arr["links"][] = $this->dbms->ReturnResult(0,0);
}

return $arr;
}//Fine funzione

Function InsertNewSubCat($en,$it,$codpadre)
{
 $query = "
  	insert into ".$this->cattable."(en, it ,id_padre)
			values('".$en."','".$it."',$codpadre)";

// echo $query;
 $this->dbms->Exec_Query($query);
 return true;
}

Function  GetSubCat2($id_padre=-1)
 {
 $query="select id_categoria,it,en from ".$this->cattable."
	where id_padre = ".$id_padre." order by ".$this->lingua;
 $this->dbms->Exec_Query($query);
 $n = $this->dbms->ReturnNum();
// echo "Ci sono $n righe ";
if ($n == 0)
{
 return -1;
}

for($i = 0;$i<$n;$i++)
{
 $arr["id"][] = $this->dbms->ReturnResult($i,"id_categoria");
 $arr["it"][] = urldecode($this->dbms->ReturnResult($i,'it'));
 $arr["en"][] = urldecode($this->dbms->ReturnResult($i,'en'));
 }

for($i = 0;$i<$n;$i++)
{

 $query="SELECT COUNT(*) FROM ".$this->cattable."
	where id_padre = ".$arr["id"][$i];
 $this->dbms->Exec_Query($query);
  $arr["figli"][] = $this->dbms->ReturnResult(0,0);
 
 $query="SELECT COUNT(*) FROM ".$this->tablename."
	where (id_categoria = ".$arr["id"][$i]." OR cat2 = ".$arr["id"][$i].") AND active=1";
 $this->dbms->Exec_Query($query);
  $arr["links"][] = $this->dbms->ReturnResult(0,0);
}

return $arr;
}//Fine funzione


Function GetIdCategoria($nome,$id_padre) {


//if(trim($nome=="" || trim($id_padre) == "" || !is_integer($id_padre)))
//	return -2;

$query = " select id_categoria from ".$this->cattable." where en = '".urlencode(trim($nome))."' and id_padre = $id_padre";
//echo $query."<br>";
$this->dbms->Exec_Query($query);
if ($this->dbms->ReturnNum()==0) { return -2; } 
else return ($this->dbms->ReturnResult(0,0));
}

Function int_All(&$arr1,$id)
{
 $query= "select id_padre,it from ".$this->cattable." where id_categoria='$id'";
//  echo  $query.'<br>'; 
 $this->dbms->Exec_Query($query);
 $padre=$this->dbms->ReturnResult(0,"id_padre");
 if($padre==1)
 { $arr1=$id;  return; }
 else
 $this->int_All($arr1,$padre);
 }

Function check_father($id,&$counter)
{
 $query= "select id_padre,it from ".$this->cattable." where id_categoria='$id'";
 $this->dbms->Exec_Query($query);
 $padre=$this->dbms->ReturnResult(0,"id_padre");
 $counter[$id]++;
 if($padre==-1) return; 
 else $this->check_father($padre,$counter);
}
 
Function GetName($id)
{
  $query="select ".$this->lingua." from ".$this->cattable." where
  		id_categoria = $id";
  $this->dbms->Exec_Query($query);
  $n=$this->dbms->ReturnNum();
	//echo " numero di ".$this->cattable." $n";
  //Controllo presenza link

  if($n==0) {
  	return -1;
	}
	 return urldecode($this->dbms->ReturnResult(0,$this->lingua));
  }

Function GetNameMore($id)
{
  $query="select ".$this->lingua.",father,related1,related2,related3 from ".$this->cattable." where
  		id_categoria = $id";
  $this->dbms->Exec_Query($query);
  $n=$this->dbms->ReturnNum();
	//echo " numero di ".$this->cattable." $n";
  //Controllo presenza link

  if($n==0) {
  	return -1;
	}
  $arr[]= urldecode($this->dbms->ReturnResult(0,$this->lingua));
  $arr[]= $this->dbms->ReturnResult(0,"related1");
  $arr[]= $this->dbms->ReturnResult(0,"related2");
  $arr[]= $this->dbms->ReturnResult(0,"related3");
  $arr[]= $this->dbms->ReturnResult(0,"father");
	 return $arr; 
  }


Function GetAllLinks($getcampi,$id,$order="id")
{
  $query="SELECT ".$getcampi[0];
  	for($i=1;$i<count($getcampi);$i++)
	$query.=",".$getcampi[$i];
  $query.= " FROM ".$this->tablename." 	WHERE  id_categoria = ".$id." ORDER by ".$order;
  $this->dbms->Exec_Query($query);
  $n=$this->dbms->ReturnNum();
  if($n == 0)
  {
    return -1;
  }
  
  for($i=0;$i<$n;$i++)
   for($j=0;$j<count($getcampi);$j++)
   	$arr[$getcampi[$j]][]=urldecode($this->dbms->ReturnResult($i,$getcampi[$j]));

  return $arr;

}

Function GetLimitNoL($getcampi,$order="id_links",$limit,$lang="null",$father=0)
{
 $lingua="";
 if($father!=0) $fcond= " AND (father1 = ".$father." OR father2 = ".$father.")";
 else $fcond="";
 if($lang!="null")
 	$lingua=" AND langue!='".$lang."'";
  $query="SELECT ".$getcampi[0];
  	for($i=1;$i<count($getcampi);$i++)
	$query.=",".$getcampi[$i];
	if($limit>0)  $query.= " FROM ".$this->tablename." WHERE ( active=1 ".$lingua."  ".$fcond.")  ORDER by ".$order." DESC LIMIT ".$limit;
	else $query.= " FROM ".$this->tablename." WHERE ( active=1 ".$lingua."  ".$fcond.")  ORDER by ".$order." DESC ";
  //echo $query;
  $this->dbms->Exec_Query($query);
  $n=$this->dbms->ReturnNum();
  if($n == 0)
  { return -1; }
  
  for($i=0;$i<$n;$i++)
   for($j=0;$j<count($getcampi);$j++)
   	$arr[$getcampi[$j]][]=urldecode($this->dbms->ReturnResult($i,$getcampi[$j]));

  for($i=0;$i<$n;$i++)
  {
   $query= "SELECT en FROM ".$this->cattable." WHERE (id_categoria=".$arr["id_categoria"][$i].") LIMIT 1";
   $this->dbms->Exec_Query($query);
   $arr["catname"][$i]=urldecode($this->dbms->ReturnResult(0,"en"));
   };
  return $arr;
}
Function GetLimit($getcampi,$order="id_links",$limit,$lang="null",$father=0)
{
 $lingua="";
 if($father!=0) $fcond= " AND (father1 = ".$father." OR father2 = ".$father.")";
 else $fcond="";
 
 if($lang!="null")
 	$lingua=" AND langue='".$lang."'";
  $query="SELECT ".$getcampi[0];
  	for($i=1;$i<count($getcampi);$i++)
	$query.=",".$getcampi[$i];

	
	if($limit>0)  $query.= " FROM ".$this->tablename." WHERE ( active=1 ".$lingua."  ".$fcond.")  ORDER by ".$order." DESC LIMIT ".$limit;
	else $query.= " FROM ".$this->tablename." WHERE ( active=1 ".$lingua." ".$fcond.")  ORDER by ".$order." DESC ";
 //echo $query;
  $this->dbms->Exec_Query($query);
  $n=$this->dbms->ReturnNum();
  if($n == 0)
  { return -1; }
  
  for($i=0;$i<$n;$i++)
  {
   for($j=0;$j<count($getcampi);$j++)
   	$arr[$getcampi[$j]][$i]=urldecode($this->dbms->ReturnResult($i,$getcampi[$j]));
   };
  for($i=0;$i<$n;$i++)
  {
   $query= "SELECT ".$this->lingua." FROM ".$this->cattable." WHERE (id_categoria=".$arr["id_categoria"][$i].") LIMIT 1";
   $this->dbms->Exec_Query($query);
   $arr["catname"][$i]=urldecode($this->dbms->ReturnResult(0,$this->lingua));
   };

  return $arr;
}


Function GetClicked($getcampi,$lang,$limit,$order,$father="0")
{
 if($father!=0) $fcond= " AND (father1 = ".$father." OR father2 = ".$father.")";
 else $fcond="";

  $query="SELECT ".$getcampi[0];
  	for($i=1;$i<count($getcampi);$i++)
	$query.=",".$getcampi[$i];
  if($lang=="it")
  $query.= " FROM ".$this->tablename." WHERE (active='1' and langue='it' ".$fcond.") ORDER by click ".$order." LIMIT ".$limit;
  else
  $query.= " FROM ".$this->tablename." WHERE (active='1' and langue!='it' ".$fcond.") ORDER by click ".$order." LIMIT ".$limit;
 // echo $query;
  $this->dbms->Exec_Query($query);
  $n=$this->dbms->ReturnNum();
  if($n == 0)
  {
    return -1;
  }
  
  for($i=0;$i<$n;$i++)
   for($j=0;$j<count($getcampi);$j++)
   	$arr[$getcampi[$j]][]=urldecode($this->dbms->ReturnResult($i,$getcampi[$j]));

  for($i=0;$i<$n;$i++)
  {
   $query= "SELECT en FROM ".$this->cattable." WHERE (id_categoria=".$arr["id_categoria"][$i].") LIMIT 1";
   $this->dbms->Exec_Query($query);
   $arr["catname"][$i]=urldecode($this->dbms->ReturnResult(0,"en"));
   };
  return $arr;

}

Function GetLimitEn($getcampi,$order="id_links",$limit,$father="0")
{
  $query="SELECT ".$getcampi[0];
  	for($i=1;$i<count($getcampi);$i++)
	$query.=",".$getcampi[$i];
  if($father!=0) 
  {
  $query.= " FROM ".$this->tablename." WHERE (active=1 AND langue !=\"it\") ORDER by ".$order." DESC LIMIT ".$limit;
  }
  {
  $query.= " FROM ".$this->tablename." WHERE (active=1 AND langue !=\"it\" AND (father1 = ".$father." OR father2 = ".$father.")) ORDER by ".$order." DESC LIMIT ".$limit;
  }
 // echo $query;
  $this->dbms->Exec_Query($query);
  $n=$this->dbms->ReturnNum();
  if($n == 0)
  {
    return -1;
  }
  
  for($i=0;$i<$n;$i++)
   for($j=0;$j<count($getcampi);$j++)
   	$arr[$getcampi[$j]][]=urldecode($this->dbms->ReturnResult($i,$getcampi[$j]));

  return $arr;

}


Function GetActive($getcampi,$id,$order="id")
{
 $query="SELECT ".$getcampi[0];
  	for($i=1;$i<count($getcampi);$i++)
	$query.=",".$getcampi[$i];
  $query.= " FROM ".$this->tablename." 	WHERE  (id_categoria = ".$id." OR cat2= ".$id.") AND active=1 ORDER by ".$order;
 //echo $query;
 $this->dbms->Exec_Query($query);
    $n=$this->dbms->ReturnNum();
  
  //echo " Sono presenti ".$n;

  if($n == 0)
  {
    return -1;
  }
  
  for($i=0;$i<$n;$i++)
   for($j=0;$j<count($getcampi);$j++)
    $arr[$getcampi[$j]][]=urldecode($this->dbms->ReturnResult($i,$getcampi[$j]));
  
  return $arr;
}


Function GetActiveL($getcampi,$id,$order="id")
{
 $query="SELECT ".$getcampi[0];
  	for($i=1;$i<count($getcampi);$i++)
	$query.=",".$getcampi[$i];
  if($this->lingua=="it")
  $query.= " FROM ".$this->tablename." 	WHERE  (id_categoria = ".$id." OR cat2= ".$id.") AND active=1 ORDER by ".$order;
  else
  $query.= " FROM ".$this->tablename." 	WHERE  (id_categoria = ".$id." OR cat2= ".$id.") AND active=1 ORDER by pagine DESC";
 $this->dbms->Exec_Query($query);
    $n=$this->dbms->ReturnNum();
  
  //echo " Sono presenti ".$n;

  if($n == 0)
  {
    return -1;
  }
  
  for($i=0;$i<$n;$i++)
   for($j=0;$j<count($getcampi);$j++)
    $arr[$getcampi[$j]][]=urldecode($this->dbms->ReturnResult($i,$getcampi[$j]));
  
  return $arr;
}


Function GetALink($id)
{
  $query="SELECT ";
  for($i=0;$i<($this->numcampi-1);$i++)
    $query.=$this->campi[$i].","; 
  $query.=$this->campi[$this->numcampi-1]." FROM ".$this->tablename." WHERE id_links = ".$id;
  $this->dbms->Exec_Query($query);
  $n=$this->dbms->ReturnNum();
  if($n == 0)
  {
    return -1;
  }

  for($j=0;$j<$this->numcampi;$j++)
  {
      $arr[$this->campi[$j]]=urldecode($this->dbms->ReturnResult(0,$this->campi[$j]));
  }
   
  return $arr;
}

Function SearchAn($getcampi,$fixcampi,$valuefix,$likecampi,$valuelike)
{ 

  $query="SELECT ".$getcampi[0];
  	for($i=1;$i<count($getcampi);$i++)
	$query.=",".$getcampi[$i];
  $query.= " FROM ".$this->tablename;
  $tempq=" WHERE ("; 
	$numfix=count($fixcampi);
if($numfix>0)
{
	$tempq.=$fixcampi[0]." = '".$valuefix[0]."' ";
	for($i=1;$i<$numfix;$i++)
	$tempq.=" AND ".$fixcampi[$i]." = '".$valuefix[$i]."' ";	
}
	$numlike=count($likecampi);
if($numfix>0 && $numlike>0)
	$tempq.=" AND ";
 if($numlike>0)
 {
	$tempq.=$likecampi[0]." LIKE '%".$valuelike[0]."%' ";
	for($i=1;$i<$numlike;$i++)
	$tempq.=" OR ".$likecampi[$i]."  LIKE '%".$valuelike[$i]."%' ";	
 } 
$tempq.= " ) ";
if(($numfix+$numlike)==0)
  $tempq="";
$query.=$tempq;
//	echo $query;
 $this->dbms->Exec_Query($query);
  $n=$this->dbms->ReturnNum();


// Controllo presenza link

  if($n == 0)
  {
    return -1;
  }
//echo $n;
for($i=0;$i<$n;$i++)
   for($j=0;$j<count($getcampi);$j++)
   	$arr[$getcampi[$j]][$i]=urldecode($this->dbms->ReturnResult($i,$getcampi[$j]));
  return $arr;
}


Function GetParent($id)
{
	$query = "select id_padre,".$this->lingua." from ".$this->cattable." where id_categoria = $id";
	$this->dbms->Exec_Query($query);
	$n=$this->dbms->ReturnNum();

	if($n==0) {
		return -1;
		}
	$arr["id"] = $this->dbms->ReturnResult(0,"id_padre");
	$arr["nome"] = $this->dbms->ReturnResult(0,$this->lingua);
	return $arr;
}


Function NewLink($insut)
{
 global $campi;

$query="insert into ".$this->tablename." (";

$a="";
$b="";

for($i=0;$i<($this->numcampi-1);$i++)
{
$a.= $campi[$i].",";
$b.="'".$insut[$i]."',";
}
$a.=$campi[$this->numcampi-1]." ) VALUES (";
$b.="'".urlencode($insut[$this->numcampi-1])."')";

$query.=$a.$b;
//echo $query;
$this->dbms->Exec_Query($query);
 return true;
}

Function ActiveLink($id,$attivazione)
{
  $query="UPDATE  ".$this->tablename." SET active=".$attivazione." WHERE id_links= ".$id." LIMIT 1";
  //echo  $query;
  $this->dbms->Exec_Query($query);
  return true;
}


Function Update($id,$getcampi,$valori)
{
 
 $query = "UPDATE ".$this->tablename." SET ".$getcampi[0]." = '".urlencode(trim($valori[0]))."'";
   for($i=1;$i<count($getcampi);$i++)
	$query.=", ".$getcampi[$i]." = '".urlencode(trim($valori[$i]))."'";
	
 $query.= " WHERE id_links = '".$id."' LIMIT 1" ;
 // echo $query;  
 $this->dbms->Exec_Query($query);
 return true;
}




Function InsRelated($id,$campo,$valore)
{
 
 $query = "UPDATE ".$this->cattable." SET ".$campo." = '".$valore."' WHERE id_categoria = '".$id."' LIMIT 1" ;
 $this->dbms->Exec_Query($query);
 return true;
}




Function Count()
{
  $query="SELECT COUNT(*) FROM ".$this->tablename;
  echo $query;
  $this->dbms->Exec_Query($query);
  $arr=$this->dbms->ReturnResult(0,0);
  return $arr;
}


Function GetNews($cat,$idcat)
{
  for($ii=0;$ii<count($cat[$idcat]);$ii++)
  {
   $id=$cat[$idcat][$ii];
   $query="SELECT ";
   for($i=0;$i<($this->numcampi-1);$i++)
    $query.=$this->campi[$i].","; 
   $query.=$this->campi[$this->numcampi-1]." FROM ".$this->tablename." WHERE id_links = ".$id;
  //echo $query;
  $this->dbms->Exec_Query($query);
  $n=$this->dbms->ReturnNum();
  if($n == 0)
  {
    return -1;
  }

  for($j=0;$j<$this->numcampi;$j++)
   $arr[$this->campi[$j]][$ii]=urldecode($this->dbms->ReturnResult(0,$this->campi[$j]));
   }
  
  for($i=0;$i<count($cat[$idcat]);$i++)
  {
   $query= "SELECT ".$this->lingua." FROM ".$this->cattable." WHERE (id_categoria=".$arr["id_categoria"][$i].") LIMIT 1";
   $this->dbms->Exec_Query($query);
   $arr["catname"][$i]=urldecode($this->dbms->ReturnResult(0,$this->lingua));
   };
  return $arr;
}

Function GetAllCategoria() 
{
$query = " select id_categoria,en from ".$this->cattable;
$this->dbms->Exec_Query($query);
$n=$this->dbms->ReturnNum();
for($i = 0;$i<$n;$i++)
{
 $arr["id_categoria"][] = $this->dbms->ReturnResult($i,"id_categoria");
 $arr["en"][] = urldecode($this->dbms->ReturnResult($i,"en"));
 }
 return $arr;
}

Function UpdateCat($id,$getcampi,$valori)
{
 
 $query = "UPDATE ".$this->cattable." SET ".$getcampi[0]." = '".urlencode(trim($valori[0]))."'";
   for($i=1;$i<count($getcampi);$i++)
	$query.=", ".$getcampi[$i]." = '".urlencode(trim($valori[$i]))."'";
	
 $query.= " WHERE id_categoria = '".$id."' LIMIT 1" ;
 // echo $query;  
 $this->dbms->Exec_Query($query);
 return true;
}


function GetLastLink()
{
  $query="SELECT id_links FROM ".$this->tablename." ORDER by id_links DESC LIMIT 1";
  $this->dbms->Exec_Query($query);
  $n=$this->dbms->ReturnNum();
  if($n == 0)
  {
    return -1;
  }
  else return $this->dbms->ReturnResult(0,"id_links");
}

}
?>
