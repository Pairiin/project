<meta charset="utf-8">
<?php
include"connect.php";
include"inc_css.php";

$device_name=$_REQUEST['device_name'];
$device_category=$_REQUEST['device_category'];
$device_type=$_REQUEST['device_type'];
$id_device=$_REQUEST['id_device'];

$sql = "UPDATE device
SET device_name = '$device_name', id_device_category = $device_category, id_device_type = $device_type
WHERE id_device = $id_device;";


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
	              window.location = "a_manage_device.php";
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
