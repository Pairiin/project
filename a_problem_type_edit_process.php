<meta charset="utf-8">
<?php
include"connect.php";
include"inc_css.php";

$problem_type_name=$_REQUEST['problem_type_name'];
$id_problem_type=$_REQUEST['id'];


$sql = "UPDATE problem_type
SET problem_type_name = '$problem_type_name'
WHERE id_problem_type = $id_problem_type";


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
	              window.location = "a_manage_problem_type.php";
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
