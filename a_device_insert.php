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
            <h1><i class="fa fa-wrench fa-lg"></i> จัดการอุปกรณ์</h1>
          </div>
        </div>

				<!-- form add -->

				<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="row">
                <div class="col-lg-6">

                  <div class="well bs-component">



                    <form action="a_device_insert_process.php"  id="form"  class="form-horizontal" method="post">
                      <fieldset>
                        <legend>เพิ่มอุปกรณ์</legend>

                        <div class="form-group">
                          <label class="col-lg-4 control-label"  for="serial_number"><font color = "red">* </font>Serial Number</label>
                          <div class="col-lg-8">
                            <input class="form-control" name="serial_number" id="serial_number" type="text" placeholder="XXXXXXX">
                          </div>
                        </div>

												<div class="form-group">
                          <label class="col-lg-4 control-label"><font color = "red">* </font>ชื่ออุปกรณ์</label>
                          <div class="col-lg-8">
                            <input class="form-control" name="device_name" id="device_name" type="text" placeholder="ชื่อรุ่น/ยี่ห้อ">
                          </div>
                        </div>
												<div class="form-group">
                          <label class="col-lg-4 control-label"><font color = "red">* </font>หมวดหมู่อุปกรณ์</label>
                          <div class="col-lg-8">
														<select name="device_category" class="form-control" id="device_category" title="กรุณาเลือก หมวดหมู่อุปกรณ์!" required>
					                    <option value=""><-- กรุณาเลือก --></option>
					                      <?php
					                      $sql_device_category = "SELECT *
					                                      FROM device_category";
					                      $obj_device_category = mysql_query($sql_device_category) or die ("Error Query [".$sql_device_category."]");

					                      while($result_device_category= mysql_fetch_array($obj_device_category))
					                      {
																	?>
																	<option value="<?php echo $result_device_category["id_device_category"];?>"><?php echo $result_device_category["id_device_category"]." - ".$result_device_category["device_category_name"];?></option>
					                      <?}?>
					                  </select>
                          </div>
                        </div>
												<div class="form-group">
                          <label class="col-lg-4 control-label"><font color = "red">* </font>ประเภทอุปกรณ์</label>
                          <div class="col-lg-8">
														<select name="device_type" class="form-control" id="device_type" title="กรุณาเลือก ประเภทอุปกรณ์!" required>
					                    <option value=""><-- กรุณาเลือก --></option>
					                      <?php
					                      $sql_device_type = "SELECT *
					                                      FROM device_type";
					                      $obj_device_type = mysql_query($sql_device_type) or die ("Error Query [".$sql_device_type."]");

					                      while($result_device_type= mysql_fetch_array($obj_device_type))
					                      {
																	?>
																	<option value="<?php echo $result_device_type["id_device_type"];?>"><?php echo $result_device_type["id_device_type"]." - ".$result_device_type["device_type_name"];?></option>
					                      <?}?>
					                  </select>
													</div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-10 col-lg-offset-4">
														<?
															if($_REQUEST[id_detail]!=""){
																echo "<input type='hidden' name='id_detail' value='$_REQUEST[id_detail]'>";
															}
														?>
														<button class="btn btn-info" type="submit">Submit</button>
                            <button class="btn btn-default" type="reset">Cancel</button>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                  </div>
                </div>

              </div>
            </div>
          </div>
			</div>

      </div>
    </div>

		<?php include"a_inc_js.php";?>

		<script type="text/javascript">
			$( document ).ready( function () {
				$( "#form" ).validate( {
					rules: {
						serial_number: "required",
						device_name: "required",
						device_category: "required",
						device_type: "required"
					},
					messages: {
						serial_number: "กรุณากรอก serial number",
						device_name: "กรุณากรอก ชื่ออุปกรณ์",
						device_category: "กรุณากรอก หมวดหมู่อุปกรณ์",
						device_type: "กรุณากรอก ประเภทอุปกรณ"
					},
					errorElement: "em",
					errorPlacement: function ( error, element ) {
						// Add the `help-block` class to the error element
						error.addClass( "help-block" );

						// Add `has-feedback` class to the parent div.form-group
						// in order to add icons to inputs
						element.parents( ".col-lg-8" ).addClass( "has-feedback" );

						if ( element.prop( "type" ) === "checkbox" ) {
							error.insertAfter( element.parent( "label" ) );
						} else {
							error.insertAfter( element );
						}

						// Add the span element, if doesn't exists, and apply the icon classes to it.
						if ( !element.next( "span" )[ 0 ] ) {
							$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
						}
					},
					success: function ( label, element ) {
						// Add the span element, if doesn't exists, and apply the icon classes to it.
						if ( !$( element ).next( "span" )[ 0 ] ) {
							$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
						}
					},
					highlight: function ( element, errorClass, validClass ) {
						$( element ).parents( ".col-lg-8" ).addClass( "has-error" ).removeClass( "has-success" );
						$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
					},
					unhighlight: function ( element, errorClass, validClass ) {
						$( element ).parents( ".col-lg-8" ).addClass( "has-success" ).removeClass( "has-error" );
						$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
					}
				} );

			} );
		</script>
  </body>
</html>

<?php } ?>
