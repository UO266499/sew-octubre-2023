var juego = new Object();
juego.preguntas = [
  "Cuál es la moneda de Armenia:",
  "Cuál es el lema de Armenia:",
  "Nombre del himno:",
  "Cual es la capital:",
  "Cual es el juego favorito:",
  "La bebida tipica en armenia:",
  "Sitio mas visitados por los armenios en Armenia:",
  "Fruta insignia del pais",
  "Colores de la bandera:",
  "Donde se encuentra Armenia:",
];
juego.contador = -1;
juego.respuestasUsuario = [];
juego.respuestasCorrectas = [0, 3, 1, 2, 0, 0, 1, 2, 1, 3];
juego.matrizJuego = [
  ["Dram", "Franco", "Euro", "Dolar", "Peso"],
  [
    "Viva, viva, viva",
    "Todo por la patria",
    "Erevan como modo de vida",
    "Una nación, una bandera",
    "A por todas",
  ],
  [
    "La estrellada",
    "Una patria",
    "La marsellesa",
    "Cuatro patrones",
    "Despistados",
  ],
  ["Madrid", "Arhmed", "Erevan", "Armenia", "Oslo"],
  ["Ajedrez", "Parchis", "Oca", "Monopoli", "Blackjack"],
  ["Coñac", "Whisky", "Ron", "Vodka", "Agua"],
  ["Erevan", "Lago Sevan", "Gavar", "Ijevan", "Alaverdi"],
  ["Manzana", "Tomate", "Granada", "Platano", "Fresa"],
  [
    "Rojo, Morado y Amarillo",
    "Rojo, Azul y Naranja",
    "Rojo, Magenta y Naranja",
    "Rojo, Azul y Ambar",
    "Rojo, Azul marino y Amarillo",
  ],
  [
    "Europa",
    "Asia",
    "Entre Europa y Asia",
    "Entre Africa y Asia",
    "Entre Africa y Europa",
  ],
];
juego.seleccionar0 = function () {
  juego.respuestasUsuario.push(0);
  juego.cambiarPregunta();
};
juego.seleccionar1 = function () {
  juego.respuestasUsuario.push(1);
  juego.cambiarPregunta();
};
juego.seleccionar2 = function () {
  juego.respuestasUsuario.push(2);
  juego.cambiarPregunta();
};
juego.seleccionar3 = function () {
  juego.respuestasUsuario.push(3);
  juego.cambiarPregunta();
};
juego.seleccionar4 = function () {
  juego.respuestasUsuario.push(4);
  juego.cambiarPregunta();
};
juego.inicializar = $(document).ready(function () {
  juego.cambiarPregunta();
});
juego.mostrarPuntuacion = function () {
  juego.puntuacion = 0;

  for (let index = 0; index < juego.respuestasCorrectas.length; index++) {
    if (juego.respuestasCorrectas[index] === juego.respuestasUsuario[index]) {
      juego.puntuacion++;
    }
  }

  document.getElementsByTagName("section")[0].innerHTML +=
    "<p> Puntuación final: " + juego.puntuacion + "/10</p>";
};
juego.cambiarPregunta = function () {
  juego.contador++;
  if (juego.contador < 10) {
    document.getElementsByTagName("input")[0].value =
      juego.preguntas[juego.contador];
    document.getElementsByTagName("button")[0].innerText =
      juego.matrizJuego[juego.contador][0];
    document.getElementsByTagName("button")[1].innerText =
      juego.matrizJuego[juego.contador][1];
    document.getElementsByTagName("button")[2].innerText =
      juego.matrizJuego[juego.contador][2];
    document.getElementsByTagName("button")[3].innerText =
      juego.matrizJuego[juego.contador][3];
    document.getElementsByTagName("button")[4].innerText =
      juego.matrizJuego[juego.contador][4];
  } else if (juego.contador == 10) {
    juego.mostrarPuntuacion();
    document.getElementsByTagName("input")[0].value = "Gracias por participar!";
  }
};
