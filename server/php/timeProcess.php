<?php 
require_once 'C:\xampp\htdocs\brber-berber-site\server\phpSetting\ayar.php';


function convertingToMonday($date){
  $response_date = clone $date;
  if(intval($date->format('N')) == 7) $response_date->setTimestamp($response_date->getTimestamp() + 1*86400);
  elseif(intval($date->format('N')) == 6 && intval($date->format('H')) >= 19)  $response_date->setTimestamp($response_date->getTimestamp() + 2*86400);
  elseif(intval($date->format('N')) == 6)  $response_date->setTimestamp($response_date->getTimestamp() - 5*86400);
  elseif(intval($date->format('N')) == 5)  $response_date->setTimestamp($response_date->getTimestamp() - 4*86400);
  elseif(intval($date->format('N')) == 4)  $response_date->setTimestamp($response_date->getTimestamp() - 3*86400);
  elseif(intval($date->format('N')) == 3)  $response_date->setTimestamp($response_date->getTimestamp() - 2*86400);
  elseif(intval($date->format('N')) == 2)  $response_date->setTimestamp($response_date->getTimestamp() - 1*86400);
  return $response_date->setTime(0,0,0);
}



function get_alldatas($id,$date){
  
  $sorgu = sql("SELECT * FROM booking WHERE date_second >= {$date->getTimestamp()} AND date_second < {$date->getTimestamp()} + (7 * 86400) AND shop_id = {$id}");
  $response_array = array();
  while($fetch = $sorgu->fetch_object()){
    $response_array[] = $fetch;
  }
  return $response_array;
}

?>