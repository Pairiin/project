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
		$id_device = $_REQUEST['id_device'];
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
							$sql1="SELECT *
										FROM device d
										LEFT JOIN device_category dc ON d.id_device_category=dc.id_device_category
										LEFT JOIN device_type dt ON d.id_device_type=dt.id_device_type

										WHERE d.id_device = $id_device";


								$objQuery1 = mysql_query($sql1);
								$objResult1 = mysql_fetch_array($objQuery1);
							?>

							<p>
								ชื่ออุปกรณ์ : <?=$objResult1['device_name']?> <br>
								Serial Number : <?=$objResult1['serial_number']?><br>
								หมวดหมู่อุปกรณ์ : <?=$objResult1['device_category_name']?><br>
								ประเภทอุปกรณ์ : <?=$objResult1['device_type_name']?>
							</p>
							<hr />
							<div class="table-responsive">
								<table class="table" id="All">
									<thead>
										<tr>
											<th  style="width:5%" id="widthTh1">#</th>
											<th style="width:15%">วันที่แจ้งซ่อม</th>
											<th style="width:15%">ชื่อผู้แจ้งซ่อม</th>
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
													LEFT JOIN admin a ON r.id_admin=a.id_admin
													WHERE dr.id_device = $id_device";


											$objQuery = mysql_query($sql);

											while($objResult = mysql_fetch_array($objQuery)){
												?>
												<tr>
													<th scope="row"><? echo $i; ?></th>
													<td><? echo $objResult['date_s'] ?></td>
													<td><? echo $objResult['user_display'] ?></td>
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
