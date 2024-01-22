<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../helper/css_bs/bootstrap.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.2/axios.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="../helper/js_bs/bootstrap.bundle.js"></script>
  <link rel="stylesheet" type="text/css" href="../styles/style.css">
  <link rel="stylesheet" type="text/css" href="../styles/header.css">
  <link rel="stylesheet" type="text/css" href="../styles/footer.css">
  <link rel="stylesheet" type="text/css" href="../styles/takeDate.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,700;1,200&family=Roboto:wght@100&display=swap"
    rel="stylesheet">

  <title>Sıranı Al</title>
  <link rel="icon" href="../helper/img/loder.png" type="image/png">
</head>

<body>
  <!--HEADER-->

  <header class="container-fluid bg-dark">
    <!--İlk Navbar-->
    <nav class=" navbar d-none d-sm-flex container justify-content-start bg-white" id="firstNavbar">
        <i class="fa-solid fa-phone"><a class="link" href="tel:+905301861194"> (+90) 530 186 1194</a></i>
        <span class="ms-4 fw-bold ">Çalışma Saatlerimiz: 10:00 - 20:00</span>
        <ul class="navbar-nav ms-auto flex-row">
          <li class="nav-item me-3">
            <a class="nav-link" href="https://www.instagram.com/cihatt.abayli/"><i class="social-link fa-brands fa-instagram fa-lg" style="color: #ac1ba7;"></i></a>
          </li >
          <li class="nav-item" style="margin-right: 30px;">
            <a class="nav-link " href="https://wa.me/+905301861194"><i class="social-link fa-brands fa-whatsapp fa-lg" style="color: #20d924;"></i></a>
          </li>
        </ul>
    </nav>
    <!--İkinci Navbar-->
    <nav class="navbar dflex" id="secondNavbar">
      <div class="container">
        <a href="#" class="navbar-brand logo">BRBER</a>
        
        <ul class="navbar-nav  flex-row customUl">
          <li class="nav-item me-3 ">
            <a href="../index.html#about" class="nav-link">Hakkımızda</a>
          </li>
          <li class="nav-item me-3 ">
            <a href="../index.html#service" class="nav-link" >Hizmetlerimiz</a>
          </li>
          <li class="nav-item me-3 ">
            <a href="../index.html#footer" class="nav-link" >İletişim</a>
          </li>
        </ul>
        
        <a href="takeDate.php" class="btn btn-warning customButton">Sıra Al!</a>
      </div>
      
    </nav>

    <!--BODY-->
    <div class="container text-white">
      <p class="justify-content-center d-flex mb-5">Sıra almak için uygun saatlerimiz 10:00 - 20:00 arasıdır.Eğer bu
        saatler arasında müsait zaman bulabilirseniz sıra alabilirsiniz.</p>
      <p class="justify-content-center d-flex fs-5">Sırayı hangi mekandan almak istersiniz?</p>
    </div>

    <div id="body_div" class="container-fluid text-white">
      <div class="card-group">
        <?php
        require_once("../server/php/getPlaces.php");
        ?>
      </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h2>Sıranı Al!</h2>
            <button type="button" class="close" id="modal-close-button" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <label for="name">İsim:</label>
            <input type="text" class="form-control" id="name" placeholder="İsminizi giriniz" maxLength="20">

            <label for="tel">Numara:</label>
            <div class="d-flex align-items-center">
              <span>+90   </span>
            <input type="tel" class="form-control" id="tel" maxLength="10" placeholder="5XX XXX XXXX" oninput="justNumber(this)">
            </div>
            

          </div>

          <!-- Modal footer -->
          <div class="modal-footer d-flex justify-content-center" id="modal-footer">
            
          </div>

        </div>
      </div>
    </div>

    <!--FOOTER-->
    <div class="container-fluid d-flex text-white" id="footer">
      <div class="container d-flex mt-3" ><img src="./helper/img/logo.png" style="margin: auto;"></div>
      <div class="container d-flex align-items-center mt-2 mb-2" id="footerSection1">
        <p style="margin: 0; font-weight: 500;">Çalışma Günlerimiz <span style="color: red;">Pazartesi - Cumartesi</span></p> 
        <a class=" nav-link callLink" style="margin-left: auto;" href="tel:+905301861194"><i class="fa fa-mobile me-2" ></i>Ara 5301861194</a>
      </div>


      <div class="container-fluid d-flex row mt-3">
        <div class="col footerCol">
          <h2 class="justify-content-center d-flex">Hızlı Linkler</h2>
          <ul class="list-group footerLinksUL">
            <li class="list-group-item mt-1 "><a class=" d-flex justify-content-center" href="../index.html#firstNavbar">Ana Sayfa</a></li>
            <li class="list-group-item mt-1 "><a class=" d-flex justify-content-center" href="../index.html#about">Hakkımızda</a></li>
            <li class="list-group-item mt-1 "><a class=" d-flex justify-content-center" href="takeDate.php">Sıra Al</a></li>
            <li class="list-group-item mt-1"><a class=" d-flex justify-content-center" href="../index.html#service">Hizmetlerimiz</a></li>
          </ul>
        </div>




        <div class="col footerCol">
          <h2 class="justify-content-center d-flex">Bize Ulaşın</h2>
          <ul class="mt-5">
            <li class="mt-3" style="margin-left: 2rem; list-style: none;"><i class="fa fa-map-marker me-1"></i>Brber Hair Osmangazi/BURSA</li>
            <li class="mt-3" style="margin-left: 2rem; list-style: none;"><i class="fa-regular fa-envelope me-1"></i><a style="color:white;text-decoration: none;" href="mailto:cihatabayli@gmail.com">cihatabayli@gmail.com</a></li>
            <li class="mt-3" style="margin-left: 2rem; list-style: none;"><i class="fa-brands fa-whatsapp me-1 "></i><a style="color:white;text-decoration: none;" href="https://wa.me/5301861194">Whatsapp'dan ulaş!</a></li>
          </ul>
        </div>



        <div class="col footerCol">
          <h2 class="justify-content-center d-flex">Takipte Kalın</h2>
          <ul class="mt-5">
            <li class="mt-3" id="bölüm3li1" style="margin-left: 2rem; list-style: none;"><i class="fa-brands fa-instagram me-1"></i><a style="color:white;text-decoration: none;" href="https://www.instagram.com/brber_hair_saloon/">@brber_hair_saloon</a></li>
            <li class="mt-3" id="bölüm3li2" style="margin-left: 2rem; list-style: none;"><i class="fa-brands fa-square-x-twitter me-1"></i><a style="color:white;text-decoration: none;" href="https://twitter.com/brber_saloon">@brber_saloon</a></li>
            <li class="mt-3" id="bölüm3li3" style="margin-left: 2rem; list-style: none;"><i class="fa-brands fa-youtube me-1 "></i><a style="color:white;text-decoration: none;" href="https://www.youtube.com/channel/brber_hair_lessons">brber_hair_lessons</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <script src="../server/js/createTable.js"></script>
  <script src="../server/js/DateProcess.js"></script>
  <script>
  function justNumber(input) {
  input.value = input.value.replace(/[^0-9]/g, '').slice(0, 10);
  }
  </script>

</body>


</html>