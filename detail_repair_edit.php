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
		$user=$_SESSION['user_display'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Help Desk</title>
		<?php include"inc_css.php";?>

		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="fancybox-master/jquery.fancybox.min.css">

</head>


<body style="background-color:#E0EEEE">
	<?php
	include"connect.php";
	include"header.php";
	?>

	<?php
	$id_repair=$_GET['id_repair'];

	function dateDB($date){
		list($y,$m,$d)=explode('-',$date);
		 $y += 543;
		 return ($d.'/'.$m.'/'.$y);
	}
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
								 </ul>

							   <!-- Table -->
							   <div class="container-fluid" style="padding-top:10px;">

								<?php
									$strSQL = "SELECT *
															FROM repair r
															LEFT JOIN status s ON r.id_status=s.id_status
															LEFT JOIN admin a ON r.id_admin=a.id_admin
															LEFT JOIN device d ON r.id_device=d.id_device
															WHERE id_repair = '$id_repair'";
									$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
									$objResult = mysql_fetch_array($objQuery);

									$date = $objResult["date_s"];
									list($y,$m,$d)=explode('-',$date);
									$y = $y+543;
									$date = $d.'/'.$m.'/'.$y;
								?>

									<strong>รหัสการแจ้งซ่อม : <?=$objResult["id_repair"]?></strong><br>
									<strong>สถานะการแจ้งซ่อม : <?=$objResult["name_status"]?></strong>
									<br><br>

									<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade active in" id="home">

											<div class="table-responsive">
									      <table class="table table-striped">
									        <tr>
									          <td><strong>ชื่อผู้แจ้ง : </strong></td>
									          <td><?=$objResult['name']?></td>
									          <td><strong>วันที่แจ้ง : </strong></td>
									          <td><?=$date?></td>
									          <td><strong>เวลาแจ้ง : </strong></td>
									          <td><?=$objResult["time_s"]?></td>
									        </tr>
									        <tr>
									          <td><strong>ชื่ออุปกรณ์ : </strong></td>
									          <td colspan="5"><?=$objResult["name_device"]?></td>
									        </tr>
									        <tr>
									          <td><strong>อาการ : </strong></td>
									          <td colspan="5"><?=$objResult["problem"]?></td>
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
									          <td><strong>เบอร์โทร : </strong></td>
									          <td><?=$objResult["phone"]?></td>
									          <td><strong>e-mail : </strong></td>
									          <td><?=$objResult["email"]?></td>
														<td></td>
									          <td></td>
									        </tr>
									      </table>
								    	</div> <!-- div respondsive -->
										</div>

										<!-- //////////////////////////////////////// -->
										<hr>

										<div class="tab-pane fade" id="evalue1">
											<div class="table-responsive">
												<strong>การประเมินครั้งที่ 1 (สำหรับเจ้าหน้าที่)</strong>
												<br><br>

												<table class="table table-striped">
									        <tr>
														<td><strong>เจ้าหน้าที่ ที่รับงาน : </strong></td>
									          <td><?=$objResult["admin_name"]." ".$objResult["admin_lname"]?></td>
									          <td><strong>วันที่ประเมิน : </strong></td>
									          <td><?=dateDB($objResult["date_evalue"])?></td>
									          <td><strong>วันที่คาดว่าจะเสร็จ : </strong></td>
									          <td><?=dateDB($objResult["date_comple"])?></td>
									        </tr>
													<tr>
														<td><strong>หมายเลขอุปกรณ์ : </strong></td>
									          <td colspan="5"><?=$objResult["id_device"]." - ".$objResult["name_device_s"]?></td>
									        </tr>
													<tr>
														<td><strong>หมายเหตุ : </strong></td>
									          <td colspan="5">
															<?=$objResult["note"];?>

														</td>
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

		<!-- Javascripts-->
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins/pace.min.js"></script>
		<script src="js/main.js"></script>
		<script src="js/sweetalert.min.js"></script>

		<script src="fancybox-master/jquery.fancybox.min.js"></script>


</body>
</html>

<?php } ?>
