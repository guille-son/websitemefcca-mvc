$(document).ready(function () {

    var tablaNoticia = $(".tablaNoticias").DataTable({
        "ajax": "ajax/tablaNoticias.ajax.php",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "paging": true,
        "pageLength": 8,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_",
            "sInfoEmpty": "Mostrando registros del 0 al 0",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

    // Activar Select con buscador
    $('.seleccionarEstructura').select2();

    function limpiarElementos() {

        $("input[name='subirImgNoticia']").val("");

    }

    // ====================================================== //
    // ====== Subir Imagen Principal Temporal Noticia ======= //
    // ====================================================== //
    $("input[name='subirImgNoticia']").change(function () {
        var imagen = this.files[0];

        // ====================================================== //
        // = VALIDAMOS QUE EL FORMATO DE LA IMAGEN SEA JPG O PNF  //
        // ====================================================== //

        if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

            limpiarElementos();

            Swal.fire({
                icon: 'error',
                title: 'Error al subir la imagen',
                text: 'La imagen debe estar en formato JPG o PNG!',
                confirmButtonText: 'Cerrar'
            })

        } else if (imagen["size"] > 5000000) {

            limpiarElementos();

            Swal.fire({
                icon: 'error',
                title: 'Error al subir la imagen',
                text: 'La imagen no debe pesar más de 5MB!',
                confirmButtonText: 'Cerrar'
            })

        } else {

            var datosImagen = new FileReader;
            datosImagen.readAsDataURL(imagen);

            $(datosImagen).on('load', function (e) {

                var rutaImagen = e.target.result;

                $('.previsualizarImgNoticia').attr('src', rutaImagen);
                $("#rutaImagenDestacada").val(rutaImagen);
                $("#imagenNueva").val(rutaImagen);
                $('.extensionImagen').val(imagen["type"]);

            });

        }

    });

    // ====================================================== //
    // ================= Plugin CK Editor 5 ================= //
    // ====================================================== //

    ClassicEditor.create(document.querySelector('#descripcionNoticia'), {
	    toolbar: ['heading', '|', 'bold', 'italic', 'underline', '|', 'link', 'bulletedList', 'numberedList', '|', 'alignment', '|', 'undo', 'redo'],
//            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'alignment', '|', 'undo', 'redo', '|', 'bold'],
            language: 'es'
        })
        .then(function (editor) {

        })
        .catch(function (error) {

        });
    
    $('.efectoHover').on('mouseover', function() {
        $(this).css("cursor", "pointer");
    });
    // ====================================================== //
    // ============== ARRASTRAR VARIAS IMAGENES ============= //
    // ====================================================== //
    var archivosTemporales = [];

    $(".subirGaleria").on("dragenter", function (e) {

        e.preventDefault();
        e.stopPropagation();

        $(".subirGaleria").css({
            "background": "url(vistas/img/pattern.jpg)"
        });

    });

    $(".subirGaleria").on("dragleave", function (e) {

        e.preventDefault();
        e.stopPropagation();

        $(".subirGaleria").css({
            "background": ""
        });

    });

    $(".subirGaleria").on("dragover", function (e) {

        e.preventDefault();
        e.stopPropagation();

    });

    $("#galeria").change(function () {

        var archivos = this.files;

        multiplesArchivos(archivos);

    });

    $(".subirGaleria").on("drop", function (e) {

        e.preventDefault();
        e.stopPropagation();

        $(".subirGaleria").css({
            "background": ""
        });

        var archivos = e.originalEvent.dataTransfer.files;

        multiplesArchivos(archivos);

    });

    function multiplesArchivos(archivos) {

        for (var i = 0; i < archivos.length; i++) {

            var imagen = archivos[i];

            if (imagen["type"] != "image/jpeg") {

                Swal.fire({
                    icon: 'error',
                    title: 'Error al subir la imagen',
                    text: 'La imagen debe estar en formato JPG!',
                    confirmButtonText: 'Cerrar'
                })

                return;

            } else if (imagen["size"] > 5000000) {

                Swal.fire({
                    icon: 'error',
                    title: 'Error al subir la imagen',
                    text: 'La imagen no debe pesar más de 5MB!',
                    confirmButtonText: 'Cerrar'
                })

                return;

            } else {

                var datosImagen = new FileReader;
                datosImagen.readAsDataURL(imagen);

                $(datosImagen).on('load', function (e) {

                    var rutaImagen = e.target.result;

                    $(".vistaGaleria").append(`
                    
                        <li class="col-12 col-md-6 col-lg-3 card px-3 rounded-0 shadow-none">

                            <img class="rounded-lg card-img-top" src="` + rutaImagen + `">

                            <div class="card-img-overlay p-0 pr-3">

                                <button
                                    class="btn btn-danger btn-sm float-right shadow-sm quitarFotoNueva"
                                    temporal>

                                    <i class="fas fa-times"></i>

                                </button>

                            </div>

                        </li>
                    
                    `);

                    if (archivosTemporales.length != 0) {

                        archivosTemporales = JSON.parse($(".inputNuevaGaleria").val());

                    }

                    archivosTemporales.push(rutaImagen);

                    $(".inputNuevaGaleria").val(JSON.stringify(archivosTemporales));

                });

            }

        }

    }

    // ====================================================== //
    // ========== QUITAR IMAGEN NUEVA DE LA GALERIA ========= //
    // ====================================================== //
    $(document).on("click", ".quitarFotoNueva", function () {

        var listaFotosNuevas = $(".quitarFotoNueva");

        var listaTemporales = JSON.parse($(".inputNuevaGaleria").val());

        for (var i = 0; i < listaFotosNuevas.length; i++) {

            $(listaFotosNuevas[i]).attr("temporal", listaTemporales[i]);

            var quitarImagen = $(this).attr("temporal");

            if (quitarImagen == listaTemporales[i]) {

                listaTemporales.splice(i, 1);

                $(".inputNuevaGaleria").val(JSON.stringify(listaTemporales));

                $(this).parent().parent().remove();

            }

        }

    });

    /*=============================================
    QUITAR IMAGEN VIEJA GALERÍA
    =============================================*/

    $(document).on("click", ".quitarFotoAntigua", function(){

        var listaFotosAntiguas = $(".quitarFotoAntigua"); 

        var listaTemporales = $(".inputAntiguaGaleria").val().split(",");

        for(var i = 0; i < listaFotosAntiguas.length; i++){

            quitarImagen = $(this).attr("temporal");

            if(quitarImagen == listaTemporales[i]){

                listaTemporales.splice(i, 1);

                $(".inputAntiguaGaleria").val(listaTemporales.toString());

                $(this).parent().parent().remove();

            }

        }
    })

    // ====================================================== //
    // ============ GUARDAR O ACTUALIZAR NOTICIA ============ //
    // ====================================================== //
    $(".guardarNoticia").click(function (e) {

        e.preventDefault();

        var idNoticia = $(".idNoticia").val();

        var idEstructura = $(".seleccionarEstructura").val();

        var titulo = $(".seleccionarTitulo").val();

        var tipoImagen = $(".extensionImagen").val();

        var imagen = $("#rutaImagenDestacada").val();
        var imagenNuevaEditar = $("#imagenNueva").val();
        var imagenAntigua = $("#imagenDestacadaActual").val();

        var facebook = $(".seleccionarLinkFace").val();

        var instagram = $(".seleccionarLinkInsta").val();

        var twitter = $(".seleccionarLinkTwi").val();

        var descripcion = $(".ck-content").html();

        var descrip_corta = $("#descripcionCortaNoticia").val();

        var galeria = $(".inputNuevaGaleria").val();
        var galeriaAntigua = $(".inputAntiguaGaleria").val();

        var tipo = $(".tipo").val();

        if (idEstructura == "" || idEstructura == "default" ||
            titulo == "" || descripcion == "" || descrip_corta == "" || imagen == "") {

            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Faltó un campo requerido!',
                showConfirmButton: false,
                timer: 2000
            })

            return;

        } else {

            Swal.fire({
                title: 'Quieres guardar los cambios?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Guardar`,
                cancelButtonText: `Cancelar`,
                denyButtonText: `No guardar`
            }).then((result) => {
    
                if (result.isConfirmed) {

                    var datos = new FormData();
                    datos.append("idNoticia", idNoticia);
                    datos.append("idEstructura", idEstructura);
                    datos.append("titulo", titulo);
                    datos.append("tipoImagen", tipoImagen);
                    datos.append("imagen", imagen);
                    datos.append("imagenEditar", imagenNuevaEditar);
                    datos.append("imagenAntigua", imagenAntigua);
                    datos.append("facebook", facebook);
                    datos.append("instagram", instagram);
                    datos.append("twitter", twitter);
                    datos.append("descripcion", descripcion);
                    datos.append("descripcionCorta", descrip_corta);
                    datos.append("galeria", galeria);
                    datos.append("galeriaAntigua", galeriaAntigua);
                    datos.append("tipo", tipo);

                    $.ajax({
                        type: "POST",
                        url: "controladores/noticias.controlador.php",
                        data: datos,
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function (data) {

                            var resultado = data;

                            if (resultado.mensaje == 'exito') {

                                eval(resultado.alerta);

                                tablaNoticia.ajax.reload(null, false);

                                setTimeout(function() {
                                    location.reload();
                                }, 2000);

                            }

                            if (resultado.mensaje == 'galeria-vacia') {

                                eval(resultado.alerta);

                            }

                            if (resultado.mensaje == 'imagen-vacia') {

                                eval(resultado.alerta);

                            }

                            if (resultado.mensaje == 'invalido') {

                                eval(resultado.alerta);

                            }

                        }
                    });
    
                } else if (result.isDenied) {
    
                    Swal.fire('Los cambios no se guardaron', '', 'info')
    
                }
            })

        }

    });

    // ====================================================== //
    // ================== ELIMINAR NOTICIA ================== //
    // ====================================================== //
    $(document).on("click", ".eliminarNoticia", function () {
        
        var idEliminar = $(this).attr("id-noticia");
        var imagenPrincipal = $(this).attr("ruta-imagen-principal");
        var galeriaNoticia = $(this).attr("galeria-noticia");

        Swal.fire({

            title: 'Estás seguro?',
            text: "No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, elimínalo!',
            cancelButtonText: 'Cancelar'

          }).then((result) => {

            if (result.isConfirmed) {

                var datos = new FormData();
                datos.append("idEliminar", idEliminar);
                datos.append("imagenPrincipal", imagenPrincipal);
                datos.append("galeriaNoticia", galeriaNoticia);

                $.ajax({

                    url:"ajax/noticias.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(respuesta){

                        if(respuesta == 'ok'){
                            
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Registro Eliminado Correctamente',
                                showConfirmButton: false,
                                timer: 2000
                            })

                            tablaNoticia.ajax.reload(null, false);

                            setTimeout(function() {
                                location.reload();
                            }, 2000);

                        }

                    }

                })
                
            }

          })

    });

});
