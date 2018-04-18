<meta charset="utf-8">
<?php
include"connect.php";
include"inc_css.php";
$serial_number=$_REQUEST['serial_number'];
$device_name=$_REQUEST['device_name'];
$device_category=$_REQUEST['device_category'];
$device_type=$_REQUEST['device_type'];

$id_detail=$_REQUEST['id_detail'];


$sql = "INSERT INTO device (serial_number,device_name,id_device_category,id_device_type)
VALUES ('$serial_number','$device_name','$device_category','$device_type')";

$objQuery = mysql_query($sql);

if($objQuery)
{
	if($id_detail==""){ //ถ้า insert โดยคลิ๊กโดยตรง
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
	}	else{ //ถ้า insert โดยผ่านหน้าประเมิน
		?>
	  <script>
	      setTimeout(function() {
	          swal({
	              title: "บันทึกข้อมูลสำเร็จ!!",
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
}
else
{
	echo "Error Save [".$sql."]";
}
?>
<script src="js/sweetalert.min.js"></script>
