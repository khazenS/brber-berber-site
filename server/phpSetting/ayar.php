<?php 
	@$db = 'brber-site';
	@$host = 'localhost';
	@$port = '3306';
	@$vtKullanici = 'root';
	@$sifre = '';

	@$link = mysqli_init();
	@$basarili = mysqli_real_connect(
		$link,
		$host,
		$vtKullanici,
		$sifre,
		$db,
		$port
	);

	ob_start();
	session_start();
	extract($_POST);
	mysqli_query($link,'SET NAMES utf8');
	date_default_timezone_set('Europe/Istanbul');
	

/*
	if($basarili){
		echo 'Bağlantı Başarılı.';
	}else{
		echo 'Hata';
	}
*/

	function sql($sql){
		global $link;
		@$sorgu = mysqli_query($link,$sql);
		return $sorgu;
	}


//uzantı küçük harf yapma
 function replace_uzanti($yazi) {
			$yazi = trim($yazi);
			$arama = array('J','P','G','E','I','F','N','T');
			$degistirme = array('j','p','g','e','i','f','n','t');
			$yeni_yazi = str_replace($arama,$degistirme,$yazi);
			return $yeni_yazi;
			} 
//------------------------------------------------------
//türkçe karakter değiştirme
			function replace_tr($text) {
			$text = trim($text);
			$search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
			$replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-');
			$new_text = str_replace($search,$replace,$text);
			return $new_text;
			} 
function kayit($Veri, $Tablo){	
	global $link;
	@$Tablo = mysqli_real_escape_string($link,addslashes(trim($Tablo)));
	foreach($Veri as $Bilgi => $Deger){		
		@$Deger = addslashes($Deger);
		@$Tablosu .= ", `$Bilgi`";
		@$Degeri .= ", '$Deger'";
	}
	$Kayit = mysqli_query($link,"INSERT INTO `$Tablo` (`Id`$Tablosu) VALUES (NULL$Degeri);");
	$KayitId = mysqli_insert_id($link);
	return $KayitId;
}