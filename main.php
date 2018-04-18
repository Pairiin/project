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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Help Desk KMUTNB</title>
	  <?php include"inc_css.php";?>
</head>


<body style="background-color:#E0EEEE">
  <?php
  include"connect.php";
	include"header.php";
	include"function.php";
	?>

    <div class="container" style="padding-top:10px;">

			<?php $c_AllHelpdesk =
							"SELECT COUNT(id_detail)
							AS AllHelpDesk
							FROM detail_repair
							WHERE id_status!=4 AND id_status!=5 AND id_status!=6";

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

				 <?php include"table_allHelpdesk.php";?>

       </div>

    </div>

    <?php include"inc_js.php";?>

</body>
</html>


<?php } ?>
