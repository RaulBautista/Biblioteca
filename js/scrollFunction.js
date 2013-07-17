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
            var total = datos.total;
            if (total == 0) {
                total = "Sin respuestas";
            }
            else if(total == 1){
                total = "1 respuesta";
            }
            else{
                total = total+" respuestas";
            };
            $(".contenido").append(
                '<article class="area_preguntas"><div class="mensaje_foro">'+
                datos.mensaje+'</div><div class="fecha_foro"><span data-livestamp="'+
                moment(fecha).unix()+'"></span></div><div class="num_respuestas">'+
                total+'</div></article>');
            //moment(fecha).fromNow()
            //<span data-livestamp="1373926936"></span>
            inicio = inicio + limite;
            }
            else if(!datos)
            {
                $('button#cargando').html('<center>No hay mas preguntas</center>'); 
                $(window).off("scroll");
                $('button#cargando').off("click").addClass('boton_error');
            };
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