<?php include("seguridad.php"); ?>
<?php
    //CONSULTA DE ACTA
    if($_REQUEST['idreg'] != "")
    {
        echo "Llego a la consulta para mostrar";
        $inforeg = 'SELECT * FROM registros WHERE id_geo = "'.$_REQUEST['idreg'].'"';
        require_once("connect.php");
        $consultainforeg = mysqli_query($dbc, $inforeg) or die ("Error al ejecutar la query de infirmacion de registrio para acta E:102".mysqli_error($dbc)); 
        mysqli_close($dbc);
        $arrayinforeg = mysqli_fetch_array($consultainforeg);
        $_SESSION['nombre_geo'] = $arrayinforeg['nombre_geo']; echo $_SESSION['nombre_geo'];
        $_SESSION['nombre_con'] = $arrayinforeg['nombre_con']; echo $_SESSION['nombre_con'];
        $_SESSION['cve_ter_gen'] = $arrayinforeg['cve_ter_gen']; echo $_SESSION['cve_ter_gen'];
        $_SESSION['cve_ent'] = $arrayinforeg['cve_ent']; echo $_SESSION['cve_ent'];
        $_SESSION['cve_mun'] = $arrayinforeg['cve_mun']; echo $_SESSION['cve_mun'];
        $_SESSION['cve_loc'] = $arrayinforeg['cve_loc']; echo $_SESSION['cve_loc'];
        $_SESSION['fecha_val'] = $arrayinforeg['fecha_val']; echo $_SESSION['fecha_val'];
        $_SESSION['id_geo'] = $_REQUEST['idreg']; echo $_SESSION['id_geo']; 
        $_SESSION['creando'] = 1;
        header('location: inicio.php');
    }
?>

<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->