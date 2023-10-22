var mapa = new Object();
mapa.cargarMapa = $(document).ready(function () {
  var imgMapa =
    "https://api.tomtom.com/map/1/staticimage?key=JzEQIyIt4LUIcJbZtgsoqRtPk6YEGFwD&zoom=8&center=44.792568,40.578341&format=jpg&layer=basic&style=main&width=960&height=540&view=Unified&language=es-ES";
  var mapa = '<img src="' + imgMapa + '"' + ' alt="Mapa estatico de Armenia"/>';
  document.getElementsByTagName("section")[3].innerHTML += mapa;
});
