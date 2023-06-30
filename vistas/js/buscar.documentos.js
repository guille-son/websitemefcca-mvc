$(document).ready(function () {

    window.addEventListener("load",function(){
        llenarPaginaInicio();
    });

    document.getElementById("btnBuscarDocInicio").addEventListener("click",function(event){
        llenarPaginaInicio();
    });

    function llenarPaginaInicio(){

        const buscar = document.getElementById("txtBuscarDocInicio").value;

        $.ajax({
            type: "post",
            data: {
                'texto_busqueda' : buscar,
            },
            url:  "/websitemefcca-mvc/controladores/documentos.inicio.controlador.php",
            success: function (data) {
                var resultado = JSON.parse(data);
                cargarDatosDocumentos(resultado);
            }
        });
    }

    function cargarDatosDocumentos(data){
        if(data.length != 0){
            var lista = document.getElementById("documentosPrincipales");
            var htmlCode = "";

            for(var i = 0; i < data.length; i++){
                htmlCode += data[i];
            }
                lista.innerHTML = htmlCode;
        }
      }

});

