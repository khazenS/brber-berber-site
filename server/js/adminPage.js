const state = {};
//Cikis Yap
async function quit(clickedButton) {
  $.ajax({
    type: "POST",
    url: "../server/phpSetting/control.php",
    data: { request: "quit" },
    success: function (res) {
      if (res.status == true) {
        window.location.replace("../index.html");
      } else {
        console.log("Bir sorun olustu");
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Hata:", textStatus, errorThrown);
    },
  });
}
//Saat degistirme fonksiyonu
async function editButton(clickedButton) {
  var row = clickedButton.closest("tr");
  var cells = row.getElementsByTagName("td");
  var kayitTarihi = cells[2].textContent.split("/")[1];
  var td = clickedButton.parentElement;
  state["oldHour"] = cells[3].innerText;
  $.ajax({
    type: "POST",
    url: "../server/phpSetting/control.php",
    data: { request: "getHours", register_date: kayitTarihi },
    success: function (res) {
      if (res.status) {
        let newDatas = secondsToHours(res.data);
        printHoursForChange(td, newDatas);
      } else {
        console.log("Hata Mesaji!");
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Hata:", textStatus, errorThrown);
    },
  });
}

//Saat degisimi icin olan saatleri yazdiricaz
function printHoursForChange(td, datas) {
  td.style.padding = "0px";
  let responseText = `<button class="btn btn-primary flex-fill" onClick="getBack(this)"><</button>`;
  for (let hour = 10; hour <= 19; hour++) {
    if (datas.includes(hour)) {
      responseText += `<button class="btn btn-secondary flex-fill disabled" onclick="changeHourDatabase(this)">${hour}</button>`;
    } else {
      responseText += `<button class="btn btn-info flex-fill" onclick="changeHourDatabase(this)">${hour}</button>`;
    }
  }

  td.innerHTML = responseText;
}

// Databaseden gelen second degerlerini saate ceviriyoruz
function secondsToHours(datas) {
  let response_array = [];
  for (let index = 0; index < datas.length; index++) {
    let response = (Number(datas[index]["date_second"]) % 86400) / 3600;
    response_array.push(response);
  }
  return response_array;
}

// buttonlari geri getirme
function getBack(clickedButton) {
  let td = clickedButton.parentElement;
  td.style.padding = "8px";
  td.innerHTML = `
  <button class="btn btn-warning flex-fill mr-2 " onclick="editButton(this)">Duzenle</button>
  <button class="btn btn-danger flex-fill" onclick="deleteRow(this)">Sil</button>
  `;
}

async function changeHourDatabase(clickedButton) {
  state["newHour"] = clickedButton.innerText;
  let gonnaChange = clickedButton.innerText;
  let currentSecond = clickedButton
    .closest("tr")
    .children[3].dataset.value.split("/")[0];
  let currentShopId = clickedButton
    .closest("tr")
    .children[3].dataset.value.split("/")[1];
  let currentHour = clickedButton.closest("tr").children[3];
  let newSecond =
    (Number(gonnaChange) - Number(currentHour.innerText)) * 3600 +
    Number(currentSecond);
  $.ajax({
    type: "POST",
    url: "../server/phpSetting/control.php",
    data: {
      request: "changeHours",
      currentSecond: currentSecond,
      newSecond: newSecond,
      shop_id: currentShopId,
    },
    success: function (res) {
      if (!res.status && res.errorFor == "secondExists") {
        clickedButton.className = "btn btn-secondary flex-fill disabled";
        printAlert(res.message, "danger");
      } else if (res.status) {
        console.log(currentHour);
        clickedButton.className = "btn btn-secondary flex-fill disabled";
        let clostestTd = clickedButton.closest("td");
        let buttons = clostestTd.querySelectorAll("button");
        let backButton = "";
        buttons.forEach(function (button, index) {
          if (button.innerText == currentHour.innerText) {
            button.className = "btn btn-info flex-fill";
          } else if (button.innerText == "<") {
            backButton = button;
          }
        });
        console.log(currentHour);
        currentHour.setAttribute("data-value", `${newSecond}/${currentShopId}`);

        currentHour.innerText = clickedButton.innerText;

        backButton.click();
        printAlert(res.message, "success");
      } else {
        printAlert("Beklenmedik bir hata olustu", "danger");
        console.log("Bir hata var");
      }
    },

    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Hata:", textStatus, errorThrown);
    },
  });
}

//Sayfanin sag altinda alert cikart
function printAlert(message, type) {
  var alertDiv = document.getElementById("alert");
  alertDiv.className = `alert alert-${type}`;
  alertDiv.innerHTML = message;
  setTimeout(function () {
    alertDiv.className += " alert-hidden";
  }, 2000);
}

// SaTIRI SIL
async function deleteRow(clickedButton) {
  let date_second = clickedButton
    .closest("tr")
    .children[3].dataset.value.split("/")[0];
  let shop_id = clickedButton
    .closest("tr")
    .children[3].dataset.value.split("/")[1];
  $.ajax({
    type: "POST",
    url: "../server/phpSetting/control.php",
    data: { request: "deleteRow", date_second: date_second, shop_id: shop_id },
    success: function (res) {
      if (res.status) {
        printAlert(res.message, "success");
        clickedButton.closest("tr").remove();
      } else {
        printAlert(res.message, "danger");
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Hata:", textStatus, errorThrown);
    },
  });
}

//Dukkan Silme
async function deletePlace(clickedButton) {
  let name = clickedButton.closest("tr").children[0].textContent
  let address = clickedButton.closest("tr").children[1].textContent
  $.ajax({
    type: "POST",
    url: "../server/phpSetting/control.php",
    data: { request: "deletePlace", name: name , address , address },
    success: function (res) {
      if (res.status) {
        printAlert(res.message, "success");
        clickedButton.closest("tr").remove();
      } else {
        printAlert(res.message, "danger");
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Hata:", textStatus, errorThrown);
    },
  });
}
// Dukkan ekleme
async function addPlace(clickedButton) {
  let name = document.getElementById("name").value;
  let address = document.getElementById("address").value;
  let url = document.getElementById("url").value;
  let tBody = document.getElementById("tbody");
  if (name == "" || address == "" || url == "") {
    printAlert("Lutfen tum alanlari eksiksiz doldurunuz", "danger");
    document.getElementById("name").value = "";
    document.getElementById("address").value = "";
    document.getElementById("url").value = "";
  } else {
    $.ajax({
      type: "POST",
      url: "../server/phpSetting/control.php",
      data: { request: "addPlace", name: name, address: address, url: url },
      success: function (res) {
        console.log(res);
        if (res.status) {
          tBody.innerHTML += `
          <tr>
        <td>${name}</td>
        <td>${address}</td>
        <td class="d-flex">
        <button class="btn btn-danger flex-fill" onclick="deletePlace(this)"">Sil</button>
        </td>
      </tr>
          `;
          document.getElementById("name").value = "";
          document.getElementById("address").value = "";
          document.getElementById("url").value = "";
          printAlert(res.message, "success");
        } else {
          printAlert(res.message, "danger");
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Hata:", textStatus, errorThrown);
      },
    });
  }
}
