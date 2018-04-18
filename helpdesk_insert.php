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
		$user_display = $_SESSION['user_display']; //ชื่อ-สกุล
		$firstname_en = $_SESSION["firstname_en"]; //ชื่ออังกฤษ
		$lname_en = $_SESSION["lname_en"]; //นามสกุลอังกฤษ
		$email = $_SESSION["email"]; //email
		$account_type = $_SESSION["account_type"]; //ประเภท

		$phone = $_SESSION['phone'];
		$room = $_SESSION['room'];
		$class = $_SESSION['class'];
		$building = $_SESSION['building'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Help Desk KMUTNB</title>
		<?php include"inc_css.php";?>
	</head>

<body style="background-color:#E0EEEE">

	<?php include"connect.php"; ?><!-- connect database -->
	<?php include"header.php"; ?>
	<?php include"function.php";?><!-- function-->

		<div class="container" style="padding-top:10px;">

			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="bs-component">

							<ul class="nav nav-tabs nav-justified">
								<li class="active"><a href="#" >ใบแจ้งซ่อม - ข้อมูลพื้นฐาน</a></li>
								<?if($phone!=null) {echo "<li><a href='helpdesk2_insert.php'>ใบแจ้งซ่อม - ข้อมูลการแจ้งซ่อม</a></li>" ;}?>
							</ul>
							<br>

							<div class="tab-content" id="myTabContent">
									<form id="form" class="form-horizontal" action="helpdesk2_insert.php" method="POST">

		 			 				<fieldset>

		 				 				<div class="form-group">
		 				 			  <label class="col-md-4 control-label">ชื่อผู้แจ้ง</label>
			 				 				<div class="col-md-4 inputGroupContainer">
												 <!-- ชื่อ-สกุลไทย -->
			 				 					<input type="hidden" name="user_name" value="<?=$user_display?>">

			 			 						<!-- ////////////////detail name///////////////////// -->

			 				 					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			 				 					  <div class="panel panel-default">
			 				 					    <div class="panel-heading" role="tab" id="headingOne">
			 				 					      <h4 class="panel-title">
			 				 					        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#detail_user" aria-expanded="false" aria-controls="detail_user">
			 				 					          <?=$user_display?>
			 				 					        </a>
			 				 					      </h4>
			 				 					    </div>
			 				 					    <div id="detail_user" class="panel-collapse collapse" role="tabpanel">
			 				 					      <div class="panel-body">
			 				 									Name : <?=$firstname_en." ".$lname_en?><br>
			 				 									E-Mail : <?=$email?><br>
			 				 									Acount Type : <?=$account_type?>
			 				 					      </div>
			 				 					    </div>
			 				 					  </div>
			 				 					</div>

			 			 					<!-- /////////////////////////////////////////// -->
			 				 				</div>
			 				 			</div>


			 							<!-- Text input email-->
			 				 			<div class="form-group">
			 				 				<label class="col-md-4 control-label"><font color="red">* </font>E-Mail</label>
			 				 				<div class="col-md-4 inputGroupContainer">
			 				 						 <input type="email" name="email" class="form-control" placeholder="email@xxxx.com" value="<?=$email?>">
			 				 				</div>
			 				 			</div>

			 							<!-- Text input phone-->
			 				 			<div class="form-group">
			 				 			  <label class="col-md-4 control-label"><font color="red">* </font>เบอร์โทรศัพท์ที่ติดต่อได้/เบอร์โทรศัพท์ภายใน</label>
			 				 		    <div class="col-md-4 inputGroupContainer">
			 				 			  		<input name="phone" placeholder="08xxxxxxxx" class="form-control" type="text" value="<?=$phone?>">
			 				 		  	</div>
			 				 			</div>

			 							<!---->
			 				 			<div class="form-group">
			 				 				<label class="col-md-4 control-label">สถานที่ตั้งคอมพิวเตอร์/อุปกรณ์</label>
			 				 			</div>

			 							<!-- Text input room-->
			 							<div class="form-group">
			 								<label class="col-md-4 control-label">ห้อง</label>
			 								<div class="col-md-4 inputGroupContainer">
			 										<input name="room" placeholder="" class="form-control" type="text" value="<?=$room?>">
			 								</div>
			 							</div>

			 							<!-- Text input class-->
			 							<div class="form-group">
			 								<label class="col-md-4 control-label">ชั้น</label>
			 								<div class="col-md-4 inputGroupContainer">
			 										<input name="class" placeholder="" class="form-control" type="text" value="<?=$class?>">
			 								</div>
			 							</div>

			 							<!-- Text input building-->
			 							<div class="form-group">
			 								<label class="col-md-4 control-label">อาคาร</label>
			 								<div class="col-md-8 inputGroupContainer">
			 										<input name="building" placeholder="" class="form-control" type="text" value="<?=$building?>">
			 								</div>
			 							</div>

			 							<div class="form-group">
			 								<label class="col-md-4 control-label"></label>
			 								<div class="col-md-4">
			 									<button type="submit" class="btn btn-success" >	บันทึกข้อมูล <span class="glyphicon glyphicon-send"></span></button>
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

	<!-- Javascripts-->
	<?php include"inc_js.php";?>

	<script type="text/javascript">
		$( document ).ready( function () {
			$( "#form" ).validate( {
				rules: {
					phone: {
						required: true,
						number: true,
						minlength: 3,
						maxlength: 10
					},
					email: {
						required: true,
						email: true
					}
				},
				messages: {
					phone: {
						required: "กรุณากรอกเบอร์โทรศัพท์",
						number: "กรุณากรอกเฉพาะตัวเลข",
						minlength: "กรุณากรอกเบอร์โทรศัพท์",
						maxlength: "ความยาวห้ามเกิน 10 ตัวอักษร"
					},
					email: {
						required: "กรุณากรอก e-mail",
						email: "กรุณากรอก e-mail"
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
