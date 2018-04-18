<meta charset="utf-8">
<?php
include"connect.php";
include"inc_css.php";

$device_category_name=$_REQUEST['device_category_name'];
$id_device_category=$_REQUEST['id'];

$sql = "UPDATE device_category
SET device_category_name = '$device_category_name'
WHERE id_device_category = $id_device_category";


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
	              window.location = "a_manage_device_category.php";
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
