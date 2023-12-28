<?php
require_once('../phpSetting/ayar.php');

function isExistsDate($date_secondControl){
  $sorgu = sql("SELECT * FROM booking WHERE date_second ={$date_secondControl}");
  if($sorgu->fetch_object() == null){
    return False;
  }
  else{
    return True;
  }
}

?>