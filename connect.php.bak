<?php

$host="localhost";
$userDB="root";
$password="12345678";
$dbname="helpdesk";
$dbcon=mysql_connect($host,$userDB,$password);
if(!$dbcon){
  echo "<script>alert('disconnect database !');history.back();</script>";
  exit();
  }

  mysql_select_db($dbname);

  mysql_query("SET NAMES UTF8");

  mysql_query("SET character_set_results=utf8");
  mysql_query("SET character_set_client=utf8");
  mysql_query("SET character_set_connection=utf8");

?>
