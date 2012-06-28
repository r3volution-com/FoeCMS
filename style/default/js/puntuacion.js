jQuery.fn.sistemaPuntuacion = function(puntos) {
	
	function createCookie(name,value,days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
		}
		else var expires = "";
		document.cookie = name+"="+value+expires+"; path=/";
	}
	
	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}
	
		  
	var container = jQuery(this);
	
	jQuery.extend(container, {
		puntos: 0,
	});
	
	var estrellas = jQuery(container).children('.estrella');
	
	estrellas
		.mouseover(function(){
			  eventos.quitar();
			  eventos.llenar(this);
		})
		.mouseout(function(){
			  eventos.quitar();
			  eventos.reiniciar();
		})
		.focus(function(){
			  eventos.quitar();
			  eventos.llenar(this);
		})
		.blur(function(){
			  eventos.quitar();
			  eventos.reiniciar();
		});

	//Cuando se hace click en una estrella
	estrellas.click(function(){

		if (readCookie('votado') == null){
			container.puntos = (estrellas.index(this) * .5) + .5;
	
	      	createCookie("votado", 1, 365);
	      	
	      	eventos.establecer_de_BD();		
		}	
  	});
       
	var eventos = {
		// llenar hasta la posición del ratón.
		llenar: function(el) { 		
			var index = estrellas.index(el) + 1;
			estrellas
				.children('a').css('width', '100%').end()
				.slice(0,index).addClass('hover').end();
		},
		
		// quitar todas las estrellas.
		quitar: function() { 		
			estrellas
				.filter('.on').removeClass('on').end()
				.filter('.hover').removeClass('hover').end();
		},
		
		// reiniciar el sistema.
		reiniciar: function() { 	
			var unidad = parseInt(container.puntos);
			var decimales = container.puntos - unidad;
			var num_estrellas = (unidad * 2) + 1;
			
			if (decimales >= .5)
				num_estrellas += 1;
			
			estrellas.slice(0, num_estrellas).addClass('on').end();
		},
		
		establecer_de_BD: function() {
			     container.puntos = puntos;  
			     eventos.reiniciar(); 
		}
	};    
	
	//Al principio establecemos el sistema con el valor que corresponde
	eventos.establecer_de_BD();
	
	return(this);	

};