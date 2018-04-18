<meta charset="utf-8">
<?php
include"connect.php";
include"inc_css.php";

$id_email=$_REQUEST['id_email'];
$email_name=$_REQUEST['email_name'];
$email=$_REQUEST['email'];
$password=$_REQUEST['password'];


$sql = "UPDATE email
SET email_name = '$email_name', email = '$email', email_password = '$password'
WHERE id_email = $id_email";


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
	              window.location = "a_setting_email.php";
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
