/* FUNCION NOBACKBUTTON
CREADA POR: MEAL
FECHA: 15 DE MARZO DE 2018
TIPO: JS
ENTRADAS: N/A
SALIDAS: IMPIDE REGRESAR A PAGINA ANTERIOR.
DESCRIPCIÓN: IMPIDE ERRORES AL BLOQUEAR EL RETROCESO EN LA PAGINA
*/
function nobackbutton()
{
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button" //chrome
   window.onhashchange=function()
   {
       window.location.hash="no-back-button";
   }
}

/* FUNCIONEXPAND
CREADA POR: MQV
FECHA: 15 DE MARZO DE 2018
TIPO: JS
ENTRADAS: N/A
SALIDAS: EXPANDE EL PANEL DE SESION DENTRO DEL BANNER.
DESCRIPCIÓN: ES AQUEL QUE GENERA LA ANIMACION QUE EXPANDE Y RETRAE EK MENU DE SESION
*/
function expand()
{
  var submenu = document.getElementById('drop');
  if(submenu.style.display == 'block')
  {
    submenu.style.display = 'none';
  } 
    else 
    {
        submenu.style.display = 'block';
    }
}

/* FUNCION  FUNCIONE
CREADA POR: MQV
FECHA: 15 DE MARZO DE 2018
TIPO: JS
ENTRADAS: N/A
SALIDAS: MUESTRA EL MENU PRINCIPAL DEL BANNER
DESCRIPCIÓN: ES AQUEL QUE GENERA LA ANIMACION QUE EXPANDE Y RETRAE EL MENU PRINCIPAL
*/
function funcione()
{
  if(document.getElementById("openMenu").className==="ocultar")
	  {
		  document.getElementById("openMenu").className="mostrar";
	  }
	else
		{
			document.getElementById("openMenu").className="ocultar";
		}
	if(document.getElementById("pen").className==="ocultar")
	  {
		  document.getElementById("pen").className="mostrar";
	  }
	else
		{
			document.getElementById("pen").className="ocultar";
		}
	if(document.getElementById("lib").className==="ocultar")
	  {
		  document.getElementById("lib").className="mostrar";
	  }
	else
		{
			document.getElementById("lib").className="ocultar";
		}
	if(document.getElementById("us").className==="ocultar")
	  {
		  document.getElementById("us").className="mostrar";
	  }
	else
		{
			document.getElementById("us").className="ocultar";
		}
}

/* FUNCION  HIDEMENU
CREADA POR: MEAL
FECHA: 15 DE MARZO DE 2018
TIPO: JS
ENTRADAS: N/A
SALIDAS: OCULTA EL MENU DE OPCIONES
DESCRIPCIÓN: ES UNA FUNCION QUE NOS PERMITE OCULTAR EL MENU CUANDO SE ESTA MOSTRANDO
*/
function ocultarme()
{
    $('#contextual').css("display","none");
    $('#contextual2').css("display","none");
    $('#contextual3').css("display","none");
    $('#contextual4').css("display","none");
}

/* FUNCION  motrocul
CREADA POR: MEAL
FECHA: 15 DE MARZO DE 2018
TIPO: JS
ENTRADAS: VALOR DE EVENT
SALIDAS: MUESTRA EL MENU DE OPCIONES
DESCRIPCIÓN: ES UNA FUNCION QUE MUESTRA EL MENU CONTEXTUAL SEGUN LAS COORDENADAS QUE ENVIA EL BOTON QUE PRESIONO LA ACCION
*/
function motrocul (event,idereg)
{
    
    $("#contextual").css("display","block");
    $("#iracta").attr("href",function(){ return "consultaacta.php?idreg="+idereg ;});
}
function motrocul2 (event)
{
    
    $("#contextual2").css("display","block");
}
function motrocul3 (event)
{
    $("#contextual3").css("display","block");
}
function motrocul4 (event,idreg)
{
    $("#contextual4").css("display","block");
    $("#irusuarios").attr("href",function(){ return "modificarusuarios.php?idreg="+idreg ;});
    $("#borrado").attr("href",function(){ return "modificarusuarios.php?cop=1&idreg="+idreg ;});
}

/* FUNCION  OCULTARMENUCONTEXTUAL
CREADA POR: MEAL
FECHA: 15 DE MARZO DE 2018
TIPO: JS
ENTRADAS: N/A
SALIDAS: EVITA MOSTRAR EL MENU CONTEXTUAL
DESCRIPCIÓN: BLOQUEA EL USO DEL CLIC DERECHO DENTRO DEL SISTEMA
*/
document.oncontextmenu = function()
{
    return false;
}

/* FUNCION  titulop
CREADA POR: MEAL
FECHA: 15 DE MARZO DE 2018
TIPO: JS - Jquery
ENTRADAS: N/A
SALIDAS: Mostrarte en pantalla los objetos de PENDIENTES
DESCRIPCIÓN: TE MUESTRA LA PANTALLA QUE DEBES VER SEGUN DONDE ESTES
*/

function titulop()
{
    document.title ="PENDIENTES - STC";
    $(".navbar a").css("text-decoration","none");
    $("#pen1").css("text-decoration","underline");
    $("#usuarios").css("display","none");
    $("#liberados").css("display","none");
    $("#pendientes").css("display","block");
}

