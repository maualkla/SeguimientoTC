<?php include("seguridad.php"); ?>
<?php 
    $regionusuario = $_SESSION['regionusuario'];
    if($regionusuario =="00")
    { 
        echo '<li id="us" class="ocultar"><a href="javascript:void(0)" onCLick="titulou()" id="us1" >USUARIOS</a></li>';
    }
?>

<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->