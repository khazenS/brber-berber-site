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

@$basari = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong style="font-weight:bold;">Başarılı! </strong><strong style="font-weight:normal;"> ';
@$hata = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong style="font-weight:bold;">Hata! </strong><strong style="font-weight:normal;"> ';
@$kapa = '.</strong></div>';



function seo($s) {
$tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',');
$eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','');
$s = str_replace($tr,$eng,$s);
$s = strtolower($s);
$s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
$s = preg_replace('/\s+/', '-', $s);
$s = preg_replace('|-+|', '-', $s);
$s = preg_replace('/#/', '', $s);
$s = str_replace('.', '', $s);
$s = trim($s, '-');
return $s;
}
 ?>