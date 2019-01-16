<?php include("seguridad.php"); ?>
<?php
    $consultarecursos = 0;
    $consultarecursos = $_SESSION['consultarecursos'];
    while ($columna = mysqli_fetch_array($consultarecursos))
    {
       echo '<option value="'.$columna['cve_recurso'].'">'.$columna['nombre'].'</option>'; 
    }
?>

<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->