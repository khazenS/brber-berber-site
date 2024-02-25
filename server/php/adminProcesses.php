<?php
function getNumberofPeople()
{
  $sorgu = sql("SELECT * FROM users");
  echo $sorgu->num_rows;
}

function getNumberOfDates()
{
  $now = new DateTime();
  $mondayDate = convertingToMonday($now);
  $sorgu = sql("SELECT * FROM booking WHERE date_second >= {$now->getTimestamp()}");
  echo $sorgu->num_rows;
}

function printAllDates()
{
  $now = new DateTime();
  $sorguBooking = sql("SELECT * FROM booking WHERE date_second >= {$now->getTimestamp()}");
  $sorguUsers = sql("SELECT * FROM users");
  $users = [];
  while ($rowUser = $sorguUsers->fetch_object()) {
    $users[] = $rowUser;
  }
  // Her booking kaydı için users dizisini döngüde işle
  while ($rowBooking = $sorguBooking->fetch_object()) {
    foreach ($users as $rowUser) {
      if ($rowBooking->user_id == $rowUser->user_id) {
        echo '<tr>
        <td>' . $rowUser->name_user . '</td>
        <td>+90 ' . $rowUser->phone_number . '</td>
        <td>' . getDayNameofWeek($rowBooking->date_date) . '/' . $rowBooking->date_date . '</td>
        <td data-value="' . $rowBooking->date_second . '/' . $rowBooking->shop_id . '">' . getHoursAcctoSecond($rowBooking->date_second) . '</td>
        <td class="d-flex"><button class="btn btn-warning flex-fill mr-2 " onclick="editButton(this)">Duzenle</button>
        <button class="btn btn-danger flex-fill" onclick="deleteRow(this)">Sil</button>
        </td>
      </tr>';
        break;
      }

    }
  }
}

function printAllPlaces()
{
  $sorgu = sql("SELECT * FROM cities");
  while ($row = $sorgu->fetch_object()) {
    echo '<tr>
        <td>' . $row->name . '</td>
        <td>' . $row->address . '</td>
        <td class="d-flex">
        <button class="btn btn-danger flex-fill" onclick="deletePlace(this)" value="' . $row->id . '">Sil</button>
        </td>
      </tr>';
  }
}
// ---------------------------------------------------------------------------------------------
function getHoursAcctoSecond($second)
{
  $hour = (intval($second) % 86400) / 3600;
  return (string) $hour;
}
function getDayNameofWeek($date)
{
  $days = ["Pazar", "Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi"];
  $newDate = new DateTime($date);
  $dayOfWeek = $newDate->format('w');
  return $days[$dayOfWeek];
}
// ---------------------------------------------------------------------------------------------
?>