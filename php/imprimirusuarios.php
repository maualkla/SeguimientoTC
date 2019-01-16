<?php include("seguridad.php"); ?>
<?php
    $consultausuarios = $_SESSION['consultausuarios'];
    while($usuarios = mysqli_fetch_array($consultausuarios, MYSQLI_BOTH)) 
    {

        echo '<tr> <td>'.$usuarios[2].'</td><td>'.$usuarios[3].'</td><td>'.$usuarios['nombre'].'</td><td>'.$usuarios[4].'</td><td><button type="button" name="botonObservacion" class="botonpb" id="botonmas" onClick="motrocul4(event,'.$usuarios['id_usua'].')"><img src="../data/mas.svg"></button></td></tr>';
    }
?>
<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->