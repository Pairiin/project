<div class="tab-pane fade active in" id="home">

<form action="<? echo "a_evalue1_process.php?id_detail=".$_REQUEST[id_detail].""?>"method="POST" >

<div class="panel panel-info" >
		<div class="container-fluid" style="padding-top:10px;">

          <strong>การประเมินครั้งที่ 1 (สำหรับเจ้าหน้าที่)</strong>
          <br><br>
          <div class="table-responsive">
							<table class="table table-striped">
                <tr>
                  <td style="width: 35%;"><strong>สถานะการรับงาน :</strong></td>
                  <td colspan="2">
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="get_job" value="1"
                            <? if($objResult['status_evalue']==""){ echo "checked"; }
                              else if($objResult['status_evalue']=="รับ"){ echo "checked ";}
                              else if($objResult['status_evalue']!="" || $objResult[id_status] == 8){ echo "disabled"; }
                              ?>>
                            <span class="label-text">รับงาน</span>
                        </label>
                      </div>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="get_job" value="2"
                            <? if($objResult['status_evalue']=="ไม่รับ"){ echo "checked "; }
                              else if($objResult['status_evalue']!="" || $objResult[id_status] == 8){ echo "disabled"; }
                              ?>>
                            <span class="label-text">ไม่รับงาน</span>
                        </label>
                      </div>
                    </div>
                </td>
              </tr>
              <tr>
                <td><strong>เจ้าหน้าที่ ที่ประเมิน :</strong></td>
                <td colspan="2">
                  <select name="id_admin" class="form-control" id="id_admin" style="width:200px"
										<?if($objResult[id_status] == 4 || $objResult[id_status] == 5 ||$objResult[id_status] == 6 || $objResult[id_status] == 8) {echo "disabled";}?>>

										<option value=""><-- กรุณาเลือก --></option>

											<?php
                      $sql_admin = "SELECT *
                                    FROM admin";
                      $obj_admin = mysql_query($sql_admin) or die ("Error Query [".$sql_admin."]");
                      while($result_admin= mysql_fetch_array($obj_admin))
                      {
                        if($objResult["id_admin"] == $result_admin["id_admin"])
                        {
                          $sel_admin = "selected";
                        }
                        else
                        {
                          $sel_admin = "";
                        }
                      ?>
                      <option value="<?php echo $result_admin["id_admin"];?>" <?php echo $sel_admin;?>><?php echo $result_admin["id_admin"]." - ".$result_admin["admin_name"]." ".$result_admin["admin_lname"];?></option>
                      <?php
                      }
                      ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td><strong>วันที่ประเมินอาการ :</strong></td>
                <td colspan="2">
                    <div class="input-group date">
                        <input type="text" name="date_evalue" class="datepicker form-control" id="datepicker1" data-date-format="dd/mm/yyyy" style="width:200px"
												<?if($objResult[id_status] == 4 || $objResult[id_status] == 5 ||$objResult[id_status] == 6 || $objResult[id_status] == 8) {echo "disabled";}?>>
                    </div>

                </td>
              </tr>
              <tr>
                <td><strong>วันที่คาดว่าจะเสร็จ :</strong></td>
                <td colspan="2">

                    <div class="input-group date">
                        <input type="text" name="date_comple" class="datepicker form-control" id="datepicker2" data-date-format="dd/mm/yyyy" style="width:200px"
												<?if($objResult[id_status] == 4 || $objResult[id_status] == 5 ||$objResult[id_status] == 6 || $objResult[id_status] == 8) {echo "disabled";}?> >
                    </div>

                </td>
              </tr>
              <tr>
                <td width="20%"><strong>หมายเลขอุปกรณ์ :</strong></td>
                <td width="30%">
                  <select name="id_device" class="form-control" id="id_device" style="width:300px"
										<?if($objResult[id_status] == 4 || $objResult[id_status] == 5 ||$objResult[id_status] == 6 || $objResult[id_status] == 8) {echo "disabled";}?>>

										<option value=""><-- กรุณาเลือก --></option>
                      <?php

                      $sql_device = "SELECT *
                                    FROM device
																		ORDER BY serial_number,device_name ASC";
                      $obj_device = mysql_query($sql_device) or die ("Error Query [".$sql_device."]");
                      while($result_device= mysql_fetch_array($obj_device))
                      {
                        if($objResult["id_device"] == $result_device["id_device"])
                        {
                          $sel_device = "selected";
                        }
                        else
                        {
                          $sel_device = "";
                        }
                      ?>
                      <option value="<?php echo $result_device["id_device"];?>" <?php echo $sel_device;?>><?php echo $result_device["serial_number"]." - ".$result_device["device_name"];?></option>
                      <?php
                      }
                      ?>
                  </select>
                </td>
                <td width="50%">
									<a class="btn btn-info icon-btn" href="a_device_insert.php?id_detail=<?=$objResult[id_detail]?>"
										<?if($objResult[id_status] == 4 || $objResult[id_status] == 5 ||$objResult[id_status] == 6 || $objResult[id_status] == 8) {echo "disabled";}?>>
										<i class="fa fa-plus"></i>เพิ่มอุปกรณ์</a>

								</td>
            </tr>
            <tr>
              <td><strong>หมายเหตุ  :<br> (กรณีไม่รับงาน) </strong></td>
              <td colspan="2"><textarea name="description" class="form-control" data-validation="required" style="height:100px;width:550px;"
								<?if($objResult[id_status] == 4 || $objResult[id_status] == 5 ||$objResult[id_status] == 6 || $objResult[id_status] == 8) {echo "disabled";}?>>
								<?php  echo $result_evalue1['note'];?></textarea></td>
            </tr>
          </table>

        </div>


        </div>
      </div>
      <center><button type="submit" class="btn btn-success btn-sm"
				<?if($objResult[id_status] == 4 || $objResult[id_status] == 5 ||$objResult[id_status] == 6 || $objResult[id_status] == 8) {echo "disabled";}?>>
				บันทึกข้อมูล</button></center>
      </form>
    </div>
