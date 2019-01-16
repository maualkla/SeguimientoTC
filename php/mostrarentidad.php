<?php include("seguridad.php"); ?>
<?php
    $consultaentidades = 0;
    $consultaentidades = $_SESSION['consultaentidades'];
    while($columna = mysqli_fetch_array($consultaentidades)) 
    {
       echo '<option value="'.$columna['cve_ent'].'">'.$columna['nombre'].'</option>';
    }
?>

<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->