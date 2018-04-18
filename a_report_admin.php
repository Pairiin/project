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
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Help Desk KMUTNB</title>
		<?php include"a_inc_css.php";?>
  </head>

  <body class="sidebar-mini fixed">
    <div class="wrapper">

      <?php include"connect.php";?><!-- connect database -->
      <?php include"function.php";?><!-- function-->
			<?php include"a_header.php";?><!-- header -->
			<?php include"a_side_nav.php";?><!-- Side-Nav-->



      <?php

      $adminStr = array();
      $adminName = array();
      $cntAdmin = 0;
      $sql_admin= "SELECT *
                    FROM admin
                    ORDER BY id_admin ASC";
      $obj_admin = mysql_query($sql_admin) or die ("Error Query [".$sql_admin."]");
      while($result_admin= mysql_fetch_array($obj_admin))
      {
        $cnt = 0;
        $date = date("Y"); //ดึงปี ปจบ
        $a=array();
        for($m=1;$m<=12;$m++){

          $query= "SELECT count(r.id_admin)
                  FROM repair r
                  INNER JOIN detail_repair dr ON r.id_repair = dr.id_repair
                  INNER JOIN status s ON dr.id_status=s.id_status
                  INNER JOIN admin a ON r.id_admin=a.id_admin
                  WHERE MONTH(date_evalue)=$m AND YEAR(date_evalue)=$date
                  AND r.id_admin=".$result_admin[0]. " group by admin_name";

          $res = mysql_query($query);
            if($row=mysql_fetch_array($res))
            {
              $a[$cnt] = $row[0];
              $cnt++;
            }
            else{
              $a[$cnt] = 0;
              $cnt++;
            }
        }
        $adminStr[$cntAdmin] =  implode(",",$a);
        $adminName[$cntAdmin] = $result_admin['admin_name'];
        $cntAdmin++;
      }

      $xmonth = array(); // ตัวแปรแกน x
      //sql สำหรับดึงข้อมูล จาก ฐานข้อมูล
      $sql = "SELECT month.`month`FROM month";
      $result = mysql_query($sql);
      while($row=mysql_fetch_array($result)) {
      //array_push คือการนำค่าที่ได้จาก sql ใส่เข้าไปตัวแปร array
      array_push($xmonth,$row[month]);

      }

      ?>

      <div class="content-wrapper">
        <div class="page-title">
          <div>
            <h1><i class="fa fa-bar-chart fa-lg"></i>รายงานสรุปจำนวนการรับงานของเจ้าหน้าที่</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-11">
            <div class="container-fluid" style="padding-top:10px;">
                <div class="card">
              <div class="embed-responsive embed-responsive-16by9">
                <div id="container" style="min-width: 150px; height: 400px; margin: 5 auto"></div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Javascripts-->
		<?php include"a_inc_js.php"; ?>

    <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="http://code.highcharts.com/modules/exporting.js"></script>

    <script>
    $(function () {
    $('#container').highcharts({
        chart: {
            type: 'column' //รูปแบบของ แผนภูมิ ในที่นี้ให้เป็น line
        },
        title: {
            text: 'กราฟแสดงจำนวนการรับงานของเจ้าหน้าที่'
        },
        subtitle: {
            text: '<?php echo "ข้อมูล ณ วันที่".DateThai(date("Y-m-d"))."";?>'
        },
        legend: {
            align: 'right',
            verticalAlign: 'middle',
            layout: 'vertical'
        },
        xAxis: {
            categories: ['<?= implode("','", $xmonth); //นำตัวแปร array แกน x มาใส่ ในที่นี้คือ เดือน?>']
        },
        yAxis: {

            title: {
                text: 'จำนวนงาน'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                 '<td style="padding:0">{point.y:.1f}</td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -10,
                        y: 100,
                        borderWidth: 0
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [
          <? for($v=0;$v<count($adminStr);$v++){ ?>
           {
             name: '<? echo $adminName[$v] ?>',
             data: [<?=  $adminStr[$v] // ข้อมูล array แกน y ?>]
           }<?
            if($v<=0) echo ",";
           }
          ?>
        ]

     });
    });
    </script>


  </body>
</html>

<?php } ?>
