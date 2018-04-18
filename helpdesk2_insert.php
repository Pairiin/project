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
		// $firstname_en = $_SESSION["firstname_en"]; //ชื่ออังกฤษ
		// $lname_en = $_SESSION["lname_en"]; //นามสกุลอังกฤษ
		$email = $_SESSION["email"]; //email
		$account_type = $_SESSION["account_type"]; //ประเภท

	 	$_SESSION['phone']=$_REQUEST['phone'];
	 	$_SESSION['room']=$_REQUEST['room'];
	 	$_SESSION['class']=$_REQUEST['class'];
	 	$_SESSION['building']=$_REQUEST['building'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Help Desk KMUTNB</title>
		<?php include"inc_css.php";?>

	</head>

<body style="background-color:#E0EEEE">
	<?php
  include"connect.php";
	include"header.php";
  ?>

	<div class="container" style="padding-top:10px;">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="bs-component">

						<ul class="nav nav-tabs nav-justified">
							<li><a href="helpdesk_insert.php" >ใบแจ้งซ่อม - ข้อมูลพื้นฐาน</a></li>
							<li class="active"><a href="#">ใบแจ้งซ่อม - ข้อมูลการแจ้งซ่อม</a></li>
						</ul>

					 <form action="helpdesk_process.php" method="POST"
								enctype="multipart/form-data"   id="app">
							<input type="hidden" name="id_status" value="1">

						 <div class="row"  v-for="(row, index) in rows">
							 <div class="col-md-4">
								 <p><b>ชื่ออุปกรณ์</b></p>
								 <div class="toggle">
										 <input name="name_device[]" v-model="row.name_device" placeholder="ยี่ห้อ/รุ่น" class="form-control" type="text" data-validation="required">
								 </div>
							 </div>
							 <div class="col-md-4">
								 <p><b>อาการ/ปัญหา</b></p>
								 <div class="toggle">
	 				 						<textarea name="problem[]" v-model="row.problem" placeholder="รายละเอียดปัญหา เช่น คอมพิวเตอร์ติดไวรัส" class="form-control" data-validation="required"></textarea>
								 </div>
							 </div>
							 <div class="col-md-2">
								 <p><b>รูปภาพ</b></p>
								 <div class="toggle">
	 				 					<input type="file" name="filUpload[]" accept=".jpg,.jpeg,.png">
	 				     			<p class="help-block">แนบรูปภาพอาการที่เกิดขึ้น</p>
								 </div>
							 </div>
							 <div class="col-md-2">
								 <button type="button" class="btn btn-danger" v-on:click="removeElement(index);" style="cursor: pointer" title="ลบ">	<i class="fa fa-close" aria-hidden="true"></i></button>
							 </div>
						</div>

						<br>
						<div class="row">
						 <div class="form-group">
							 <label class="col-md-4 control-label"></label>
							 <div class="col-md-4">
								 <button type="button" class="btn btn-info" v-on:click="addRow()" >	<i class="fa fa-plus" aria-hidden="true"></i>เพิ่มอุปกรณ์</button>
								 <button type="submit" class="btn btn-success" >	ส่งใบแจ้งซ่อม <span class="glyphicon glyphicon-send"></span></button>
							 </div>
						 </div>
			 	 		</div>
	 				</form>

	 			</div>
	 		</div>
		</div>

	<?php include"inc_js.php";?>

	<script>
	var app = new Vue({
			el: "#app",
			data: {
					rows: [{
							name_device: "",
							problem: "",
							filUpload: ""
					}]
			},
			methods: {
					addRow: function() {
							this.rows.push({
									name_device: "",
									problem: "",
									filUpload: ""
							});
					},
					removeElement: function(index) {
							this.rows.splice(index, 1);
					},
					setFilename: function(event, row) {
							var file = event.target.files[0];
							row.file = file
					}
			}
	});

	</script>

</body>
</html>

<?php } ?>
