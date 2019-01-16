<html>
    <head>
        <title> Cargar - Seguimiento TC </title>
        <link rel="shortcut icon" href="data/icono.ico">
		<link rel=StyleSheet href= "css/est.css" type="text/css">
    </head>
    <body>
        <?php
        $campo1 = $_REQUEST['id_geo'];
        $campo2 = $_REQUEST['nombre_geo'];
        $campo3 = $_REQUEST['nombre_con'];
        $campo4 = $_REQUEST['ref_loc'];
        if($campo4 == ""){ $campo4 = " ";}
        $campo5 = $_REQUEST['cve_carta50'];
        if($campo5 == ""){ $campo5 = " ";}
        $campo6 = $_REQUEST['fecha_reg'];
        $campo7 = $_REQUEST['cve_ter_gen'];
        $campo8 = $_REQUEST['cve_ent'];
        $campo9 = $_REQUEST['cve_mun'];
        $campo10 = $_REQUEST['cve_loc'];
        $campo11 = $_REQUEST['coor_lat_nor'];
        $campo12 = $_REQUEST['coor_lon_or'];
        $campo13 = $_REQUEST['sop_ofi'];
        if($campo13 == ""){ $campo13 = " ";}
        $campo14 = $_REQUEST['cve_recurso'];
        $campo15 = $_REQUEST['proced_fte'];
        if($campo15 == ""){ $campo15 = " ";}
        $campo16 = $_REQUEST['obs'];
        if($campo16 == ""){ $campo16 = " ";}
        $campo17 = "P";
        
        $usuarios = 'SELECT * FROM USUARIOS WHERE cve_nivel LIKE "%'.$campo8.$campo14.'"';
        $agregar = "INSERT INTO registros (id_geo,nombre_geo,nombre_con,ref_loc,cve_carta50,fecha_val,cve_ter_gen,cve_ent,cve_mun,cve_loc,coor_lat_nor,coor_lon_or,sop_ofi,cve_recurso,proced_fte,obs,estado) VALUES ('".$campo1."','".$campo2."','".$campo3."','".$campo4."','".$campo5."','".$campo6."','".$campo7."','".$campo8."','".$campo9."','".$campo10."','".$campo11."','".$campo12."','".$campo13."','".$campo14."','".$campo15."','".$campo16."','".$campo17."')";
        

        require_once("connect.php");
        $resultado = mysqli_query($dbc,$agregar) or die (" ERROR, NO SE AGREGARON LOS DATOS ".mysqli_error($dbc));
        $resusuario = mysqli_query($dbc,$usuarios) or die(" ERROR QUERY USUARIOS FALLO ".mysqli_error($dbc));
        mysqli_close($dbc);
        $usuariocorr = mysqli_fetch_array($resusuario, MYSQLI_BOTH );
        $header = 'SISTEMA DE SEGUIMIENTO DEL TRABAJADOR DE CAMPO';
        $body = 'HOLA '.$usuariocorr['nombre'].' USTED TIENE UN <a href="../index.html">REGISTRO</a> POR VALIDAR, '.$campo2.'. SI ESTE CORREO NO ES PARA USTED COMUNIQUESE AL AREA DE GEOGRAFIA.';
        $from = 'From: preguntas.asi@gmail.com';
        echo $usuariocorr['correo'];
        $bool = mail($usuariocorr['correo'],$header, $body, $from);
        
        if($bool)
        {
            header('Location: ../php/create.html');
        }
        else
        {
            echo " Mensaje no enviado."; echo $header."<br>"; echo $body."<br>"; echo $usuariocorr['correo']."<br>";
        }
        ?>
    </body>
</html>

<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->
