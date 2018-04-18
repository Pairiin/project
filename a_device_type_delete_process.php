<meta charset="utf-8">
<?php
include"connect.php";
include"inc_css.php";
$id=$_REQUEST['id'];

$sql = "DELETE FROM device_type
WHERE id_device_type='$id'";

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
							window.location.href = "a_manage_device_type.php";
					}, 1000);
			});
	</script>
<?}
else
{
	echo "Error Save [".$sql."]";
}
?>
<script src="js/sweetalert.min.js"></script>
