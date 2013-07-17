$(document).on('ready', function(){
    var inicio = 0;
    var limite = 1;
    var ocupado = false;
    function peticion(){
        $.ajax({
        url: "includes/preguntas.php",
        type: 'POST',
        data: {inicio: inicio, limite: limite},
        dataType: "json",
        success: function(datos)
        {
            if(datos){
            var fecha = datos.fecha; 
            $(".contenido").append(
                "<article class='area_preguntas'><div class='mensaje_foro'>"+
                datos.mensaje+"</div><div class='fecha_foro'>"+
                moment(fecha).fromNow()+"</div><div class='num_respuestas'>"+
                datos.total+"</div></article>");
            //$(".num_respuestas").append(datos.total);
            //<span data-livestamp="1373926936"></span>
            inicio = inicio + limite;
            }
            else if(!datos)
            {
                $('button#cargando').html('<center>No hay mas preguntas</center>'); 
                $(window).off("scroll");
                $('button#cargando').off("click");
            }
            ocupado = false;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            $('button#cargando').html('<center>Ocurrio un error. Intente mas tarde.</center>'); 
            $(window).off("scroll");
            $('button#cargando').off("click");
            ocupado = false;
        }
        });
        }
	//$(window).scroll(function()
    $(window).on("scroll", function(){
        //if($(window).scrollTop() == $(document).height() - $(window).height())
        if($(window).scrollTop() + $(window).height() > $('boton#cargando').height() && !ocupado)
        {                
            ocupado = true;
            setTimeout(function() {            
                peticion();
            }, 500);
        }
    });
    $('button#cargando').on("click", function(){
        if(ocupado == false) {
            ocupado = true;
            peticion();
        }
    });
    peticion();
});