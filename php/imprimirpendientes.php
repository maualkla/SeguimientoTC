<?php include("seguridad.php"); ?>
<?php
    $consultapendientes = $_SESSION['consultapendientes'];
    while($pendientes = mysqli_fetch_array($consultapendientes, MYSQLI_BOTH)) 
    {
        echo '<tr> <td>'.$pendientes[15].'</td><td>'.$pendientes[9].'</td><td>'.$pendientes[10].'</td><td>'.$pendientes[11].'</td><td>'.$pendientes[8].'</td><td>'.$pendientes[2].'</td><td>'.$pendientes[3].'</td><td>'.$pendientes[5].'</td><td><button type="button" name="botonObservacion" class="botonpb" id="botonmas" onClick="motrocul(event,'.$pendientes[0].')"><img src="../data/mas.svg"></button></td><td>'.$pendientes[6].'</td></tr>';
    }
?>

<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->