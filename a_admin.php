<?php
	session_start();
	if($_SESSION['user_admin'] == "")
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
		<?php include"a_inc_css.php";?>
  </head>

  <body class="sidebar-mini fixed">
    <div class="wrapper">

			<?php include"connect.php";?><!-- connect database -->
			<?php include"a_header.php";?><!-- header -->
			<?php include"a_side_nav.php";?><!-- Side-Nav-->
			<?php include"function.php";?><!-- function-->

      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-home fa-lg"></i> HOME</h1>
          </div>
        </div>

				<?php
				$c_NotAccept =
								"SELECT COUNT(id_detail)
								AS CountNotAccept
								FROM detail_repair
								WHERE id_status=1";

							$c_WaitConfirm =
								"SELECT COUNT(id_detail)
								AS CountWaitConfirm
								FROM detail_repair
								WHERE id_status=2";

							$c_Process =
								"SELECT COUNT(id_detail)
								AS CountProcess
								FROM detail_repair
								WHERE id_status=3";

							$objQuery_NotAccept = mysql_query($c_NotAccept);
							$objQuery_WaitConfirm = mysql_query($c_WaitConfirm);
							$objQuery_Process = mysql_query($c_Process);

							$objResult_NotAccept = mysql_fetch_array($objQuery_NotAccept);
							$objResult_WaitConfirm = mysql_fetch_array($objQuery_WaitConfirm);
							$objResult_Process = mysql_fetch_array($objQuery_Process);

				?>

				<div class="row">
					<div class="col-md-8">
						<div class="bs-component">
							<ul class="nav nav-pills">
								<li class="active"><a>งานที่ยังไม่รับ<span class="badge"><?=$objResult_NotAccept[CountNotAccept]?></span></a></li>
								<li class="warning"><a>งานที่ไม่ได้ประเมิน<span class="badge"><?=$objResult_WaitConfirm[CountWaitConfirm]?></span></a></li>
								<li class="danger"><a>งานที่ยังไม่สำเร็จ<span class="badge"><?=$objResult_Process[CountProcess]?></span></a></li>
							</ul>
						</div>
					</div>
				</div>

				<br>
				<!-- เฉพาะที่ยังไม่รับงาน และรอการประเมิน -->

				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<h3 class="card-title">รายการแจ้งซ่อมที่รอการรับงาน และประเมิน</h3>
							<div class="table-responsive">
								<table class="table" id="WaitConfirm">
									<thead>
										<tr>
											<th width:"10%">#</th>
					            <th width="12%" id="widthTh1">ใบแจ้งซ่อม</th>
											<th width="10%">รหัสการแจ้งซ่อม</th>
					            <th width="18%">ชื่อผู้แจ้ง</th>
					            <th width="23%">ปัญหา</th>
					            <th width="10%">วันที่</th>
					            <th width="15%">สถานะ</th>
											<th width="22%">รายละเอียด</th>
					          </tr>
									</thead>
									<tbody>
										<?php
										$i=1;
										//รอการรับงาน และประเมิน
										$sqlWait="SELECT *
 															FROM detail_repair dt
 															LEFT JOIN repair r ON dt.id_repair=r.id_repair
															LEFT JOIN status s ON dt.id_status=s.id_status
 															WHERE dt.id_status = 1 OR dt.id_status = 2
		 													ORDER BY dt.id_repair desc , dt.id_detail asc";

											$objQuery = mysql_query($sqlWait);
											while($objResult = mysql_fetch_array($objQuery)){
												?>
												<tr>
													<th align="center"><?=$i;?></td>
													<td><?=$objResult[id_repair] ?></th>
													<td><?=$objResult[id_detail] ?></th>
													<td><?=$objResult[user_display] ?></td>
													<td><?=$objResult[problem] ?></td>
													<td><?=dateToBE($objResult["date_s"]);?></td>
													<td align="center"><?=$objResult[status_name] ?></a></td>
													<td><a href="a_evalue.php?id_detail=<?=$objResult['id_detail'];?>">รายละเอียด</a></td>
												</tr>
												<?$i++;} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<!-- เฉพาะงานที่กำลังดำเนินการซ่อม -->

				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<h3 class="card-title">รายการที่กำลังดำเนินการซ่อม</h3>
							<div class="table-responsive">
								<table class="table" id="Process">
									<thead>
										<tr>
											<th width:"10%">#</th>
					            <th width="12%" id="widthTh2">ใบแจ้งซ่อม</th>
											<th width="10%">รหัสการแจ้งซ่อม</th>
					            <th width="18%">ชื่อผู้แจ้ง</th>
					            <th width="23%">ปัญหา</th>
					            <th width="10%">วันที่</th>
					            <th width="15%">สถานะ</th>
											<th width="22%">รายละเอียด</th>
					          </tr>
									</thead>
									<tbody>
										<?php
										$i=1;
										//กำลังดำเนินการซ่อม
										$sqlProcess="SELECT *
		 															FROM detail_repair dt
		 															LEFT JOIN repair r ON dt.id_repair=r.id_repair
																	LEFT JOIN status s ON dt.id_status=s.id_status
		 															WHERE dt.id_status = 3
		 															ORDER BY dt.id_repair desc , dt.id_detail asc";

												$objQuery = mysql_query($sqlProcess);
												while($objResult = mysql_fetch_array($objQuery)){
													?>
													<tr>
														<th align="center" scope="row"><?=$i;?></td>
														<td><?=$objResult[id_repair];?></th>
														<td><?=$objResult[id_detail];?></th>
														<td><?=$objResult[user_display]; ?></td>
														<td><?=$objResult[problem]; ?></td>
														<td><?=dateToBE($objResult["date_s"]);?></td>
														<td><?=$objResult[status_name] ?></a></td>
														<td><a href="a_evalue.php?id_detail=<?=$objResult['id_detail'];?>">รายละเอียด</a></td>
													</tr>
													<?$i++;} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<!-- เฉพาะที่สำเร็จ -->

				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<h3 class="card-title">รายการแจ้งซ่อมที่สำเร็จการแจ้งซ่อม</h3>
							<div class="table-responsive">
								<table class="table" id="Success">
									<thead>
										<tr>
											<th width:"10%">#</th>
					            <th width="12%" id="widthTh3">ใบแจ้งซ่อม</th>
											<th width="10%">รหัสการแจ้งซ่อม</th>
					            <th width="18%">ชื่อผู้แจ้ง</th>
					            <th width="23%">ปัญหา</th>
					            <th width="10%">วันที่</th>
					            <th width="15%">สถานะ</th>
											<th width="22%">รายละเอียด</th>
					          </tr>
									</thead>
									<tbody>
										<?php
										$i=1;
										//สำเร็จ
										$sqlSuccess="SELECT *
		 															FROM detail_repair dt
		 															LEFT JOIN repair r ON dt.id_repair=r.id_repair
																	LEFT JOIN status s ON dt.id_status=s.id_status
		 															WHERE dt.id_status = 4
		 															ORDER BY dt.id_repair desc , dt.id_detail asc";
												$objQuery = mysql_query($sqlSuccess);
												while($objResult = mysql_fetch_array($objQuery)){
													?>
													<tr>
														<th align="center"><?=$i;?></td>
														<td><?=$objResult[id_repair];?></th>
														<td><?=$objResult[id_detail];?></th>
														<td><?=$objResult[user_display] ?></td>
														<td><?=$objResult[problem] ?></td>
														<td><?=dateToBE($objResult["date_s"]);?></td>
														<td><?=$objResult[status_name] ?></a></td>
														<td><a href="a_evalue.php?id_detail=<?=$objResult['id_detail'];?>">รายละเอียด</a></td>
													</tr>
													<?$i++;} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<!-- เฉพาะที่ไม่รับงานและไม่สำเร็จ -->

				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<h3 class="card-title">รายการแจ้งซ่อมที่ไม่รับงานและไม่สำเร็จ</h3>
							<div class="table-responsive">
								<table class="table" id="Unsuccess">
									<thead>
										<tr>
											<th width:"10%">#</th>
					            <th width="12%" id="widthTh4">ใบแจ้งซ่อม</th>
											<th width="10%">รหัสการแจ้งซ่อม</th>
					            <th width="18%">ชื่อผู้แจ้ง</th>
					            <th width="23%">ปัญหา</th>
					            <th width="10%">วันที่</th>
					            <th width="15%">สถานะ</th>
											<th width="22%">รายละเอียด</th>
					          </tr>
									</thead>
									<tbody>
										<?php
										$i=1;
										//ไม่รับงานและไม่สำเร็จ
										$sqlUnsuccess ="SELECT *
		 															FROM detail_repair dt
		 															LEFT JOIN repair r ON dt.id_repair=r.id_repair
																	LEFT JOIN status s ON dt.id_status=s.id_status
		 															WHERE dt.id_status = 5 OR dt.id_status = 6
		 															ORDER BY dt.id_repair desc , dt.id_detail asc";

											$objQuery = mysql_query($sqlUnsuccess);
											while($objResult = mysql_fetch_array($objQuery)){
												?>
												<tr>
													<th align="center"><?=$i;?></td>
													<td><?=$objResult[id_repair] ?></th>
													<td><?=$objResult[id_detail] ?></th>
													<td><?=$objResult[user_display] ?></td>
													<td><?=$objResult[problem] ?></td>
													<td><?=dateToBE($objResult["date_s"]);?></td>
													<td><?=$objResult[status_name] ?></a></td>
													<td><a href="a_evalue.php?id_detail=<?=$objResult['id_detail'];?>">รายละเอียด</a></td>
												</tr>
												<?$i++;} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<!-- การซ่อมทั้งหมด -->

				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<h3 class="card-title">รายการแจ้งซ่อมทั้งหมด</h3>
							<div class="table-responsive">
								<table class="table" id="AllHelpDest">
									<thead>
										<tr>
											<th width:"10%">#</th>
					            <th width="12%" id="widthTh5">ใบแจ้งซ่อม</th>
											<th width="10%">รหัสการแจ้งซ่อม</th>
					            <th width="18%">ชื่อผู้แจ้ง</th>
					            <th width="23%">ปัญหา</th>
					            <th width="10%">วันที่</th>
					            <th width="15%">สถานะ</th>
											<th width="22%">รายละเอียด</th>
					          </tr>
									</thead>
									<tbody>
										<?php
										$i=1;
										$sqlAll="SELECT *
		 															FROM detail_repair dt
		 															LEFT JOIN repair r ON dt.id_repair=r.id_repair
																	LEFT JOIN status s ON dt.id_status=s.id_status
		 															ORDER BY dt.id_repair desc , dt.id_detail asc";

											$objQuery = mysql_query($sqlAll);
											while($objResult = mysql_fetch_array($objQuery)){
												?>
												<tr>
													<th align="center"><?=$i;?></td>
													<td><?=$objResult[id_repair] ?></th>
													<td><?=$objResult[id_detail] ?></th>
													<td><?=$objResult[user_display] ?></td>
													<td><?=$objResult[problem] ?></td>
													<td><?=dateToBE($objResult["date_s"]);?></td>
													<td><?=$objResult[status_name] ?></a></td>
													<td><a href="a_evalue.php?id_detail=<?=$objResult['id_detail'];?>">รายละเอียด</a></td>
												</tr>
												<?$i++;} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

      </div>
    </div>

    <!-- Javascripts-->
		<?php include"a_inc_js.php"; ?>

		<script type="text/javascript">$('#AllHelpDest').DataTable();</script>
		<script type="text/javascript">$('#WaitConfirm').DataTable();</script>
		<script type="text/javascript">$('#Process').DataTable();</script>
		<script type="text/javascript">$('#Success').DataTable();</script>
		<script type="text/javascript">$('#Unsuccess').DataTable();</script>

		<!-- <script>
			$(document).ready(function() {
				$("#widthTh1").click().click();
				$("#widthTh2").click().click();
				$("#widthTh3").click().click();
				$("#widthTh4").click().click();
				$("#widthTh5").click().click();
			});
		</script> -->


  </body>
</html>

<?php } ?>
