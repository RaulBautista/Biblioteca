$(document).on('ready', function(){
    var inicio = 0;
    var limite = 2;
    var ocupado = false;
    function peticion(){
        $.ajax({
        url: "includes/preguntas.php",
        type: 'POST',
        data: {inicio: inicio, limite: limite},
        dataType: "json",
        success: function(datos){
        if(datos == "no"){
            $('button#cargando').html('<center>No hay mas preguntas</center>'); 
            $(window).off("scroll");
            $('button#cargando').off("click").addClass('boton_error');
        }
        else{
            $.each(datos, function(c, v){
                var total = v.total;
                if(total == 0){
                    total = '<div class="num_respuestas_cero">Sé el primero en responder</div>';
                }
                else if(total == 1){
                    total = '<div class="num_respuestas">'+total+' respuesta</div>';
                }else{
                    total = '<div class="num_respuestas">'+total+' respuestas</div>';
                }
                $(".contenido").append(
                    '<article class="area_preguntas"><div class="mensaje_foro">'+
                    v.mensaje+'</div><div class="fecha_foro"><span data-livestamp="'+
                    moment(v.fecha).unix()+'"></span></div>'+total+'</article>');
            });
            inicio = inicio + limite;
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