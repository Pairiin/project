<div class="tab-pane fade" id="profile">

<form action="<? echo "a_evalue2_process.php?id_detail=".$_REQUEST['id_detail'].""?>"method="POST" >

<div class="panel panel-info" >
		<div class="container-fluid" style="padding-top:10px;">

					<strong>การประเมินครั้งที่ 2 (สำหรับเจ้าหน้าที่)</strong>
					<br><br>
					<div class="table-responsive">
							<table class="table table-striped">
								<tr>
									<td width="20%"><strong>ปัญหา : </strong></td>
									<td width="30%">
										<select name="id_problem" class="form-control" id="id_problem" style="width:350px" <?if($objResult[id_status] == 4 || $objResult[id_status] == 5) {echo "disabled";}?>>
											<option value=""><-- กรุณาเลือก --></option>
												<?php
												$sql_problem = "SELECT * from problem";
												$obj_problem = mysql_query($sql_problem) or die ("Error Query [".$sql_problem."]");

												while($result_problem= mysql_fetch_array($obj_problem))
												{
													if($objResult["id_problem"] == $result_problem["id_problem"])
													{
														$sel_problem = "selected";
													}
													else
													{
														$sel_problem = "";
													}
												?>
												<option value="<?php echo $result_problem["id_problem"];?>" <?php echo $sel_problem;?>><?php echo $result_problem["id_problem"]." - ".$result_problem["problem_name"];?></option>
												<?php
												}
												?>
										</select>
									</td>
									<td width="50%"><a class="btn btn-info icon-btn" href="a_problem_insert.php?id_repair=<?=$objResult[id_repair]?>"><i class="fa fa-plus"></i>เพิ่มปัญหา</a></td>
							</tr>
							<tr>
								<td><strong>วิธีการแก้ไขปัญหา : </strong></td>
								<td colspan="2"><textarea name="solution" class="form-control" data-validation="required" style="height:140px;width:550px;"><?=$objResult['solution']?></textarea></td>
						</tr>
						<tr>
							<td><strong>ผลกระทบ : </strong></td>
							<td colspan="2"><textarea name="effect" class="form-control" data-validation="required" style="height:140px;width:550px;"><?=$objResult['effect']?></textarea></td>
						</tr>
						<tr>
							<td><strong>หมายเหตุ : </strong></td>
							<td colspan="2"><textarea name="description" class="form-control" data-validation="required" style="height:140px;width:550px;"><?=$objResult['description']?></textarea></td>
						</tr>

						<tr>
							<td width="20%"><strong>สถานะ : <br>(เมื่อดำเนินการเสร็จสิ้น)</strong></td>
							<td width="30%">
								<select name="id_status" class="form-control" id="id_status" style="width:350px" <?if($objResult[id_status] == 4 || $objResult[id_status] == 5) {echo "disabled";}?>>
									<option value=""><-- กรุณาเลือก --></option>
									<option value="4">สำเร็จ</option>
									<option value="5">ไม่สำเร็จ</option>
								</select>
							</td>
						</tr>
					</table>

				</div>

				</div>
			</div>
			<input type="hidden" name="user_email" value="<?=$objResult['user_email']?>">
			<input type="hidden" name="user_name" value="<?=$objResult['user_name']?>">
			<input type="hidden" name="user_lname" value="<?=$objResult['user_lname']?>">
			<center><button type="submit" class="btn btn-success btn-sm">บันทึกข้อมูล</button></a></center>
		</form>

		</div>
