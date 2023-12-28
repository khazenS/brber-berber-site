<?php 
require_once('ayar.php');
require_once('../php/timeProcess.php');
require_once('../php/dateControls.php');
error_reporting(0);


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //Tablo olusturma islemleri
  if($_POST['request'] == 'place'){
    $nowDate = new DateTime();


    $mondayDate = convertingToMonday($nowDate);
    $response_array = get_alldatas($_POST['place_id'],$mondayDate);
    
    $response = [
      'status'=> true,
      'dates' => $response_array,
      'db_date' => $mondayDate
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
  }


  //Kullanici randevu islemleri
  if($_POST['request'] == 'date'){

    $a = isExistsDate($_POST['register']['date_second']);
    $response = [
      'status' => true,
      'message' => $a
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
  }

}
?>

