<meta charset="utf-8">
<?php
include"connect.php";
include"inc_css.php";
$problem_name=$_REQUEST['problem_name'];
$id_problem_type=$_REQUEST['id_problem_type'];
$solution_problem=$_REQUEST['solution_problem'];


$sql = "INSERT INTO problem (problem_name,solution_problem,id_problem_type)
VALUES ('$problem_name','$solution_problem','$id_problem_type')";

$objQuery = mysql_query($sql);

if($objQuery)
{
	if($id_repair==""){
	?>
  <script>
      setTimeout(function() {
          swal({
              title: "บันทึกข้อมูลสำเร็จ!!",
              text: "คลิกปุ่ม \"OK\" เพื่อรับทราบ",
              type: "success",
              confirmButtonText: "OK"
          }, function() {
              window.location = "a_manage_problem.php";
          }, 1000);
      });
  </script>
  <?
}
else{
	?>
	<script>
			setTimeout(function() {
					swal({
							title: "บันทึกข้อมูลสำเร็จ!!",
							text: "คลิกปุ่ม \"OK\" เพื่อรับทราบ",
							type: "success",
							confirmButtonText: "OK"
					}, function() {
							window.location.href = "a_evalue.php?id_repair=<?=$id_repair?>";
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
