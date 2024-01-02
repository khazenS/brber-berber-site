// Database kaydi icin state degiskenini kullanicaz.
const state = {}
const clickedBTN = {}
// Mekan id ve Zaman verilerini aliyoruz.
function getValues(clickedButton){
    [day,hour,place_id] = clickedButton.value.split(" ");
    state['shop_id'] = place_id
    clickedBTN['id']= clickedButton.id
    //Database kaydi icin date olusturduk ve saniye oalrak state icine kaydettik
    setTimes(day,hour,state)
}
//State objesi icin zamanlari ayarla
function setTimes(day,hour,state){
    let response_date = new Date();
    day = Number(day)
    hour = Number(hour)

    if (response_date.getDay() == 6 && response_date.getHours() >= 19){
      response_date.setDate(response_date.getDate() + day + 1)
    }
    else{
      response_date.setDate(response_date.getDate() + (day - response_date.getDay()))
    }

    response_date.setHours(hour,0,0)
    let date_second = Math.floor((response_date.getTime() - response_date.getTimezoneOffset() * 60000)  / 1000)
    printInfosToModal(response_date,hour)
    state['date_date'] = response_date
    state['date_second'] = date_second
}

//Modal icerisine bilgiyi yazdir
function printInfosToModal(date,hour){
    let modal_footer = document.getElementById("modal-footer")

    let stringDate = date.toLocaleDateString('tr-TR', { year: 'numeric', month: 'long', day: 'numeric' })
    modal_footer.innerHTML = `
    <h3>${stringDate} günü ve ${hour}:00-${Number(hour)+1}:00 saatinde </h3>
    <class id="forAlert"></class>
    <button type="button" class="btn btn-success btn-block" id='takeDateButton' onClick="registerUser(this)">Randevuyu Al</button>
    `
}

// Post request yapip kullaniciyi database kaydedip sira aldiricaz
async function registerUser(clickedButton){
  console.log(state)
  // Herhangi bir hata yoksa post islemine devam ediyoruz
  let boolean = takeInputs()
  if(boolean){
    $.ajax({
      type : "POST",
      url : "../server/phpSetting/control.php",
      data: {request:'date', register:state},
      success : function(res){
        // Serverdan gelen istek uzerine eger dateExists hatasi var ise bir alert bastirip randevu almak istedigimiz butonu kapatiyoruz
        if(res.status == false && res.errorFor == 'dateExists'){
          document.getElementById(clickedBTN['id']).classList.add('disabled')
          document.getElementById(clickedBTN['id']).classList.add('btn-danger')
          printAlert("forAlert",String(res.message),"warning")
        }
        else if(res.a){
          document.getElementById('takeDateButton').classList.add('disabled')
          document.getElementById(clickedBTN['id']).classList.add('disabled')
          document.getElementById(clickedBTN['id']).classList.add('btn-danger')
          printAlert("forAlert",'Basariyla Kayit oldunuz. Yonlendiriliyor...',"success")
          setTimeout(function() {
            document.getElementById('modal-close-button').click();
          }, 2500);
          console.log(res.a)
        }

      },
      error: function(jqXHR, textStatus, errorThrown) {
        printAlert("forAlert","Bir hata olustu lutfen sonra birkez daha deneyiniz.","danger")
        console.error('Hata:', textStatus, errorThrown);
      }
    })
  }


}

// Input bilgilerini state kaydet
function takeInputs(){
  let name = document.getElementById("name").value
  let tel = document.getElementById("tel").value
  if(tel.length != 10){
    printAlert("forAlert","Lutfen telefon numaranizi duzgun giriniz!","danger")
    return false
  }
  else if (name == ''){
    printAlert("forAlert","Lutfen bir isim giriniz!","danger")
    return false
  }
  else{
    state['name_user'] = name
    state['phone_number'] = tel
    document.getElementById("name").value = ''
    document.getElementById("tel").value = ''
    return true
  }
}

//alert bastirma
function printAlert(toWhere,message,typeAlert){
  let printElement = document.getElementById(toWhere)
  printElement.innerHTML = `
  <div class="alert alert-${typeAlert}" role="alert" id="alert">
  ${message}
  </div>
  `
  setTimeout(function() {
    document.getElementById('alert').remove()
  }, 2500);
}

