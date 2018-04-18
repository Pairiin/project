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
			$user=$_SESSION['user_display'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Help Desk</title>
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
	?>

	<?php
	$strSQL = "SELECT *
							FROM satisfaction s
							LEFT JOIN user_status us ON s.id_user_status = us.id_user_status
							LEFT JOIN faculty f ON s.id_faculty = f.id_faculty
							LEFT JOIN department d ON s.id_department = d.id_department
							WHERE id_repair=$_REQUEST[id_repair]";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);

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
                        <form class="form-horizontal" name="frmMain" method="post" action="status_show.php">
                          <fieldset>
                            <legend>ส่วนที่ 1 ข้อมูลทั่วไป</legend>
														<div class="form-group">
															<label class="control-label col-md-3">สถานภาพ</label>
															<div class="col-md-9">
																<input type="text" class="form-control" name="user_status" value="<?=$objResult["name_user_status"];?>" style="width:20%;" disabled>
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-3">เพศ</label>
															<div class="col-md-9">
																<div class="radio-inline">
																	<label>
																		<input type="radio" name="gender" value=""
																			<? if($objResult['gender']=="ชาย"){ echo "checked ";}
																				else if($objResult['user_status']!=""){ echo "disabled"; }
																				?>>ชาย
																	</label>
																</div>
																<div class="radio-inline">
																	<label>
																		<input type="radio" name="gender" value=""
																			<? if($objResult['gender']=="หญิง"){ echo "checked ";}
																				else if($objResult['user_status']!=""){ echo "disabled"; }
																				?>>หญิง
																	</label>
																</div>
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-3">ระดับการศึกษา</label>
															<div class="col-md-9">
																<div class="radio-inline">
																	<label>
																		<input type="radio" name="education" value=""
																			<? if($objResult['education']=="ปวช"){ echo "checked ";}
																				else if($objResult['education']!=""){ echo "disabled"; }
																				?>>ปวช
																	</label>
																</div>
																<div class="radio-inline">
																	<label>
																		<input type="radio" name="education" value=""
																			<? if($objResult['education']=="ปริญญาตรี 2-3 ปี"){ echo "checked ";}
																				else if($objResult['education']!=""){ echo "disabled"; }
																				?>>ปริญญาตรี 2-3 ปี
																	</label>
																</div>
																<div class="radio-inline">
																	<label>
																		<input type="radio" name="education" value=""
																			<? if($objResult['education']=="ปริญญาตรี 4 ปี"){ echo "checked ";}
																				else if($objResult['education']!=""){ echo "disabled"; }
																				?>>ปริญญาตรี 4 ปี
																	</label>
																</div>
																<div class="radio-inline">
																	<label>
																		<input type="radio" name="education" value=""
																			<? if($objResult['education']=="ปริญญาโท/ ปริญญาเอก"){ echo "checked ";}
																				else if($objResult['education']!=""){ echo "disabled"; }
																				?>>ปริญญาโท/ ปริญญาเอก
																	</label>
																</div>
															</div>
														</div>

														<div class="form-group">
															<label class="control-label col-md-3" for="inputFaculty">คณะ</label>
															<div class="col-md-9">
																<input class="form-control" id="faculty" name="faculty" type="text" style="width:70%" value="<?=$objResult['faculty_name']?>" disabled>
															</div>
														</div>
														<div class="form-group">
															<label class="control-label col-md-3" for="inputDepartment">สาขา</label>
															<div class="col-md-9">
																<input class="form-control" id="department" name="department" type="text" style="width:70%" value="<?=$objResult['department_name_en']." - ".$objResult['department_name']?>" disabled>
															</div>
														</div>
														<br><br>

														<div class="col-md-12">
																<legend>ส่วนที่ 2 ระดับความพึงพอใจเกี่ยวกับการปรับปรุงและพัฒนาห้องบริการคอมพิวเตอร์</legend>

																<table class="table-responsive table-bordered" style="width:70%;" align="center">
																	<thead>
																		<tr>
																			<th rowspan="2" style="text-align:center;padding:20px 0px;width:50%">หัวข้อประเมิน</th>
																			<th style="text-align:center;">ระดับความพึงพอใจ</th>
																		</tr>
																	</thead>
																	<tbody>

																		<?php
																			//detail
																			$strSQL = "SELECT *
																									FROM satisfaction s
																									LEFT JOIN detail_satisfaction dt ON s.id_satisfaction=dt.id_satisfaction
																									LEFT JOIN question q ON dt.id_question=q.id_question
																									WHERE s.id_repair=$_REQUEST[id_repair]";
																			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
																			$Num_Rows = mysql_num_rows($objQuery);

																			$i=1;
																			while($result2 = mysql_fetch_array($objQuery)){
																			?>
																			<tr>
																				<td><?=$i.". ".$result2['question_name'];?></td>
																				<td width="70" align="center"><?=$result2['point']?></td>
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
																		<textarea class="form-control" id="textArea" rows="3" name="sugges" disabled><?=$objResult['sugges']?></textarea>
																</div>
															</div>
														</div>

														</fieldset>

														<div class="form-group">
															<label class="col-md-5 control-label"></label>
															<div class="col-md-5">
																<button type="submit" class="btn btn-info" >	กลับหน้าตรวจสอบสถานะ <span class="glyphicon glyphicon-send"></span></button>
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
