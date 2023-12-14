<?php 
require_once('../phpSetting/ayar.php');


function convertingToMonday($date){
  if(intval($date->format('N')) == 7)  $date->setTimestamp($date->getTimestamp() - 6*86400);
  if(intval($date->format('N')) == 6)  $date->setTimestamp($date->getTimestamp() - 5*86400);
  if(intval($date->format('N')) == 5)  $date->setTimestamp($date->getTimestamp() - 4*86400);
  if(intval($date->format('N')) == 4)  $date->setTimestamp($date->getTimestamp() - 3*86400);
  if(intval($date->format('N')) == 3)  $date->setTimestamp($date->getTimestamp() - 2*86400);
  if(intval($date->format('N')) == 2)  $date->setTimestamp($date->getTimestamp() - 1*86400);
  return $date->setTime(0,0,0);
}

function get_alldatas($id,$date){
  
  $sorgu = sql("SELECT * FROM booking WHERE date_ms >= {$date->getTimestamp()} AND date_ms < {$date->getTimestamp()} + (7 * 86400) AND shop_id = {$id}");
  $response_array = array();
  while($fetch = $sorgu->fetch_object()){
    $response_array[] = $fetch;
  }
  return $response_array;
}

?>