<?
session_start();
include "./c_mysql.php";
include "./news.inc.php";

$dbms = new c_mysql;
$dbms->ConnectSQL();
$dbms->Set_DB("freescience");

$query="insert into topics (it,en,image) VALUES ('$it','$en','".$image."')";
$dbms->Exec_Query($query);
header("location:topics.php");
?>

