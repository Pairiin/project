<style>
.navbar-brand{
  padding: 5px 5px;
}
a{
   cursor:  pointer;
}
</style>

<!-- header -->
<nav class="navbar-default" style="background-color:#1E90FF">
  <div class="container" style="">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1" aria-expanded="false">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">
        <img alt="Brand" src="./images/rws_logo.png" height="40px" >
      </a>
    </div>

    <div class="collapse navbar-collapse" id="navbar1">
      <ul class="nav navbar-nav">
          <li>
            <a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a>
          </li>
          <li <?php if($_SESSION['username'] == ""){echo "class=hide";}?>>
            <a class="nav-link" href="helpdesk_insert.php"><i class="fa fa-pencil" aria-hidden="true"></i> กรอกใบแจ้งซ่อม</a>
          </li>
          <li <?php if($_SESSION['username'] == ""){echo "class=hide";}?>>
            <a class="nav-link" href="status_show.php"><i class="fa fa-check-square-o" aria-hidden="true"></i> ตรวจสอบสถานะ</a>
          </li>
          <li>
            <a class="nav-link" href="faq.php"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ปัญหาที่พบบ่อย</a>
          </li>
      </ul>

      <ul class="nav navbar-nav navbar-right <?php if($_SESSION['username'] != ""){echo 'hide';}?>">
        <li><a style="padding-top:15px;color:#fff;">ถ้าต้องการแจ้งซ่อม กรุณา </a>
        <li data-toggle="modal" data-target=".bs-example-modal-lg"><a href="#"><i class="fa fa-sign-in"></i> Login</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right <?php if($_SESSION['username'] == ""){echo 'hide';}?>" >
        <li>
          <a style="padding-top:15px;color:#fff;"><strong><?=$_SESSION['user_display']?></strong></a>
        </li>
        <li><a href="logout.php"><i class="fa fa-sign-in"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>


<!--close header -->
