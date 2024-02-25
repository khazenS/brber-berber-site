<?php
require("../server/phpSetting/ayar.php");
require("../server/php/timeProcess.php");
require("../server/php/adminProcesses.php");
?>
<?php
// Kullanıcı giriş yapmış
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../helper/css_bs/bootstrap.css">
    <link rel="stylesheet" href="../styles/admin.css">
    <script src="../helper/js_bs/bootstrap.bundle.js"></script>
    <title>Admin sayfasi</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>

  <body>
    <!--HEADER-->
    <div class="container d-flex mt-3 p-3" id="header">
      <h3 class="mr-auto">Admin Paneli</h3>
      <button class="btn btn-danger" onclick="quit(this)">Cikis Yap</button>
    </div>
    <!-- Burda bilgi veriyoruz -->
    <div class="container p-3" id="firstBody">
      <div class="container d-flex mt-3">
        <h6>Toplam kayitli kullanici sayisi :
          <?php getNumberofPeople(); ?>
        </h6>
      </div>
      <div class="container d-flex mt-3">
        <h6>Bu hafta ki toplam randevu sayisi :
          <?php getNumberOfDates(); ?>
        </h6>
      </div>
    </div>
    
    <!-- Randevu duzenle sil -->

    <div class="container mt-5 " id="secondBody">
      <h3 class="text-center mb-3">Butun Haftanin Randevu Kayitlari</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">İsim</th>
                    <th class="text-center">Numara</th>
                    <th class="text-center">Kayıt Günü</th>
                    <th class="text-center">Kayıt Saati</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
              <?php printAllDates(); ?>
            </tbody>
        </table>
    </div>
<!-- Yeni dukkan ekleme -->
  <div class="container mt-5">
    <h3 class="text-center">Mevcut Dukkanlariniz</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Dukkan Yeri</th>
                    <th class="text-center">Dukkan Adresi</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tbody">
            <?php printAllPlaces(); ?>
            </tbody>
        </table>
    <h3 class="text-center">Yeni dukkan ekleme</h3>
    <div class="card">
      <div class="card-body">

          <label for="name" class="mt-3">Mekanin Bulunacagi Sehir</label>
          <input type="text" class="form-control" id="name" placeholder="Sehir Adi Giriniz">


          <label for="address" class="mt-3">Mekan Adresi</label>
          <input type="text" class="form-control" id="address" placeholder="Adresi Giriniz">

          <label for="url" class="mt-3">Resim URL</label>
          <input type="text" class="form-control" id="url" placeholder="Resim URL giriniz">

        <button class="btn btn-info btn-block mt-4" onClick="addPlace(this)">Ekle</button>
      </div>
    </div>
  </div>


    <div class="alert alert-hidden" id="alert">
    
    </div>

    <script src="../server/js/adminPage.js"></script>
  </body>

  </html>
  <?php
} else {
  // Kullanıcı giriş yapmamış. Ana sayfaya yonlendir.
  header('Location: ../index.html');
}
?>