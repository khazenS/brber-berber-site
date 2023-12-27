
// Mekan id ve Zaman verilerini aliyoruz.
function getValues(clickedButton){
    [day,hour,place_id] = clickedButton.value.split(" ");
    // Database kaydi icin state degiskenini kullanicaz.
    const state = {}
    setTimes(day,hour,state)
    console.log(state)
}

//State objesi icin zamanlari ayarla
function setTimes(day,hour,state){
    let response_date = new Date();
    day = Number(day)

    if (response_date.getDay() == 6 && response_date.getHours() >= 19){
      response_date.setDate(response_date.getDate() + day + 1)
    }
    else{
      response_date.setDate(response_date.getDate() + (day - response_date.getDay()))
    }

    response_date.setHours(hour,0,0)
    
    let date_second = response_date.getTime()
    date_second = Math.floor(date_second / 1000)
    printInfosToModal(response_date,hour)
    state['date'] = response_date
    state['date_second'] = date_second

}

//Modal icerisine bilgiyi yazdir
function printInfosToModal(date,hour){
    let modal_footer = document.getElementById("modal-footer")

    let stringDate = date.toLocaleDateString('tr-TR', { year: 'numeric', month: 'long', day: 'numeric' })
    modal_footer.innerHTML = `
    <h3>${stringDate} günü ve ${hour}:00-${Number(hour)+1}:00 saatinde </H3>
    <button type="button" class="btn btn-success btn-block">Randevuyu Al</button>
    `
}


