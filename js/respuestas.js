$(document).on('ready', function(){
    $( "#tabs" ).tabs(); //Tabs jquery ui
        //Live url
        var videosrc;
        var urlVideo;
        var urlImagen;
        var hayImagen = false;
        var total_respuestas;
        var imagenWeb; //para obtener ruta preview        

        var curImages = new Array();
        
                
                $('textarea.respuesta').liveUrl({
                    loadStart : function(){
                        $('.liveurl-loader').show();
                    },
                    loadEnd : function(){
                        $('.liveurl-loader').hide();
                    },
                    success : function(data) 
                    {
                        urlImagen = data.url;
                        //.log(data);//Add by RaulBG                         

                        var output = $('.liveurl');
                        output.find('.title').text(data.title);
                        output.find('.description').text(data.description);
                        output.find('.url').text(data.url);
                        output.find('.image').empty();
                        
                        output.find('.close').one('click', function() 
                        {
                            hayImagen = false;
                            var liveUrl     = $(this).parent();
                            liveUrl.hide('fast');
                            liveUrl.find('.video').html('').hide();
                            liveUrl.find('.image').html('');
                            liveUrl.find('.controls .prev').addClass('inactive');
                            liveUrl.find('.controls .next').addClass('inactive');
                            liveUrl.find('.thumbnail').hide();
                            liveUrl.find('.image').hide();

                            $('textarea.respuesta').trigger('clear'); 
                            curImages = new Array();
                        });
                        
                        output.show('fast');
                        
                        if (data.video != null) {
                            videosrc = data.video.file;
                            urlVideo = data.url;                   
                            var ratioW        = data.video.width  /350;
                            data.video.width  = 350;
                            data.video.height = data.video.height / ratioW;
        
                            var video = 
                            '<object width="' + data.video.width  + '" height="' + data.video.height  + '">' +
                                '<param name="movie"' +
                                      'value="' + data.video.file  + '"></param>' +
                                '<param name="allowScriptAccess" value="always"></param>' +
                                '<embed src="' + data.video.file  + '"' +
                                      'type="application/x-shockwave-flash"' +
                                      'allowscriptaccess="always"' +
                                      'width="' + data.video.width  + '" height="' + data.video.height  + '"></embed>' +
                            '</object>';
                            output.find('.video').html(video).show();
                            
                         
                        }
                    },
                    addImage : function(image)
                    {                           
                        hayImagen = true;
                        var output  = $('.liveurl');
                        var jqImage = $(image);                        
                        jqImage.attr('alt', 'Preview');

                        console.log(image.src);
                        imagenWeb = image.src;

                        if ((image.width / image.height)  > 7 
                        ||  (image.height / image.width)  > 4 ) {
                            // we dont want extra large images...
                            return false;
                        } 

                        curImages.push(jqImage.attr('src'));
                        output.find('.image').append(jqImage);
                        
                        
                        if (curImages.length == 1) {
                            // first image...
                            
                            output.find('.thumbnail .current').text('1');
                            output.find('.thumbnail').show();
                            output.find('.image').show();
                            jqImage.addClass('active');
                            
                        }
                        
                        if (curImages.length == 2) {
                            output.find('.controls .next').removeClass('inactive');
                        }
                        
                        output.find('.thumbnail .max').text(curImages.length);                        
                    }
                });
              
              
                $('.liveurl ').on('click', '.controls .button', function() 
                {
                    var self        = $(this);
                    var liveUrl     = $(this).parents('.liveurl');
                    var content     = liveUrl.find('.image');
                    var images      = $('img', content);                    
                    var activeImage = $('img.active', content);                    

                    if (self.hasClass('next')) 
                         var elem = activeImage.next("img");
                    else var elem = activeImage.prev("img");
      
                    if (elem.length > 0) {
                        activeImage.removeClass('active');
                        elem.addClass('active');  
                        liveUrl.find('.thumbnail .current').text(elem.index() +1);
                        
                        if (elem.index() +1 == images.length || elem.index()+1 == 1) {
                            self.addClass('inactive');
                        }
                    }

                    if (self.hasClass('next')) 
                         var other = elem.prev("img");
                    else var other = elem.next("img");
                    
                    if (other.length > 0) {
                        if (self.hasClass('next')) 
                               self.prev().removeClass('inactive');
                        else   self.next().removeClass('inactive');
                   } else {
                        if (self.hasClass('next')) 
                               self.prev().addClass('inactive');
                        else   self.next().addClass('inactive');
                   }                                                  
                });
    //End live url
	//Peticion obtener pregunta
	function peticionPregunta(){
        $.ajax({
        url: "includes/pregunta.php",
        type: "POST",
        data: {id: id},
        dataType: "json",
        success: function(data){    
        	$.each(data, function(c, v){
                total_respuestas = v.total;
        		$('#pregunta_res').append(
        			'<div class="pregunta_preg"><p>'+v.pregunta+'</p></div>'+
        			'<div class="mensaje_preg">'+v.mensaje+'</div>'+
        			'<div class="autor_preg">'+v.autor+'</div>'+
        			'<div class="fecha_preg">'+moment(v.fecha).calendar()+'</div>'
        		);
        		$('.total_resp').append(total_respuestas+" comentarios"); 
        	})
        },
        error: function (xhr, ajaxOptions, thrownError) {
        	console.log(xhr.status);
            console.log(thrownError);
            console.log(ajaxOptions);
        }
    	});
    };
    //Inicia nueva funcion respuestas
    function peticionRespuestas(){
        $.ajax({
        url: "includes/respuestas.php",
        type: "POST",
        data: {id: id},
        dataType: "json",
        success: function(data){
        	$.each(data, function(c, v){
        		var res = v.respuesta;                
        		if(v.control == 1){        		
        			res = '<pre class="brush:php; html-script:true; toolbar: false;">'+res+'</pre>';                    
        		}
        		$('.add_resp').append(
        			'<article class="respuestas_alumnos"><div class="autor">'+v.autor+'</div>'+
        			'<div class="fecha_resp">'+moment(v.fecha).calendar()+'</div>'+
        			'<div class="msg_respuesta">'+res+'</div>'+
        			'<div class="voto"><a href="#" class="clickme" id="'+v.id+'"><img src="img/corazon.png"></a><div class="'+v.id+' votos">'+v.votos+'</div></div></article>'
        		);
        	}); 
            votar();
            aplicarColor();       	
        },
        error: function (xhr, ajaxOptions, thrownError) {
        	console.log(xhr.status);
            console.log(thrownError);
            console.log(ajaxOptions);
        }
    	});
    }
    //End peticionRespuestas    
    peticionRespuestas();
    peticionPregunta();
	//Fin ajax	
	//Redimencionar textarea
	$('.animated').autosize({append: "\n"});	
	//Contador respuesta
	$('.respuesta').keydown(function(e){
		var maxChars = 649;
		if($(this).val().length <= maxChars){
			var charsLeft = ( maxChars - $(this).val().length );
			$('#contador_resp').text( charsLeft + ' caracteres restantes.' ).css('color', (charsLeft<10)?'#F00':'#000' );
		}else{
			return ($.inArray(e.keyCode,[8,35,36,37,38,39,40]) !== -1);
		}
	});
//End
	//Syntax highlighter
    function aplicarColor() {
	function path(){
		var args = arguments,
		    result = []
		    ;
		for(var i = 0; i < args.length; i++)
		    result.push(args[i].replace('@', 'js/syntax/scripts/'));
		     
		return result
	};
			 
	SyntaxHighlighter.autoloader.apply(null, path(
		'applescript            @shBrushAppleScript.js',
		'actionscript3 as3      @shBrushAS3.js',
		'bash shell             @shBrushBash.js',
		'coldfusion cf          @shBrushColdFusion.js',
		'cpp c                  @shBrushCpp.js',
		'c# c-sharp csharp      @shBrushCSharp.js',
		'css                    @shBrushCss.js',
		'delphi pascal          @shBrushDelphi.js',
		'diff patch pas         @shBrushDiff.js',
		'erl erlang             @shBrushErlang.js',
		'groovy                 @shBrushGroovy.js',
		'java                   @shBrushJava.js',
		'jfx javafx             @shBrushJavaFX.js',
		'js jscript javascript  @shBrushJScript.js',
		'perl pl                @shBrushPerl.js',
		'php                    @shBrushPhp.js',
		'text plain             @shBrushPlain.js',
		'py python              @shBrushPython.js',
		'ruby rails ror rb      @shBrushRuby.js',
		'sass scss              @shBrushSass.js',
		'scala                  @shBrushScala.js',
		'sql                    @shBrushSql.js',
		'vb vbnet               @shBrushVb.js',
		'html                   @shBrushXml.js'
	));
	SyntaxHighlighter.all();
    }
    //setTimeout(function () { aplicarColor(); }, 2000);
    //En time

    function validar(){
        if($('textarea.respuesta').val().length < 10){
            $('.mensajes_load').html('<h1>Ingrese minimo 10 caracteres</h1>').hide().slideDown(500);
            return false;
        }
        return true;
    };
    function validar2(){
        if($('textarea.respuesta2').val().length < 10){
            $('.mensajes_load').html('<h1>Ingrese minimo 10 caracteres</h1>').hide().slideDown(500);
            return false;
        }
        return true;
    };
	//End syntax Publicar pregunta
    function publicarRespuesta(id, respuesta, autor, control){
        $.ajax({
            url: "includes/responder.php",
            type: 'POST',
            data: {id: id, respuesta: respuesta, autor: autor, control: control},
            dataType: "json",
            beforeSend: function(){                
                $('.mensajes_load').html('<img src="img/preloader.gif" width="40px">').hide().slideDown(500);
            },
            success: function(data){
                if(data == "error"){
                    $('.mensajes_load').html('<h1>Ocurrió un error. Intente mas tarde</h1>').hide().slideDown(500);
                }else{
                $.each(data, function(c, v){
                    var res = v.respuesta;
                    if(v.control == 1){             
                        res = '<pre class="brush:php; html-script:true; toolbar: false;">'+res+'</pre>';                    
                    }
                    $('.add_resp').prepend(
                        '<article class="respuestas_alumnos last"><div class="autor">'+v.autor+'</div>'+
                        '<div class="fecha_resp">'+moment(v.fecha).calendar()+'</div>'+
                        '<div class="msg_respuesta">'+res+'</div>'+
                        '<div class="voto"><a href="#" class="clickme" id="'+v.id+'"><img src="img/corazon.png"></a><div class="'+v.id+' votos">'+v.votos+'</div></div></article>'
                    );                
                    $('.last').hide().slideDown(1000);
                    total_respuestas = parseInt(total_respuestas) + 1;
                    $('.total_resp').text(total_respuestas+" comentarios").fadeIn(500);
                    //REsetear campos
                    videosrc = null;
                    hayImagen = false;
                    var ocultar = $('.liveurl');
                    ocultar.hide('fast');
                    ocultar.find('.video').html('').hide();
                    ocultar.find('.image').html('');
                    ocultar.find('.controls .prev').addClass('inactive');
                    ocultar.find('.controls .next').addClass('inactive');
                    ocultar.find('.thumbnail').hide();
                    ocultar.find('.image').hide();

                    $('textarea.respuesta').trigger('clear'); 
                    curImages = new Array();
                    //
                    $('textarea.respuesta').val("");                    
                });
                }                
                aplicarColor();               
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('.mensajes_load').html('<h1>Ocurrió un error. Intente mas tarde</h1>').hide().slideDown(500);
                console.log(xhr.status);
                console.log(thrownError);                               
            }            
        });
        $('.mensajes_load').html('<img src="img/preloader.gif" width="40px">').hide(); 
    };//end funcion
    //Crear links
    //fin links
    $('.formRespuesta').on('submit', function(e){
        e.preventDefault();        
        //console.log(respuesta, autor, id, control);
        if(validar()){
            var respuesta = $('textarea.respuesta').val();
            var autor = $('.autor').val();
            var id = $('.id').val();
            var control = $('.control').val();        
            if(videosrc != null){
                respuesta = respuesta.replace(/(https?:\/\/[^ ;|\\*'"!,()<>]+\/?)+\n/g,'<a href="'+urlVideo+'" target="_blank" >$1</a>\n') + '<iframe width="640" height="480" src="'+videosrc+'" frameborder="0" allowfullscreen></iframe>';
                console.log(respuesta);
            }
            else if(hayImagen){
                 respuesta = respuesta.replace(/(https?:\/\/[^ ;|\\*'"!,()<>]+\/?)+\n/g,'<a href="'+urlImagen+'" target="_blank" >$1</a>\n') + '<img src="'+imagenWeb+'" alt="Sin Vista previa">';
            }

            publicarRespuesta(id, respuesta, autor, control);
        };
    });//end on submit
    $('.formRespuesta2').on('submit', function(e){
        e.preventDefault();
        if(validar2()){
            var respuesta = $('textarea.respuesta2').val();
            var autor = $('.autor2').val();
            var id = $('.id2').val();
            var control = $('.control2').val();
            console.log(respuesta, autor, id, control);
            publicarRespuesta(id, respuesta, autor, control);
        };
    });
    //Inicio script votacion
    function votar(){
        $('.clickme').on('click', function(e){
            e.preventDefault();
            var idp = $(this).attr("id");
            //ajax
            $.ajax({
                url: "includes/votarRespuesta.php",
                type: 'POST',
                data: {id: idp},
                dataType: "json",
                beforeSend: function(){                
                    console.log("Enviando");
                },
                success: function(data){
                    $.each(data, function(c, v){
                        console.log("los datos: "+v.id);
                        var idr = v.id;
                        $('.'+idr).text(v.valor);
                    });
                },
                error: function (xhr, ajaxOptions, thrownError) {                
                console.log(xhr.status);
                console.log(thrownError);                               
                } 
            });
            //end ajax 
        })
    }
    //Termina script votacion
});//End jquery onload