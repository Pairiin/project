<meta charset="utf-8">
<?php
include"connect.php";
include"inc_css.php";
$id_detail=$_REQUEST['id_detail'];

$sql ="UPDATE detail_repair
				SET id_status='8'
				WHERE id_detail=".$id_detail."";


$objQuery = mysql_query($sql);

if($objQuery)
{
		?>
	  <script>
	      setTimeout(function() {
	          swal({
	              title: "ยกเลิกใบแจ้งซ่อมสำเร็จ!!",
	              text: "คลิกปุ่ม \"OK\" เพื่อรับทราบ",
	              type: "success",
	              confirmButtonText: "OK"
	          }, function() {
	              window.location.href = "a_evalue.php?id_detail=<?=$id_detail?>";
	          }, 1000);
	      });
	  </script>
	  <?
}
else
{
	echo "Error Save [".$sql."]";
}
?>
<script src="js/sweetalert.min.js"></script>
