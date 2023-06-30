/*=======================================================================
    ===================== FUNCIONES MAPA DELEGACIONES =====================
    =======================================================================
*/

if(document.getElementById('mp')) {

  var mapa = $('.delegacion');
  var zoom = 100;
  var xdistance = 0;
  var ydistance = 0;
  var delegacionesData;
  var bloquearToolTip = false;

  window.addEventListener("load",function(){
    document.getElementById("tooltip").addEventListener("mouseleave",function(){
      bloquearToolTip = false;
      ocultarToolTip();
      quitarDelegacionSeleccionada();
    });
  });

  function quitarDelegacionSeleccionada(){
    var seleccionadas = document.getElementsByClassName("delegacionSeleccionada");

    for(var i = 0; i < seleccionadas.length; i++){
      seleccionadas[i].classList.remove("delegacionSeleccionada");
    }
  }

  // Asignacion de evento para cada delegacion
  for (var i = 0; i < mapa.length; i++) {
    $(mapa[i]).on('mouseleave', ocultarToolTip);

    mapa[i].addEventListener("mouseover",function(){mostrarToolTip(this);});

    mapa[i].addEventListener("click",function(){
      quitarDelegacionSeleccionada();
      this.classList.add("delegacionSeleccionada");

      if(bloquearToolTip){
        bloquearToolTip = false;
        console.log(this);
        mostrarToolTip(this);
      }

      bloquearToolTip = true;
    });
  }

  // Metodo para eliminar caracteres especiales, como tildes
  const prepareSearch = (str) => {
    const minuscula = str.toLowerCase();
    const sinespacio = minuscula.replace(/ /g, "");
    return sinespacio.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
  }

  // Estos metodos muestran o ocultan el tooltip cuando se posiciona el mouse encima de una delegacion o no
  function mostrarToolTip(element) {
    console.log(element);
    if(!bloquearToolTip){
      var delegacion = document.getElementById(element.id).getAttribute("title");
      const findDelegacion = delegacionesData.find( delegaciones => 
        prepareSearch( delegaciones.nombre_delegacion )  == prepareSearch( "delegación"+delegacion ) );
        cargarToolTip(findDelegacion,delegacion);
      $('#tooltip').css('opacity', '1');
      if ($(document).width() < 768) {
        $('figcaption.informacion').css({
          'display': 'block'
        });
      }
    }
  }

  function ocultarToolTip() {
    if(!bloquearToolTip){
      $('#tooltip').css('opacity', '0');
      if ($(document).width() < 768) {
        $('figcaption.informacion').css('display', 'none');
      }
    }
  }

  // Metodos para el manejo del zoom del mapa
  $('#zoom').on('click', aumentarZoom);
  $('#menoszoom').on('click', dismZoom);

  function aumentarZoom() {
    if ($(document).width() < 768) {
      zoom += 25; // Es necesario para nivelar el zoom del pinchar con el del boton
      zoom = zoom <= 250 ? zoom : 250;
      $('#mp').css('width', zoom + '%');
    }
  }

  function dismZoom() {
    if ($(document).width() < 768) {
      zoom -= 25;
      zoom = zoom >= 100 ? zoom : 100;
      $('#mp').css('width', zoom + '%');
    }
  }

  // Metodo para ajustar mapa al cambiar el tamaño de la ventana
  $(window).on('resize', resizePage);
  $(window).on('load', cargarPagina);

  function cargarPagina(){
    resizePage();
    cargarDatos();
  }

  // Este evento se asegura que el contenedor del mapa no cambie su altura (cuidado de los zoom)
  function resizePage() {
    // El ajuste de HeightMap se encarga de asignar la altura requerida por el svg obteniendola de su tamaño original en la pantalla
    // Se realiza el calculo zoom/100 para obtener la razon de zoom actual en el mapa
    if (window.innerWidth >= 768) {
      document.getElementById("mp").style.width = "100%";
      document.getElementById("map").style.height = "100%";
    } else {
      var heigtMap = document.getElementById("mp").clientHeight;
      heigtMap /= (zoom / 100);
      $('#map').css('height', heigtMap + 'px');
    }

    if ($(document).width() >= 768) {
      $('figcaption.informacion').css({
        'display': 'block'
      });
    } else {
      $('figcaption.informacion').css('display', 'none');
    }
  }

  // Se obtiene el valor inicial de la diferencia tanto en x como en y
  // Funcion no necesaria del todo, ayuda al zoom touch del mapa a no cometer acciones alocadas

  document.getElementById("map").addEventListener("touchstart", function (event) {
    if (event.touches.length > 1) {
      xdistance = Math.abs(event.touches[0].pageX - event.touches[1].pageX);
      ydistance = Math.abs(event.touches[0].pageY - event.touches[1].pageY);
    }
  });

  // Zoom por touch (pellizcar) se tiene cuidado con la variable zoom global que administra el evento zoom en botones
  // Si hay dos dedos en pantalla moviendose, deshabilita cualquier otro evento que pueda causar conflicto
  // El zoom se hace proporcional evaluando la distancia entre los dedos en el eje X o en el eje Y
  document.getElementById("map").addEventListener("touchmove", function (event) {
    if (window.innerWidth >= 768) {
      return;
    }
    var touches = event.touches;
    var distaux = 0;
    var distaY = 0;
    if (touches.length == 2) {
      event.preventDefault();
      distaux = Math.abs(touches[0].pageX - touches[1].pageX);
      distaY = Math.abs(touches[0].pageY - touches[1].pageY);

      if ((xdistance > distaux) || (ydistance > distaY)) { // Accion de reducir zoom
        zoom -= 10;
        zoom = zoom >= 100 ? zoom : 100;
      } else { // Accion de aumentar zoom
        zoom += 5;
        zoom = zoom <= 250 ? zoom : 250;
      }
      xdistance = distaux; // Se actualiza siempre, porque al ser un evento move, el valor de las distancias siempre cambiara
      ydistance = distaY;
      document.getElementById("mp").style.width = zoom + "%";
      resizePage();
    }
  });

  // Eventos de control de tooltip (carga)

  // Reemplazar atributos de la busqueda por los nombres reales en la base de datos
  // Analizar objeto JSON
  function cargarDatos(){
    $.ajax({
      type: "post",
      data: {
          'tipo' : 'delegaciones'
      },
      url: "../controladores/adelante.controlador.php",
      success: function (data) {
        if(data != null){
          delegacionesData = JSON.parse(data);
        }
      },
      error: function(){
        alert("Base de datos no disponible.")
      }
    });
  }

  function cargarToolTip(deleg){
    if(deleg != null){
        document.getElementById("txtdelegacion").innerHTML = deleg.nombre_delegacion;
        document.getElementById("delegado").innerHTML = deleg.nombre_delegado;
        document.getElementById("telefono").innerHTML = deleg.telefono_delegacion;
        document.getElementById("correo").innerHTML = deleg.email_delegacion;
        document.getElementById("direccion").innerHTML = deleg.direccion_delegacion;
        document.getElementById("imagen").src = "../../../backend/"+deleg.nombre_imagen_delegacion_subida;

        cargarRedesSociales("facebook",deleg.facebook);
        cargarRedesSociales("instagram",deleg.instagram);
        cargarRedesSociales("twitter",deleg.twitter);
    }
  }

  function cargarRedesSociales(elementId, delegacionRedSocial){
    if(delegacionRedSocial != null){
      var elemento = document.getElementById(elementId);
      elemento.setAttribute("href",delegacionRedSocial);
      $(elemento).show();
    }else{
      var elemento = document.getElementById(elementId);
      $(elemento).hide();
    }
  }
}
