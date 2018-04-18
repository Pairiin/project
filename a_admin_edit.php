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
            <h1><i class="fa fa-wrench fa-lg"></i> จัดการผู้ดูแลระบบ</h1>
          </div>
        </div>

				<!-- form add -->

				<div class="row">
          <div class="col-md-12">
            <div class="card">

							<?php
								$sql_admin = "SELECT *
														FROM admin
														WHERE id_admin = $_REQUEST[id_admin]";
								$objQuery = mysql_query($sql);
								$objResult = mysql_fetch_array($objQuery);
							?>

							<form action="a_admin_edit_process.php" id="form" class="form-horizontal" method="post">
								<fieldset>
									<legend>แก้ไขประวัติส่วนตัว</legend>

									<div class="form-group">
										<label class="col-md-2 control-label"><font color = "red">* </font>ชื่อ</label>
										<div class="col-md-4">
											<input class="form-control" name="admin_name" id="admin_name" type="text" placeholder="กรุณากรอกชื่อ" value="<?=$objResult['admin_name']?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label"><font color = "red">* </font>นามสกุล</label>
										<div class="col-md-4">
											<input class="form-control" name="admin_lname" id="admin_lname" type="text" placeholder="กรุณากรอกนามสกุล" value="<?=$objResult['admin_lname']?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">เบอร์โทรศัพท์</label>
										<div class="col-md-4">
											<input class="form-control" name="admin_phone" id="admin_phone" type="text" placeholder="0999999999" value="<?=$objResult['admin_phone']?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label">e-mail</label>
										<div class="col-md-4">
											<input class="form-control" name="admin_email" id="admin_email" type="text" placeholder="e-mail@hotmail.com" value="<?=$objResult['admin_email']?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label"><font color = "red">* </font>Username</label>
										<div class="col-md-4">
											<input class="form-control" name="username" id="username" type="text" placeholder="กรุณากรอก username" value="<?=$objResult['username']?>">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label"><font color = "red">* </font>Password</label>
										<div class="col-md-4">
											<input class="form-control" name="password" id="password" type="password" placeholder="กรุณากรอก password">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-2 control-label"><font color = "red">* </font>ยืนยัน Password</label>
										<div class="col-md-4">
											<input class="form-control" name="confirm_password" id="confirm_password" type="password" placeholder="กรุณากรอกยืนยัน password">
										</div>
									</div>

									<div class="form-group">
										<div class="col-md-4 col-md-offset-2">
											<input type="hidden" name="id_admin" value="<?=$_REQUEST['id_admin'];?>">
											<button class="btn btn-primary" type="submit">Submit</button>
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

		<?php include"a_inc_js.php";?>

		<script type="text/javascript">

		//ให้ password เป็นค่าเดียวกับ username------------------------
		// $('#username').change(function(event) {
		// 	var val = $('#username').val();
		// 	$('#password').val(val);
		// });

			$( document ).ready( function () {
				$( "#form" ).validate( {
					rules: {
						admin_name: "required",
						admin_lname: "required",
						admin_phone: {
							minlength: 10,
							maxlength: 10,
							number:true
						},
						admin_email: {
							email: true
						},
						username: {
							required: true,
							minlength: 5
						},
						password: {
							required: true,
							minlength: 6
						},
						confirm_password: {
							required: true,
							minlength: 6,
							equalTo: "#password"
						}
					},
					messages: {
						admin_name: "กรุณากรอกชื่อ",
						admin_lname: "กรุณากรอกนามสกุล",
						admin_phone: {
							minlength: "กรุณากรอกเบอร์โทรศัพท์ 10 ตัวเลข",
							maxlength: "กรุณากรอกเบอร์โทรศัพท์ 10 ตัวเลข",
							number: "กรุณากรอกเบอร์โทรศัพท์เป็นตัวเลข"
						},
						admin_email: "กรุณากรอก email",
						username: {
							required: "กรุณากรอก username",
							minlength: "กรุณากรอก username อย่างน้อย 5 ตัวอักษร"
						},
						password: {
							required: "กรุณากรอก Password",
							minlength: "กรุณากรอก Password อย่างน้อย 6 ตัวอักษร"
						},
						confirm_password: {
							required: "กรุณากรอกยืนยัน Password",
							minlength: "กรุณากรอกยืนยัน Password อย่างน้อย 6 ตัวอักษร",
							equalTo: "กรุณากรอกให้ตรงกับ Password"
						}
					},
					errorElement: "em",
					errorPlacement: function ( error, element ) {
						// Add the `help-block` class to the error element
						error.addClass( "help-block" );

						// Add `has-feedback` class to the parent div.form-group
						// in order to add icons to inputs
						element.parents( ".col-md-4" ).addClass( "has-feedback" );

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
						$( element ).parents( ".col-md-4" ).addClass( "has-error" ).removeClass( "has-success" );
						$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
					},
					unhighlight: function ( element, errorClass, validClass ) {
						$( element ).parents( ".col-md-4" ).addClass( "has-success" ).removeClass( "has-error" );
						$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
					}
				} );
			} );
		</script>


  </body>
</html>

<?php } ?>
