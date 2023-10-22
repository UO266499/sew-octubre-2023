var noticias = new Object();
noticias.cargarDatos = $(document).ready(function () {
  $.ajax({
    dataType: "json",
    url: "https://eventregistry.org/api/v1/article/getArticles",
    data: {
      action: "getArticles",
      keyword: "Armenia",
      articlesPage: 1,
      articlesCount: 8,
      articlesSortBy: "date",
      articlesSortByAsc: false,
      articlesArticleBodyLen: -1,
      resultType: "articles",
      dataType: ["news", "pr"],
      apiKey: "7cc54f60-e75e-47d3-bf0f-9da1bba39c78",
      forceMaxDataTimeWindow: 31,
    },
    method: "GET",
    success: function (data) {
      var lasNoticias = data.articles.results;

      document.getElementsByTagName("section")[4].innerHTML +=
        "<p>Última actualización: " +
        new Date().toLocaleString("es-ES") +
        "</p>";
      for (let index = 0; index < lasNoticias.length; index++) {
        var not = lasNoticias[index];
        document.getElementsByTagName("section")[4].innerHTML +=
          "<article><h3>" +
          not.title +
          "</h3>" +
          '<img src="' +
          not.image +
          '" ' +
          'alt="imagen de la noticia publicada por' +
          not.source.uri +
          '" />' +
          '<a href="' +
          not.url +
          '">Enlace a la noticia</a>' +
          "<p> Ultima actualización de la noticia: " +
          new Date(not.date).toLocaleString("es-ES") +
          "</p></article>";
      }
    },
    error: function () {
      document.write(noticias.error);
    },
  });
});
