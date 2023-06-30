$(document).ready(function () {
    
    var tablaEstructura = $(".tablaEstructura").DataTable({
        "ajax": "ajax/tablaEstructura.ajax.php",
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
    $('.seleccionarCatalogo').select2();

    function limpiarElementos() {

        $("input[name='subirImgNoticia']").val("");

    }

    // ====================================================== //
    // ================= Plugin CK Editor 5 ================= //
    // ====================================================== //

    ClassicEditor.create(document.querySelector('#descripcionEstructura'), {
        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo'],
        language: 'es'
    })
    .then(function (editor) {

    })
    .catch(function (error) {

    });

    // ====================================================== //
    // =============== Subir Imagen Temporal ================ //
    // ====================================================== //
    $("input[name='subirImgEstructura']").change(function () {
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

                $('.previsualizarImgEstructura').attr('src', rutaImagen);
                $("#rutaImagen").val(rutaImagen);
                $("#imagenNueva").val(rutaImagen);
                $('.extensionImagen').val(imagen["type"]);

            });

        }

    });

    // ====================================================== //
    // =========== GUARDAR O ACTUALIZAR ESTRUCTURA ========== //
    // ====================================================== //
    $(".guardarEstructura").click(function (e) {

        e.preventDefault();

        var idEstructura = $(".idEstructura").val();

        var idCatalogo = $(".seleccionarCatalogo").val().split(",")[0];
        var catalogo = $(".seleccionarCatalogo").val().split(",")[1];

        var titulo = $(".seleccionarTitulo").val();

        var tipoImagen = $(".extensionImagen").val();

        var imagen = $("#rutaImagen").val();
        var imagenNuevaEditar = $("#imagenNueva").val();
        var imagenAntigua = $("#imagenActual").val();

        var descripcion = $(".ck-content").html();

        var tipo = $(".tipo").val();

        if (idCatalogo == "" || idCatalogo == "default" ||
            titulo == "" || descripcion == "" || imagen == "") {

            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Todos los campos son requeridos!',
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
                    datos.append("idEstructura", idEstructura);
                    datos.append("idCatalogo", idCatalogo);
                    datos.append("catalogo", catalogo);
                    datos.append("titulo", titulo);
                    datos.append("tipoImagen", tipoImagen);
                    datos.append("imagen", imagen);
                    datos.append("imagenNueva", imagenNuevaEditar);
                    datos.append("imagenAntigua", imagenAntigua);
                    datos.append("descripcion", descripcion);
                    datos.append("tipo", tipo);

                    $.ajax({
                        type: "POST",
                        url: "ajax/estructura.ajax.php",
                        data: datos,
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function (data) {

                            var resultado = data;

                            if (resultado.mensaje == 'exito') {

                                eval(resultado.alerta);

                                tablaEstructura.ajax.reload(null, false);

                                setTimeout(function() {
                                    location.reload();
                                }, 2000);

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
    // ================ ELIMINAR ESTRUCTURA ================= //
    // ====================================================== //
    $(document).on("click", ".eliminarEstructura", function () {
        
        var idEliminar = $(this).attr("id-estructura");
        var imagen = $(this).attr("ruta-imagen");

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
                datos.append("imagenEstructura", imagen);

                $.ajax({

                    url:"ajax/estructura.ajax.php",
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

                            tablaEstructura.ajax.reload(null, false);

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