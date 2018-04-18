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
    <?php include"a_inc_css.php";?>

		<script src="js/jquery-2.1.4.min.js"></script>

	 	<script>
			 $(document).ready(function () {
				 $('#datepicker1').datepicker({
						 format: 'dd/mm/yyyy',
						 todayBtn: true,
						 language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
						 thaiyear: true              //Set เป็นปี พ.ศ.
				 }).datepicker("setDate", "0");  //กำหนดเป็นวันปัจุบัน

				 $('#datepicker2').datepicker({
						 format: 'dd/mm/yyyy',
						 todayBtn: true,
						 language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
						 thaiyear: true              //Set เป็นปี พ.ศ.
				 }).datepicker("setDate", "0");
			});
	 </script>

  <title>Home</title>
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
            <h1><i class="fa fa-wrench fa-lg"></i> รายละเอียดการแจ้งซ่อม</h1>
          </div>
          <div>
            <ul class="breadcrumb">
              <li><a href="a_admin.php"><i class="fa fa-home fa-lg"></i></a></li>
              <li><a href="#">รายละเอียดการแจ้งซ่อม</a></li>
            </ul>
          </div>
        </div>
			    <div class="panel panel-info" >
			    <!-- Default panel contents -->
			    <div class="panel-heading">ข้อมูลการแจ้งซ่อมของผู้รับบริการ</div>
			    <!-- Table -->
				    <div class="container-fluid" style="padding-top:10px;">

							<?php
								$strSQL = "SELECT *
														FROM repair r
														LEFT JOIN detail_repair dt ON r.id_repair=dt.id_repair
														LEFT JOIN status s ON dt.id_status=s.id_status
														LEFT JOIN admin a ON r.id_admin=a.id_admin
														LEFT JOIN device d ON dt.id_device=d.id_device
														WHERE dt.id_detail = '$_REQUEST[id_detail]'";

								$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
								$objResult = mysql_fetch_array($objQuery);

							?>
							<div class="col-md-10">
								<strong>รหัสการแจ้งซ่อม : <?=$objResult["id_repair"]?></strong><br>

								<strong>สถานะการแจ้งซ่อม : <?=$objResult["status_name"]?></strong><br>
							</div>
							<div class="col-md-2" style="padding:10px 10px">
								<?php
									if($objResult['id_status'] == 1 && $objResult[id_status]==""){
										echo "<a class='btn btn-sm btn-danger btnCencel' data-target='btnCencel' href='a_evalue_cencel_process.php?id_detail=<?=$objResult[id_detail];?>' style='align:right;' <i class='fa fa-times'></i> ยกเลิกใบแจ้งซ่อม</a> ";
									}
								?>
							</div>
							<br><br><br>
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
									<td style="width:20%;"><strong>สถานที่ตั้งอุปกรณ์ ห้อง : </strong></td>
									<td style="width:15%;"><?=$objResult["room"]?></td>
									<td style="width:10%;"><strong>ชั้น : </strong></td>
									<td style="width:10%;"><?=$objResult["class"]?></td>
									<td style="width:10%;"><strong>อาคาร : </strong></td>
									<td style="width:10%;"><?=$objResult["building"]?></td>
								</tr>
								<tr>
				          <td><strong>รูปภาพ : </strong></td>
				          <td colspan="5">
										<a class="fancybox" rel="gallery1" data-fancybox data-type="image" href="./upload/<?php echo $objResult['image']; ?>" rel="lightbox"><img src="upload/<?php echo $objResult['image']; ?>" border="0" alt=""  width="100px" /></a>
									</td>

								</tr>
				      </table>

							<br>
							<strong>ช่องทางการติดต่อ</strong>
							<br><br>

							<table class="table table-striped">
				        <tr>
				          <td><strong>เบอร์โทร : </strong></td>
				          <td><?=$objResult["user_phone"]?></td>
				          <td><strong>e-mail : </strong></td>
				          <td><?=$objResult["user_email"]?></td>
									<td></td>
				          <td></td>
				        </tr>
				      </table>

				    	</div>
						</div>
			  	</div>

					<!-- ////////////////////////////////////////// -->

          <div class="bs-component">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab">การประเมินครั้งที่ 1</a></li>
              <li class="<? if($objResult[id_status] == 1 || $objResult[id_status] == 6 || $objResult[id_status] == 8 || $objResult[id_status]=="") { echo 'hide'; }?>" ><a href="#profile" data-toggle="tab">การประเมินครั้งที่ 2</a></li>
            </ul>

						<div class="tab-content" id="nav-tabContent">


						<?php include"a_evalue1.php";?>
            <!-- //////////////////////////// -->
						<?php include"a_evalue2.php";?>


            </div>
          </div>

        </div>
			</div>



			<?php include"a_inc_js.php";?>

			<script type="text/javascript">
				$(document).ready(function () {
					<?php
					function dateToBE_script($date){
						list($y,$m,$d)=explode('-',$date);
						if($y!=""){
						 return ($d.'/'.$m.'/'.$y);
					 }else {
						 return ("");
					 }
					}
					?>

					var date_complet='<?php echo dateToBE_script($objResult['date_comple']);?>'
					var date_evalue='<?php echo dateToBE_script($objResult['date_evalue']);?>'

					console.log(date_evalue)
						if(date_evalue!=""){
							$('#datepicker1').datepicker("setDate",date_evalue)
						}

					console.log(date_complet)
						if(date_complet!=""){
							$('#datepicker2').datepicker("setDate",date_complet)
						}
					});

					$('.btnCencel').click(function(event) {
						var a = $(this);
						var url = a.prop( 'href' );
						event.preventDefault()
						swal({
							title: "ต้องการยกเลิกใบแจ้งซ่อม?",
							text: "",
							type: "warning",
							showCancelButton: true,
							confirmButtonClass: "btn-danger",
							confirmButtonText: "ใช่, ต้องการยกเลิก!",
							closeOnConfirm: false
						},
						function(){
							window.location.href=url
						});
						});


				</script>

  </body>
</html>

<?php } ?>
