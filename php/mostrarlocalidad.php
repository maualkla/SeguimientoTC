<?php include("seguridad.php"); ?>
<?php
$consultalocalidades = 0;
    $consultalocalidades = $_SESSION['consultalocalidades'];
    while($columna = mysqli_fetch_array($consultalocalidades, MYSQLI_BOTH)) 
    {
       echo '<option value="'.$columna[0].'">'.$columna['nombre'].'</option>';

    }
?>

<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->