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
            <h1><i class="fa fa-wrench fa-lg"></i> จัดการอุปกรณ์</h1>
          </div>
        </div>

				<!-- การซ่อมทั้งหมด -->

				<div class="row">
					<div class="col-md-12">
						<div class="card">

              <div class="card-title-w-btn">
                <h3 class="title">อุปกณ์ทั้งหมด</h3>
                <p><a class="btn btn-info icon-btn" href="a_device_insert.php"><i class="fa fa-plus"></i>เพิ่มอุปกรณ์</a></p>
              </div>

							<div class="table-responsive">
								<table class="table" id="All">
									<thead>
										<tr>
					            <th  style="width:5%" id="widthTh1">#</th>
					            <th style="width:20%">serial number</th>
					            <th style="width:25%">ชื่ออุปกรณ์</th>
                      <th style="width:15%">หมวดหมู่อุปรณ์</th>
					            <th style="width:15%">ประเภทอุปกรณ์</th>
                      <th style="text-align: center;width:14%">จัดการอุปกรณ์</th>

					          </tr>
									</thead>
									<tbody>
										<?php
										$sql_device="SELECT *
                              FROM device d
                              INNER JOIN device_category dc ON d.id_device_category = dc.id_device_category
                              INNER JOIN device_type dt ON d.id_device_type = dt.id_device_type";

											$objQuery = mysql_query($sql_device);
											while($objResult = mysql_fetch_array($objQuery)){
												?>
												<tr>
													<th scope="row"><?=$objResult[id_device] ?></th>
													<td><?=$objResult[serial_number] ?></td>
													<td><?=$objResult[device_name] ?></td>
													<td><?=$objResult[device_category_name] ?></td>
                          <td><?=$objResult[device_type_name] ?></td>
                          <td align="center">
														<div class="btn-group">
															<a class="btn btn-info" href="a_device_edit.php?id=<?=$objResult['id_device'];?>" style="padding:8px 15px"><i class="fa fa-lg fa-edit"></i></a>
															<a class="btn btn-danger btnDelete" data-target="btnDelete" href="a_device_delete_process.php?id=<?=$objResult['id_device'];?>" style="padding:8px 15px"x><i class="fa fa-lg fa-trash"></i></a>
														</div>

                          </td>
                        </tr>
												<?} ?>
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
		<script type="text/javascript">$('#All').DataTable();</script>

		<!-- script manual-->
		<?php include"a_inc_script.php";?>

  </body>
</html>

<?php } ?>
