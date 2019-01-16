<?php include("seguridad.php"); ?>
<?php
    if($_REQUEST['cop'] == 1)
    {
        $delete = 'DELETE FROM usuarios WHERE id_usua = "'.$_REQUEST['idreg'].'"';
        echo $delete;
        require_once("connect.php");
        $consultadelete = mysqli_query($dbc, $delete) or die ("Error: NO se elimino el nombre".mysqli_error($dbc));
        mysqli_close($dbc);
        header ("Location: inicio.php");
    }
    else
    {
        if($_REQUEST['idreg'] != "")
        {
            echo 'LISTO';
            $infousua = 'SELECT * FROM usuarios WHERE id_usua = "'.$_REQUEST['idreg'].'"';
            require_once("connect.php");
            $consulta = mysqli_query($dbc, $infousua) or die ("Error: No se realizo la consulta ".mysqli_error($dbc));
            mysqli_close($dbc);
            $arrayu = mysqli_fetch_array($consulta);
            $_SESSION['id_usua'] = $arrayu[0]; 
            $_SESSION['nombre'] = $arrayu[1];
            $_SESSION['cve_nivel'] = $arrayu[2];
            $_SESSION['correo'] = $arrayu[3];
            $_SESSION['ext'] = $arrayu[4];
            $_SESSION['contra'] = $arrayu[5];
            $_SESSION['creando'] = 2;
            header ("Location: inicio.php");
        }
        else if($_REQUEST['op'] == 2)
        {
            $_SESSION['creando'] = 3;
            $_SESSION['insertar'] = 1;
            header ("Location: inicio.php");
        }
        else if($_REQUEST['op'] == 3)
        {
            $_SESSION['creando'] == 4;
            header ("Location: inicio.php");
        }
    }
?>

<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->