<html>
    <head>
        <title> Iniciar Sesión - STC </title>
        <link rel="shortcut icon" href="../data/icono.ico">
		<link rel=StyleSheet href= "../css/est.css" type="text/css">
    </head>
    <body>
        <?php
        //RECIBE DATOS
        $si = 0;
        $contra = $_REQUEST['contra'];
        $user = $_REQUEST['user'];
        $sql = "select * from usuarios";
        require_once("connect.php");
        $result = mysqli_query($dbc,$sql) or die ("Error: " .mysqli_error($dbc));
        mysqli_close($dbc);
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH )) 
        {
            if(( $contra == $row[5])&&( $user == $row[3]))
               {
                $si++;
                $valor = $row[0];
               }
        }
        if( $si == 1)
        {
            // Iniciamos una sesion en el sitio en caso de que si este correcto el usuario y contraseña.
            session_start();
            $_SESSION['sesion'] = '##$$!!'; $_SESSION['seccion'] = 1;
            $_SESSION['nomusua'] = $valor; echo 'Bienvenido '.$_SESSION['nomusua'].' da clic <a href="inicio.php">aqui</a> para acceder.';
            header('Location: inicio.php');
        }
        else
        {
            echo'<script type="text/javascript"> alert("USUARIO O CONTRASEÑA INCORRECTOS"); </script>';
            header('Location: ../index.html');
        }
        ?>
    </body>
</html>

<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->
