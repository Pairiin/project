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
		$user_display = $_REQUEST['user_display'];
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
            <h1><i class="fa fa-wrench fa-lg"></i> ประวัติการแจ้งซ่อม</h1>
          </div>
        </div>

				<!-- การซ่อมทั้งหมด -->

				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<?php
							$sql_user="SELECT * , COUNT(user_display) AS count_user
														FROM repair r
														LEFT JOIN detail_repair dr ON r.id_repair = dr.id_repair
														INNER JOIN user_status us ON r.id_user_status = us.id_user_status

										WHERE r.user_display = '$user_display'";


								$objQuery1 = mysql_query($sql_user);
								$objResult1 = mysql_fetch_array($objQuery1);
							?>

							<p>
								ชื่อผู้แจ้ง : <?=$objResult1['user_display']?> <br>
								สถานะ : <?=$objResult1['name_user_status']?><br>
								จำนวนที่แจ้งซ่อม : <?=$objResult1['count_user']?><br>
							</p>
							<hr />
							<div class="table-responsive">
								<table class="table" id="All">
									<thead>
										<tr>
											<th  style="width:5%" id="widthTh1">#</th>
											<th style="width:12%">วันที่แจ้งซ่อม</th>
											<th style="width:15%">Serial Number</th>
											<th style="width:15%">ชื่ออุปกรณ์</th>
											<th style="width:15%">ปัญหา</th>
											<th style="width:15%">วิธีแก้ไข</th>
											<th style="width:15%">เจ้าหน้าที่ผู้รับงาน</th>
											<th style="width:15%">สถานะ</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;

										$sql="SELECT *
													FROM detail_repair dr
													LEFT JOIN repair r ON dr.id_repair=r.id_repair
													LEFT JOIN device d ON dr.id_device=d.id_device
													LEFT JOIN device_category dc ON d.id_device_category=dc.id_device_category
													LEFT JOIN device_type dt ON d.id_device_type=dt.id_device_type
													LEFT JOIN status s ON dr.id_status=s.id_status
													WHERE r.user_display = '$user_display'";


											$objQuery = mysql_query($sql);

											while($objResult = mysql_fetch_array($objQuery)){
												?>
												<tr>
													<th scope="row"><? echo $i; ?></th>
													<td><?=dateToBE($objResult['date_s']); ?></td>
													<td><? echo $objResult['serial_number'] ?></td>
													<td><? echo $objResult['device_name'] ?></td>
													<td><? echo $objResult['problem'] ?></td>
													<td><? echo $objResult['solution'] ?></td>
													<td><? echo $objResult['admin_name']." ".$objResult['admin_lname'] ?></td>
													<td><? echo $objResult['status_name'] ?></td>

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

		<!-- Javascripts-->
		<?php include"a_inc_js.php";?>

		<!-- Data table plugin-->
		<script type="text/javascript">
			$('#All').DataTable();


		</script>

		<!-- script manual-->
		<?php include"a_inc_script.php";?>

  </body>
</html>

<?php } ?>
