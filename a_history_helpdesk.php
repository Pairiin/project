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
            <h1><i class="fa fa-wrench fa-lg"></i> ประวัติการแจ้งซ่อม</h1>
          </div>
        </div>

				<!-- การซ่อมทั้งหมด -->

				<div class="row">
					<div class="col-md-12">
						<div class="card">

								<div class="bs-component">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#sr" data-toggle="tab">ค้นหา Serial Number</a></li>
										<li><a href="#user" data-toggle="tab">ค้นหา ชื่อผู้แจ้ง</a></li>
									</ul>
									<div class="tab-content" id="myTabContent">

										<!-- ค้นหา Serial Number -->
										<div class="tab-pane fade active in" id="sr">

											<br>
											<div class="table-responsive">
												<table class="table" id="serial_number">
													<thead>
														<tr>
									            <th  style="width:5%" id="widthTh1">#</th>
									            <th style="width:20%">serial number</th>
									            <th style="width:25%">ชื่ออุปกรณ์</th>
				                      <th style="width:15%">หมวดหมู่อุปรณ์</th>
									            <th style="width:15%">ประเภทอุปกรณ์</th>
				                      <th style="text-align: center;width:14%">ประวัติการซ่อม</th>

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
																		<a href="a_history_serial_detail.php?id_device=<?=$objResult['id_device'];?>">ประวัติการซ่อม</a>

				                          </td>
				                        </tr>
																<?} ?>
													</tbody>
												</table>
											</div>

										</div>

										<!-- ค้นหา ชื่อผู้ใช้ -->
										<div class="tab-pane fade" id="user">
											<br>
											<div class="table-responsive">
												<table class="table" id="user_hd">
													<thead>
														<tr>
									            <th  style="width:5%" id="widthTh1">#</th>
									            <th style="width:20%">ชื่อผู้แจ้ง</th>
									            <th style="width:25%">สถานะ</th>
															<th style="width:25%">จำนวนที่แจ้งซ่อม</th>
				                      <th style="text-align: center;width:14%">ประวัติการซ่อม</th>

									          </tr>
													</thead>
													<tbody>
														<?php
														$i = 1;
														$sql_user="SELECT * , COUNT(user_display) AS count_user
																					FROM repair r
																					INNER JOIN user_status us ON r.id_user_status = us.id_user_status
																					GROUP BY user_display";

															$objQuery_user = mysql_query($sql_user);
															while($objResult_user = mysql_fetch_array($objQuery_user)){
																?>
																<tr>
																	<th scope="row"><?=$i ?></th>
																	<td><?=$objResult_user[user_display] ?></td>
																	<td><?=$objResult_user[name_user_status] ?></td>
																	<td><?=$objResult_user[count_user] ?></td>
				                          <td align="center">
																		<a href="a_history_user_detail.php?user_display=<?=$objResult_user['user_display'];?>">ประวัติการซ่อม</a>

				                          </td>
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
				</div>

      </div>
    </div>

		<!-- Javascripts-->
		<?php include"a_inc_js.php";?>

		<!-- Data table plugin-->
		<script type="text/javascript" charset="utf-8">
				$('#serial_number').DataTable({

					"oLanguage": {
            "sSearch": "ค้นหา Serial Number :"
          },

				"aoColumns": [
					{"bSearchable": false},
					{"bSearchable": true},
					{"bSearchable": false},
					{"bSearchable": false},
					{"bSearchable": false},
					{"bSearchable": false}
				]
				});


				$('#user_hd').DataTable({
					"oLanguage": {
            "sSearch": "ค้นหา ชื่อผู้แจ้ง :"
          },

				"aoColumns": [
					{"bSearchable": false},
					{"bSearchable": true},
					{"bSearchable": false},
					{"bSearchable": false},
					{"bSearchable": false}
				]
				});
		</script>


		<!-- script manual-->
		<?php include"a_inc_script.php";?>

  </body>
</html>

<?php } ?>
