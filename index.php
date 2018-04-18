<?php session_start();?>

<!DOCTYPE html>
<html>
<head>
    <title>Help Desk KMUTNB</title>
	  <?php include"inc_css.php";?>
</head>

<style>
/* The Modal (background) */
.modal {
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe; /*color block*/
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 40%; /* Could be more or less, depending on screen size */
}

body{
  background-color:#E0EEEE;
}

.navbar-default{
  background-color:#1E90FF;
}

img {
  height:40px;
}

.navbar-brand{
  padding: 5px 5px;
}

</style>

<body>
  <?php
    include"connect.php";
  	include"header.php";
  	include"function.php";
  	?>



  <!-- modal login -->
  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Login</h3>
        </div>
        <form action="login_process.php" method="post">
          <div class="modal-body">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username"  style="height:40px;margin:8px 0px;" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" style="height:40px;margin:8px 0px;">
            </div>
          </div>
          <div class="modal-footer">
              <input type="submit" class="btn btn-info" value="Login" />
              <button class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--close modal login -->

  <div class="container" style="padding-top:10px;">
    <?php if($_REQUEST['id'] == "fail") {?>
      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Invalid User ID or Password. Please try again.</strong>
      </div>
    <?php }if($_REQUEST['id'] == "login") {?>
      <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Please Login!</strong>
      </div>
     <?php }   ?>
     <?php $c_AllHelpdesk =
             "SELECT COUNT(id_detail)
             AS AllHelpDesk
             FROM detail_repair
             WHERE id_status!=4 AND id_status!=5 AND id_status!=6 AND id_status != 8";

           $objQuery_AllHelpdesk = mysql_query($c_AllHelpdesk);

           $objResult_AllHelpdesk = mysql_fetch_array($objQuery_AllHelpdesk);
           ?>

     <div class="row">

       <div class="col-md-3" style="width: 360px;">
         <div class="widget-small warning coloured-icon" style="height:45px;width:350px;"><i class="icon fa fa-cubes fa-2x"></i>
           <div class="warning" style="padding:0px 0px 0px 10px">
             <h4>งานที่กำลังดำเนินการซ่อม&nbsp;&nbsp;<?=$objResult_AllHelpdesk[AllHelpDesk]?></h4>
           </div>
         </div>
       </div>

       <!-- table help_desk -->
       <?php include "table_allHelpdesk.php";?>
      </div>
    </div>

    <?php include "inc_js.php";?>

    <script>
			$(document).ready(function() {
				$("#widthTh1").click();

			});
		</script>

</body>
</html>
