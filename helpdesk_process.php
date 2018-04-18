<?php
session_start();

include"connect.php";
include"inc_css.php";
include"function.php";

$date_s = dateToday();
$time_s=date("H:i:s");

$username = $_SESSION['username'];
$user_display = $_SESSION['user_display'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];
$user_type = $_SESSION['account_type'];

if($user_type == "personel") {$user_type = "1";}
else if ($user_type == "students") {$user_type = "2";}
else if ($user_type == "templecturer") {$user_type = "3";}

$user_type;
$room = $_SESSION['room'];
$class = $_SESSION['class'];
$building = $_SESSION['building'];

$id_status=$_REQUEST['id_status'];

$array_file = array();

function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}


if ($_FILES['filUpload']) {
    $file_ary = reArrayFiles($_FILES['filUpload']);

    foreach ($file_ary as $file) {
        @copy($file["tmp_name"],
            "upload/" . $file["name"]);
            $array_file[] = $file["name"];
    }
}

$strSQL = "SELECT MAX(id_repair) AS id_repair FROM repair";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
$objResult = mysql_fetch_array($objQuery);

$id_repair=$objResult["id_repair"]+1;

$sql_repair = "INSERT INTO repair (id_repair,user_name,user_display,user_email,user_phone,id_user_status,room,class,building,date_s,time_s)
VALUES ('$id_repair','$username','$user_display','$email','$phone','$user_type','$room','$class','$building','$date_s','$time_s')";

$objQuery_repair = mysql_query($sql_repair);

for($i=0;$i<count($_REQUEST['name_device']);$i++){
    $name_device=$_REQUEST['name_device'];
    $problem=$_REQUEST['problem'];

    $sql_detail = "INSERT INTO detail_repair (id_repair,device_name_s,problem,id_status,image)
    VALUES ('$id_repair','$name_device[$i]','$problem[$i]','$id_status','$array_file[$i]')";

    $objQuery_detail = mysql_query($sql_detail);
}

if($objQuery_repair){
  if($objQuery_detail)
  {
  	?>
    <script>
        setTimeout(function() {
            swal({
                title: "บันทึกข้อมูลสำเร็จ!!",
                text: "คลิกปุ่ม \"OK\" เพื่อรับทราบ",
                type: "success",
                confirmButtonText: "OK"
            }, function() {
                window.location = "status_show.php";
            }, 1000);
        });
    </script>
    <?

  }
  else
  {
    echo "Error Save1 [".$objQuery_detail."]";
  }
}
else
{
  echo "Error Save2 [".$objQuery_repair."]";
}

unset($_SESSION["phone"]);
unset($_SESSION["room"]);
unset($_SESSION["class"]);
unset($_SESSION["building"]);
?>

<script src="js/sweetalert.min.js"></script>
