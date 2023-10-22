var met = new Object();
met.error = "<h2>¡problemas! No puedo obtener información</h2>";
met.cargarDatos = $(document).ready(function () {
  met.url =
    "https://api.open-meteo.com/v1/forecast?latitude=40.179188&longitude=44.499104&daily=weathercode,temperature_2m_max,temperature_2m_min,apparent_temperature_max,apparent_temperature_min,uv_index_max,precipitation_sum,precipitation_probability_max,windspeed_10m_max,winddirection_10m_dominant&timezone=Europe%2FLondon";

  $.ajax({
    dataType: "JSON",
    url: met.url,
    method: "GET",
    success: function (data) {
      met.datos = data;
      met.verDatos();
    },
    error: function () {
      document.write(met.error);
    },
  });
});

met.verDatos = function () {
  time = met.datos.daily.time;
  precipitacion = met.datos.daily.precipitation_probability_max;
  tempMax = met.datos.daily.temperature_2m_max;
  feelTempMax = met.datos.daily.apparent_temperature_max;
  tempMin = met.datos.daily.temperature_2m_min;
  feelTempMin = met.datos.daily.apparent_temperature_min;
  uvMax = met.datos.daily.uv_index_max;
  precipitation_sum = met.datos.daily.precipitation_sum;
  windspeed = met.datos.daily.windspeed_10m_max;
  winddir = met.datos.daily.winddirection_10m_dominant;

  met.dia = "";
  for (let index = 0; index < time.length; index++) {
    fechaFormateada =
      time[index].split("-")[2] + "-" + time[index].split("-")[1];
    met.dia += "<section>";
    met.dia += "<h3>Día: " + fechaFormateada + "</h3>";
    met.dia += "<p>Temperatura Máxima: " + tempMax[index] + "ºC</p>";
    met.dia += "<p>Sencación térmica máxima: " + feelTempMax[index] + "ºC</p>";
    met.dia += "<p>Temperatura Mínima: " + tempMin[index] + "ºC</p>";
    met.dia += "<p>Sencación térmica mínima: " + feelTempMin[index] + "ºC</p>";
    met.dia +=
      "<p>Porcentaje de precipitación: " + precipitacion[index] + "%</p>";
    met.dia +=
      "<p>Acumulación de precipitación: " + precipitation_sum[index] + "mm</p>";
    met.dia += "<p>Velocidad de viento media: " + windspeed[index] + "km/h</p>";
    met.dia += "<p>Dirección del viento: " + winddir[index] + "</p>";
    met.dia += "<p>Indice máximo de rayos uv: " + uvMax[index] + "</p>";
    met.dia += "</section>";
  }

  document.getElementsByTagName("section")[0].innerHTML += met.dia;
};
