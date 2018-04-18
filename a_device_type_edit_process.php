<meta charset="utf-8">
<?php
include"connect.php";
include"inc_css.php";

$device_type_name=$_REQUEST['device_type_name'];
$id_device_type=$_REQUEST['id'];

$sql = "UPDATE device_type
SET device_type_name = '$device_type_name'
WHERE id_device_type = $id_device_type";


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
	              window.location = "a_manage_device_type.php";
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
