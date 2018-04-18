<?php
	session_start();
	if($_SESSION['username'] == "")
	{
    ?>
    <meta http-equiv='refresh' content='0;URL=index.php?id=login'>
    <?
		//exit();
	}

  else {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Help Desk KMUTNB</title>
	  <?php include"inc_css.php";?>
</head>

<style>
	th {
		background-color: #d9edf7;
	}
</style>

<body style="background-color:#E0EEEE">
	<?php
	include "connect.php";
	include "header.php";
	include "function.php";
	?>

    <div class="container" style="padding-top:10px;">

       <div class="row">
				 <div class="col-md-12">
					   <div class="card">
					     <h3 class="card-title">ประวัติการซ่อมทั้งหมด</h3>
							 <p style="text-align:center;color:red">**สถานะการซ่อม : รอการรับงาน -> รอประเมินอาการ -> รอการยืนยัน -> กำลังดำเนินการซ่อม -> สำเร็จ**</p></li>

					     <div class="table-responsive">
					       <table class="table table-bordered table-hover" id="AllHelpDest">
					         <thead>
					           <tr>
					             <th style="text-align:center; width:15%;"  id="widthTh1">รหัสการแจ้งซ่อม	</th>
					             <th style="text-align:center; width:15%;">ชื่ออุปกรณ์</th>
											 <th style="text-align:center;">ปัญหา</th>
											 <th style="text-align:center; width:15%;">วันที่แจ้งซ่อม</th>
					             <th style="text-align:center; width:15%;">สถานะการซ่อม</th>
											 <th style="text-align:center; width:15%;">รายละเอียด</th>
					           </tr>
					         </thead>
					         <tbody>

										 <?php
										 $i=1;
	 										$strSQL = "SELECT *
	 															FROM repair r
	 															LEFT JOIN detail_repair dt ON r.id_repair=dt.id_repair
																LEFT JOIN status s ON dt.id_status=s.id_status
	 															WHERE user_display = '$_SESSION[user_display]' AND dt.id_repair = '$_REQUEST[id_repair]'";
	 										$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	 										while ($objResult = mysql_fetch_array($objQuery)) {

	 									?>
											<tr>
												<td  id="widthTh1" align="center"><?php echo $i;?></td>
												<td style="text-align:left	;"><? echo $objResult["device_name_s"]; ?></td>
												<td style="text-align:left;"><?php echo $objResult["problem"];?></td>
												<td style="text-align:center;"><? echo dateToBE($objResult[date_s]); ?></td>
												<td style="text-align:center;">
													<?php
													if($objResult["id_status"]=="7"){ //รอการยืนยัน
														?>
														<a href="confirm_effect.php?id_detail=<?=$objResult["id_detail"];?>">
															<?php echo $objResult["status_name"];?>
														</a>
														<?php
													}else{
														echo $objResult["status_name"];
													}
													?>
												</td>
												<td align="center">
													<a href="detail_repair.php?id_detail=<?=$objResult["id_detail"];?>">
														รายละเอียด
													</a>
												</td>
											</tr>
					            <? $i++; } ?>
					         </tbody>
					       </table>
					     </div>
					   </div>
					 </div>

				 </div>
       </div>
			</div>

			<?php include"inc_js.php";?>
</body>
</html>
<?php } ?>
