// O T'EN VAS A FER PUÑETES VA CHE ANIMAT
//
function validate_id_vehicle(texto) {
  //mira avore si esta ple yau
  if (texto.length > 0) {
    //^[A-Z0-9 _]*$   /^[A-Z0-9 _]*[A-Z0-9][A-Z0-9 _]*$/
    var reg = /[A-Za-z0-9]+/g;
    return reg.test(texto);
  }
  return false;
}

function validate_marca(texto) {
  if (texto.length > 0) {
    var reg = /^[a-zA-Z]*$/;
    return reg.test(texto);
  }
  return false;
}
function validate_modelo(texto) {
  if (texto.length > 0) {
    var reg = /[A-Za-z0-9]+/g;
    return reg.test(texto);
  }
  return false;
}

function validate_HP(texto) {
  if (texto.length > 0) {
    var reg = /^[0-9]{1,4}$/;
    return reg.test(texto);
  }
  return false;
}
///^\d+$/ o
function validate_Km(texto) {
  if (texto.length > 0) {
    var reg = /^[0-9]{1,6}$/;
    return reg.test(texto);
  }
  return false;
}

function validate_Anyo_produccion(texto) {
  ///"^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$"gm/;
  // ^[0-9]{4}$ "/w3schools/i"
  if (texto.length > 0) {
    return true;
  }
  return false;
}

function validate_color(texto) {
  if (texto.length > 0) {
    var reg = /^[a-zA-Z]*$/;
    return reg.test(texto);
  }
  return false;
}

function validate_precio(texto) {
  //perque puñeta em trau 250000.00 aixin ane el zero
  if (texto.length > 0) {
    var reg = /^[0-9]+$/;
    return reg.test(texto);
  }
  return false;
}

function validate() {
  /* console.log('hola validate js');
     return true;  */
  var check = true;

  var v_id_vehicle = document.getElementById("id_vehicle").value;
  var v_marca = document.getElementById("marca").value;
  var v_modelo = document.getElementById("modelo").value;
  var v_HP = document.getElementById("HP").value;
  var v_Km = document.getElementById("Km").value;
  var v_Anyo_produccion = document.getElementById("Anyo_produccion").value;
  var v_color = document.getElementById("color").value;
  var v_precio = document.getElementById("precio").value;

  var r_id_vehicle = validate_id_vehicle(v_id_vehicle);
  var r_marca = validate_marca(v_marca);
  var r_modelo = validate_modelo(v_modelo);
  var r_HP = validate_HP(v_HP);
  var r_Km = validate_Km(v_Km);
  var r_Anyo_produccion = validate_Anyo_produccion(v_Anyo_produccion);
  var r_color = validate_color(v_color);
  var r_precio = validate_precio(v_precio);

  if (!r_id_vehicle) {
    document.getElementById("error_id_vehicle").innerHTML =
      " * El código vehiculo introducido no es valido";
    //per parar quan done error > return false
    check = false;
  } else {
    document.getElementById("error_id_vehicle").innerHTML = "";
  }
  if (!r_marca) {
    document.getElementById("error_marca").innerHTML =
      " * La marca del vehiculo no es valida ";
    check = false;
  } else {
    document.getElementById("error_marca").innerHTML = "";
  }
  if (!r_modelo) {
    document.getElementById("error_modelo").innerHTML =
      " * El modelo introducido no es valido";
    check = false;
  } else {
    document.getElementById("error_modelo").innerHTML = "";
  }
  if (!r_HP) {
    document.getElementById("error_HP").innerHTML =
      " * No has introducido un caracter valido";
    check = false;
  } else {
    document.getElementById("error_HP").innerHTML = "";
  }
  if (!r_Km) {
    document.getElementById("error_Km").innerHTML =
      " * No has introducido un caracter valido";
    check = false;
  } else {
    document.getElementById("error_Km").innerHTML = "";
  }
  if (!r_Anyo_produccion) {
    document.getElementById("error_Anyo_produccion").innerHTML =
      " *La fecha introducido no es valido ";
    check = false;
  } else {
    document.getElementById("error_Anyo_produccion").innerHTML = "";
  }
  if (!r_color) {
    document.getElementById("error_color").innerHTML =
      " * EL color introducido no es valido";
    check = false;
  } else {
    document.getElementById("error_color").innerHTML = "";
  }
  if (!r_precio) {
    document.getElementById("error_precio").innerHTML =
      " * El precio introducido no es valido";
    check = false;
  } else {
    document.getElementById("error_precio").innerHTML = "";
  }

  document.update_vehicle.submit();
  document.update_vehicle.action =
    "index.php?page=controller_vehicle?op=update";

  return check;
  //  implementar el ajax per a que arreplegue les dades i li xufles ahi a tope va
}

function showModal(carTitle, id) {
  $("#details_vehicle")
    .show()
    .dialog({
      title: carTitle,
      width: 850,
      height: 500,
      resizable: "false",
      modal: "true",
      hide: "fold",
      show: "fold",
      buttons: {
        Update: function () {
          window.location.href =
            "index.php?page=controller_vehicle&op=update&id=" + id;
        },
        Delete: function () {
          window.location.href =
            "index.php?page=controller_vehicle&op=delete&id=" + id;
        }
      }
    });
}

function loadContentModal() {
  $("#table_home").DataTable();

  $(".car").on("click", function () {
    var id = this.getAttribute("id");

    $.ajax({
      type: "GET",
      dataType: "json",
      url:
        "module/vehicle/controller/controller_vehicle.php?op=read_modal&id=" +
        id,
    })
      .done(function (jsonCar) {
        if (jsonCar === "error") {
          /*  desc=list  pues has de millorar  el tema de les exceptions2*/
          window.location.href = "index.php?page=exception&op=503&read";
        } else {
          /*  divv */
          $("#modalcontent").empty();
          $("<div></div>")
            .attr("id", "details_vehicle")
            .appendTo("#modalcontent");
          $("#details_vehicle").html(function () {
            var content = "";
            for (row in jsonCar) {
              content +=
                "<br><span>" +
                row +
                ": <span id =" +
                row +
                ">" +
                jsonCar[row] +
                "</span></span>";
            } // end_for
            //////
            return content;
          });
        }
        /*         console.log(jsonCar);*/
        showModal(carTitle = jsonCar.marca + " " + jsonCar.modelo + " " + jsonCar.HP ,jsonCar.id_vehicle);
      })
      .fail(function () {
        window.location.href = "index.php?page=exception&op=503&read";
      });
  });
}

$(document).ready(function () {
  loadContentModal();
});
