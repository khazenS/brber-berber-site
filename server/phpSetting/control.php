<?php
require('./ayar.php');
require('../php/timeProcess.php');
require('../php/dateControls.php');
require('../php/admin.php');
error_reporting(0);


session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //Tablo olusturma islemleri
  if ($_POST['request'] == 'place') {
    $nowDate = new DateTime();


    $mondayDate = convertingToMonday($nowDate);
    $response_array = get_alldatas($_POST['place_id'], $mondayDate);

    $response = [
      'status' => true,
      'dates' => $response_array,
      'db_date' => $mondayDate
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
  }


  //Kullanici randevu islemleri
  if ($_POST['request'] == 'date') {
    $existsUser = isUserExists($_POST['register']['name_user'], $_POST['register']['phone_number']);
    $dateExists = isExistsDate($_POST['register']['date_second'], $_POST['register']['shop_id']);
    $dateAA = registerUsertoDatabase($existsUser, $_POST['register']['shop_id'], $_POST['register']['date_second'], $_POST['register']['date']);
    //Kaydetmeden once o tarih alinmis mi diye kontrol ediyoruz
    if ($dateExists) {
      $response = [
        'status' => false,
        'errorFor' => 'dateExists',
        'message' => 'Maalesef biri sizden once kayit olmus gozukuyor :('
      ];
    } else {
      $response = [
        'status' => true,
        'message' => 'basarili!',
        'a' => $dateAA
      ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
  }


  //Admin login islemleri
  if ($_POST['request'] == 'login') {
    $adminLogin = login($_POST['username'], $_POST['username']);
    if ($adminLogin) {
      $_SESSION['login'] = true;
      $response = [
        'status' => true,
        'message' => 'Basariyla giris yaptiniz. Yonlendiriliyor...'
      ];
    } else {
      session_destroy();
      $response = [
        'status' => false,
        'message' => 'Kullanici adi veya sifre yanlis!'
      ];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }

  if ($_POST['request'] == 'quit') {
    session_destroy();
    $response = [
      'status' => true
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    ;
  }
  if ($_POST['request'] == 'getHours') {
    $sorgu = sql("SELECT date_second FROM booking WHERE date_date = '{$_POST['register_date']}'");
    $response_array = [];
    while ($row = $sorgu->fetch_object()) {
      $response_array[] = $row;
    }
    $response = [
      'status' => true,
      'data' => $response_array
    ];


    header('Content-Type: application/json');
    echo json_encode($response);
  }


  if ($_POST['request'] == 'changeHours') {
    $secondExists = secondExists($_POST['newSecond'], $_POST['shop_id']);
    if ($secondExists) {
      $response = [
        'status' => false,
        'errorFor' => 'secondExists',
        'message' => 'Uzgunum sizden once biri bu tarihe kayit yaptirmis'
      ];
    } else {
      $responseValue = exchangeSeconds($_POST['newSecond'], $_POST['currentSecond']);
      $response = [
        'status' => true,
        'message' => 'Basariyla kayit olundu!'
      ];
    }



    header('Content-Type: application/json');
    echo json_encode($response);
  }

  if ($_POST['request'] == 'deleteRow') {
    $sorgu = sql("DELETE FROM booking WHERE date_second = '{$_POST['date_second']}' AND shop_id = '{$_POST['shop_id']}'");
    if ($sorgu) {
      $response = [
        'status' => true,
        'message' => 'Silme islemi basariyla tammalandi'
      ];
    } else {
      $response = [
        'status' => false,
        'message' => 'Silme isleminde bir problem cikti'
      ];
    }



    header('Content-Type: application/json');
    echo json_encode($response);
  }

  if ($_POST['request'] == 'deletePlace') {
    $sorgu = sql("DELETE FROM cities WHERE name = '{$_POST['name']}' AND address = '{$_POST['address']}'");
    if ($sorgu) {
      $response = [
        'status' => true,
        'message' => 'Silme islemi basariyla tammalandi'
      ];
    } else {
      $response = [
        'status' => false,
        'message' => 'Silme isleminde bir problem cikti'
      ];
    }



    header('Content-Type: application/json');
    echo json_encode($response);
  }

  if ($_POST['request'] == 'addPlace') {
    $sorgu = sql("INSERT INTO cities(`name`, `address`, `picture`) VALUES ('{$_POST['name']}', '{$_POST['address']}', '{$_POST['url']}')");
    if ($sorgu) {
      $response = [
        'status' => true,
        'message' => 'Dukkan ekleme islemi basarili'
      ];
    } else {
      $response = [
        'status' => false,
        'message' => 'Dukkan eklenemedi'
      ];
    }


    header('Content-Type: application/json');
    echo json_encode($response);
  }

}
?>