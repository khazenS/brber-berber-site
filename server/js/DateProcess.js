// Database kaydi icin state degiskenini kullanicaz.
const state = {}


// Mekan id ve Zaman verilerini aliyoruz.
function getValues(clickedButton){
    [day,hour,place_id] = clickedButton.value.split(" ");
    state['shop_id'] = place_id
    //Database kaydi icin date olusturduk ve saniye oalrak state icine kaydettik
    setTimes(day,hour,state)
    console.log(state)
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
    console.log(hour)
    console.log(response_date)
    let date_second = Math.floor(response_date.getTime() / 1000)
    printInfosToModal(response_date,hour)
    state['date'] = response_date
    state['date_second'] = date_second

}

//Modal icerisine bilgiyi yazdir
function printInfosToModal(date,hour){
    let modal_footer = document.getElementById("modal-footer")

    let stringDate = date.toLocaleDateString('tr-TR', { year: 'numeric', month: 'long', day: 'numeric' })
    modal_footer.innerHTML = `
    <h3>${stringDate} günü ve ${hour}:00-${Number(hour)+1}:00 saatinde </h3>
    <class id="forAlert"></class>
    <button type="button" class="btn btn-success btn-block" onClick="registerUser(this)">Randevuyu Al</button>
    `
}

// Post request yapip kullaniciyi database kaydedip sira aldiricaz
async function registerUser(clickedButton){
  takeInputs()
  $.ajax({
    type : "POST",
    url : "../server/phpSetting/control.php",
    data: {request:'date', register:state},
    success : function(res){
      console.log(res.message)
    },
    error: function(jqXHR, textStatus, errorThrown) {
      printAlert("forAlert","Bir hata olustu lutfen sonra birkez daha deneyiniz.","danger")
      console.error('Hata:', textStatus, errorThrown);
    }
  })
}

// Input bilgilerini state kaydet
function takeInputs(){
  let name = document.getElementById("name").value
  let tel = document.getElementById("tel").value
  if(tel.length != 10){
    printAlert("forAlert","Lutfen telefon numaranizi duzgun giriniz!","danger")
  }
  else if (name == ''){
    printAlert("forAlert","Lutfen bir isim giriniz!","danger")
  }
  else{
    state['name'] = name
    state['phone_number'] = tel
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
  }, 2000);
}

