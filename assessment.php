<?php
	session_start();
	if($_SESSION['username'] == "")
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
	  <?php include"inc_css.php";?>
</head>

<style>
	th {
		background-color: #d9edf7;
	}
</style>



<body style="background-color:#E0EEEE">
	<?php
	include"connect.php";
	include"header.php";
	include"function.php";
	?>

    <div class="container" style="padding-top:10px;">

       <div class="row">
				 <div class="col-md-12">
					   <div class="card">
					     <legend style="text-align:center;">แบบประเมินความพึงพอใจการให้บริการฝ่ายเทคโนโลยีสารสนเทศ
							 <h4 style="text-align:center;">สำนักคอมพิวเตอร์และเทคโนโลยีสารสนเทศ ฝ่ายเทคโนโลยีสารสนเทศ วิทยาเขตปราจีนบุรี</h4></legend><br>
               <p style="text-align:center;"><strong>คำชี้แจง : </strong>แบบสอบถามนี้จัดทำขึ้นเพื่อการวัดความพึงพอใจในการให้บริการของสำนักคอมพิวเตอร์และเทคโนโลยีสารสนเทศ<br>
                  เพื่อนำมาใช้ในการปรับปรุงหาแนวทางพัฒนาการให้บริการ ให้มีประสิทธิภาพยิ่งขึ้น โดยการใส่เครื่องหมาย <i class="fa fa-check-circle-o" aria-hidden="true"></i> ที่ตรงกับความพึงพอใจของท่าน </p>

                  <br>
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="bs-component">
                        <form class="form-horizontal" name="frmMain" method="post" action="assessment_process.php">
                          <fieldset>
                            <legend>ส่วนที่ 1 ข้อมูลทั่วไป</legend>
														<div class="form-group">
															<label class="control-label col-md-3">สถานภาพ</label>
															<div class="col-md-9">
																<input type="text" class="form-control" name="user_status" value="<?=$_SESSION["account_type"];?>" style="width:20%;" disabled>
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-3">เพศ</label>
															<div class="col-md-9">
																<div class="radio-inline">
																	<label>
																		<input type="radio" name="gender" value="ชาย" id="rdo_gender_0">ชาย
																	</label>
																</div>
																<div class="radio-inline">
																	<label>
																		<input type="radio" name="gender" value="หญิง" id="rdo_gender_1">หญิง
																	</label>
																</div>
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-3">ระดับการศึกษา</label>
															<div class="col-md-9">
																<div class="radio-inline">
																	<label>
																		<input type="radio" name="education" value="ปวช" id="rdo_edu_1">ปวช
																	</label>
																</div>
																<div class="radio-inline">
																	<label>
																		<input type="radio" name="education" value="ปริญญาตรี 2-3 ปี" id="rdo_edu_2">ปริญญาตรี 2-3 ปี
																	</label>
																</div>
																<div class="radio-inline">
																	<label>
																		<input type="radio" name="education" value="ปริญญาตรี 4 ปี" id="rdo_edu_3">ปริญญาตรี 4 ปี
																	</label>
																</div>
																<div class="radio-inline">
																	<label>
																		<input type="radio" name="education" value="ปริญญาโท/ ปริญญาเอก" id="rdo_edu_4">ปริญญาโท/ ปริญญาเอก
																	</label>
																</div>
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-3" for="inputEmail">คณะ</label>
															<div class="col-md-9">
																<select class="form-control" id="faculty" name="faculty" style="width:70%;">
								                  <optgroup label="เลือกคณะ">
																		<option>-- กรุณาเลือกคณะ --</option>
																		<?php
							                      $sql_faculty = "SELECT *
							                                      FROM faculty";
							                      $obj_faculty = mysql_query($sql_faculty) or die ("Error Query [".$sql_faculty."]");

							                      while($result_faculty= mysql_fetch_array($obj_faculty))
							                      {
																			?>
																			<option value="<?php echo $result_faculty["id_faculty"];?>"><?php echo $result_faculty["id_faculty"]." - ".$result_faculty["faculty_name"];?></option>
							                      <?}?>

								                  </optgroup>
								                </select>
															</div>
														</div>


														<div class="form-group">
															<label class="control-label col-md-3" for="inputEmail">สาขา</label>
															<div class="col-md-9">
																<select class="form-control" id="faculty" name="department" style="width:70%;">
																	<optgroup label="เลือกสาขาวิชา">
																		<option>-- กรุณาเลือกสาขาวิชา --</option>
																		<?php
																		$sql_department = "SELECT *
																										FROM department";
																		$obj_department = mysql_query($sql_department) or die ("Error Query [".$sql_department."]");

																		while($result_department= mysql_fetch_array($obj_department))
																		{
																			?>
																			<option value="<?php echo $result_department["id_department"];?>"><?php echo $result_department["id_department"]." - ".$result_department["department_name_en"]." - ".$result_department["department_name"];?></option>
																		<?}?>

																	</optgroup>
																</select>
															</div>
														</div>
														<br><br>

														<div class="col-md-12">
																<legend>ส่วนที่ 2 ระดับความพึงพอใจเกี่ยวกับการปรับปรุงและพัฒนาห้องบริการคอมพิวเตอร์</legend>

																<table class="table-responsive table-bordered" style="width:70%;" align="center">
																	<thead>
																		<tr>
																			<th rowspan="2" style="text-align:center;padding:20px 0px;width:50%">หัวข้อประเมิน</th>
																			<th colspan="5" style="text-align:center;">ระดับความพึงพอใจ</th>
																		</tr>
																		<tr>
																			<th style="text-align:center;">มากที่สุด</th>
																			<th style="text-align:center;">มาก</th>
																			<th style="text-align:center;">ปานกลาง</th>
																			<th style="text-align:center;">น้อย</th>
																			<th style="text-align:center;">น้อยที่สุด</th>
																		</tr>
																	</thead>
																	<tbody>

																		<?php
																			$strSQL = "select * from question ";
																			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
																			$Num_Rows = mysql_num_rows($objQuery);

																			$i=1;
																			while($result2 = mysql_fetch_array($objQuery))
																			{
																		?>
																		<tr>
																			<td><?=$i.". ".$result2['question_name'];?></td>
																			<td width="70" align="center"><input name="point<?=$i;?>" id="point<?=$i;?>_1" type="radio" value="5"></td>
																			<td width="63" align="center"><input name="point<?=$i;?>" id="point<?=$i;?>_2" type="radio" value="4"></td>
																			<td width="71" align="center"><input name="point<?=$i;?>" id="point<?=$i;?>_3" type="radio" value="3"></td>
																			<td width="65" align="center"><input name="point<?=$i;?>" id="point<?=$i;?>_4" type="radio" value="2"></td>
																			<td width="81" align="center"><input name="point<?=$i;?>" id="point<?=$i;?>_5" type="radio" value="1"></td>
																		</tr>
																		<?
																			$i++;
																			}

																		 ?>
																	</tbody>
									              </table>
																<br>

																<div class="form-group">
																	<label class="col-md-3 control-label" for="textArea">ข้อเสนอแนะ</label>
																	<div class="col-md-7">
																		<textarea class="form-control" id="textArea" rows="3" name="sugges"></textarea>
																</div>
															</div>
														</div>

														</fieldset>

														<input type="hidden" name="id_repair" value="<?=$_REQUEST[id_repair];?>">

														<div class="form-group">
							 								<label class="col-md-5 control-label"></label>
							 								<div class="col-md-5">
							 									<button type="submit" class="btn btn-success" >	บันทึกข้อมูล <span class="glyphicon glyphicon-send"></span></button>
							 								</div>
							 							</div>
													</form>

                        </div>
                      </div> <!--row-->
                    </div> <!--card-->



					   </div>
					 </div>

				 </div>
       </div>
			</div>


			<!-- Javascripts-->
	    <script src="js/jquery-2.1.4.min.js"></script>
	    <script src="js/bootstrap.min.js"></script>
	    <script src="js/plugins/pace.min.js"></script>
	    <script src="js/main.js"></script>

	    <!-- Data table plugin-->


</body>
</html>
<?php } ?>
