<?php
	session_start();
	include "connect.php";

	if($_REQUEST['token']!=null){
  $sql_session = "SELECT *
					FROM token
					WHERE tokens = '$_REQUEST[token]'";

	$objQuery_session = mysql_query($sql_session) or die ("Error Query [".$sql_session."]");
	$objResult_session = mysql_fetch_array($objQuery_session);
	}

	if($_SESSION['username'] == "" && $objResult_session['tokens'] == "")
	{
    ?>
    <meta http-equiv='refresh' content='0;URL=index.php?id=login'>
    <?
		//exit();
	}
  else {

		if($objResult_session['status_tokens']!=null){
			?>
			<meta http-equiv='refresh' content='0;URL=check_token.php'>
			<?
		}else{

	$id_detail = $objResult_session['id_detail'];
	$user_name = $objResult_session['user_name'];
?>

<?php

if($objResult_session['tokens'] != ""){
	$access_token = 'PoLPGEKLONLQ5IM7iaKm1rO8_QdK53Iu'; // <----- API - Access Token Here
	$scopes 	= 'personel,student,templecturer'; 	// <----- Scopes for search account type
	$username 	= $user_name; // <----- Username for authen

	$api_url = 'https://api.account.kmutnb.ac.th/api/account-api/user-info'; // <----- API URL

	$ch = curl_init();// Initiate connection
	curl_setopt($ch, CURLOPT_URL, $api_url); // set url
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // 10s timeout time for cURL connection
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // allow https verification if true
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Verify the certificate's name against host
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// Set so curl_exec returns the result instead of outputting it.
	curl_setopt($ch, CURLOPT_POST, true);// Set post method
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // automatically follow Location: headers (ie redirects)
	curl_setopt($ch, CURLOPT_POSTFIELDS, array('username' => $username));

	if(($response = curl_exec($ch)) === false){
		echo 'Curl error: ' . curl_errno($ch) . ' - ' . curl_error($ch);
	}else{
		$json_data = json_decode($response, true);
		if($json_data['api_status'] == 'success'){

			$_SESSION["username"] = $json_data['userInfo']['username'];
			$_SESSION["user_display"] = $json_data['userInfo']['displayname']; //ชื่อ
			$_SESSION["firstname_en"] = $json_data['userInfo']['firstname_en'];
			$_SESSION["lname_en"] =  $json_data['userInfo']['lastname_en'];
			$_SESSION["email"] = $json_data['userInfo']['email'];
			$_SESSION["birthdate"] = $json_data['userInfo']['birthdate'];
			$_SESSION["account_type"] = $json_data['userInfo']['account_type'];

			// echo 'Login success';
			// echo "<br />=============================";
			// echo "<br />Username: " . $json_data['userInfo']['username'];
			// echo "<br />Displayname: " . $json_data['userInfo']['displayname'];
			// echo "<br />Firstname EN: " . $json_data['userInfo']['firstname_en'];
			// echo "<br />Lirstname EN: " . $json_data['userInfo']['lastname_en'];
			// echo "<br />pid: " . $json_data['userInfo']['pid'];
			// echo "<br />Email: " . $json_data['userInfo']['email'];
			// echo "<br />Birthdate: " . $json_data['userInfo']['birthdate'];
			// echo "<br />Account type: " . $json_data['userInfo']['account_type'];
		}elseif($json_data['api_status'] == 'fail'){
			echo "API Error: " . $json_data['api_status_code'] . ' - ' . $json_data['api_message'];
		}else{
			echo "Internal Error";
		}
	}
	curl_close($ch);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Help Desk</title>
	  <?php include"inc_css.php";?>
</head>

<style>
	th {
		background-color: #d9edf7;
	}
</style>

<body style="background-color:#E0EEEE">
	<?php

	include "header.php";

	include "function.php";
	?>

  <?php
	if($id_detail==""){$id_detail =$_REQUEST['id_detail'];}

    $strSQL = "SELECT *
              FROM repair r
              LEFT JOIN detail_repair dt ON r.id_repair=dt.id_repair
              LEFT JOIN status s ON dt.id_status=s.id_status
              LEFT JOIN admin a ON r.id_admin=a.id_admin
              LEFT JOIN device d ON dt.id_device=d.id_device

              WHERE dt.id_detail = $id_detail";
    $objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
    $objResult = mysql_fetch_array($objQuery);
  ?>

    <div class="container" style="padding-top:10px;">

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="row">
              <div class="col-lg-12">
                <div class=" bs-component">
                  <form class="form-horizontal" method="post" action="confirm_process.php?id_detail=<?=$id_detail;?>">
                    <fieldset>
                      <legend>ยืนยันสถานะการซ่อม</legend>
                      <div class="form-group">
                        <label class="control-label col-md-3">รหัสใบแจ้งซ่อมที่ : </label>
                        <div class="col-md-9">
                            <label class="control-label" style="font-weight:normal;"><?=$objResult['id_repair'];?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3">รหัสการแจ้งซ่อมที่ : </label>
                        <div class="col-md-9">
                            <label class="control-label" style="font-weight:normal;"><?=$objResult['id_detail'];?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3">วันที่แจ้งซ่อม : </label>
                        <div class="col-md-9">
                            <label class="control-label" style="font-weight:normal;"><?=dateToBE($objResult['date_s']);?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3">Serial Number : </label>
                        <div class="col-md-9">
                            <label class="control-label" style="font-weight:normal;"><?=$objResult['serial_number'];?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3">ชื่ออุปกรณ์ : </label>
                        <div class="col-md-9">
                            <label class="control-label" style="font-weight:normal;"><?=$objResult['device_name'];?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3">อาการ : </label>
                        <div class="col-md-9">
                            <label class="control-label" style="font-weight:normal;"><?=$objResult['problem'];?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3">ผลกระทบ : </label>
                        <div class="col-md-9">
                            <label class="control-label" style="font-weight:normal;"><?=$objResult['effect'];?></label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3"></label>
                        <div class="col-md-9" style="color:red;">
                            <label class="control-label" >เนื่องจากการซ่อมได้มีผลกระทบ กับอุปกรณ์ของท่าน </label><br>
                            <label class="control-label">กรุณา "กดยินยอมการซ่อม" เพื่อดำเนินการซ่อม หรือกด "ยกเลิกการซ่อม" เพื่อยกเลิกการซ่อม</label>
                        </div>
                      </div>
                      <br>
                      <div class="form-group">
                        <div class="col-lg-12 col-lg-offset-4">
													<input type="hidden" name="id_repair" value="<?=$objResult['id_repair']?>">
													<input type="hidden" name="id_tokens" value="<?=$objResult['id_tokens']?>">
                          <a class="btn btn-danger btnCencel" data-target="btnCencel" href="confirm_process.php?id_detail=<?=$objResult['id_detail'];?>&x=1&id_repair=<?=$objResult['id_repair'];?>&id_tokens=<?=$objResult['id_tokens'];?>" style="align:right;"> ยกเลิกการซ่อม</a>
                          <button class="btn btn-primary" type="submit">ยินยอมการซ่อม</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>


       </div>
			</div>

			<?php include"inc_js.php";?>
</body>
</html>
<?php }} ?>
