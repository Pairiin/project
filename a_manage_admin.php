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
            <h1><i class="fa fa-wrench fa-lg"></i>จัดการผู้ดูแลระบบ</h1>
          </div>
        </div>
				<!-- การซ่อมทั้งหมด -->

				<div class="row">
					<div class="col-md-12">
						<div class="card">

              <div class="card-title-w-btn">
                <h3 class="title">ผู้ดูแลระบบทั้งหมด</h3>
                <p><a class="btn btn-info icon-btn" href="a_admin_insert.php"><i class="fa fa-plus"></i>เพิ่มผู้ดูแลระบบ</a></p>
              </div>

							<div class="table-responsive">
								<table class="table" id="All">
									<thead>
										<tr>
					            <th  style="width:5%" id="widthTh1">#</th>
					            <th style="width:25%">ชื่อ-นามสกุล</th>
					            <th style="width:15%">เบอร์โทร</th>
                      <th style="width:20%">e-mail</th>
					            <th style="width:15%">username</th>
                      <th style="width:7%;text-align:center">ลบ</th>
					          </tr>
									</thead>
									<tbody>
										<?php
                    $i = 1;
										$sql="SELECT *
                              FROM admin a";

											$objQuery = mysql_query($sql);
											while($objResult = mysql_fetch_array($objQuery)){
												?>
												<tr>
													<th scope="row"><? echo $i; ?></th>
													<td><? echo $objResult['admin_name']." ".$objResult['admin_lname'] ?></td>
													<td><? echo $objResult['admin_phone'] ?></td>
													<td><? echo $objResult['admin_email'] ?></td>
                          <td><? echo $objResult['username'] ?></td>
                          <td align="center">
														<div class="btn-group">
															<a class="btn btn-sm btn-danger btnDelete" data-target="btnDelete" href="a_admin_delete_process.php?id_admin=<?=$objResult['id_admin'];?>"><i class="glyphicon glyphicon-trash"></i></a>
														</div>

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

		<!-- Javascripts-->
		<?php include"a_inc_js.php";?>

		<!-- Data table plugin-->
		<script type="text/javascript">$('#All').DataTable();</script>

		<!-- script manual-->
		<?php include"a_inc_script.php";?>

  </body>
</html>

<?php } ?>
