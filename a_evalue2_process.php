<meta charset="utf-8">
<?php
include"connect.php";
include"inc_css.php";

$id_detail=$_REQUEST['id_detail'];
$problem=$_REQUEST['id_problem'];
$solution=$_REQUEST['solution'];
$effect=$_REQUEST['effect'];
$description=$_REQUEST['description'];
$id_status=$_REQUEST['id_status'];

if($id_status==""){
	if($effect==""){ //if don't have effect
		$sql = "UPDATE detail_repair
						SET id_problem='$problem',solution='$solution',effect='$effect',description='$description',id_status='3'
						WHERE id_detail='$id_detail'";
	}
	else {

		$sql_detail = "SELECT *
              FROM repair r
              LEFT JOIN detail_repair dt ON r.id_repair=dt.id_repair
              LEFT JOIN status s ON dt.id_status=s.id_status
              LEFT JOIN admin a ON r.id_admin=a.id_admin
              LEFT JOIN device d ON dt.id_device=d.id_device
              WHERE dt.id_detail = '$id_detail'";

		$obj_detail = mysql_query($sql_detail) or die ("Error Query [".$sql_detail."]");
		$result_detail = mysql_fetch_array($obj_detail);

		if($result_detail['effect']!=$effect){
			include"a_mail.php";

			$sql = "UPDATE detail_repair
							SET id_problem='$problem',solution='$solution',effect='$effect',description='$description',id_status='7',id_tokens=$last_id
							WHERE id_detail='$id_detail'";

		}else{
			$sql = "UPDATE detail_repair
							SET id_problem='$problem',solution='$solution',effect='$effect',description='$description',id_status='3'
							WHERE id_detail='$id_detail'";
		}

	}
}else{
	$sql = "UPDATE detail_repair
					SET id_status='$id_status'
					WHERE id_detail='$id_detail'";
}


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
              window.location = "a_admin.php";
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
