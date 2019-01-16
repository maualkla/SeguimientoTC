<?php
// create connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registrong";

//check connection
    $dbc = mysqli_connect($servername,$username,$password,$dbname);
    if (!$dbc) {
        die("Connection failed" . mysqli_connect_error());
    }
?>
<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->