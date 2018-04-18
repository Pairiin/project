<meta charset="utf-8">
<?php
include"connect.php";
include"inc_css.php";
$id_admin=$_REQUEST['id_admin'];

$sql = "DELETE FROM admin
WHERE id_admin='$id_admin'";


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
	              window.location.href = "a_manage_admin.php";
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