/* FUNCION  titulol
CREADA POR: MEAL
FECHA: 20 DE MARZO DE 2018
TIPO: JS - Jquery
ENTRADAS: N/A
SALIDAS: Mostrarte en pantalla los objetos de LIBERADOS
DESCRIPCIÓN: TE MUESTRA LA PANTALLA QUE DEBES VER SEGUN DONDE ESTES
*/

function titulol()
{
    document.title ="LIBERADOS - STC";
    $(".navbar a").css("text-decoration","none");
    $("#lib1").css("text-decoration","underline");
    $("#usuarios").css("display","none");
    $("#pendientes").css("display","none");
    $("#liberados").css("display","block");
}

/* FUNCION  titulou
CREADA POR: MEAL
FECHA: 20 DE MARZO DE 2018
TIPO: JS - Jquery
ENTRADAS: N/A
SALIDAS: Mostrarte en pantalla los objetos de USUARIOS
DESCRIPCIÓN: TE MUESTRA LA PANTALLA QUE DEBES VER SEGUN DONDE ESTES
*/

function titulou()
{
    document.title ="USUARIOS - STC";
    $(".navbar a").css("text-decoration","none");
    $("#us1").css("text-decoration","underline");
    $("#pendientes").css("display","none");
    $("#liberados").css("display","none");
    $("#usuarios").css("display","block");
}

/* FUNCION  titulog
CREADA POR: MEAL
FECHA: 20 DE MARZO DE 2018
TIPO: JS - Jquery
ENTRADAS: N/A
SALIDAS: Mostrarte en pantalla los objetos de USUARIOS
DESCRIPCIÓN: TE MUESTRA LA PANTALLA QUE DEBES VER SEGUN DONDE ESTES
*/

function titulog()
{
    var x = document.title;
    if(x == 'PENDIENTES - STC')
    {
        $(".navbar a").css("text-decoration","none");
        $("#pen1").css("text-decoration","underline");
        $("#usuarios").css("display","none");
        $("#liberados").css("display","none");
        $("#pendientes").css("display","block");
    }
    else if(x == 'LIBERADOS - STC')
    {
        $(".navbar a").css("text-decoration","none");
        $("#lib1").css("text-decoration","underline");
        $("#usuarios").css("display","none");
        $("#pendientes").css("display","none");
        $("#liberados").css("display","block");
    }
    else if(x = 'USUARIOS - STC')
    {
        $(".navbar a").css("text-decoration","none");
        $("#us1").css("text-decoration","underline");
        $("#pendientes").css("display","none");
        $("#liberados").css("display","none");
        $("#usuarios").css("display","block");
    }
}


/* FUNCION  CAmbio
CREADA POR: MEAL
FECHA: 20 DE MARZO DE 2018
TIPO: JS - Jquery
ENTRADAS: String
SALIDAS:String a mayusculas
DESCRIPCIÓN: Cambia la string a mayusculas.
*/
function cambio()
{
    var x = document.login.user.value
    document.login.user.value = (x.toUpperCase());
}

/* FUNCION  Clear (SIN USAR)
CREADA POR: MEAL
FECHA: 26 DE MARZO DE 2018
TIPO: JS - Jquery
ENTRADAS: n/a
SALIDAS: Limpia el contenido de la textbox
DESCRIPCIÓN: Mediante la funcion document. borra el contenido de cierta caja de texto
*/
function clear()
{
    $("#insumo").value = "";
}

/* FUNCION  change
CREADA POR: MQV
FECHA: 11 DE ABRIL DE 2018
TIPO: JS - Jquery
ENTRADAS: n/a
SALIDAS: 
DESCRIPCIÓN: 
*/
function change(a)
{
	
	if(a=="desactivado")
	{
		var b=document.getElementById("active");
		var c=document.getElementById("desactivado");
		
		b.id="desactivado";
		c.id="active";
		
		if(b.className=="campo")  
		{
			document.getElementById("formcens").style.display="none";
			document.getElementById("formgab").style.display="block";
		}
		if(b.className=="gabinete")
		{
			document.getElementById("formgab").style.display="none";
			
			document.getElementById("formcens").style.display="block";
		}
	}
	
}

/* FUNCION  crear acta
CREADA POR: MEAL
FECHA: 16 DE ABRIL DE 2018
TIPO: JS - Jquery
ENTRADAS: n/a
SALIDAS: 
DESCRIPCIÓN: 
*/
function crearacta()
{
    $(".banner").css("display","none");
    $("#usuarios").css("display","none");
    $("#liberados").css("display","none");
    $("#pendientes").css("display","none");
    $(".crearnuevaacta").css("display","block");
    $(".userform").css("display","none");
    $(".userform2").css("display","none");
}

/* FUNCION  modiuser
CREADA POR: MEAL
FECHA: 16 DE ABRIL DE 2018
TIPO: JS - Jquery
ENTRADAS: n/a
SALIDAS: 
DESCRIPCIÓN: 
*/
function modiuser()
{
    $(".banner").css("display","none");
    $("#usuarios").css("display","none");
    $("#liberados").css("display","none");
    $("#pendientes").css("display","none");
    $(".crearnuevaacta").css("display","none");
    $(".userform").css("display","block");
    $(".userform2").css("display","none");
}
function crearuser()
{
    $(".banner").css("display","none");
    $("#usuarios").css("display","none");
    $("#liberados").css("display","none");
    $("#pendientes").css("display","none");
    $(".crearnuevaacta").css("display","none");
    $(".userform").css("display","none");
    $(".userform2").css("display","block");
}

//-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres //Geograficos -