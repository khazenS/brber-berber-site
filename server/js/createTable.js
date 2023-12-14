// Mevcut randevu kontrolu icin haftanin gunu olarak ve saat olarak yeni array kaydediyoruz
function getDateInfo(res) {
  for(let index=0 ;index < res.length; index++){
    var date = new Date(res[index]['date']);
    var day = date.getDay();
    var hour = (res[index]['date_ms']%86400)/3600;
    res[index]['new_date'] = [day,hour]
  }
  return res
}
//Tabloyu yazdiricaz
function printTable(datas){
  const div_body = document.querySelector("#body_div");
  div_body.innerHTML = `
  <div class="container mt-5" style="color:white">
    <table class="table table-bordered text-white">
      <thead>
        <tr>
          <th class="text-center" scope="col">Pazartesi</th>
          <th class="text-center" scope="col">Salı</th>
          <th class="text-center" scope="col">Çarşamba</th>
          <th class="text-center" scope="col">Perşembe</th>
          <th class="text-center" scope="col">Cuma</th>
          <th class="text-center" scope="col">Cumartesi</th>
        </tr>
      </thead>
      <tbody id="tbody">
      </tbody>
    </table>
  </div>
  `;
  console.log(div_body)
  const t_body = document.querySelector("#tbody")
  console.log(t_body)
  for(let i = 10; i <= 19; i++){
    let rowHTML = '<tr>';
    for (let j = 1; j <= 6; j++){
      var controlled_data = controlData(i,j,datas)
      if(controlled_data['id']){
        rowHTML += `<td style="padding:1px;"><div style="padding:3px" class="text-center"><button type="button" class="btn btn-danger btn-block disabled">${String(i)}:00-${String(i+1)}:00</button></div></td>`;
      }else{
        rowHTML += `<td style="padding:1px;"><div style="padding:3px" class="text-center"><button type="button" class="btn btn-success btn-block ">${String(i)}:00-${String(i+1)}:00</button></div></td>`;
      }
    }
    
    rowHTML.innerHTML += '</tr>';
    t_body.innerHTML += rowHTML
  }
}
//Randevu var mi diye kontrol ediyoruz
function controlData(hour,day,datas){
  let control = {}
  for(let index=0 ;index < datas.length; index++){
    if(datas[index]['new_date'][0] == day && datas[index]['new_date'][1] == hour){
      control = datas[index]
    }
  }
  console.log(control)
  return control
}
//Burda aldigimiz mekan id sine gore istek atiyoruz ve o mekanin butun randevularini aliyoruz
async function placeButtonProcess(clickedButton){
  const response_data = clickedButton.value;
  const body_div = document.querySelector("#body_div");
  body_div.innerHTML = `<div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
  <div class="spinner-border"></div>
</div>`;

  $.ajax({
    type : "POST",  
    url  : "../server/phpSetting/control.php",
    data : {request:'place' , place_id : Number(response_data)},
    success: function(res){
      new_res = getDateInfo(res.dates);
      printTable(new_res)
      console.log(new_res)
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error('Hata:', textStatus, errorThrown);
    }
  });
};