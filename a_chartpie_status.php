<?php
 include"a_inc_css.php";
 include"connect.php";
 include"a_header.php";
 include"a_side_nav.php";

 function dateFormatDB($date){
      $dateArr = explode("/",$date);
      return ($dateArr[2]-543)."-".$dateArr[1]."-".$dateArr[0];
    }

 $date_start=dateFormatDB($_REQUEST['date_start']);
 $date_end=dateFormatDB($_REQUEST['date_end']);
 $id_status=$_REQUEST['id_status'];

 $query= "SELECT status_name, count(detail_repair.id_status) FROM repair INNER JOIN detail_repair ON repair.id_repair = detail_repair.id_repair INNER JOIN status ON detail_repair.id_status = status.id_status WHERE date_s BETWEEN '$date_start' AND '$date_end' group by status_name";
// $query = "SELECT problem, count(id_device) FROM detail_repair group by problem";
$res = mysql_query($query);
?>
<html>
  <head>
    <title>ChartPie</title>
    <?php include"a_inc_css.php";?>
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins/pace.min.js"></script>
		<script src="js/plugins/jquery-ui.custom.min.js"></script>
		<script src="js/main.js"></script>
		<!-- CSS -->
	   <link rel="stylesheet" type="text/css" href="fancybox-master/jquery.fancybox.min.css">
	 		<link href="dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	   	 <script src="dist/js/bootstrap-datepicker-custom.js"></script>
	   	 <script src="dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['status_name', 'detail_repair.id_status'],
          <?php
          while($row=mysql_fetch_array($res))
          {
            echo "['".$row['status_name']."',".$row['count(detail_repair.id_status)']."],";
          }
          ?>
        ]);
        var options = {
          title: 'Repair From Status',
          is3D:true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div class="content-wrapper">
      <div class="page-title">
        <div>
          <h1><i class="fa fa-pie-chart fa-lg"></i> กราฟแสดงงานซ่อมตามสถานะ</h1>
        </div>
      </div>
        <div class="bs-component">
          <div class="panel panel-info" >
            <div class="table-responsive">
            <table width="100%"  class="table table-bordered table-striped table-hover table-condensed">
              <tr>
                <td width="20%" height="32" align="center"><strong>ข้อมูลระหว่างวันที่ :  </strong>
                 <? echo $_GET[date_start] ."  ถึง  ". $_GET[date_end] ?></td>
                </tr>
              </table>
              <div class="container-fluid" style="padding-top:10px;">

                      <div id="piechart" style="width: 800px; height: 400px;"></div>

                  </div>
                </div>
                </div>
                <center><a class="btn btn-info icon-btn" href="a_report_status_process.php?date_start=<? echo $_REQUEST['date_start'];?>&date_end=<? echo $_REQUEST['date_end'];?>&id_status=<? echo $id_status;?>" >ย้อนกลับ</a>
        </div>
      </div>
  </body>
</html>
