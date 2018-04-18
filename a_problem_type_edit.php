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
            <h1><i class="fa fa-wrench fa-lg"></i> จัดการประเภทปัญหา</h1>
          </div>
        </div>

				<!-- form -->

				<?php
				$sql="SELECT *
									FROM problem_type pt
									WHERE pt.id_problem_type = $_REQUEST[id] ";

					$objQuery = mysql_query($sql);
					$objResult = mysql_fetch_array($objQuery);
						?>

				<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="row">
                <div class="col-lg-6">

                  <div class="well bs-component">
                    <form action="a_problem_type_edit_process.php" id="form" class="form-horizontal" method="get">
                      <fieldset>
                        <legend>แก้ไขประเภทปัญหา</legend>
												<div class="form-group">
                          <label class="col-lg-4 control-label" for="textArea">ชื่อประเภทปัญหา</label>
                          <div class="col-lg-8">
														<input class="form-control" name="problem_type_name" id="problem_type_name" type="text" placeholder="ชื่อประเภทปัญหา" value="<?=$objResult['problem_type_name']?>" required>
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
					},
					messages: {
						problem_name: "กรุณากรอก รายละเอียดปัญหา",
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
