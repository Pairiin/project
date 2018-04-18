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
			<?
			$sql_status = "SELECT *
										FROM status
										ORDER BY id_status ASC";
			$obj_status = mysql_query($sql_status) or die ("Error Query [".$sql_status."]");
			?>
			<form action="<? echo "a_report_status_process.php"?>" method="GET">
      <div class="content-wrapper">
				<div class="page-title">
          <div>
            <h1><i class="fa fa-bar-chart fa-lg"></i>รายงานสรุปการซ่อมตามสถานะ</h1>
          </div>
        </div>
          <div class="bs-component">
						<div class="panel panel-info" >
								<div class="container-fluid" style="padding-top:10px;">

						          <strong>กรุณาเลือกรายการที่ต้องการ </strong>
						          <br><br>
						          <div class="table-responsive">
													<table class="table table-striped">
						              <tr>
						                <td><strong>ข้อมูลวันที่ :</strong></td>
						                <td colspan="2">
						                    <div class="input-group date">
						                        <input type="text" name="date_start" class="datepicker form-control" id="datepicker1" data-date-format="dd/mm/yyyy" style="width:200px">
						                    </div>
						                </td>
						                <td><strong>ถึง:</strong></td>
						                <td colspan="2">
						                    <div class="input-group date">
						                        <input type="text" name="date_end" class="datepicker form-control" id="datepicker2" data-date-format="dd/mm/yyyy" style="width:200px">
						                    </div>
						                </td>
						              </tr>
													<tr>
						                <td width="20%"><strong>สถานะ :</strong></td>
						                <td width="30%">
						                  <select name="id_status" class="form-control" id="id_status" type="hidden" style="width:300px">
						                    <option value=""><-- กรุณาเลือก --></option>
						                      <?php
						                      while($result_status= mysql_fetch_array($obj_status))
						                      {

						                      ?>
						                      <option value="<?php echo $result_status["id_status"];?>"><?php echo $result_status["status_name"];?></option>
						                      <?php
						                      }
						                      ?>
						                  </select>
						                </td>
						            </tr>
						          </table>
						        </div>
						        </div>
									</div>
						<center><button type="submit" class="btn btn-success btn-sm">ค้นหารายงาน</button></center>
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
