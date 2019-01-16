<?php include("seguridad.php"); ?>
<?php
    $consultamunicipios = 0;
    $consultamunicipios = $_SESSION['consultamunicipios'];
    while($columna = mysqli_fetch_array($consultamunicipios, MYSQLI_BOTH)) 
    {
       echo '<option value="'.$columna['cve_mun'].'">'.$columna['nombre'].'</option>';
    }
?>

<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->