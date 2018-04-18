<meta charset="utf-8">
<?php
session_start();
include"connect.php";
include"inc_css.php";

$id_admin=$_REQUEST['id_admin'];

$admin_name=$_REQUEST['admin_name'];
$admin_lname=$_REQUEST['admin_lname'];
$admin_phone=$_REQUEST['admin_phone'];
$admin_email=$_REQUEST['admin_email'];
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];

$sql = "UPDATE admin
SET admin_name='$admin_name',admin_lname='$admin_lname',admin_phone='$admin_phone',admin_email='$admin_email',username='$username',password='$password'
WHERE id_admin='$id_admin'";


$objQuery = mysql_query($sql);

if($objQuery)
{
	$_SESSION["user_admin"] = $username;
	$_SESSION["pass_admin"] = $password;

	session_write_close();

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
