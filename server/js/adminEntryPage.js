async function adminLogin(clickedButton){
  let username = document.getElementById("username").value;
  let password = document.getElementById("password").value;
  if(username == '' || password == ''){
    printAlert("forAlert","Kullanici adi veya Sifreyi eksik girdiniz.","danger")
  }
  else{
    $.ajax({
      type : "POST",
      url : "../server/phpSetting/control.php",
      data : {request:'login' , username : username , password : password},
      success : function(res){
        if(res.status){
          printAlert("forAlert",res.message,"success")
          setTimeout(function() {
            window.location.replace("../pages/adminPage.php");
          }, 1500);
        }
        else{
          printAlert("forAlert",res.message,"danger")
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error('Hata:', textStatus, errorThrown);
      }
    })
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