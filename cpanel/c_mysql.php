<?php

global $cc_mysql;

function mysqli_result($result,$row,$field=0) {
    if ($result===false) return false;
    if ($row>=mysqli_num_rows($result)) return false;
    if (is_string($field) && !(strpos($field,".")===false)) {
        $t_field=explode(".",$field);
        $field=-1;
        $t_fields=mysqli_fetch_fields($result);
        for ($id=0;$id<mysqli_num_fields($result);$id++) {
            if ($t_fields[$id]->table==$t_field[0] && $t_fields[$id]->name==$t_field[1]) {
                $field=$id;
                break;
            }
        }
        if ($field==-1) return false;
    }
    mysqli_data_seek($result,$row);
    $line=mysqli_fetch_array($result);
    return isset($line[$field])?$line[$field]:false;
}



if (!isset($cc_mysql))
{
 $cc_mysql = 1;

 class c_mysql {

	var $dbname;
	var $link;
	var $result;

Function ConnectSQL()
{
 $this->link = mysqli_connect("localhost","attacc","ab28gfk67")
 or die ("non posso connettermi".mysqli_error());
 }

Function Set_DB($name_db)
{
 $this->dbname = $name_db;
 mysqli_select_db($this->link, $name_db);
 mysqli_error($this->link);
}

Function Exec_Query($query)
{
 $this->result = mysqli_query($this->link,$query);
 if($this->result == false)
  {
  print("Errore nell'esecuzione dell query: <br><b>".mysqli_error($this->link)."</b>");
  exit();
  }
}

Function ReturnResult($num,$campo)
{
  $result = mysqli_result($this->result,$num,$campo);
  return($result);
}

Function ReturnNum()
{
 @$num = mysqli_num_rows($this->result);
 return($num);
}

Function DisconnectSQL ()
{
@mysqli_close($this->link);
}

Function ReturnLastID()
{
$id = mysqli_insert_id($this->link);
}

Function ReturnNextRow()
{
return mysqli_fetch_row($this->result);
}

Function ReturnNextObject()
{
return mysqli_fetch_object($this->result);
}

} //fine classe
} //fine if

?>
