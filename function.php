<?php

date_default_timezone_set("Asia/Bangkok");

function dateToday(){
  $date = date("Y-m-d"); //2018-03-17

  return ($date);
}

function dateToBE($date){ //แปลงค.ศ.เป็นพ.ศ.
  list($y,$m,$d)=explode('-',$date);
  if($y!=""){
   $y += 543;
   return ($d.'/'.$m.'/'.$y);
 }else {
   return ("");
 }
}

function date_expirt($date){ //วันหมดอายุ +7 วัน
  $exp_date = date ("Y-m-d", strtotime("+7 day", strtotime($date)));
  return $exp_date;
}


function getToken($length){
     $token = "";
     $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
     $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
     $codeAlphabet.= "0123456789";
     $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[random_int(0, $max-1)];
    }

    return $token;
}

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
