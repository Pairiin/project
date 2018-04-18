<?php
	session_start();
	if($_SESSION['user_display'] == "")
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
		<?php include"inc_script.php";?>

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
	?>

	<div class="container" style="padding-top:10px;">
		 <div class="row">
			 <div class="col-md-12">
				 <div class="card">

					 <div class="panel panel-info" >
						 <div class="panel-heading">สถานะการแจ้งซ่อมของคุณ</div>
						 <div class="card">

						 <div class="bs-component">
							 <ul class="nav nav-tabs">
								 <li><a href="detail_repair.php">รายละเอียด</a></li>
								 <li class="active"><a href="#">การประเมินครั้งที่ 1</a></li>
								 <li><a href="#profile">การประเมินครั้งที่ 2</a></li>

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

								<div class="table-responsive">
								<strong>การประเมินครั้งที่ 1 (สำหรับเจ้าหน้าที่)</strong>
								<br><br>

								<table class="table table-striped">
					        <tr>
										<td><strong>เจ้าหน้าที่ ที่รับงาน : </strong></td>
					          <td><?=$objResult["admin_name"]?></td>
					          <td><strong>วันที่ประเมิน : </strong></td>
					          <td><?=$objResult["date_evalua"]?></td>
					          <td><strong>วันที่คาดว่าจะเสร็จ : </strong></td>
					          <td><?=$objResult["date_comple"]?></td>
					        </tr>
									<tr>
										<td><strong>หมายเลขอุปกรณ์ : </strong></td>
					          <td colspan="5"><?=$objResult["admin_name"]?></td>
					        </tr>
									<tr>
										<td><strong>หมายเหตุ : </strong></td>
					          <td colspan="5"><?=$objResult["note"]?></td>
					        </tr>
					      </table>
								</div>

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

		<script src="fancybox-master/jquery.fancybox.min.js"></script>

		<script type="text/javascript">

		</script>

</body>
</html>

<?php } ?>
