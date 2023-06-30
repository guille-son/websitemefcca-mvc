$(document).ready(function () {
    

    var crear = "crear";
    var editar = "editar";

    var tablaTransmisiones = $(".tablaTransmision").DataTable({
        "ajax": "ajax/tablaTransmisiones.ajax.php",
        "deferRender": true,
        "retrieve": true,
        "processing": true,
        "paging": true,
        "pageLength": 5,
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

    //Timepicker
    $('#crearTransmision #timepicker, #editarTransmisionModal #timepickerEditar').datetimepicker({
        format: 'HH:mm:ss'
    })

    var urlControlador = "controladores/transmisiones.controlador.php";

    // ====================================================== //
    // ============== AGREGAR LINK TRANSMISION ============== //
    // ====================================================== //
    $("#editarTransmisionModal .seleccionarLinkFace, #crearTransmision .seleccionarLinkFace").change(function () {

        var structlink = "https://fb.watch/";
        var link = $(this).val();

        if(!link.includes(structlink)) {

            $(".seleccionarLinkFace").val("");

            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Formato de link invalido!',
                showConfirmButton: false,
                timer: 2000
            })

        }
        
    });

    /*=============================================
    Registrar Transmisión
    =============================================*/
    function limpiarModalTransmision(valor) {

        if(valor == "crear") {

            $("#crearTransmision").find("input").val("");
            $("#crearTransmision input[name='tipo']").val("registroTransmision");

        } else {

            $("#editarTransmisionModal").find("input").val("");
            $("#crearTransmision input[name='tipo']").val("editarTransmision");

        }

    }
    
    $('#modal_registro_transmision').on('submit', function (e) {
        e.preventDefault();

        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: urlControlador,
            dataType: 'json',
            success: function (resultado) {

                if(resultado.mensaje == 'exito'){

                    eval(resultado.alerta);

                    setTimeout(function() {

                        limpiarModalTransmision(crear);
                        $('#crearTransmision').modal("hide");

                    }, 2000);

                    tablaTransmisiones.ajax.reload(null, false);
                }
                
                if(resultado.mensaje == 'invalido') {
                    eval(resultado.alerta);
                }                
            }
        });
    });

    $('#btCerrarModalRegistroTransmision, #btnCancelarRegistroTransmision').on('click', function () {
        limpiarModalTransmision(crear);
    });

    /*=============================================
    Editar Transmisión
    =============================================*/
    $(document).on("click", ".editarTransmision", function () {
        var idTransmision = $(this).attr("id-transmision");

        var datos = new FormData();
        datos.append("idTransmision", idTransmision);

        $.ajax({
            url:"ajax/transmision.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                $('input[name="editarIdTransmision"]').val(respuesta["id"]);
                $('input[name="editarTitulo"]').val(respuesta["titulo"]);
                $('input[name="editarHoraTransmision"]').val(respuesta["hora"]);
                $('input[name="editarLinkTransmision"]').val(respuesta["link"]);

            }
        })
    });

    $('#modal_editar_transmision').on('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Quieres guardar los cambios?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Guardar`,
            cancelButtonText: `Cancelar`,
            denyButtonText: `No guardar`
        }).then((result) => {
            if (result.isConfirmed) {

                var datos = $(this).serializeArray();

                $.ajax({
                    type: $(this).attr('method'),
                    data: datos,
                    url: urlControlador,
                    dataType: 'json',
                    success: function (resultado) {
                        
                        if(resultado.mensaje == 'exito'){

                            eval(resultado.alerta);

                            setTimeout(function() {
                                limpiarModalTransmision(editar);
                                $('#editarTransmisionModal').modal("hide");
                            }, 2000);

                            tablaTransmisiones.ajax.reload(null, false);

                        }

                        if(resultado.mensaje == 'invalido') {
                            eval(resultado.alerta);
                        }
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Los cambios no se guardaron', '', 'info')
            }
        })
    });

    $('#btCerrarModalEditarTransmision, #btnCancelarEditarTransmision').on('click', function () {
        limpiarModalTransmision(editar);
    });

    /*=============================================
    Eliminar Transmision
    =============================================*/
    $(document).on("click", ".eliminarTransmision", function () {
        var idTransmision = $(this).attr("id-transmision");

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
                datos.append("idEliminar", idTransmision);

                $.ajax({

                    url:"ajax/transmision.ajax.php",
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

                            tablaTransmisiones.ajax.reload(null, false);

                        }

                    }

                })
                
            }

          })

    });

    /*=============================================
    Finalizar o Poner en Curso Transmision
    =============================================*/
    $(document).on("click", ".btnActivarTransmision", function () {

        var idTransmision = $(this).attr("id-transmision");
        var estado = $(this).attr("estadoTransmision");

        var datos = new FormData();
        datos.append("idTransmision", idTransmision);
        datos.append("estado", estado);

        $.ajax({

            url:"ajax/transmision.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){

                tablaTransmisiones.ajax.reload(null, false);

            }

        })

    });

});