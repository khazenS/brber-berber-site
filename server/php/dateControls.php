<?php
require_once('../phpSetting/ayar.php');

function isExistsDate($date_secondControl,$place_id){
  $sorgu = sql("SELECT * FROM booking WHERE date_second = '{$date_secondControl}' AND shop_id = '{$place_id}' LIMIT 1");
  if($sorgu->fetch_object() == null){
    return False;
  }
  else{
    return True;
  }
}

function isUserExists($user_name,$user_phone_number){
  $sorgu2 = sql("SELECT * FROM users WHERE phone_number = '{$user_phone_number}' AND name_user = '{$user_name}' LIMIT 1");
  if($sorgu2->num_rows == 0){
    // Yeni user veri tabanina eklenir ve booking kaydi yapilir
    $registerUser = sql("INSERT INTO users(name_user, phone_number) VALUES ('{$user_name}', '{$user_phone_number}')");
    $registeredUser = sql("SELECT * FROM users WHERE phone_number = '{$user_phone_number}' AND name_user = '{$user_name}' LIMIT 1");
    return $registeredUser->fetch_object()->user_id;
  }else{
    //Yeni kullanici yoksa veri tabaninda ki o kullaniciyi dondur
    return $sorgu2->fetch_object()->user_id;
  }
}

// Randevu kaydi icin 
function registerUsertoDatabase($user_id,$shop_id,$date_second,$date){
  $date = DateTime::createFromFormat('D M d Y H:i:s eO', $_POST['register']['date_date']);
  $formattedDate = $date->format('Y-m-d');
  $registerDate = sql("INSERT INTO booking (user_id,shop_id,date_second,date_date) VALUES ('{$user_id}', '{$shop_id}','{$date_second}','$formattedDate')");
  return $registerDate;
}
?>