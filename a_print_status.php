<?php
	require_once "mpdf/mpdf.php";
	ob_start();
  session_start();
	include_once "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<? function dateFormatDB($date){
    $dateArr = explode("/",$date);
    return ($dateArr[2]-543)."-".$dateArr[1]."-".$dateArr[0];
  } ?>
  <?php
  function dateToBE($date){
    list($y,$m,$d)=explode('-',$date);
    if($y!=""){
     $y += 543;
     return ($d.'/'.$m.'/'.$y);
   }else {
     return ("");
   }
  }
  ?>
  <?
  $date_start=dateFormatDB($_REQUEST['date_start']);
  $date_end=dateFormatDB($_REQUEST['date_end']);
  $id_device_type=$_REQUEST['id_device_type']; ?>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</head>
<body>
  <center><strong><h3><?php echo "รายงานสรุปการซ่อมตามสถานะอุปกรณ์";?></h3></strong></center>
<table width="100%" border="" class="table table-bordered table-striped table-hover table-condensed">
  <tr>
    <td width="20%" height="32" align="center"><strong>ข้อมูลระหว่างวันที่ :  </strong>
     <? echo $_GET[date_start] ."  ถึง  ". $_GET[date_end] ?></td>
    </tr>
  </table>
  <table width="100%" border="1" class="table table-bordered table-striped table-hover table-condensed">
    <tr bgcolor="#84cdce">
      <td width="7%" height="32" align="center"><strong>ลำดับ</strong></td>
      <td width="7%" height="32" align="center"><strong>รหัสการซ่อม</strong></td>
      <td width="7%" height="32" align="center"><strong>ชื่อผู้แจ้ง</strong></td>
      <td width="7%" height="32" align="center"><strong>วันที่แจ้งซ่อม</strong></td>
      <td width="15%" height="32" align="center"><strong>ชื่ออุปกรณ์</strong></td>
      <td width="25%" height="32" align="center"><strong>ปัญหา</strong></td>
      <td width="7%" height="32" align="center"><strong>ประเภทอุปกรณ์</strong></td>
      <td width="7%" height="32" align="center"><strong>สถานะการซ่อม</strong></td>
    </tr>

    <?php
    $sql="SELECT * FROM REPAIR INNER JOIN detail_repair ON repair.id_repair = detail_repair.id_repair INNER JOIN status ON detail_repair.id_status=status.id_status INNER JOIN device ON detail_repair.id_device = device.id_device INNER JOIN device_type ON device.id_device_type=device_type.id_device_type WHERE date_s BETWEEN '$date_start' AND '$date_end' AND detail_repair.id_status='$id_status'";
    $result = mysql_query($sql);
    $i = 1;
    while($objResult =mysql_fetch_array($result)){;
     ?>
      <tr>
      <td align="center"><?php echo $i; ?></td>
      <td align="center"><?php echo $objResult[id_repair]; ?></td>
      <td align="center"><?php echo $objResult[user_name]; ?></td>
      <td align="center"><?php echo dateToBE($objResult[date_s]); ?></td>
      <td align="center"><?php echo $objResult[device_name]; ?></td>
      <td align="center"><?php echo $objResult[problem]; ?></td>
      <td align="center"><?php echo $objResult[device_type_name]; ?></td>
      <td align="center"><?php echo $objResult[status_name]; ?></td>

    <? $i+=1 ; }?>

      <!-- // echo "<script>alert('ไม่พบข้อมูลที่ต้องตรวจ!');history.back();</script>";
      // exit(); -->
  </table>
  <br>
  <br>

  <?php echo "ข้อมูล ณ วันที่".DateThai(date("Y-m-d"))."";?>
</body>
</html>
<?Php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4-L', '0', 'THSaraban');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();         // เก็บไฟล์ html ที่แปลงแล้วไว้ใน MyPDF/MyPDF.pdf ถ้าต้องการให้แสดง

function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return " $strDay $strMonthThai $strYear";
	}
?>
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF/MyPDF.pdf">คลิกที่นี้</a>-->
