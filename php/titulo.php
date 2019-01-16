
<?php include("seguridad.php"); ?>
<?php 
//Tomamos el valor de "seccion" y lo imprimimos en el titulo dependiendo de la seccion en la que se encuentre.
$seccion = $_SESSION['seccion']; 
if($seccion == '1')
{
    echo 'PENDIENTES - STC';
}
else if($seccion == '2')
{
    echo 'LIBERADOS - STC';
}
else if($seccion == '3')
{
    echo 'USUARIOS - STC';
}
//2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos 
?>

