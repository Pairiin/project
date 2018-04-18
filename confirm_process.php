<?php
session_start();

include"connect.php";
include"inc_css.php";

$id_tokens=$_REQUEST['id_tokens'];
$id_detail=$_REQUEST['id_detail'];
$id_repair=$_REQUEST['id_repair'];
$x=$_REQUEST['x'];

if($x=="1"){
  $sql = "UPDATE detail_repair
  SET confirm_effect='0',id_status='5',description='ผู้ใช้ไม่ประสงค์ให้ซ่อม'
  WHERE id_detail='$id_detail'";

  $sql_token = "UPDATE token
  SET status_tokens='1'
  WHERE id='$id_tokens'";

  // confirm_effect='0' is ไม่ยินยอม
}else{
  $sql = "UPDATE detail_repair
  SET confirm_effect='1',id_status='3',description='ผู้ใช้ประสงค์ให้ซ่อม'
  WHERE id_detail='$id_detail'";

  $sql_token = "UPDATE token
  SET status_tokens='1'
  WHERE id='$id_tokens'";

  // confirm_effect='1' is ยินยอม
}

$objQuery1 = mysql_query($sql_token);
$objQuery = mysql_query($sql);


  if($objQuery)
  {
  	?>
    <script>
        setTimeout(function() {
            swal({
                title: "บันทึกข้อมูลสำเร็จ!!",
                text: "คลิกปุ่ม \"OK\" เพื่อรับทราบ",
                type: "success",
                confirmButtonText: "OK"
            }, function() {
                window.location = "status_show_detail.php?id_repair=<?=$id_repair?>";
            }, 1000);
        });
    </script>
    <?
  }
  else
  {
    echo "Error Save1 [".$objQuery."]";
  }

?>
<script src="js/sweetalert.min.js"></script>
