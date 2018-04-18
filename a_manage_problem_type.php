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
            <h1><i class="fa fa-wrench fa-lg"></i> จัดการประเภทปัญหา</h1>
          </div>
        </div>

				<!-- การซ่อมทั้งหมด -->

				<div class="row">
					<div class="col-md-12">
						<div class="card">

              <div class="card-title-w-btn">
                <h3 class="title">ประเภทปัญหาทั้งหมด</h3>
                <p><a class="btn btn-info icon-btn" href="a_problem_type_insert.php"><i class="fa fa-plus"></i>เพิ่มประเภทปัญหา</a></p>
              </div>

							<div class="table-responsive">
								<table class="table" id="All">
									<thead>
										<tr>
					            <th id="widthTh1">#</th>
					            <th width="72%">ชื่อประเภทปัญหา</th>
											<th style="text-align:center">จัดการประเภทปัญหา</th>
					          </tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										$sql_problem="SELECT *
                              FROM problem_type pt";


											$objQuery = mysql_query($sql_problem);
											while($objResult = mysql_fetch_array($objQuery)){
												?>
												<tr>
													<th><?=$i;?></th>
													<td><?=$objResult['problem_type_name'];?></td>
													<td align="center">
														<div class="btn-group">
															<a class="btn btn-info" href="a_problem_type_edit.php?id=<?=$objResult['id_problem_type'];?>" style="padding:8px 15px"><i class="fa fa-lg fa-edit"></i></a>
														</div>

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

		<!-- Javascripts-->
		<?php include"a_inc_js.php";?>

		<!-- Data table plugin-->
		<script type="text/javascript">$('#All').DataTable();</script>

		<!-- script manual-->
		<?php include"a_inc_script.php";?>

  </body>
</html>

<?php } ?>
