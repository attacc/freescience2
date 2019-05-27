<?

global $cc_mysql;

if (!isset($cc_mysql))
{
 $cc_mysql = 1;

 class c_mysql {

 	var $username;
	var $password;
	var $hostname;
	var $dbname;
	var $link;
	var $result;
	var $dati;

Function ConnectSQLDefault()
{
	$this->link=mysql_connect (
		$this->hostname,$this->username,
		$this->password)
	or die ("non posso connetermi ".mysql_error());
}

Function ConnectSQL()
{
 if(!isset($this->dati["hostname"]))
  $this->Set_Hostname("localhost");

  if(!isset($this->dati["user"]))
    $this->Set_Username("root");
//  $this->Set_Username("science");

 if(!isset($this->dati["password"]))
  $this->Set_Password("cokolad71!");

 $this->link = mysql_connect("localhost","science","cokolad71!")
// $this->link = mysql_connect("localhost","root","ab28gfk67!")
 or die ("non posso connettermi".mysql_error());
 }

Function Set_Username($user)
{
 $this->username = $user;
 $this->dati["username"] = 1;
}

Function Set_Hostname($host)
{
 $this->hostname = $host;
 $this->dati["hostname"] = 1;
}

Function Set_Password($pass)
{
 $this->Password = $pass;
 $this->dati["password"] = 1;
}

Function Set_DB($name_db)
{
 $this->dbname = $name_db;
 $this->dati["dbname"]= 1;
 mysql_select_db($name_db, $this->link);
 mysql_error();
}

Function ConnectSQL_db($dbname)
{
 $link = mysql_connect(
 	$this->hostname,$this->username,
	$this->password)
	or die ("non posso connettermi ".mysql_error());
 $this->Set_DB($dbname);
}

Function Exec_Query($query)
{
  if(!isset($this->dati["dbname"]))
  {
    //echo " Sono entrato nel ciclio brutto <br> ";
  	$this->dbname=1;
	$this->Set_DB($dbname);
  }
//  echo " Query: ".$query."<br>";
 $this->result = mysql_query($query);
 if($this->result == false)
  {
  print("Errore nell'esecuzione dell
   query: ".mysql_error()."<br>");
  exit();
  }
}

Function ReturnResult($num,$campo)
{
  $result = mysql_result(
	  $this->result,$num,$campo);
  return($result);
}

Function ReturnNum()
{
 @$num = mysql_num_rows($this->result);
 return($num);
}

Function DisconnectSQL ()
{
@mysql_close($this->link);
}

Function ReturnLastID()
{
$id = mysql_insert_id($this->link);
}

Function ReturnNextRow()
{
return mysql_fetch_row($this->result);
}

Function ReturnNextObject()
{
return mysql_fetch_object($this->result);
}

} //fine classe
} //fine if

?>
