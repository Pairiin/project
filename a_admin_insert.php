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
              <div class="row">
                <div class="col-lg-6">

                  <div class="well bs-component">
										<!-- a_device_insert_process.php -->
                    <form action="a_admin_insert_process.php"  id="form"  class="form-horizontal" method="post">
                      <fieldset>
                        <legend>เพิ่มผู้ดูแลระบบ</legend>

                        <div class="form-group">
                          <label class="col-lg-4 control-label"><font color = "red">* </font>ชื่อ</label>
                          <div class="col-lg-8">
                            <input class="form-control" name="admin_name" id="admin_name" type="text" placeholder="กรุณากรอกชื่อ">
                          </div>
                        </div>

												<div class="form-group">
                          <label class="col-lg-4 control-label"><font color = "red">* </font>นามสกุล</label>
                          <div class="col-lg-8">
                            <input class="form-control" name="admin_lname" id="admin_lname" type="text" placeholder="กรุณากรอกนามสกุล">
                          </div>
                        </div>

												<div class="form-group">
                          <label class="col-lg-4 control-label"><font color = "red"></font>เบอร์โทรศัพท์</label>
                          <div class="col-lg-8">
                            <input class="form-control" name="admin_phone" id="admin_phone" type="text" placeholder="099999999">
                          </div>
                        </div>

												<div class="form-group">
                          <label class="col-lg-4 control-label"><font color = "red"></font>email</label>
                          <div class="col-lg-8">
                            <input class="form-control" name="admin_email" id="admin_email" type="text" placeholder="xxxx@xxxx.com">
                          </div>
                        </div>

												<div class="form-group">
                          <label class="col-lg-4 control-label"><font color = "red">* </font>Username</label>
                          <div class="col-lg-8">
                            <input class="form-control" name="username" id="username" type="text" placeholder="กรุณากรอก Username">
                          </div>
                        </div>

												<div class="form-group">
                          <label class="col-lg-4 control-label"><font color = "red">* </font>Password</label>
                          <div class="col-lg-8">
                            <input class="form-control" name="password" id="password" type="password" placeholder="กรุณากรอก Password">
                          </div>
                        </div>

												<div class="form-group">
                          <label class="col-lg-4 control-label"><font color = "red">* </font>ยืนยัน Password</label>
                          <div class="col-lg-8">
                            <input class="form-control" name="confirm_password" id="confirm_password" type="password" placeholder="กรุณากรอกยืนยัน Password">
                          </div>
                        </div>


                        <div class="form-group">
                          <div class="col-lg-10 col-lg-offset-4">
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

      </div>
    </div>

		<?php include"a_inc_js.php";?>

		<script type="text/javascript">
			$( document ).ready( function () {
				$( "#form" ).validate( {
					rules: {
						admin_name: "required",
						admin_lname: "required",
						admin_phone: {
							number: true,
							minlength: 3,
							maxlength: 10
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
							number: "กรุณากรอกเฉพาะตัวเลข",
							minlength: "กรุณากรอกเบอร์โทรศัพท์",
							maxlength: "หความยาวห้ามเกิน 10 ตัวอักษร"
						},
						admin_email: "กรุณากรอก email",
						username: {
							required: "กรุณากรอก username",
							minlength: "ความยาวอย่างน้อย 5 ตัวอักษร"
						},
						password: {
							required: "กรุณากรอก password",
							minlength: "กรุณากรอก Password อย่างน้อย 6 ตัวอักษร"
						},
						confirm_password: {
							required: "กรุณากรอก ยืนยัน password",
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
