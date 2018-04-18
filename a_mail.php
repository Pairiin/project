<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/PHPMailer-master/src/SMTP.php';

include "function.php";

$sql_mail = "SELECT * FROM email";
$objQuery_mail = mysql_query($sql_mail);
$objResult_mail = mysql_fetch_array($objQuery_mail);

$admin_name=$objResult_mail['email_name']; //นาม email
$admin_email=$objResult_mail['email']; //email ผู้ส่ง
$email_pass=$objResult_mail['email_password']; //email ผู้ส่ง

// $admin_name="Helpdesk KMUTNB"; //นาม email
// $admin_email="pinkcls39@gmail.com"; //email ผู้ส่ง
// $email_pass="04072539pink"; //email ผู้ส่ง

$user_name=$result_detail['user_name']; //username
$user_display=$result_detail['user_display']; //ชื่อ ผู้รับ

$user_email = "5706021610029@fitm.kmutnb.ac.th";
//$user_email=$_REQUEST['user_email']; //email ผู้รับ

//$exp_date = date_expirt(dateToday());

$date = dateToBE($result_detail['date_s']);

$tokens = bin2hex(openssl_random_pseudo_bytes(8));

$sql_token = "INSERT INTO token (user_name,tokens,id_detail)
VALUES ('$user_name','$tokens','$id_detail')";

$objQuery_token = mysql_query($sql_token);

$last_id = mysql_insert_id(); // คืนค่า id ที่ insert ล่าสุด



$detail_mail = "
รหัสใบแจ้งซ่อมที่ : $result_detail[id_repair] <br>
รหัสการแจ้งซ่อมที่ : $result_detail[id_detail] <br><br>
วันที่แจ้งซ่อม : $date <br><br>
Serial Number :  $result_detail[serial_number]<br><br>
ชื่ออุปกรณ์ : $result_detail[device_name]<br><br>
อาการ : $result_detail[problem]<br><br>
ผลกระทบ :$effect<br><br>


เนื่องจากการซ่อมได้มีผลกระทบ กับอุปกรณ์ของท่าน <br>
กรุณากดเข้าสู่ระบบ และ กดยินยอมการซ่อม ในเมนู ตรวจสอบสถานะ หรือกด http://localhost/helpdesk_kmutnb/confirm_effect.php?token=$tokens ";

$mail = new PHPMailer(true);
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);                      // Passing `true` enables exceptions
try {
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail -> Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $admin_email; // SMTP username
    $mail->Password = $email_pass; // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($admin_email, $admin_name); //from
    $mail->addAddress($user_email, $user_display);     // Add a recipient

    //Content
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';                                // Set email format to HTML
    $mail->Subject = 'แจ้งสถานะการซ่อม';
    $mail->Body    = $detail_mail;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>
