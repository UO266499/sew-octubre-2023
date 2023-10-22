var meteorologiaTiempoReal = new Object();
meteorologiaTiempoReal.cargarDatos = $(document).ready(function () {
  $.ajax({
    dataType: "json",
    url: "https://api.openweathermap.org/data/2.5/weather?lat=40.179188&lon=44.499104&units=metric&lang=es&APPID=727c660ef8c103988af4f1a03eebdf3c",
    meteorologiaTiempoRealhod: "GET",
    success: function (data) {
      document.getElementsByTagName("section")[2].innerHTML +=
        '<img src="https://openweathermap.org/img/wn/' +
        data.weather[0].icon +
        '@2x.png" alt="icono que muestra el tiempo actual">' +
        "<p>Temperatura: " +
        data.main.temp +
        " ºC</p>" +
        "<p>Temperatura máxima: " +
        data.main.temp_max +
        " ºC</p>" +
        "<p>Temperatura mínima: " +
        data.main.temp_min +
        " ºC</p>";
    },
    error: function () {
      document.getElementsByTagName("section")[2].innerHTML +=
        "<h2>¡problemas! No puedo obtener información de <a href='https://openweathermap.org'>OpenWeatherMap</a></h2>";
    },
  });
});
