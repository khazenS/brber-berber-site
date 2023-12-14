<?php require_once('ayar.php') ?>
<?php 
error_reporting(0);

if($_POST['login']){
	if($login == 1){
		$ka = addslashes($ka);
		$sif = addslashes($sif);
		$sif = md5($sif);

		$control = sql("SELECT * FROM admin WHERE ka='$ka'");
		$sayControl = mysqli_num_rows($control);
		if($sayControl==1){
			$controlFetch = mysqli_fetch_object($control);
			$controlSif = $controlFetch->sif;
			if($sif == $controlSif){
				@$_SESSION['oturum'] = $controlFetch;
				$dizi['tamam'] = $basari.'Başarıyla Giriş Yapıldı'.$kapa;
			}else{
				$dizi['hata'] = $hata.'Şifre Hatalı'.$kapa;
			}

		}else{
			$dizi['hata'] = $hata.'Böyle Bir Kullanıcı Yok'.$kapa;
		}



	}


echo json_encode($dizi);
}


 ?>