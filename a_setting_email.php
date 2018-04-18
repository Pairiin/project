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
            <h1><i class="fa fa-cogs fa-lg"></i> ตั้งค่า e-mail</h1>
          </div>
        </div>

				<!-- form add -->

				<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="row">
                <div class="col-lg-6">

                  <div class="well bs-component">

										<?php
											$strSQL = "SELECT *
																	FROM email";

											$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
											$objResult = mysql_fetch_array($objQuery);

										?>

                    <form action="a_setting_email_edit.php"  id="form"  class="form-horizontal" method="post">
                      <fieldset>
                        <legend>จัดการ e-mail</legend>

                        <div class="form-group">
                          <label class="col-lg-4 control-label"  for="serial_number">นาม e-mail</label>
                          <div class="col-lg-8">
                            <input class="form-control" name="email_name" id="email_name" type="text" value="<?=$objResult['email_name']?>" disabled >
                          </div>
                        </div>

												<div class="form-group">
                          <label class="col-lg-4 control-label">e-mail</label>
                          <div class="col-lg-8">
                            <input class="form-control" name="email" id="email" type="text" value="<?=$objResult['email']?>" disabled >
                          </div>
                        </div>

												<div class="form-group">
													<label class="col-lg-4 control-label">password email</label>
													<div class="col-lg-8 	">
														<input class="form-control" name="password" id="password" type="password" value="<?=$objResult['email_password']?>" disabled >
													</div>
												</div>

												<div class="form-group col-lg-8">
			                    <div class="checkbox">
			                      <label class="col-lg-12 control-label">
			                        <input  type="checkbox" onclick="showpassword()">Show Password
			                      </label>
			                    </div>
			                  </div>

                        <div class="form-group">
                          <div class="col-lg-10 col-lg-offset-4">
														<button class="btn btn-warning" type="submit">แก้ไข</button>

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
		function showpassword() {
			 var x = document.getElementById("password");
			 if (x.type === "password") {
					 x.type = "text";
			 } else {
					 x.type = "password";
			 }
	 }
		</script>
  </body>
</html>

<?php } ?>
