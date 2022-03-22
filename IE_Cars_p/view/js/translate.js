function changeLang(lang) {
  lang = lang || localStorage.getItem("app-lang") || "en";
  localStorage.setItem("app-lang", lang);
  var elmnts = document.querySelectorAll("[data-tr]");

  $.ajax({
    url: "view/js/lang/" + lang + ".json",
    type: "GET",
    dataType: "json",
    success: function (data) {
      for (var i = 0; i < elmnts.length; i++) {
        elmnts[i].innerHTML = data.hasOwnProperty(lang)
          ? data[lang][elmnts[i].dataset.tr]
          : elmnts[i].dataset.tr;
      }
    },
  });
}

$(document).ready(function () {
  changeLang(); //perdeterminat
  $("#btn-es").on("click", function () {
    changeLang("es"); //de cada llenguatxe
  });
  $("#btn-en").on("click", function () {
    changeLang("en");
  });
  $("#btn-val").on("click", function () {
    changeLang("val");
  });
});
