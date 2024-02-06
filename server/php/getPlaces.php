<?php
require_once('../server/phpSetting/ayar.php');

function getPlaces()
{
  $sorgu = sql("SELECT * FROM cities");
  while ($row = $sorgu->fetch_object()) {
    echo '
    <div class="card custom-card bg-warning text-dark">
  <img class="card-img-top place-image" src="' . $row->picture . '" alt="Mekan Resmi">
  <div class="card-body ">
    <h4 class="card-title">Brber ' . $row->name . '</h4>
    <p class="card-text">ADRES: ' . $row->address . '</p>
    <button type="button" value="' . $row->id . '"class="btn btn-primary mt-3 placeButtons" onClick=placeButtonProcess(this)>Randevu Al</button>
  </div>
</div>
    ';
  }
}
getPlaces();


?>