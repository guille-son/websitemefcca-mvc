$(document).ready(function () {
    

    var crear = "crear";
    var editar = "editar";

    var tablaRadio = $(".tablaRadio").DataTable({
        "ajax": "ajax/tablaRadio.ajax.php",
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

    // Iniciar Datepicker
    $('#crearRadio #registroFecha, #editarRadioModal #editarFecha').datepicker({
        format: 'yyyy-mm-dd',
        todayBtn: "linked",
        language: "es",
        orientation: "bottom auto",
        autoclose: true,
        todayHighlight: true
    });

    function limpiarElementosRadio() {

        $("input[name='subirPrograma']").val("");
        $("#nombreArchivoNuevoPrograma").html("");

        $("input[name='subirProgramaEditar']").val("");
        $("#nombreArchivoEditarPrograma").html("");

    }

    function limpiarModalRadio(valor) {

        if(valor == "crear") {

            $("#crearRadio").find("input,textarea").val("");
            $("#crearRadio input[name='tipo']").val("registroRadio");
            $("input[name='subirPrograma']").val("");
            $("#nombreArchivoNuevoPrograma").html("");

        } else {

            $("#editarRadioModal").find("input,textarea").val("");
            $("#editarRadioModal input[name='tipo']").val("editarRadio");
            $("input[name='subirProgramaEditar']").val("");
            $("#nombreArchivoEditarPrograma").html("");

        }
    }

    // ====================================================== //
    // ============== Subir Programa Temporal =============== //
    // ====================================================== //
    $("input[name='subirPrograma'], input[name='subirProgramaEditar']").change(function () { 
        var programa = this.files[0];

        // ====================================================== //
        // ==== VALIDAMOS QUE EL FORMATO DEL ARCHIVO SEA MP3 ==== //
        // ====================================================== //

        if(programa["type"] != "audio/mpeg"){

            limpiarElementosRadio();

            Swal.fire({
                icon: 'error',
                title: 'Error al subir el programa',
                text: 'El programa debe estar en formato MP3!',
                confirmButtonText: 'Cerrar'
            })

        } else if(programa["size"] > 100000000){

            limpiarElementosRadio();

            Swal.fire({
                icon: 'error',
                title: 'Error al subir el programa',
                text: 'El programa de radio no debe pesar más de 100MB!',
                confirmButtonText: 'Cerrar'
            })

        }
        
    });

    $('#btCerrarModalRegistroRadio, #btnCancelarRegistroRadio').on('click', function () {
        limpiarModalRadio(crear);
    });

    $('#btnCancelarEditarRadio, #btCerrarModalEditarRadio').on('click', function () {
        limpiarModalRadio(editar);
    });

    var urlControlador = "controladores/radio.controlador.php";

    // ====================================================== //
    // ============== GUARDAR PROGRAMA DE RADIO ============= //
    // ====================================================== //
    $('#modal_registro_radio').on('submit', function (e) {
        e.preventDefault();

        var tema = $("#registroTema").val();
        var fecha = $("#registroFecha").val();

        if (tema == "" || fecha == "") {

            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Todos los campos son requeridos!',
                showConfirmButton: false,
                timer: 2000
            })

            return;

        } else {

            var datos = new FormData($('#modal_registro_radio')[0])

            $.ajax({
                type: $(this).attr('method'),
                contentType: false,
                data: datos,
                processData: false,
                url: urlControlador,
                dataType: 'json',
                success: function (resultado) {

                    if(resultado.mensaje == 'exito'){

                        eval(resultado.alerta);

                        setTimeout(function() {
                            limpiarModalRadio(crear);
                            $('#crearRadio').modal("hide");
                        }, 2000);

                        tablaRadio.ajax.reload(null, false);
                        
                    }
                    
                    if(resultado.mensaje == 'invalido') {
                        eval(resultado.alerta);
                    }

                    if(resultado.mensaje == 'subir-audio') {
                        eval(resultado.alerta);
                    }

                }

            });

        }

    });

    // ====================================================== //
    // ============== EDITAR PROGRAMA DE RADIO ============== //
    // ====================================================== //
    $(document).on("click", ".editarRadio", function () {
        var idRadio = $(this).attr("id-radio");

        var datos = new FormData();
        datos.append("idRadio", idRadio);

        $.ajax({
            url:"ajax/radio.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(respuesta){

                $('input[name="editarIdRadio"]').val(respuesta["id"]);
                $('input[name="editarTema"]').val(respuesta["tema"]);
                $('input[name="editarFecha"]').val(respuesta["fecha"]);
                $('input[name="programaActual"]').val(respuesta["link"]);

            }
        })
    });

    $('#modal_editar_radio').on('submit', function (e) {
        e.preventDefault();

        var tema = $("#editarTema").val();
        var fecha = $("#editarFecha").val();

        if (tema == "" || fecha == "") {

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

                    var datos = new FormData($('#modal_editar_radio')[0])

                    $.ajax({
                        type: $(this).attr('method'),
                        contentType: false,
                        data: datos,
                        processData: false,
                        url: urlControlador,
                        dataType: 'json',
                        success: function (resultado) {

                            if(resultado.mensaje == 'exito'){

                                eval(resultado.alerta);

                                setTimeout(function() {

                                    limpiarModalRadio(editar);
                                    $('#editarRadioModal').modal("hide");

                                }, 2000);

                                tablaRadio.ajax.reload(null, false);
                                
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

        }

    });

    // ====================================================== //
    // ============= ELIMINAR PROGRAMA DE RADIO ============= //
    // ====================================================== //
    $(document).on("click", ".eliminarRadio", function () {
        
        var idEliminar = $(this).attr("id-radio");
        var ruta = $(this).attr("ruta");

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
                datos.append("programa", ruta);

                $.ajax({

                    url:"ajax/radio.ajax.php",
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

                            tablaRadio.ajax.reload(null, false);

                        }

                    }

                })
                
            }

          })

    });

});