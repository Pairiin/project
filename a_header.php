<!-- Navbar-->
<header class="main-header hidden-print">
  <a class="logo" style="font-size: 0px;" href="a_admin.php">
    <img alt="Brand" src="./images/rws_logo.png" height="40px">
  </a>
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button--><a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
    <!-- Navbar Right Menu-->
    <div class="navbar-custom-menu">
      <ul class="top-nav">

        <!-- User Menu-->
        <?php

        $sql="SELECT *
            FROM admin
            WHERE username = '$_SESSION[user_admin] ' AND password = '$_SESSION[pass_admin]'";

        $objQuery = mysql_query($sql);
				$objResult = mysql_fetch_array($objQuery);
        $name_admin =  $objResult[admin_name]."  ".$objResult[admin_lname];

        ?>
        <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu">
            <li><a href="a_admin_edit.php?id_admin=<?=$objResult[id_admin];?>"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
        <font color="white"><?php echo $name_admin;?></font>

      </ul>
    </div>
  </nav>
</header>
