$(document).ready(function () {
  $('.menu .li_encabezado:has(ul)').click(function (e) {

    if ($(document).width() < 624 || $(document).width() < 992) {
      e.preventDefault();

      if ($(this).hasClass('activado')) {
        $(this).removeClass('activado');
        $(this).children('ul').slideUp();
      } else {
        $('.menu>ul>li>ul,.cuarto>div>ul>li>ul,.tercero>div>ul>li>ul').slideUp();
        $('.menu>ul>li,.cuarto>div>ul>li,.tercero>div>ul>li').removeClass('activado');
        $(this).addClass('activado');
        $(this).children('ul').slideDown();
      };
    }
  });

  $(window).resize(function () {
    if ($(document).width() < 624 || $(document).width() < 992) {
      $('.menu>ul>li>ul,.cuarto>div>ul>li>ul,.tercero>div>ul>li>ul').css({
        'display': 'none'
      });

      $('.menu>ul>li>ul,.cuarto>div>ul>li>ul,.tercero>div>ul>li>ul').slideUp();

    } else {
      $('.menu>ul>li>ul,.cuarto>div>ul>li>ul,.tercero>div>ul>li>ul').css({
        'display': 'inline'
      });
    }
  });

  $('.menu>ul>li>ul>li>a,.menu>ul>.cuarto>div>ul>li>ul>li>a,.menu>ul>.tercero>div>ul>li>ul>li>a').click(function () {
    window.location.href = $(this).attr("href");
  });

  $(window).scroll(function () {
    if (document.documentElement.scrollTop > 400) {
      $('.contenedor_boton_ir_arriba').addClass('show');
    } else {
      $('.contenedor_boton_ir_arriba').removeClass('show');
    }
  });

  $('.contenedor_boton_ir_arriba').click(function () {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });

    if ($(document).width() < 992) {
      $('.menu>ul>li>ul,.cuarto>div>ul>li>ul,.tercero>div>ul>li>ul').slideUp();
    }

  });

  // Datos de Buzon
  let nombre = $('#nombre_buzon');
  let mail = $('#mail_buzon');
  let asunto = $('#asunto_buzon');
  let mensaje = $('#mensaje_buzon');

  if ($('#buzon')) {
    $(nombre).blur(validarCampos);
    $(mail).blur(validarMail);
    $(asunto).blur(validarCampos);
    $(mensaje).blur(validarMensaje);

    function validarCampos() {
      if (this.value == '') {
        // this.style.border = '1px solid red';
      } else {
        this.style.border = 'none';
      }
    }

    function validarMensaje() {
      if (this.value == '') {
        // $('.buzon_mensaje').css('border', '1px solid red');
      } else {
        $('.buzon_mensaje').css('border', 'none');
      }
    }


    function validarMail() {
      var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if (!expr.test(this.value)) {
        // $(this).css('border', '1px solid red');
      } else {
        $(this).css('border', 'none');
      }
    }
  }

  $(".lazy").slick({
    dots: false,
    infinite: false,
    speed: 1000,
    slidesToShow: 4,
    responsive: [
      {
        breakpoint: 1460,
        settings: {
          slidesToShow: 3
        }
      },
      {
        breakpoint: 1030,
        settings: {
          slidesToShow: 3
        }
      },
      {
        breakpoint: 780,
        settings: {
          slidesToShow: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1
        }
      }

    ]
  });

  $("audio").audioPlayer();
});

if(document.getElementById("buscarVideoInicio")){
  document.getElementById("buscarVideoInicio").addEventListener("keydown",function(event){
    if(event.key == 'Enter'){
      document.getElementById('formBuscarVideo').submit()
    }
  });
}

if(document.getElementById("buscarVideoInicioExpo")){
  document.getElementById("buscarVideoInicioExpo").addEventListener("keydown",function(event){
    if(event.key == 'Enter'){
      document.getElementById('formBuscarVideoExpo').submit()
    }
  });
}