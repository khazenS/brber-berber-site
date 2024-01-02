<?php 
require_once('../phpSetting/ayar.php');

function login($username,$password){
  $sorgu = sql("SELECT * FROM admin WHERE username = '{$username}' AND password = '{$password}'");
  if($sorgu->num_rows == 0){
    return false;
  }
  else{
    return true;
  }
}

function secondExists($newSecond,$shopId){
  $sorgu = sql("SELECT * FROM booking WHERE date_second = '{$newSecond}' AND shop_id = '{$shopId}'");
  if($sorgu->num_rows == 0){
    return false;
  }
  else{
    return true;
  }
}

function exchangeSeconds($newSecond, $oldSecond){
  $sorgu = sql("UPDATE booking SET date_second = '{$newSecond}' WHERE date_second = '{$oldSecond}'");
  return True;
}

?>