<?php
	session_start();

	include"connect.php";

	$access_token = 'PoLPGEKLONLQ5IM7iaKm1rO8_QdK53Iu'; // <----- API - Access Token Here
	$scopes 	= 'personel,student,templecturer'; 	// <----- Scopes for search account type

	$username 	= $_REQUEST['username']; // <----- Username for authen
	$password 	= $_REQUEST['password']; 	// <----- Password for authen

	$sql="SELECT * FROM admin WHERE username='$username' AND password='$password'";
	//echo $sql;

	$objQuery = mysql_query($sql);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult) //ถ้า username และ password ไม่มีในฐานข้อมูล เช็คของ admin
	{

		$api_url = 'https://api.account.kmutnb.ac.th/api/account-api/user-authen'; // <----- API URL
    $ch = curl_init();// Initiate connection
    curl_setopt($ch, CURLOPT_URL, $api_url); // set url
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // 10s timeout time for cURL connection
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // allow https verification if true
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Verify the certificate's name against host
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// Set so curl_exec returns the result instead of outputting it.
    curl_setopt($ch, CURLOPT_POST, true);// Set post method
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $access_token));
    @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // automatically follow Location: headers (ie redirects)
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('scopes' => $scopes, 'username' => $username, 'password' => $password));

    if(($response = curl_exec($ch)) === false){
      //echo 'Curl error: ' . curl_errno($ch) . ' - ' . curl_error($ch);
      echo "Can't load data";
    }
    else{
      $json_data = json_decode($response, true);
      if($json_data['api_status'] == 'success'){ //username or password correct

				$_SESSION["username"] = $json_data['userInfo']['username'];
        $_SESSION["user_display"] = $json_data['userInfo']['displayname']; //ชื่อ
				$_SESSION["firstname_en"] = $json_data['userInfo']['firstname_en'];
				$_SESSION["lname_en"] =  $json_data['userInfo']['lastname_en'];
				$_SESSION["email"] = $json_data['userInfo']['email'];
				$_SESSION["birthdate"] = $json_data['userInfo']['birthdate'];
				$_SESSION["account_type"] = $json_data['userInfo']['account_type'];
        // echo "<br />=============================";
        // echo "<br />Username: " . $json_data['userInfo']['username'];
        // echo "<br />Displayname: " . $json_data['userInfo']['displayname'];
        // echo "<br />Firstname EN: " . $json_data['userInfo']['firstname_en'];
        // echo "<br />Lirstname EN: " . $json_data['userInfo']['lastname_en'];
        // echo "<br />pid: " . $json_data['userInfo']['pid'];
        // echo "<br />Email: " . $json_data['userInfo']['email'];
        // echo "<br />Birthdate: " . $json_data['userInfo']['birthdate'];
        // echo "<br />Account type: " . $json_data['userInfo']['account_type'];
        ?>
        <script>location.href='index.php'</script>
        <?

      }elseif($json_data['api_status'] == 'fail'){ //username or password incorrect?>
          <meta http-equiv='refresh' content='0;URL=index.php?id=fail'>
    <?  }else{
        echo "Internal Error";
      }
    }
    curl_close($ch);

	}
	else //ถ้ามีข้อมูลในฐานข้อมูล admin login
	{
		$_SESSION["user_admin"] = $username;
		$_SESSION["pass_admin"] = $password;

		session_write_close();

		?>
			<meta http-equiv='refresh' content='0;URL=./a_admin.php'>
		<?

	}
	mysql_close();
?>
