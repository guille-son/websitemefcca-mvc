if(document.getElementById("buzonContent")){

    const exr = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let contador = 0;
    const btnCorreo = document.querySelector('#btnCorreo');
    const formulario = document.querySelector('#formulario-buzon');
    const nombreB = document.querySelector('#nombre_buzon');
    const mailB = document.querySelector('#mail_buzon');
    const asuntoB = document.querySelector('#asunto_buzon');
    const mensajeB = document.querySelector('#mensaje_buzon');

    eventListeners();
    function eventListeners() {
        //Cuando arranca la app
        document.addEventListener('DOMContentLoaded', iniciarPagina);
        //campos de formulario
        mailB.addEventListener('blur', validaFormulario);
    }

    function iniciarPagina() {
    }

    //Reseteo Formulario
    function reseteo() {
        formulario.reset();
    }

    function validaFormulario(e) {
        if (e.target.type === 'email') {
            //const resultado = e.target.value.indexOf('@');
            if (exr.test(e.target.value)) {
                contador = 0;
            } else {
                contador = 1;
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Correo inválido!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    }

    let movimiento = document.querySelector('.lds-dual-ring');

    document.getElementById('btnBuzon').addEventListener('click', function (e) {

        e.preventDefault();

        if (nombreB.value !== '' && asuntoB.value !== '' && mensajeB.value !== '') {
            if ((exr.test(mailB.value))) {
                btnCorreo.style.display = "none";

                let nombre = document.getElementById('nombre_buzon').value;
                let correo = document.getElementById('mail_buzon').value;
                let asunto = document.getElementById('asunto_buzon').value;
                let mensaje = document.getElementById('mensaje_buzon').value;

                movimiento.style.display = 'block';
                nombreB.style.disabled = 'true';
                mailB.style.disabled = 'true';
                asuntoB.style.disabled = 'true';
                mensajeB.style.disabled = 'true';
                $.ajax({
                    type: "post",
                    data: {
                        // Valores que se envian al php
                        'nombre_buzon': nombre,
                        'mail_buzon': correo,
                        'asunto_buzon': asunto,
                        'mensaje_buzon': mensaje
                    },
                    // Direccion del archivo php donde se procesara la peticion
                    url: '/websitemefcca-mvc/controladores/buzon.controlador.php',
                    success: function (e) {
                        reseteo();
                        movimiento.style.display = 'none';
                        btnCorreo.style.display = "block";
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'El mensaje se ha enviado con éxito!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                        nombreB.style.disabled = 'false';
                        mailB.style.disabled = 'false';
                        asuntoB.style.disabled = 'false';
                        mensajeB.style.disabled = 'false';
                    }
                });
            }
            else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Correo inválido!',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        } else {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Faltan Elementos!',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });

}