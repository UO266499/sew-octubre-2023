var carrusel = new Object();
carrusel.rutasFotos = [
  "multimedia/imagenes/erevan.webp",
  "multimedia/imagenes/areni.jpg",
  "multimedia/imagenes/dilijan.jpg",
  "multimedia/imagenes/goris-tatev.webp",
  "multimedia/imagenes/sevan.jpg",
];
carrusel.informacionImagenes = [
  "foto que muestra las calles de Erevan, la capital de Armenia",
  "foto que muestra el paisaje de Areni",
  "foto que muestra el paisaje de Dilijan",
  "foto que muestra el paisaje de Goris-tatev",
  "foto que muestra el paisaje de Sevan",
];
carrusel.contador = 0;
carrusel.previo = function () {
  carrusel.contador--;
  if (carrusel.contador === -1) {
    carrusel.contador = carrusel.rutasFotos.length - 1;
  }
  document.getElementsByTagName("img")[1].src =
    carrusel.rutasFotos[carrusel.contador];
  document.getElementsByTagName("img")[1].alt =
    carrusel.informacionImagenes[carrusel.contador];
};
carrusel.posterior = function () {
  carrusel.contador++;
  if (carrusel.contador === carrusel.rutasFotos.length) {
    carrusel.contador = 0;
  }
  document.getElementsByTagName("img")[1].src =
    carrusel.rutasFotos[carrusel.contador];
  document.getElementsByTagName("img")[1].alt =
    carrusel.informacionImagenes[carrusel.contador];
};
