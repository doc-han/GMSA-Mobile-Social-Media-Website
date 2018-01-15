<?php

//This is a fuction to solve the date provided by server into a form understandable by users//
function solveDate($date){
  $months = ['Jan','Feb','March','April','May','June','July','Aug','Sep','Oct','Nov','Dec'];
  $year = "";
  for($i=0;$i<4;$i++){
    $year .= $date[$i];
  }

  $month = "";
  for($i=4;$i<6;$i++){
    $month .= $date[$i];
  }
  $month = $months[$month * 1];

  $day = "";
  for($i=6;$i<8;$i++){
    $day .= $date[$i];
  }
  if($day == '01'){
    $day = "1st";
  }else if($day == '02'){
    $day = "2nd";
  }else if($day == '03'){
    $day = "3rd";
  }else{
    if($day[0] == '0'){
      $day = $day[1]."th";
    }else{
      $day = $day."th";
    }

  }

  $hour = "";
  for($i=8;$i<10;$i++){
    $hour .= $date[$i];
  }
  if($hour[0] == '0'){
    $hour = $hour[1];
  }
  if($hour*1>12){
    $hour -= 12;
    $suffix = 'pm';
  }else{
    $suffix = 'am';
  }

  $minutes = "";
  for($i=10;$i<12;$i++){
    $minutes .= $date[$i];
  }

  return "$hour:$minutes$suffix $day $month, $year";
}


?>
