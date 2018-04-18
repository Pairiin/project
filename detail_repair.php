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


<body style="background-color:#E0EEEE">
	<?php
	include"connect.php";
	include"header.php";
	include"function.php";
	?>

	<?php
	$id_repair=$_REQUEST['id_repair'];
	$id_detail=$_REQUEST['id_detail'];

	?>

	<?php
		$strSQL = "SELECT *
							FROM repair r
							LEFT JOIN detail_repair dt ON r.id_repair=dt.id_repair
							LEFT JOIN status s ON dt.id_status=s.id_status
							LEFT JOIN admin a ON r.id_admin=a.id_admin
							LEFT JOIN device d ON dt.id_device=d.id_device
							WHERE dt.id_detail = '$id_detail'";
		$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
		$objResult = mysql_fetch_array($objQuery);

	?>

	<div class="container" style="padding-top:10px;">
		 <div class="row">
			 <div class="col-md-12">
				 <div class="card">

					 <div class="panel panel-info" >
						 <div class="panel-heading">สถานะการแจ้งซ่อมของคุณ</div>
						 	 <div class="bs-component" >
								 <ul class="nav nav-tabs" style="margin:10px 10px">
									 <li class="active"><a href="#home" data-toggle="tab">รายละเอียด</a></li>
									 <li><a href="#evalue1" data-toggle="tab" class="<? if($objResult[id_status] == 1 || $objResult[id_status] == 8 || $objResult[id_status]=="") { echo 'hide'; }?>">การประเมินครั้งที่ 1</a></li>
									 <li><a href="#evalue2" data-toggle="tab" class="<? if($objResult[id_status] == 1 || $objResult[id_status] == 2 ||$objResult[id_status] == 6 || $objResult[id_status] == 8 || $objResult[id_status]=="") { echo 'hide'; }?>">การประเมินครั้งที่ 2</a></li>
								 </ul>

							   <!-- Table -->
							   <div class="container-fluid" style="padding-top:10px;">

									 <div class="col-md-10">
											<strong>รหัสการแจ้งซ่อม : <?=$objResult["id_repair"]?></strong><br>
											<strong>สถานะการแจ้งซ่อม : <?=$objResult["status_name"]?></strong>
									</div>
									<div class="col-md-2" style="padding:10px 10px">
										<a class="btn btn-sm btn-danger btnCencel <? if($objResult['id_status'] != 1 && $objResult[id_status]!="") { echo 'hide'; }?>" data-target="btnCencel" href="evalue_cencel_process.php?id_detail=<?=$objResult['id_detail'];?>" style="align:right;"><i class="fa fa-times"></i> ยกเลิกใบแจ้งซ่อม</a>
									</div>
									<div class="col-md-2">
										<!-- <a type="button" href="assessment.php?id_detail=<?=$id_detail?>" class="btn btn-warning btn-sm <? if($objResult['id_status'] != 1) { echo 'hide'; }?>"><i class="fa fa-check-square-o"></i> ประเมินความพึงพอใจ</a> -->
									</div>
									<!-- <a class="btn btn-info" href="detail_repair_edit.php?id_repair=<?=$objResult["id_repair"]?>" role="button">แก้ไข</a> -->
									<br><br><br>

									<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade active in" id="home">

											<div class="table-responsive">
									      <table class="table table-striped">
									        <tr>
									          <td><strong>ชื่อผู้แจ้ง : </strong></td>
									          <td colspan="5"><?=$objResult['user_display']?></td>
									        </tr>
													<tr>
														<td><strong>วันที่แจ้ง : </strong></td>
														<td><?=dateToBE($objResult["date_s"]);?></td>
														<td><strong>เวลาแจ้ง : </strong></td>
														<td><?=$objResult["time_s"]?></td>
													</tr>
									        <tr>
									          <td><strong>ชื่ออุปกรณ์ : </strong></td>
									          <td colspan="5"><?=$objResult["device_name_s"]?></td>
									        </tr>
									        <tr>
									          <td><strong>อาการ : </strong></td>
									          <td colspan="5"><?=$objResult["problem"]?></td>
									        </tr>
													<tr>
														<td style="width:25%;"><strong>สถานที่ตั้งคอมพิวเตอร์/อุปกรณ์ ห้อง : </strong></td>
														<td style="width:15%;"><?=$objResult["room"]?></td>
														<td style="width:10%;"><strong>ชั้น : </strong></td>
														<td style="width:10%;"><?=$objResult["class"]?></td>
														<td style="width:10%;"><strong>อาคาร : </strong></td>
														<td style=""><?=$objResult["building"]?></td>
													</tr>
													<tr>
									          <td><strong>รูปภาพ : </strong></td>
									          <td colspan="5">
															<a data-fancybox="gallery" href="./upload/<?php echo $objResult['image']; ?>" rel="lightbox"><img src="upload/<?php echo $objResult['image']; ?>" border="0" alt=""  width="100px" /></a>
														</td>

													</tr>
									      </table>

												<br>
												<strong>ช่องทางการติดต่อ</strong>
												<br><br>
												<table class="table table-striped">
									        <tr>
									          <td style="width:15%;"><strong>เบอร์โทร : </strong></td>
									          <td style="width:15%;"><?=$objResult["user_phone"]?></td>
									          <td style="width:10%;"><strong>e-mail : </strong></td>
									          <td style=""><?=$objResult["user_email"]?></td>
									        </tr>
									      </table>
								    	</div> <!-- div respondsive -->
										</div>

										<!-- ////////////////การประเมินครั้งที่ 1//////////////// -->
										<hr>

										<div class="tab-pane fade" id="evalue1">
											<div class="table-responsive">
												<strong>การประเมินครั้งที่ 1 (สำหรับเจ้าหน้าที่)</strong>
												<br><br>

												<table class="table table-striped">
									        <tr>
														<td><strong>เจ้าหน้าที่ ที่รับงาน : </strong></td>
									          <td colspan="4"><?=$objResult["admin_name"]." ".$objResult["admin_lname"]?></td>
													</tr>
													<tr>
									          <td style="width:20%;"><strong>วันที่ประเมิน : </strong></td>
									          <td style="width:30%;"><?=dateToBE($objResult["date_evalue"])?></td>
									          <td style="width:20%;"><strong>วันที่คาดว่าจะเสร็จ : </strong></td>
									          <td style="width:30%;"><?=dateToBE($objResult["date_comple"])?></td>
									        </tr>
													<tr>
														<td><strong>หมายเลขอุปกรณ์ : </strong></td>
									          <td colspan="4"><?=$objResult["serial_number"]." / ".$objResult["device_name"]?></td>
									        </tr>
													<tr>
														<td><strong>หมายเหตุ (กรณีไม่รับงาน) : </strong></td>
									          <td colspan="4">
															<?=$objResult["note"];?>

														</td>
									        </tr>
									      </table>
											</div>
										</div>

										<!-- ////////////////การประเมินครั้งที่ 2//////////////// -->
										<?php
											$strSQL_evalue2 = "SELECT *
																FROM detail_repair dr
																LEFT JOIN problem p ON dr.id_problem=p.id_problem
																LEFT JOIN problem_type pt ON p.id_problem_type=pt.id_problem_type
																WHERE id_detail = '$id_detail'";

											$objQuery_evalue2 = mysql_query($strSQL_evalue2) or die ("Error Query [".$strSQL_evalue2."]");
											$objResult_evalue2 = mysql_fetch_array($objQuery_evalue2);


										?>

										<div class="tab-pane fade" id="evalue2">
											<div class="table-responsive">
												<strong>การประเมินครั้งที่ 2 (สำหรับเจ้าหน้าที่)</strong>
												<br><br>

												<table class="table table-striped">
									        <tr>
														<td width="20%"><strong>ประเภทปัญหา : </strong></td>
									          <td><?=$objResult_evalue2["problem_type_name"]?></td>
									        </tr>
													<tr>
														<td><strong>ปัญหา : </strong></td>
									          <td><?=$objResult_evalue2["problem_name"]?></td>
									        </tr>
													<tr>
														<td><strong>วิธีแก้ไขปัญหา : </strong></td>
									          <td><?=$objResult_evalue2["solution"];?></td>
									        </tr>
													<tr>
														<td><strong>ผลกระทบ : </strong></td>
									          <td><?=$objResult_evalue2["effect"];?></td>
									        </tr>
													<tr>
														<td><strong>หมายเหตุ : </strong></td>
									          <td><?=$objResult_evalue2["description"];?></td>
									        </tr>
									      </table>
											</div>
										</div>
										<!-- ///////////////////////////////////// -->

									</div>

	    					</div>

					</div> <!-- div card -->
				</div> <!-- div col -->
			</div> <!-- div row -->
		</div> <!-- div container -->


<?php include"inc_js.php";?>


</body>
</html>

<?php } ?>
