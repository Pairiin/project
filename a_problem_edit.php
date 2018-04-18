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
    <title>Home</title>
		<?php include"a_inc_css.php";?>

		<script type="text/javascript" src="lib/jquery-1.11.1.js"></script>
		<script type="text/javascript" src="dist/jquery.validate.js"></script>
  </head>

  <body class="sidebar-mini fixed">
    <div class="wrapper">

			<?php include"connect.php";?>

			<!-- header -->
			<?php include"a_header.php";?>

      <!-- Side-Nav-->
			<?php include"a_side_nav.php";?>

			<div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-wrench fa-lg"></i> จัดการปัญหา</h1>
          </div>
        </div>

				<!-- form -->

				<?php
				$sql="SELECT *
									FROM problem p
									WHERE p.id_problem = $_REQUEST[id] ";

					$objQuery = mysql_query($sql);
					$objResult = mysql_fetch_array($objQuery);
						?>

				<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="row">
                <div class="col-lg-6">

                  <div class="well bs-component">
                    <form action="a_problem_edit_process.php" id="form" class="form-horizontal" method="get">
                      <fieldset>
                        <legend>แก้ไขปัญหา</legend>
												<div class="form-group">
                          <label class="col-lg-4 control-label" for="textArea"><font color="red">* </font>รายละเอียดปัญหา</label>
                          <div class="col-lg-8">
                            <textarea class="form-control" id="problem_name" rows="3" name="problem_name" required><?=$objResult['problem_name']?></textarea>
                          </div>
                        </div>

												<div class="form-group">
                          <label class="col-lg-4 control-label"><font color="red">* </font>ประเภทปัญหา</label>
                          <div class="col-lg-8">
														<select name="id_problem_type" class="form-control" id="problem_type">
					                      <?php
																$sql_problem_type = "SELECT *
																								FROM problem_type";
																$obj_problem_type = mysql_query($sql_problem_type) or die ("Error Query [".$sql_problem_type."]");


					                      while($result_problem_type= mysql_fetch_array($obj_problem_type))
					                      {
					                        if($result_problem_type["id_problem_type"] == $objResult["id_problem_type"])
					                        {
					                          $sel_problem_type = "selected";
					                        }
					                        else
					                        {
					                          $sel_problem_type = "";
					                        }
					                      ?>
					                      <option value="<?php echo $result_problem_type["id_problem_type"];?>" <?php echo $sel_problem_type;?>><?php echo $result_problem_type["id_problem_type"]." - ".$result_problem_type["problem_type_name"];?></option>
					                      <?php
					                      }
					                      ?>
					                  </select>
                          </div>
                        </div>

												<div class="form-group">
                          <label class="col-lg-4 control-label" for="textArea"><font color="red">* </font>วิธีแก้ปัญหาเบื้องต้น</label>
                          <div class="col-lg-8">
                            <textarea class="form-control" id="solution_problem" rows="3" name="solution_problem"><?=$objResult['solution_problem']?></textarea>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-10 col-lg-offset-4">
														<input type="hidden" name="id" value="<?=$_REQUEST['id'];?>">
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
    <!-- Javascripts-->
		<script type="text/javascript">
			$( document ).ready( function () {
				$( "#form" ).validate( {
					rules: {
						problem_name: "required",
						solution_problem: "required",
						problem_type: "required"
					},
					messages: {
						problem_name: "กรุณากรอก รายละเอียดปัญหา",
						solution_problem: "กรุณากรอก วิธีแก้ปัญหาเบื้องต้น",
						problem_type: "กรุณาเลือก ประเภทปัญหา"
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

    <!-- <script src="js/jquery-2.1.4.min.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/pace.min.js"></script>
    <script src="js/main.js"></script>

		<!-- Data table plugin-->
  </body>
</html>

<?php } ?>
