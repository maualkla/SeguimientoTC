<?php include("seguridad.php"); ?>
<?php
    $consultaliberados = $_SESSION['consultaliberados'];
    while($liberados = mysqli_fetch_array($consultaliberados, MYSQLI_BOTH)) 
    {
       echo '<tr><td>'.$liberados[15].'</td><td>'.$liberados[9].'</td><td>'.$liberados[10].'</td><td>'.$liberados[11].'</td><td>'.$liberados[8].'</td><td>'.$liberados[2].'</td><td>'.$liberados[3].'</td><td>'.$liberados[5].'</td><td><button type="button" name="botonObservacion" class="botonpb" id="botonmas" onClick="motrocul2(event)"><img src="../data/mas.svg"></button></td><td>'.$liberados[6].'</td><td>'.$liberados[18].'</td></tr>';
    }
?>
<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->