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
		$user=$_SESSION['user_admin'];
?>
<!DOCTYPE html>
<html>
  <head>
		<title>Report</title>
    <?php include"a_inc_css.php";?>
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins/pace.min.js"></script>
		<script src="js/plugins/jquery-ui.custom.min.js"></script>
		<script src="js/main.js"></script>

		<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="fancybox-master/jquery.fancybox.min.css">

	 		<link href="dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	   	 <script src="dist/js/bootstrap-datepicker-custom.js"></script>
	   	 <script src="dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>

			 <? function dateFormatDB($date){
        		$dateArr = explode("/",$date);
        		return ($dateArr[2]-543)."-".$dateArr[1]."-".$dateArr[0];
        	} ?>
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
	<?
	$date_start=dateFormatDB($_REQUEST['date_start']);
	$date_end=dateFormatDB($_REQUEST['date_end']);
	$id_status=$_REQUEST['id_status']; ?>

  <body class="sidebar-mini fixed">
    <div class="wrapper">
			<?php include"connect.php";?>
			<!-- header -->
			<?php include"a_header.php";?>
      <!-- Side-Nav-->
			<?php include"a_side_nav.php";?>
			<?php
			function dateToBE($date){
				list($y,$m,$d)=explode('-',$date);
				if($y!=""){
				 $y += 543;
				 return ($d.'/'.$m.'/'.$y);
			 }else {
				 return ("");
			 }
			}
			?>
      <div class="content-wrapper">
				<div class="page-title">
          <div>
            <h1><i class="fa fa-bar-chart fa-lg"></i>รายงานสรุปงานซ่อมตามสถานะ</h1>
          </div>
        </div>
          <div class="bs-component">
						<div class="panel panel-info" >
								<div class="container-fluid" style="padding-top:10px;">
						          <div class="table-responsive">
                        <table width="100%"  class="table table-bordered table-striped table-hover table-condensed">
                          <tr>
                            <td width="20%" height="32" align="center"><strong>ข้อมูลระหว่างวันที่ :  </strong>
                             <? echo $_GET[date_start] ."  ถึง  ". $_GET[date_end] ?></td>
                            </tr>
                          </table>
                          <table width="100%"  class="table table-bordered table-striped table-hover table-condensed">
                            <tr>
															<td width="1%" height="32" align="center"><strong>ลำดับ</strong></td>
                              <td width="7%" height="32" align="center"><strong>รหัสการซ่อม</strong></td>
                              <td width="7%" height="32" align="center"><strong>ชื่อผู้แจ้ง</strong></td>
                              <td width="7%" height="32" align="center"><strong>วันที่แจ้งซ่อม</strong></td>
                              <td width="7%" height="32" align="center"><strong>ชื่ออุปกรณ์</strong></td>
                              <td width="7%" height="32" align="center"><strong>ปัญหา</strong></td>
                              <td width="7%" height="32" align="center"><strong>ประเภทอุปกรณ์</strong></td>
                              <td width="7%" height="32" align="center"><strong>สถานะการซ่อม</strong></td>
                            </tr>

                            <?php
                            $sql="SELECT * FROM REPAIR INNER JOIN detail_repair ON repair.id_repair = detail_repair.id_repair INNER JOIN status ON detail_repair.id_status=status.id_status INNER JOIN device ON detail_repair.id_device = device.id_device INNER JOIN device_type ON device.id_device_type=device_type.id_device_type WHERE date_s BETWEEN '$date_start' AND '$date_end' AND detail_repair.id_status='$id_status'";
                            $result = mysql_query($sql);
                            $num1=mysql_num_rows($result);
														if($num1<=0){
															?>
															 <script>
																	setTimeout(function() {
																			swal({
																					title: "ไม่พบข้อมูลที่ต้องการ!!",
																					text: "คลิกปุ่ม \"OK\" เพื่อรับทราบ",
																					type: "warning",
																					confirmButtonText: "OK"
																			}, function() {
																					window.location = "a_report_status.php";
																			}, 1000);
																	});
															</script>
														 <?
														}
														$i = 1;
                            while($objResult =mysql_fetch_array($result)){;
                             ?>
                              <tr>
															<td align="center"><?php echo $i; ?></td>
                              <td align="center"><?php echo $objResult[id_repair]; ?></td>
                              <td align="center"><?php echo $objResult[user_name]; ?></td>
                              <td align="center"><?php echo dateToBE($objResult[date_s]); ?></td>
                              <td align="center"><?php echo $objResult[device_name]; ?></td>
                              <td align="center"><?php echo $objResult[problem]; ?></td>
                              <td align="center"><?php echo $objResult[device_type_name]; ?></td>
                              <td align="center"><?php echo $objResult[status_name]; ?></td>
                            <? $i+=1; }?>

                              <!-- // echo "<script>alert('ไม่พบข้อมูลที่ต้องตรวจ!');history.back();</script>";
                              // exit(); -->
                          </table>
						        </div>
						        </div>
									</div>
						<center><a class="btn btn-info" href="a_print_status.php?date_start=<? echo $_REQUEST['date_start'];?>&date_end=<? echo $_REQUEST['date_end'];?>&id_status=<? echo $id_status;?>" target="_blank">รายงาน</a>
						<a class="btn btn-success" href="a_chartpie_status.php?date_start=<? echo $_REQUEST['date_start'];?>&date_end=<? echo $_REQUEST['date_end'];?>&id_status=<? echo $id_status;?>" >กราฟ</a></center>

          </div>
        </div>
			</form>
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

								$('#btnCencel').click(function(){

									swal({
									  title: "ต้องการยกเลิกใบแจ้งซ่อม",
									  type: "warning",
									  showCancelButton: true,
										confirmButtonText: "ใช่!",
										cancelButtonText: "ไม่!",
										closeOnConfirm: false
									},
									function(isConfirm) {
									  if (isConfirm) {
									    swal("Deleted!", "Your imaginary file has been deleted.", "success");
											$.ajax({
													 url:"ajaxEvalue.php",
													 method:"GET",
													 data:{id:<?php echo $_REQUEST['id_detail']; ?>},
													 success:function(data)
													 {
														 	setTimeout(function(){
																window.location.reload()
															},2000)


													 }
											});

									  } else {
									    swal("Cancelled", "Your imaginary file is safe :)", "error");
									  }
									});

								});

							// 	$(document).ready(function(){
				     //      $('#btnCencel').click(function(){
				     //           $.ajax({
				     //                url:"ajaxEvalue.php",
				     //                method:"GET",
				     //                data:{id:<?php// echo $_REQUEST['id_detail']; ?>},
				     //                success:function(data)
				     //                {
				     //                     alert(data);
             //
				     //                }
				     //           });
             //
				     //      });
				     // });
							</script>

							<?php// $sql_detail ="UPDATE detail_repair SET id_status='8' where id_detail=".$_REQUEST[id_detail]."";	?>
							<?php //$objQuery_detail = mysql_query($sql_detail);?>

  </body>
</html>

<?php } ?>
