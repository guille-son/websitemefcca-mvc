if(document.getElementById("paginacion")){

    var url_Data;
    var countIndex;
    const pageSize = 6;

    var Shuffle = window.Shuffle;
    var element = document.querySelector('.my-shuffle-container');
    var shuffleInstance = new Shuffle(element, {
        itemSelector: '.temporal',
        speed: 1500
    });

    var busqueda = false;
    var tituloBusqueda;

    var filtroActual;
    var estructura;

    window.addEventListener("load",function(){
        limpiarHistorial();
        filtroActual = "Todos";
        asignarEstructura();
        eventoFiltroCategoria();
        asignarPagina();
        cargarBarraPaginacion();
        eventosBusqueda();

        if(document.getElementById("filtros")){
            filtrosScrollOnOff();
            filtrosScrollEvent();
        }
        
    });

    // Sirve para que no brinde duplicidad al recargar la pagina (cuando se envia por form la busqueda)
    function limpiarHistorial(){
        if (window.history.replaceState) { // verificamos disponibilidad
            window.history.replaceState(null, null, window.location.href);
        }
    }

    function asignarEstructura(){
        if(document.getElementById("filtroEstructura")){
            estructura = document.getElementById("filtroEstructura").getAttribute("estructura");

            // Si no es un numero, quiere decir que esta recibiendo una cadena con un filtro
            if(isNaN(estructura)){
                filtroActual = estructura;
                estructura = 'Ninguna';
            }

        }else{
            estructura = 'Ninguna';
        }
    }

    function asignarPagina(){
        if(document.getElementById("notimefcca")){
            url_Data = "/websitemefcca-mvc/controladores/notimefcca.controlador.php";
        }
        else if(document.getElementById("documentos")){
            url_Data = "/websitemefcca-mvc/controladores/documentos.paginacion.controlador.php";
        }
        else if(document.getElementById("videos_Paginacion")){
            url_Data = "/websitemefcca-mvc/controladores/videos.paginacion.controlador.php";
        }else if(document.getElementById("documentosInicio")){
            url_Data = "/websitemefcca-mvc/controladores/documentos.inicio.controlador.php";
        }else if(document.getElementById("programasEmblematicos")){
            url_Data = "/websitemefcca-mvc/controladores/programasEmblematicos.controlador.php";
        }else if(document.getElementById("estrategias")){
            url_Data = "/websitemefcca-mvc/controladores/estrategias.controlador.php";
        }
    }

    // Esta funcion recibe el id de la pagina que se va a mostrar para realizar la peticion a la base
    // Cuando realiza la peticion, manda a crear las cajas de informacion
    function cargarPaginaNoticias(pagina){
        ajaxPaginacion(pagina);
    }

    /* FUNCIONES PARA LA CARGA DE LOS TEMPLATE DE INFORMACION */
    function ajaxPaginacion(pagina){
        const titulo = document.getElementById("txtBusqueda").value;

        if(titulo != ''){
            busqueda = true;
        }

        $.ajax({
            type: "post",
            data: {
                // Valores que se envian al php
                'tipo' : 'cargar_paginacion',
                'paginaActual' : pagina,
                'pageSize' : pageSize,
                'filtro' : filtroActual,
                'titulo' : titulo,
                'estructura' : estructura
            },
            // Direccion del archivo php donde se procesara la peticion
            url: url_Data,
            success: function (data) {
                var resultado = JSON.parse(data);
                cargarNoticiaBoxes(resultado);
            }
        });
    }

    /* AJAX PARA CARGAR LOS ARREGLOS DE ID PARA LA PAGINACION */

    function cargarBarraPaginacion(){
        AjaxNumRegistros();
    }

    function AjaxNumRegistros(){
        const titulo = document.getElementById("txtBusqueda").value;

        $.ajax({
            type: "post",
            data: {
                'tipo' : 'IdCount',
                'filtro' : filtroActual,
                'titulo' : titulo,
                'estructura' : estructura
            },
            url: url_Data,
            success: function (data) {
                if(data != null){
                    var resultado = JSON.parse(data);
                    countIndex = resultado;
                    iniciarBarra();
                    cargarPaginaNoticias(1);
                }
            }
        });
    }

    // Inicia la barra de paginacion (barraPaginacion.js) con el numero de paginas segun el pageSize
    function iniciarBarra(){
        if(countIndex != null){
            if(countIndex > pageSize){
                document.getElementById("holder").classList.remove("ocultarItem");
                const numpaginas = Math.ceil(countIndex/pageSize);
                iniciarBarraPaginacion(numpaginas);
                setDinamic();
            }else{
                document.getElementById("holder").innerHTML = "";
                document.getElementById("holder").classList.add("ocultarItem");
            }
        }
    }

    // Esta funcion regula el funcionamiento de la barra de paginacion al hacer click
    function setDinamic(){
        // Se valida que la pagina no sea la misma cargada
        var paginas = document.getElementsByClassName("botonActivo");
        for(var i = 0; i < paginas.length; i++){
            paginas[i].addEventListener("click",function(){
                if(getCurrentPage() != this.innerHTML){
                    scrollWindowTop(this.innerHTML);
                    cargarPaginaNoticias(this.innerHTML);
                }
            });
        }

        var boton_antes = document.getElementsByClassName("previous");
        for(var i = 0; i < boton_antes.length; i++){
            boton_antes[i].addEventListener("click",function(){
                if(!this.classList.contains( 'jp-disabled' )){
                    const paginaActual = getCurrentPage()-1;
                    scrollWindowTop(paginaActual);
                    cargarPaginaNoticias( paginaActual );
                    paginate(paginaActual);
                }
            });
        }

        // Se valida tanto en previous como en next que no se pase a numeros fuera del rango de las paginas
        var boton_despues = document.getElementsByClassName("next");
        for(var i = 0; i < boton_despues.length; i++){
            boton_despues[i].addEventListener("click",function(){
                if(!this.classList.contains( 'jp-disabled' )){
                    scrollWindowTop( (getCurrentPage()+1) );
                    cargarPaginaNoticias( ( getCurrentPage()+1) );
                    paginate(( getCurrentPage()+1));
                }
            });
        }
    }

    function scrollWindowTop(paginaActual){
        if(paginaActual == Math.ceil(countIndex/pageSize)){
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    }

    // Esta funcion es la encargada de crear las cajas que contienen la informacion de las paginas a aplicar la paginacion
    // Aqui se agregaran los enlaces a las distintas redes sociales de las etiquetas <a> con href=#
    function cargarNoticiaBoxes(data){
        comprobarMensajeNulo();

        resetBoxNotice();
        if(data.length != 0){
            var lista = document.getElementById("listPage");
            var htmlCode = "";
            for(var i = 0; i < data.length; i++){
                htmlCode += data[i];
            }
            lista.innerHTML = htmlCode;
        }else{
            const sinresultado = document.createElement("p");
            sinresultado.id = "mensajeNulo";
            sinresultado.innerHTML = "Aun no hay informacion por mostrar.";
            sinresultado.className = "centrarTexto";

            var mensajeBlanco = document.getElementById("inicio") ? "textoBlanco" : "textoNegro";
            sinresultado.classList.add(mensajeBlanco);

            document.getElementById("paginacion").appendChild(sinresultado);
            return ;
        }

        const agregado = document.getElementsByClassName("temporal");

        efectoshuffle(agregado);
        eventosEspecificosPorPagina();
    }

    function eventosEspecificosPorPagina(){
        if(document.getElementById("videos_Paginacion")){
            // Plugin para el manejo del IFrame de Youtube
            inicializarPlugin();
        }
    }

    function comprobarMensajeNulo(){
        if(document.getElementById("mensajeNulo")){
            document.getElementById("paginacion").removeChild(document.getElementById("mensajeNulo"));
        }
    }

    function resetBoxNotice(){
        if(document.getElementsByClassName("temporal").length != 0){
            eliminarElementos();
        }
    }

    function efectoshuffle(elements){
        shuffleInstance.add(elements);
        shuffleInstance.update();
    }

    function eliminarElementos(){
        const shuffleRemove = document.getElementsByClassName("temporal");
        shuffleInstance.remove(shuffleRemove);
        shuffleInstance.update();
    }

    function eventosBusqueda(){
        document.getElementById("btnBuscar").addEventListener("click",function(event){
            eventoBusquedaTitulo();
        });
    
        document.getElementById("txtBusqueda").addEventListener("keydown",function(event){
            if(event.key == 'Enter'){
                eventoBusquedaTitulo();
            }
        });

        if(document.getElementById("cancelarBusqueda")){

            document.getElementById("cajaBusqueda").addEventListener("mouseover",mostrarOcultarCancel);

            document.getElementById("cajaBusqueda").addEventListener("mouseout",function(){
                document.getElementById("cancelarBusqueda").style.display = "none";
            });

            document.getElementById("txtBusqueda").addEventListener("click",mostrarOcultarCancel);

            document.getElementById("cancelarBusqueda").addEventListener("click",function(){
                document.getElementById("txtBusqueda").value = '';
                mostrarOcultarCancel();
            });

            document.getElementById("txtBusqueda").addEventListener("keyup",mostrarOcultarCancel);
        }
    }

    function mostrarOcultarCancel(){
        var busqueda = document.getElementById("txtBusqueda").value;
    
        if(busqueda != ''){
            document.getElementById("cancelarBusqueda").style.display = "block";
        }else{
            document.getElementById("cancelarBusqueda").style.display = "none";
        }
    }

    function eventoBusquedaTitulo(){
        const buscar = document.getElementById("txtBusqueda").value;
        if(!busqueda){
            // Primera vez que presiona el boton para busqueda, evalua que no tenga el campo de busqueda vacio
            if(buscar != ''){
                tituloBusqueda = buscar;
                busqueda = true;
                cargarBarraPaginacion();
            }
        }else{
            if(buscar == ''){
                // Esta una busqueda activa que deja de dar un titulo para buscar
                tituloBusqueda = '';
                busqueda = false;
            }else if(buscar == tituloBusqueda){
                return;
            }
            tituloBusqueda = buscar;
            cargarBarraPaginacion();
        }
    }



    // Implementacion de eventos para gestionar los filtros

    // Evento para mover la barra de filtros al hacer scroll
    function filtrosScrollEvent(){
        document.getElementById("filtros").addEventListener("wheel",function(event){
            event.preventDefault();
            const filtros = document.getElementById("filtros");
            var scrollPos = event.deltaY;

            // ARRIBA
            if (scrollPos < 0){
                filtros.scrollLeft -= 50;
            }
            // ABAJO
            else{
                filtros.scrollLeft += 50;
            }
                
        });
    };

    // Eventos para deshabilitar el scroll de la pantalla cuando se esta encima del div de filtros
    function filtrosScrollOnOff(){
        document.getElementById("filtros").addEventListener("mouseenter",function(event){
            window.addEventListener('scroll', noScroll);
        });

        document.getElementById("filtros").addEventListener("mouseleave",function(event){
            window.removeEventListener('scroll', noScroll);
        });
    }

    function noScroll() {
        window.scrollTo(0, 0);
    }

    /* Esta funcion maneja el filtro al dar click en los botones, quita la clase activa y asigna al 
    correspondiente. Se quita el evento noScroll a la ventana para que no bloquee al dar touch a un boton. */
    function eventoFiltroCategoria(){
        const filtros = document.getElementsByClassName("filtroBusqueda");

        for(var i = 0; i < filtros.length; i++){
            filtros[i].addEventListener("click",function(event){
                window.removeEventListener('scroll', noScroll);

                if(event.target.textContent != filtroActual){
                    quitarFiltroHabilitado();
                    event.target.classList.add("filtroActivado");
                    filtroActual = event.target.textContent;
                    cargarBarraPaginacion();
                }
                
            });
        }
    }

    function quitarFiltroHabilitado(){
        var filtrosActivos = document.getElementsByClassName("filtroActivado");
        for(var i = 0; i < filtrosActivos.length; i++){
            filtrosActivos[i].classList.remove("filtroActivado");
        }
    }
}