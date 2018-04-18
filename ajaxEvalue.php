<?php
include"connect.php";

$id_detail = $_GET['id'];
echo $id_detail;

$sql_detail ="UPDATE detail_repair SET id_status='8' where id_detail=".$id_detail."";
$objQuery_detail = mysql_query($sql_detail);

?>
