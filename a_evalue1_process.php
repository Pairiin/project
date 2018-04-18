<meta charset="utf-8">
<?php
include"connect.php";
include"inc_css.php";

$id_detail=$_REQUEST['id_detail'];
$id_admin=$_REQUEST['id_admin'];

$get_job=$_REQUEST['get_job'];
$date_evalue=$_REQUEST['date_evalue'];
$date_comple=$_REQUEST['date_comple'];
$id_device=$_REQUEST['id_device'];
$description=$_REQUEST['description'];

function dateFormatDB($date){
		$dateArr = explode("/",$date);
		return ($dateArr[2]-543)."-".$dateArr[1]."-".$dateArr[0];
	}

	$date_evalue=dateFormatDB($date_evalue);
	$date_comple=dateFormatDB($date_comple);



$evalue1 = ($get_job=='1' ? "รับ" : "ไม่รับ");

$sql = "SELECT *
		FROM repair r
		LEFT JOIN detail_repair dt ON r.id_repair=dt.id_repair
		LEFT JOIN status s ON dt.id_status=s.id_status
		WHERE dt.id_detail = '$_REQUEST[id_detail]'";

$obj_repair = mysql_query($sql) or die ("Error Query [".$sql."]");
$result_repair = mysql_fetch_array($obj_repair);

//แก้ไขขณะ รอประเมินอารการ,ดำเนินการซ่อม,รอยืนยัน
if($result_repair['id_status'] == "2" || $result_repair['id_status'] == "3" || $result_repair['id_status'] == "7"){
		$sql_repair = "UPDATE repair
						SET id_admin='$id_admin'
						WHERE id_repair=".$result_repair['id_repair']."";

		$sql_detail = "UPDATE detail_repair
						SET id_device='$id_device',date_evalue='$date_evalue',date_comple='$date_comple',description='$description'
						WHERE id_detail=".$id_detail."";

}else {
	if($get_job==1){ //ทำการประเมินครั้งแรกเมื่อ รับงาน
		$sql_repair = "UPDATE repair
						SET id_admin='$id_admin',status_satis='1'
						WHERE id_repair=".$result_repair['id_repair']."";

		$sql_detail = "UPDATE detail_repair
						SET id_device='$id_device',date_evalue='$date_evalue',date_comple='$date_comple',description='$description',status_evalue='$evalue1',id_status='2'
						WHERE id_detail=".$id_detail."";
	}
	else{ //ทำการประเมินครั้งแรกเมื่อ ไม่รับงาน
		$sql_repair = "UPDATE repair
						SET id_admin='$id_admin',status_satis='1'
						WHERE id_repair=".$result_repair['id_repair']."";

		$sql_detail = "UPDATE detail_repair
						SET id_device='$id_device',description='$description',status_evalue='$evalue1',id_status='6'
						WHERE id_detail=".$id_detail."";
	}
}
//echo $sql;
$objQuery_repair = mysql_query($sql_repair);
$objQuery_detail = mysql_query($sql_detail);

if($objQuery_repair){
	if($objQuery_detail){
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
	}	else {echo "Error Save [".$sql_detail."]";}
}else {echo "Error Save [".$sql_repair."]";}
?>
<script src="js/sweetalert.min.js"></script>
