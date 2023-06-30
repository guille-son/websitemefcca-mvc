if(document.getElementsByClassName('videoYoutube').length != 0) {
  var reproducir = false;

  window.addEventListener("load",function(){
    if(document.getElementById("videosSinPaginar")){
      inicializarPlugin();
    }
  });

  /*function onYouTubeIframeAPIReady() {
    if(document.getElementById("videosSinPaginar")){
      reproducirVideo();
    }
  }*/

  function inicializarPlugin(){
    reproducirVideo();
    funcionesPopup();
  }

  function funcionesPopup(){
    $(".videoLink").magnificPopup({
      type: "inline",
      midClick: true,
    });
  
    $(".videoLink").magnificPopup({
      midClick: true,
      mainClass: "mfp-fade",
      closeOnBgClick: false,
    });
  }

  function reproducirVideo(){
    const frames = document.getElementsByClassName("youtubeFrame");
    const videoContainers = document.getElementsByClassName("imagen_youtube");

    for(var i = 0; i < frames.length; i++){
      const idPlayer = frames[i].getAttribute("id");
      const srcUrl = frames[i].getAttribute("srcUrl");

      setImageVideo(srcUrl,videoContainers[i]);

      const player = new YT.Player(idPlayer, {
        height: "360",
        width: "640",
        videoId: captureCodingURL(srcUrl),
        playerVars: {
            autoplay: 0,
            enablejsapi: 1,
            controls: 1,
        },
        events: {
          onReady: onPlayerReady
        }
      });
    }

  }

  function onPlayerReady(event) {
    const url = event.target.h.getAttribute("srcUrl");
    const duracion = event.target.getDuration();
    //duraciones.push( {url:event.target.h.getAttribute("srcUrl"),duracion:event.target.getDuration()} );
    setTimes(url,duracion);
  }

  // tiempoDuracion es una clase de las etiquetas p que describen el tiempo del video, siempre van a 
  // coincidir el numero de estas etiquetas con los frames creados, asi entonces con los tiempos capturados
  // El orden tambien va a ser el mismo
  function setTimes(url,duration){
    var txtDuraciones = document.getElementsByClassName("tiempoDuracion");

    for(var i = 0; i < txtDuraciones.length; i++){
      const urlMatch = txtDuraciones[i].getAttribute("srcUrl");

      if(urlMatch == url){
        txtDuraciones[i].textContent = "  " + formatTime(duration);
        break;
      }

    }

  }

  function setImageVideo(urlYoutube,contImagen){
    const srcImage = getThumb(captureCodingURL(urlYoutube));
    contImagen.setAttribute("src",srcImage);
  }

  // Obtener src para las imagenes de los videos
  function getThumb(url, size) {
    var video, results, thumburl;

    if (url === null) {
      return "";
    }

    results = url.match("[\\?&]v=([^&#]*)");
    video = results === null ? url : results[1];

    if (size != null) {
      thumburl = "https://img.youtube.com/vi/" + video + "/" + size + ".jpg";
    } else {
      thumburl = "https://img.youtube.com/vi/" + video + "/mqdefault.jpg";
    }

    return thumburl;
  }

  function captureCodingURL(url) {
      try {
          var structlink = "https://www.youtube.com/watch?v=";
          var structlink2 = "https://youtu.be/";
          var dato;

          if (url == null) {
              console.log("NINGUN ENLACE INGRESADO");
          } else if (url.includes(structlink)) {
              return url.replace(structlink, "");
          } else if (url.includes(structlink2)) {
              return url.replace(structlink2, "");
          }
          return dato;
      } catch (e) {
          if (e instanceof TypeError) {
              // sentencias para manejar excepciones TypeError
          } else if (e instanceof RangeError) {
              // sentencias para manejar excepciones RangeError
          } else if (e instanceof EvalError) {
              // sentencias para manejar excepciones EvalError
          } else {
              // sentencias para manejar cualquier excepción no especificada
              logMyErrors(e); // pasa el objeto de la excepción al manejador de errores
          }
      }
  }

  function formatTime(time) {
    if (time <= 3600) {
      time = Math.round(time);
      var minute = Math.floor((time / 60) % 60);
      minute = minute < 10 ? "0" + minute : minute;
      var second = time % 60;
      second = second < 10 ? "0" + second : second;
      return minute + ":" + second;
    } else if (time >= 3600) {
      time = Math.round(time);
      var hour = Math.floor(time / 3600);
      hour = hour < 10 ? "0" + hour : hour;
      var minute = Math.floor((time / 60) % 60);
      minute = minute < 10 ? "0" + minute : minute;
      var second = time % 60;
      second = second < 10 ? "0" + second : second;
      return hour + ":" + minute + ":" + second;
    }
  }
  
}