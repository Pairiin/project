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
	include"connect.php";
	include"header.php";
	include"function.php";
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
					             <th style="text-align:center; width:10%;"  id="widthTh1">ใบแจ้งซ่อม</th>
											 <th style="text-align:center; width:15%;">วันที่แจ้งซ่อม</th>
					             <th style="text-align:center; width:15%;">สถานะการประเมินความพึงพอใจ</th>
											 <th style="text-align:center; width:15%;">รายละเอียด</th>
					           </tr>
					         </thead>
					         <tbody>

										 <?php
										 $i=1;
	 										$strSQL = "SELECT *
	 															FROM repair r
	 															WHERE user_display = '$_SESSION[user_display]'";
	 										$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	 										while ($objResult = mysql_fetch_array($objQuery)) {

	 									?>
											<tr>
												<td  id="widthTh1" align="center"><?php echo $i;?></td>
												<td style="text-align:center;"><? echo dateToBE($objResult[date_s]); ?></td>
												<td style="text-align:center;">
													<?php
														if($objResult["status_satis"]=="1"){ //แสดงเมื่อรับงานเข้าระบบ
															echo "<a href='assessment.php?id_repair=$objResult[id_repair]'>กรุณาทำแบบประเมิน</a>";
														}else if($objResult["status_satis"]=="2"){ //แสดงเมื่อประเมินแล้ว
															echo "<a href='assessment_show.php?id_repair=$objResult[id_repair]'>ทำแบบประเมินแล้ว</a>";
														}else{
															echo "ยังไม่สามารถทำแบบประเมินได้";
														}
													?></td>
												<td align="center">
													<a href="status_show_detail.php?id_repair=<?=$objResult["id_repair"];?>">
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
