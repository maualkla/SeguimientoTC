<?php
//Continuar Sesion}
@session_start();
if($_SESSION['sesion'] != '##$$!!')
{
    // En caso de no haber iniciado sesion, se le redirecciona.
    header("Location: ../index.html");
    exit();
}
//2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->
?>

