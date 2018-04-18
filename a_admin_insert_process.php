<meta charset="utf-8">
<?php
include"a_inc_css.php";
include"connect.php";
include"function.php";

$admin_name=$_REQUEST['admin_name'];
$admin_lname=$_REQUEST['admin_lname'];
$admin_phone=$_REQUEST['admin_phone'];
$admin_email=$_REQUEST['admin_email'];
$username=$_REQUEST['username'];
$password=$_REQUEST['password']


$sql = "INSERT INTO admin (admin_name,admin_lname,admin_phone,admin_email,username,password)
VALUES ('$admin_name','$admin_lname','$admin_phone','$admin_email','$username','$username')";

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
	              window.location = "a_manage_admin.php";
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
