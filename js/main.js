(function(){
"use strict";

document.addEventListener('DOMContentLoaded',function(){


// mapa del sitio
if(document.getElementById('mapa')){
var map = L.map('mapa').setView([9.077646, -79.524665], 17);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.marker([9.077646, -79.524665]).addTo(map)
    .bindPopup('GDLWebCamp 2018 </br> Boletos ya disponibles')
    .openPopup()
    .bindTooltip('aqui seran')
    .openTooltip();
}


var regalo = document.getElementById('regalo');
// Campos de Datos de usuario 

var nombre = document.getElementById('nombre');
var apellido = document.getElementById('apellido');
var email = document.getElementById('email');
// Campos pases
  var pase_dia = document.getElementById('pase_dia');
  var pase_dosdias = document.getElementById('pase_dosdias');
  var pase_completo = document.getElementById('pase_completo');

//Botones y divs de resultados
var calcular = document.getElementById('calcular');
var errordiv = document.getElementById('error');
var botonRegistro = document.getElementById('btnRegistro');
var listadoProd = document.getElementById('lista-productos');
var suma =  document.getElementById("suma-total");

//Extras 
var etiquetas = document.getElementById("etiquetas");
var camisas = document.getElementById("camisa_evento");

botonRegistro.disabled = true;

  if(document.getElementById('calcular')){
 
calcular.addEventListener('click',calcularMontos);

//validar tipo de pases 
pase_dia.addEventListener('blur',mostrarDias);
pase_dosdias.addEventListener('blur',mostrarDias);
pase_completo.addEventListener('blur',mostrarDias);

// validar campos
nombre.addEventListener('blur',validarCampos);

apellido.addEventListener('blur',validarCampos);
email.addEventListener('blur',validarCampos);
email.addEventListener('blur',validarEmail);

function validarCampos(){
	if(this.value == ''){
       errordiv.style.display = 'block';
       errordiv.innerHTML = "Este campo es obligatorio";
       errordiv.style.border = '1px solid red';
       this.style.border = '1px solid red';
      }else{
      	errordiv.style.display = 'none';
      	this.style.border = '1px solid #cccccc';
      }

}

function validarEmail (){
	if(this.value.indexOf("@")>-1) {
	  errordiv.style.display = 'none';
      this.style.border = '1px solid #cccccc';

	}else{
       errordiv.style.display = 'block';
       errordiv.innerHTML = "Formato incorrecto para email (@)";
       errordiv.style.border = '1px solid red';
       this.style.border = '1px solid red';		

	}
}




function calcularMontos(event){
	event.preventDefault();
   
    if(regalo.value === '' ){
    	alert("Debes elegir un regalo");
    
    }else{

    	var boletosDia = parseInt(pase_dia.value,10)||0,
    	    boletos2Dias = parseInt(pase_dosdias.value,10)||0,
    	    boletosCompleto = parseInt(pase_completo.value,10)||0,
    	    cantCamisas = parseInt(camisas.value,10)||0,
    	    cantEtiquetas = parseInt(etiquetas.value,10)||0;

    	var totalPagar = (boletosDia * 30) + (boletos2Dias * 45) + (boletosCompleto * 50) +((cantCamisas * 10) * .93) + (cantEtiquetas * 2) ;
     
        console.log(totalPagar);

        var listaProducto = [];

        
        
       listadoProd.innerHTML = '';

        if(boletosDia>=1){
          listaProducto.push(boletosDia+ " Pases por día");
        }

        if(boletos2Dias>=1){
          listaProducto.push(boletos2Dias+ " Pases por 2 días");
        }

        if(boletosCompleto>=1){
          listaProducto.push(boletosCompleto+ " Pases completo");
        }
                
        if(cantCamisas>=1){
          listaProducto.push(cantCamisas+ " Camisas");

        }
         

        if(cantEtiquetas>=1){
          listaProducto.push(cantCamisas+ " Etiquetas");
        }
    
        listadoProd.style.display = 'block' 
        for (var i = 0;i<listaProducto.length;i++){
         listadoProd.innerHTML+=listaProducto[i] + "<br>";
        
        }

       suma.innerHTML = "$ "+ totalPagar.toFixed(2);
       botonRegistro.disabled = false;
       document.getElementById('total_pedido').value = totalPagar;
    }

} //  fin  calcularMontos


function mostrarDias (){
   console.log(pase_dia);
	var boletosDia = parseInt(pase_dia.value,10)||0,
    	    boletos2Dias = parseInt(pase_dosdias.value,10)||0,
    	    boletosCompleto = parseInt(pase_completo.value,10)||0;

    var diasElegidos = [];

        
        
       listadoProd.innerHTML = '';

        if(boletosDia>=1){
          diasElegidos.push("viernes");
        }

        if(boletos2Dias>=1){
          diasElegidos.push("viernes","sabado");
        }

        if(boletosCompleto>=1){
          diasElegidos.push("viernes","sabado","domingo");
        }
        
        for(var i = 0 ; i <diasElegidos.length; i++ ){
          document.getElementById(diasElegidos[i]).style.display = 'block'
        }

} //  fin mostrarDias

}


}); //DOM CONTENT LOADED

})();

$(function(){
     
  //LETTERING  
  $('.nombre-sitio').lettering('');

  //AGREGAR CLASE A MENU
  $('body.conferencia .navegacion-principal a:contains("Conferencia")').addClass('activo');
  $('body.invitados .navegacion-principal a:contains("Invitados")').addClass('activo');
  $('body.registro .navegacion-principal a:contains("Reservaciones")').addClass('activo');
  $('body.calendario .navegacion-principal a:contains("Calendario")').addClass('activo');

  //MENU FIJO 
  var windowheight =  $(window).height();
  var barraAltura =  $('.barra').innerHeight();
  $(window).scroll(function(){
   var scroll =  $(window).scrollTop();
   if(scroll>windowheight){
   $('.barra').addClass('fixed');
   $('body').css({'margin-top': barraAltura+'px'});
   }else{
    $('.barra').removeClass('fixed');
    $('body').css({'margin-top': '0px'});
   }

  });

   //MENU RESPONSIVE
   $('.menu-movil').on('click',function(){
     $('.navegacion-principal').slideToggle(300);
   });

  
  //  Ocultar programa del EVENTO con jquery
  //$('div.ocultar').hide();

  //PROGRAMA DE CONFERENCIAS
  $('.programa-evento .info-curso:first').show();
  $(".menu-programa a:first").addClass('activo');

  $(".menu-programa a").on('click',function(){
    $(".menu-programa a").removeClass('activo');
    $(this).addClass('activo');
    $('div.ocultar').hide();
   var enlace = $(this).attr('href');
   $(enlace).fadeIn(1000);
   return false;
  });
  
  //ANIMACIONES PARA LOS NUMEROS
  $('.resumen-evento li:nth-child(1) p').animateNumber({number:6},1200);
  $('.resumen-evento li:nth-child(2) p').animateNumber({number:15},1200);
  $('.resumen-evento li:nth-child(3) p').animateNumber({number:3},1500);
  $('.resumen-evento li:nth-child(4) p').animateNumber({number:9},1500);

 //CUENTA REGRESIVA 
 $('.cuenta-regresiva').countdown('2018/10/12 09:00:00', function(event){
  $('#dias').html(event.strftime('%D'));
  $('#horas').html(event.strftime('%H'));
  $('#minutos').html(event.strftime('%M'));
  $('#segundos').html(event.strftime('%S'));

 }); 
//Colorbox
$('.invitado-info').colorbox({inline:true, width:"50%"});
$('.boton_newsletter').colorbox({inline:true, width:"50%"});




});
