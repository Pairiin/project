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
  <?php include"connect.php"; ?><!-- connect database -->
  <?php include"function.php";?><!-- function-->

  <!-- header -->
  <nav class="navbar-default">
    <div class="container" style="">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1" aria-expanded="false">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
          <img alt="Brand" src="./images/rws_logo.png" height="25px">
        </a>
      </div>

      <div class="collapse navbar-collapse" id="navbar1">
        <ul class="nav navbar-nav">
            <li>
              <a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <!-- <li>
              <a class="nav-link" href="help_desk.php"><i class="fa fa-pencil" aria-hidden="true"></i> แจ้งซ่อม</a>
            </li> -->
            <!-- <li>
              <a class="nav-link" href="#"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ปัญหาที่พบบ่อย</a>
            </li> -->
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a style="padding-top:15px;color:#fff;">ถ้าต้องการแจ้งซ่อม กรุณา </a>
          <li data-toggle="modal" data-target=".bs-example-modal-lg"><a href="#"><i class="fa fa-sign-in"></i> Login</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!--close header -->

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

     <div class="row">
       <div class="container">
         <div class="alert alert-warning" role="alert">
           link ไม่สามารถใช้งานได้ เนื่องจาก หมดอายุ หรือ ถูกใช้งานแล้ว หากสงสัยกรุณาติดต่อเจ้าหน้าที่สำนักคอมพิวเตอร์
         </div>
       </div>


      </div>
    </div>

    <?php include "inc_js.php";?>


</body>
</html>
