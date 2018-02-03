<?php

function getpos($var){
  $positionslist = [
    /*1*/"President [ P ]",
    /*2*/"Vice President [ VP ]",
    /*3*/"General Secretary [ GS ]",
    /*4*/"Imam [ I ]",
    /*5*/"Public Relation Officer [ PRO ]",
    /*6*/"Womens Commissioner [ WOCOM ]",
    /*7*/"Deputy Imam [ DI ]",
    /*8*/"Financial Secretary [ FS ]",
    /*9*/"Male Organiser [ MO ]",
    /*10*/"Female Organiser [ FO ]",
    /*11*/"Male Advisor [ MA ]",
    /*12*/"Female Advisor [ FA ]",
    /*13*/"Asst Male Organiser [ AMO ]",
    /*14*/"Treasure [ T ]",
    /*15*/"Deputy Womens Commissioner [ DWC ]"
  ];
  return $positionslist[$var - 1];
}

function getposint($var){
  $positionslist = [
    /*1*/"President [ P ]",
    /*2*/"Vice President [ VP ]",
    /*3*/"General Secretary [ GS ]",
    /*4*/"Imam [ I ]",
    /*5*/"Public Relation Officer [ PRO ]",
    /*6*/"Womens Commissioner [ WOCOM ]",
    /*7*/"Deputy Imam [ DI ]",
    /*8*/"Financial Secretary [ FS ]",
    /*9*/"Male Organiser [ MO ]",
    /*10*/"Female Organiser [ FO ]",
    /*11*/"Male Advisor [ MA ]",
    /*12*/"Female Advisor [ FA ]",
    /*13*/"Asst Male Organiser [ AMO ]",
    /*14*/"Treasure [ T ]",
    /*15*/"Deputy Womens Commissioner [ DWC ]"
  ];
  for($i=0;$i<=sizeof($positionslist);$i++){
    if($positionslist[$i] == $var){
      return $i+1;
    }
  }

}
?>
