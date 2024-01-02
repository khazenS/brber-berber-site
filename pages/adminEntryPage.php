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
  <link rel="stylesheet" href="../helper/css_bs/bootstrap.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../helper/css_bs/bootstrap.css">
  <link rel="stylesheet" href="../styles/adminEntry.css">
  <script src="../helper/js_bs/bootstrap.bundle.js"></script>
  <title>Admin Giris sayfasi</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>


  <div class="d-flex justify-content-center align-items-center bg-light flex-column" style="min-height: 100vh;">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title text-center">Admin Giris</h4>

          <label for="username" class="mt-3">Kullanıcı Adı</label>
          <input type="text" class="form-control" id="username" placeholder="Kullanıcı adınızı girin">


          <label for="password" class="mt-3">Şifre</label>
          <input type="password" class="form-control" id="password" placeholder="Şifrenizi girin">

        <button class="btn btn-primary btn-block mt-4" onclick="adminLogin(this)">Giris Yap</button>
      </div>
    </div>


    <div id="forAlert" class="mt-3">

    </div>


    <script src="../server/js/adminEntryPage.js"></script>
</body>

</html>