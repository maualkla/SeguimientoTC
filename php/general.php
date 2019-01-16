<?php include("seguridad.php"); ?>
<?php
        
        echo '<p style="display: none">';
        //Definimos los vectores que contienen la informacion acerca de las regiones, el primero contiene las claves, el segundo el numero de estados y el tercero los estados dentro de una string.
        $cve_regiones = array("01","02","03","04","05","06","07","08","09","10");
        $cve_2regiones = array("4","3","3","4","4","3","4","3","3","1");
        $cve_3regiones = array("02032526","081032","051928","06141618","01112224","121517","13212930","072027","042331","09");
        //Tomamos el usuario de la direccion (TEMPORAL)
        $usua = $_SESSION['nomusua'];
        global $usua;
        $_SESSION['usua'] = $usua;
                
        $x =0; $no = 0; $cont = 0;

        //Creamos dentro del string $datosusuario una consulta en la cual solicitamos la informacion del usuario para crear la pagina que debe visualizar
        $datosusuario= 'SELECT nombre, cve_nivel, correo FROM usuarios WHERE id_usua = "'.$usua.'"';
        //Creamos una conexion con la base de datos.
        require_once("connect.php");
        //Hacemos la consulta
        $consultausuario = mysqli_query($dbc,$datosusuario) or die ("Error: " .mysqli_error($dbc));
        //Guardamos el resultado de la consulta en un array para utilizar esos datos
        $arrayusuario = mysqli_fetch_array($consultausuario, MYSQLI_BOTH);
        global $arrayusuario; $_SESSION['arrayusuario'] = $arrayusuario;

        //Obtenemos a partir de la clave de nivel del usuario, el estado , la region y el recurso que le corresponde.
        $estadousuario = substr($arrayusuario['cve_nivel'],2,2); 
        $recursousuario = substr($arrayusuario['cve_nivel'],-2); 
        $regionusuario = substr($arrayusuario['cve_nivel'],0, 2); 
        $_SESSION['estadousuario'] = $estadousuario;
        $_SESSION['recursousuario'] = $recursousuario;
        $_SESSION['regionusuario'] = $regionusuario;

        
        //CREAMOS LA QUERY DE REGISTROS
        //En caso de que su region no sea 00 y su estado tampoco sea 00 pero su clave de recurso sea AA le mostramos todos los registros de su estado.
        
        //Definir las variables de campos.
        $campo1 = "";
        $campo2 = "";
        $campo3 = "";
        $campo4 = "";
        $campo5 = "";
        $campo6 = "";
        $campo7 = "";
        $campo8 = "";
        $campo9 = "";
        $campo10 = "";
        $campo11 = "";
        $campo12 = "";
        $campo13 = "";
        // Variables para crear acta, En ellas vaciamos la informacion que viene de la seccion "crearacta"
        $campo14 = ""; $campo14 = $_REQUEST['nombrec'];
        $campo15 = ""; $campo15 = $_REQUEST['fecha_evento'];
        $campo16 = ""; $campo16 = $_REQUEST['nombreev'];
        $campo17 = ""; $campo17 = $_REQUEST['obs_regr']; 
        $campo18 = ""; $campo18 = $_REQUEST['tipodeacta'];
        $campo19 = ""; $campo19 = $_REQUEST['nombredoc'];
        $campo20 = ""; $campo20 = $_REQUEST['doc_anexo'];
        // Variables para modificar al usuario
        $campo21 = ""; $campo21 = $_POST['idusua'];
        $campo22 = ""; $campo22 = $_POST['nombreusu'];
        $campo23 = ""; $campo23 = $_POST['contraseña'];
        $campo24 = ""; $campo24 = $_POST['correo'];
        $campo25 = ""; $campo25 = $_POST['ext'];
        $campo26 = ""; $campo26 = $_POST['region'];
        $campo27 = ""; $campo27 = $_POST['estado'];
        $campo28 = ""; $campo28 = $_POST['recurso'];
        // Variables para agregar un nuevo usuario
        $campo32 = ""; $campo32 = $_POST['nuevonombreusu'];
        $campo33 = ""; $campo33 = $_POST['nuevocontraseña'];
        $campo34 = ""; $campo34 = $_POST['nuevocorreo'];
        $campo35 = ""; $campo35 = $_POST['nuevoext'];
        $campo36 = ""; $campo36 = $_POST['nuevoregion'];
        $campo37 = ""; $campo37 = $_POST['nuevoestado'];
        $campo38 = ""; $campo38 = $_POST['nuevorecurso'];
            
        $fecha = date("Y")."/".date("m")."/".date("d"); echo $fecha; //Aqui obtengo la fecha. 
        $_SESSION['fecha'] = $fecha;
        
        //NUEVO USUARIO
        if(($campo32 != "")&&($campo33 != "")&&($campo34 != "")&&($campo35 != "")&&($campo36 != "")&&($campo37 != "")&&($campo38 != "")&&($_SESSION['insertar'] == 1))
        {
            $cvelevel = $campo36.$campo37.$campo38;
            $actualizarusuario = 'INSERT INTO usuarios (nombre, cve_nivel, correo, ext, contra) VALUES  ("'.$campo32.'","'.$cvelevel.'", "'.$campo34.'","'.$campo35.'","'.$campo33.'")';
            $campo32 = ""; $campo33 = ""; $campo34 = ""; $campo35 = ""; $campo36 = ""; $campo37 = ""; $campo38 = ""; 
            $consultaactualizarusuario = mysqli_query($dbc, $actualizarusuario) or die ("Error: No se ha realizado la actualización.".mysqli_error($dbc));
            $_SESSION['insertar'] = 0;
        }
        
        //MODIFICAR USUARIO
        if(($campo21 != "")&&($campo22 != "")&&($campo23 != "")&&($campo24 != "")&&($campo25 != "")&&($campo26 != "")&&($campo27 != "")&&($campo28 != ""))
        {
            $cvelevel = $campo26.$campo27.$campo28;
            $actualizarusuario = 'UPDATE usuarios SET nombre = "'.$campo22.'", cve_nivel = "'.$cvelevel.'", correo = "'.$campo24.'", ext = "'.$campo25.'", contra = "'.$campo23.'" WHERE id_usua = "'.$campo21.'"';
            $campo21 = ""; $campo22 = ""; $campo23 = ""; $campo24 = ""; $campo25 = ""; $campo26 = ""; $campo27 = ""; $campo28 = ""; 
            $consultaactualizarusuario = mysqli_query($dbc, $actualizarusuario) or die ("Error: No se ha realizado la actualización.".mysqli_error($dbc));
        }
        
        //CREACIÓN DE ACTAS
        if(($campo14 != "")&&($campo15 != "")&&($campo16 != "")&&($campo17 != "")&&($campo18 != ""))
        {
            //Aqui creamos una nueva acta
            $acta = 'INSERT INTO actas (id_geo, fecha_fin, tipodeacta, nombrec, obs_regr, fecha_evento, nombreev, id_usuario) VALUES ("'.$_SESSION['id_geo'].'","'.$fecha.'","'.$_REQUEST['tipodeacta'].'","'.$_REQUEST['nombrec'].'","'.$_REQUEST['obs_regr'].'","'.$_REQUEST['fecha_evento'].'","'.$_REQUEST['nombreev'].'","'.$usua.'")';
            $consultaacta = mysqli_query($dbc, $acta) or die ("Error: No se pudo realizar la insersion de acta. ".mysqli_error($dbc));
            //Se actualiza el estado de el registro
            $agregaracta = 'SELECT * FROM actas WHERE id_geo = "'.$_SESSION['id_geo'].'"';
            $cagregaracta = mysqli_query($dbc, $agregaracta) or die ("ERROR: ".mysqli_error($dbc));
            $aagregaracta = mysqli_fetch_array($cagregaracta);
            $cambio = 'UPDATE registros SET fecha_reg = "'.$fecha.'", estado = "L", id_acta = "'.$aagregaracta[0].'" WHERE id_geo = "'.$_SESSION['id_geo'].'"' ;
            //Ejecutamos las consultas.
            $consultacambio = mysqli_query($dbc, $cambio) or die ("Error: No se pudo realizar el cambio en la tabla registros".mysqli_error($dbc));
            echo $acta; echo $cambio; echo"<br> ENTRO 1 <br>";
        }
        if(($campo14 != "")&&($campo19 != "")&&($campo20 != "")&&($campo17 != "")&&($campo18 != ""))
        {
            $acta = 'INSERT INTO actas (id_geo, fecha_fin, tipodeacta, nombrec, obs_regr, nombredoc, doc_anexo) VALUES ("'.$_SESSION['id_geo'].'","'.$fecha.'","'.$_REQUEST['tipodeacta'].'","'.$_REQUEST['nombrec'].'","'.$_REQUEST['obs_regr'].'","'.$_REQUEST['nombredoc'].'","'.$_REQUEST['doc_anexo'].'","'.$usua.'")';
            $consultaacta = mysqli_query($dbc, $acta) or die ("Error: No se pudo realizar la insersion de acta. ".mysqli_error($dbc));
            $agregaracta = 'SELECT * FROM actas WHERE id_geo = "'.$_SESSION['id_geo'].'"';
            $cagregaracta = mysqli_query($dbc, $agregaracta) or die ("ERROR: ".mysqli_error($dbc));
            $aagregaracta = mysqli_fetch_array($cagregaracta);
            $cambio = 'UPDATE registros SET fecha_reg = "'.$fecha.'", estado = "L", id_acta = "'.$aagregaracta[0].'" WHERE id_geo = "'.$_SESSION['id_geo'].'"' ;
            //Ejecutamos las consultas.
            $consultacambio = mysqli_query($dbc, $cambio) or die ("Error: No se pudo realizar el cambio en la tabla registros".mysqli_error($dbc));
            echo $acta; echo $cambio; echo"<br> ENTRO 2 <br>";
        }
        
        // CONSULTA PERSONALIZADA DE REGISTROS
        //En caso de que se haya realizado una Query, tomamos los posibles valores que se enviaron.
        
        
        //PENDIENTES Y LIBERADOS
        if(($_REQUEST['insumo'] != "")||($_REQUEST['entidad'] != "")||($_REQUEST['municipio'] != "")||($_REQUEST['localidad'] != "")||($_REQUEST['terGen'] != "")||($_REQUEST['nombreGeo'] != "")||($_REQUEST['nombreCon'] != "")||($_REQUEST['cveCarta50m'] != "")||($_REQUEST['fechatabla'] != ""))
        {
            echo 'ENTRO A TOMAR VALORES PARA LA QUERY *************************';
            $campo1 = $_REQUEST['insumo']; echo'<br> '.$campo1;
            $campo2 = $_REQUEST['entidad']; echo'<br> '.$campo2;
            $campo3 = $_REQUEST['municipio']; echo'<br> '.$campo3;
            $campo4 = $_REQUEST['localidad']; echo'<br> '.$campo4;
            $campo5 = $_REQUEST['terGen']; echo'<br> '.$campo5;
            $campo6 = $_REQUEST['nombreGeo']; echo'<br> '.$campo6;
            $campo7 = $_REQUEST['nombreCon']; echo'<br> '.$campo7;
            $campo8 = $_REQUEST['cveCarta50m']; echo'<br> '.$campo8;
            $campo9 = $_REQUEST['fechatabla']; echo'<br> '.$campo9;
            
        }
        //Usaremos esta variable para agregar AND entre cada diferente consicional de la consulta
        $cont = 0;
        $cont2 = 0;
        $no = 0;
        
        //Validamos que valores se enviaron
        //SI ES CENTRAL
        if((($campo1 != "")||($campo2 != "")||($campo3 != "")||($campo4 != "")||($campo5 != "")||($campo6 != "")||($campo7 != "")||($campo8 != "")||($campo9 != "")||($campo10 != "")||($campo11 != ""))&&($regionusuario == '00'))
        {
            $cont = 0;
            $pendientes = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE ';
            $liberados = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado  FROM registros WHERE ';
            if($campo1 !="")
            {
                $pendientes = $pendientes . ' cve_recurso = "'.$campo1.'"';
                $liberados = $liberados . ' cve_recurso = "'.$campo1.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
                
            }
            if($campo2 !="")
            {
                $pendientes = $pendientes . ' cve_ent = "'.$campo2.'"';
                $liberados = $liberados . ' cve_ent = "'.$campo2.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
                
            }
            if($campo3 !="")
            {
                $pendientes = $pendientes . ' cve_mun = "'.$campo3.'"';
                $liberados = $liberados . ' cve_mun = "'.$campo3.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo4 !="")
            {
                $pendientes = $pendientes . ' cve_loc = "'.$campo4.'"';
                $liberados = $liberados . ' cve_loc = "'.$campo4.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo5 !="")
            {
                $pendientes = $pendientes . ' cve_ter_gen = "'.$campo5.'"';
                $liberados = $liberados . ' cve_ter_gen = "'.$campo5.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo6 !="")
            {
                $pendientes = $pendientes . ' nombre_geo = "'.$campo6.'"';
                $liberados = $liberados . ' nombre_geo = "'.$campo6.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo7 !="")
            {
                $pendientes = $pendientes . ' nombre_con = "'.$campo7.'"';
                $liberados = $liberados . ' nombre_con = "'.$campo7.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo8 !="")
            {
                $pendientes = $pendientes . ' cve_carta50 = "'.$campo8.'"';
                $liberados = $liberados . ' cve_carta50 = "'.$campo8.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo9 !="")
            {
                $pendientes = $pendientes . ' fecha_val = "'.$campo9.'"';
                $liberados = $liberados . ' fecha_val = "'.$campo9.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            $pendientes = $pendientes . ' estado = "P"'; 
            $liberados = $liberados . ' (estado = "L" OR estado = "R")'; 
            $no = 1;
        }
        else
        {
            $cont = 1;
        }
        //SI ES REGIONAL 
        if((($campo1 != "")||($campo2 != "")||($campo3 != "")||($campo4 != "")||($campo5 != "")||($campo6 != "")||($campo7 != "")||($campo8 != "")||($campo9 != "")||($campo10 != "")||($campo11 != ""))&&(($regionusuario != '00')&&($estadousuario == '00')))
        {
            $cont = 0;
            echo 'QUERY DE REGIONAL PERSONALIZADA.';
            $pendientes = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE ';
            $liberados = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado  FROM registros WHERE ';
            if($campo1 !="")
            {
                $pendientes = $pendientes . ' cve_recurso = "'.$campo1.'"';
                $liberados = $liberados . ' cve_recurso = "'.$campo1.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
                
            }
            if($campo2 !="")
            {
                $pendientes = $pendientes . ' cve_ent = "'.$campo2.'"';
                $liberados = $liberados . ' cve_ent = "'.$campo2.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
                
            }
            if($campo3 !="")
            {
                $pendientes = $pendientes . ' cve_mun = "'.$campo3.'"';
                $liberados = $liberados . ' cve_mun = "'.$campo3.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo4 !="")
            {
                $pendientes = $pendientes . ' cve_loc = "'.$campo4.'"';
                $liberados = $liberados . ' cve_loc = "'.$campo4.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo5 !="")
            {
                $pendientes = $pendientes . ' cve_ter_gen = "'.$campo5.'"';
                $liberados = $liberados . ' cve_ter_gen = "'.$campo5.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo6 !="")
            {
                $pendientes = $pendientes . ' nombre_geo = "'.$campo6.'"';
                $liberados = $liberados . ' nombre_geo = "'.$campo6.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo7 !="")
            {
                $pendientes = $pendientes . ' nombre_con = "'.$campo7.'"';
                $liberados = $liberados . ' nombre_con = "'.$campo7.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo8 !="")
            {
                $pendientes = $pendientes . ' cve_carta50 = "'.$campo8.'"';
                $liberados = $liberados . ' cve_carta50 = "'.$campo8.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo9 !="")
            {
                $pendientes = $pendientes . ' fecha_val = "'.$campo9.'"';
                $liberados = $liberados . ' fecha_val = "'.$campo9.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            echo $pendientes;
            if($campo2 != "")
            {
                $pendientes = $pendientes . ' (estado = "P")'; 
                $liberados = $liberados . ' (estado = "L" OR estado = "R")'; 
                echo "PASO PORQUE CAMPO2 VALE ALGO";
            }
            else
            {
                echo" PASO AL FOR ALV";
               for($x = 0; $x <10; $x++)
                {
                    if($regionusuario == $cve_regiones[$x])
                    {   
                        if($cve_2regiones[$x] == 4)
                        {
                            $edo1 = substr($cve_3regiones[$x],0,2);
                            $edo2 = substr($cve_3regiones[$x],2,2);
                            $edo3 = substr($cve_3regiones[$x],4,2);
                            $edo4 = substr($cve_3regiones[$x],-2);

                            //Se hace la consulta en caso de que el usuario sea de esta regional para mostrarle los combobox
                            $pendientes = $pendientes . ' (cve_ent = "'.$edo1.'" OR cve_ent = "'.$edo2.'" OR cve_ent = "'.$edo3.'" OR cve_ent = "'.$edo4.'") AND (estado = "P")'; echo $pendientes;
                            $liberados = $liberados . ' (cve_ent = "'.$edo1.'" OR cve_ent = "'.$edo2.'" OR cve_ent = "'.$edo3.'" OR cve_ent = "'.$edo4.'") AND (estado = "L" OR estado = "R")'; 
                            break;
                        }
                        if($cve_2regiones[$x]==3)
                        {
                            $edo1 = substr($cve_3regiones[$x],0,2);
                            $edo2 = substr($cve_3regiones[$x],2,2);
                            $edo3 = substr($cve_3regiones[$x],4,2); 

                            //Se hace la consulta en caso de que el usuario sea de esta regional para mostrarle los combobox
                            $pendientes = $pendientes . ' (cve_ent = "'.$edo1.'" OR cve_ent = "'.$edo2.'" OR cve_ent = "'.$edo3.'") AND (estado = "P")'; 
                            $liberados = $liberados . ' (cve_ent = "'.$edo1.'" OR cve_ent = "'.$edo2.'" OR cve_ent = "'.$edo3.'") AND (estado = "L" OR estado = "R")'; 
                            break;
                        }
                        if($cve_2regiones[$x] == 1)
                        {
                            $edo1 = substr($cve_3regiones[$x],2);

                            //Se hace la consulta en caso de que el usuario sea de esta regional para mostrarle los combobox
                            $pendientes = $pendientes . ' (cve_ent = "'.$edo1.'") AND (estado = "P")'; 
                            $liberados = $liberados . ' (cve_ent = "'.$edo1.'") AND (estado = "L" OR estado = "R")'; 
                            break;
                        }
                    }
                }
            } $no = 1;   
        }
        else
        {
            $cont = 1;
        }
        // SI ES ESTATAL
        if((($campo1 != "")||($campo2 != "")||($campo3 != "")||($campo4 != "")||($campo5 != "")||($campo6 != "")||($campo7 != "")||($campo8 != "")||($campo9 != "")||($campo10 != "")||($campo11 != ""))&&(($recursousuario == "AA")&&($estadousuario != "00")&&($regionusuario != "00")))
        {
            $cont = 0;
            $pendientes = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE ';
            $liberados = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado  FROM registros WHERE ';
            if($campo1 !="")
            {
                $pendientes = $pendientes . ' cve_recurso = "'.$campo1.'"';
                $liberados = $liberados . ' cve_recurso = "'.$campo1.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
                
            }
            if($campo3 !="")
            {
                $pendientes = $pendientes . ' cve_mun = "'.$campo3.'"';
                $liberados = $liberados . ' cve_mun = "'.$campo3.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo4 !="")
            {
                $pendientes = $pendientes . ' cve_loc = "'.$campo4.'"';
                $liberados = $liberados . ' cve_loc = "'.$campo4.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo5 !="")
            {
                $pendientes = $pendientes . ' cve_ter_gen = "'.$campo5.'"';
                $liberados = $liberados . ' cve_ter_gen = "'.$campo5.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo6 !="")
            {
                $pendientes = $pendientes . ' nombre_geo = "'.$campo6.'"';
                $liberados = $liberados . ' nombre_geo = "'.$campo6.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo7 !="")
            {
                $pendientes = $pendientes . ' nombre_con = "'.$campo7.'"';
                $liberados = $liberados . ' nombre_con = "'.$campo7.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo8 !="")
            {
                $pendientes = $pendientes . ' cve_carta50 = "'.$campo8.'"';
                $liberados = $liberados . ' cve_carta50 = "'.$campo8.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo9 !="")
            {
                $pendientes = $pendientes . ' fecha_val = "'.$campo9.'"';
                $liberados = $liberados . ' fecha_val = "'.$campo9.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            $pendientes = $pendientes . 'cve_ent = "'.$estadousuario.'" AND estado = "P"'; 
            $liberados = $liberados . 'cve_ent = "'.$estadousuario.'" AND (estado = "L" OR estado = "R")'; 
            $no = 1;
        }
        else
        {
            $cont = 1;
        }
        //SI ES TC
        if((($campo1 != "")||($campo2 != "")||($campo3 != "")||($campo4 != "")||($campo5 != "")||($campo6 != "")||($campo7 != "")||($campo8 != "")||($campo9 != "")||($campo10 != "")||($campo11 != ""))&&($recursousuario != "AA"))
        {
            $cont = 0;
            $pendientes = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE ';
            $liberados = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado  FROM registros WHERE ';
            
            if($campo3 != "")
            {
                $pendientes = $pendientes . ' cve_mun = "'.$campo3.'"';
                $liberados = $liberados . ' cve_mun = "'.$campo3.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo4 !="")
            {
                $pendientes = $pendientes . ' cve_loc = "'.$campo4.'"';
                $liberados = $liberados . ' cve_loc = "'.$campo4.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo5 !="")
            {
                $pendientes = $pendientes . ' cve_ter_gen = "'.$campo5.'"';
                $liberados = $liberados . ' cve_ter_gen = "'.$campo5.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo6 !="")
            {
                $pendientes = $pendientes . ' nombre_geo = "'.$campo6.'"';
                $liberados = $liberados . ' nombre_geo = "'.$campo6.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo7 !="")
            {
                $pendientes = $pendientes . ' nombre_con = "'.$campo7.'"';
                $liberados = $liberados . ' nombre_con = "'.$campo7.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo8 !="")
            {
                $pendientes = $pendientes . ' cve_carta50 = "'.$campo8.'"';
                $liberados = $liberados . ' cve_carta50 = "'.$campo8.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            if($campo9 !="")
            {
                $pendientes = $pendientes . ' fecha_val = "'.$campo9.'"';
                $liberados = $liberados . ' fecha_val = "'.$campo9.'"';
                $cont =  1;
            }
            if($cont == 1)
            {
                $pendientes = $pendientes . ' AND ';
                $liberados = $liberados . ' AND ';
                $cont = 0;
            }
            $pendientes = $pendientes . 'cve_recurso = "'.$recursousuario.'" AND cve_ent = "'.$estadousuario.'" AND estado = "P"'; 
            $liberados = $liberados . 'cve_recurso = "'.$recursousuario.'" AND cve_ent = "'.$estadousuario.'" AND (estado = "L" OR estado = "R")'; 
            $no = 1;
        }
        else
        { 
            $cont = 1;
        }
        
        //QUERY DEFAULT
        echo $no;
        if(($cont == 1)&&($no == 0))
        {
            if(($estadousuario != "00")&&($recursousuario == "AA"))
            {
                $pendientes = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE cve_ent = "'.$estadousuario.'" AND estado = "P"';
                $liberados = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE cve_ent = "'.$estadousuario.'" AND (estado = "L" OR estado = "R")';
            }
            //En caso de que sea un trabajador de campo se realizara su consulta de la siguiente manera.
            if(($regionusuario != "00")&&($estadousuario != "00")&&($recursousuario !="AA"))
            {
                //Hacemos las consultas de registros
                $pendientes = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE cve_ent = "'.$estadousuario.'" AND cve_recurso = "'.$recursousuario.'" AND estado = "P"';
                $liberados = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE cve_ent = "'.$estadousuario.'" AND cve_recurso = "'.$recursousuario.'" AND (estado = "L" OR estado = "R")';
            }

            //Validamos en caso de que sean usuarios con permisos centrales 
            if($regionusuario == "00")
            {
                //Hacemos las consultas de registros en caso de que no se haya hecho una query
                $pendientes = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE estado = "P"';
                $liberados = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE estado = "L" OR estado = "R"';  
            }
            //En caso de que tengan alguna region en especifico
            if(($regionusuario != "00")&&($estadousuario == "00"))
            {
                for($x = 0; $x <10; $x++)
                {
                    if($regionusuario == $cve_regiones[$x])
                    {
                        if($cve_2regiones[$x] == "4")
                        {
                            $edo1 = substr($cve_3regiones[$x],0,2);
                            $edo2 = substr($cve_3regiones[$x],2,2);
                            $edo3 = substr($cve_3regiones[$x],4,2);
                            $edo4 = substr($cve_3regiones[$x],-2);

                            //En caso de que no se haya hecho una consulta personalizada se hace aqui la consulta de los registros.
                            $pendientes = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE (cve_ent = "'.$edo1.'" OR cve_ent = "'.$edo2.'" OR cve_ent = "'.$edo3.'" OR cve_ent = "'.$edo4.'") AND estado = "P"'; 
                            $liberados = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE (cve_ent = "'.$edo1.'" OR cve_ent = "'.$edo2.'" OR cve_ent = "'.$edo3.'" OR cve_ent = "'.$edo4.'") AND (estado = "L" OR estado = "R")';  
                            break;

                        }
                        if($cve_2regiones[$x]=="3")
                        {
                            $edo1 = substr($cve_3regiones[$x],0,2);
                            $edo2 = substr($cve_3regiones[$x],2,2);
                            $edo3 = substr($cve_3regiones[$x],-2);

                            //En caso de que no se haya hecho una consulta personalizada se hace aqui la consulta de los registros.

                            $pendientes = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE (cve_ent = "'.$edo1.'" OR cve_ent = "'.$edo2.'" OR cve_ent = "'.$edo3.'") AND estado = "P"';
                            $liberados = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE (cve_ent = "'.$edo1.'" OR cve_ent = "'.$edo2.'" OR cve_ent = "'.$edo3.'") AND (estado = "L" OR estado = "R")';   
                            break;

                        }
                        if($cve_2regiones[$x] == "1")
                        {
                            $edo1 = substr($cve_3regiones[$x],2);                        

                            $pendientes = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE (cve_ent = "'.$edo1.'") AND estado = "P"'; 
                            $liberados = 'SELECT id_geo, id_acta, nombre_geo, nombre_con, ref_loc, cve_carta50, fecha_val, fecha_reg, (SELECT nombre FROM termino_generico WHERE cve_ter_gen = registros.cve_ter_gen), (SELECT nombre FROM entidad WHERE cve_ent = registros.cve_ent), (SELECT nombre FROM municipio WHERE cve_mun = registros.cve_mun), (SELECT nombre FROM localidad WHERE cve_loc = registros.cve_loc), coor_lat_nor, coor_lon_or, sop_ofi, (SELECT nombre FROM recurso WHERE cve_recurso = registros.cve_recurso), proced_fte, obs, estado FROM registros WHERE (cve_ent = "'.$edo1.'") AND (estado = "L" OR estado = "R")'; 
                            break;

                        }
                    }
                }
            }
        }
        
        //USUARIOS
        if((($_REQUEST['uinsumo'] != "")||($_REQUEST['uentidad'] != "")||($_REQUEST['uregionpais'] != "")||($_REQUEST['unombreusua'] != ""))&&($regionusuario == "00"))
        {
            $cont = 0;
            $campo10 = $_REQUEST['uregionpais']; 
            $campo11 = $_REQUEST['unombreusua']; 
            $campo12 = $_REQUEST['uinsumo']; 
            $campo13 = $_REQUEST['uentidad']; echo'<br> '.$campo13;
            $usuarios = 'SELECT * FROM usuarios ';
            if($campo12 != "")
            {
                $usuarios = $usuarios . 'WHERE cve_nivel LIKE "%'.$campo10.'"';
                $cont2 = 1;
            }
            if($cont13 != "")
            {
                if($cont2 == 1)
                {
                    $usuarios = $usuarios . ' AND cve_nivel LIKE "%'.$campo13.'%"';
                }
                else
                {
                    $usuarios = $usuarios . 'WHERE cve_nivel LIKE "%'.$campo13.'%"';
                }
                $cont2 = 1; 
            }
            if($campo10 != "")
            {
                if($cont2 == 1)
                {
                    $usuarios = $usuarios . ' AND cve_nivel LIKE "'.$campo10.'%"';
                }
                else
                {
                    $usuarios = $usuarios . 'WHERE cve_nivel LIKE "'.$campo10.'%"';
                }
                
                $cont2 = 1;
            }
            if($campo11 != "")
            {
                if($cont2 == 1)
                {
                    $usuarios = $usuarios . ' AND nombre = "'.$campo11.'"';
                }
                else
                {
                   $usuarios = $usuarios . 'WHERE nombre = "'.$campo11.'"'; 
                }
            }
            echo $usuarios; echo "PERSONALIZADA USUARIOS";
            //En este caso hacemos la consulta dado que solo los usuarios centrales podran modificar los usuarios.
            $consultausuarios  = mysqli_query($dbc,$usuarios) or die ("Error: ".mysqli_error($dbc)); 
        }
        else if($regionusuario == "00")
        {
            $usuarios = 'SELECT * FROM usuarios'; echo "DEFAULT USUARIOS";
            //En este caso hacemos la consulta dado que solo los usuarios centrales podran modificar los usuarios.
            $consultausuarios  = mysqli_query($dbc,$usuarios) or die ("Error: ".mysqli_error($dbc));
        }
        
        
        //COMBOBOXES
        //Validamos en caso de que la region sea 00 para mostrarle una consulta sin restricciones.
        if($regionusuario == "00")
        {
            //Hacemos las consultas para combobox
            $entidades='SELECT * FROM entidad';
            $municipios='SELECT * FROM municipio ';
            $localidades='SELECT * FROM localidad ';
        }
        //En caso de que su region no sea 00 pero su estado si, le mostramos todos los estados de su region.
        if(($regionusuario != "00")&&($estadousuario == "00"))
        {
            echo "TRABAJADOR REGIONAL. ";
            for($x = 0; $x <10; $x++)
            {
                if($regionusuario == $cve_regiones[$x])
                {   
                    if($cve_2regiones[$x] == 4)
                    {
                        $edo1 = substr($cve_3regiones[$x],0,2);
                        $edo2 = substr($cve_3regiones[$x],2,2);
                        $edo3 = substr($cve_3regiones[$x],4,2);
                        $edo4 = substr($cve_3regiones[$x],-2);
                            
                        //Se hace la consulta en caso de que el usuario sea de esta regional para mostrarle los combobox
                        $entidades = 'SELECT * FROM entidad WHERE (cve_ent = "'.$edo1.'" OR cve_ent = "'.$edo2.'" OR cve_ent = "'.$edo3.'" OR cve_ent = "'.$edo4.'")'; 
                        $municipios = 'SELECT * FROM municipio WHERE (cve_ent = "'.$edo1.'" OR cve_ent = "'.$edo2.'" OR cve_ent = "'.$edo3.'" OR cve_ent = "'.$edo4.'")';
                        $localidades = 'SELECT * FROM localidad WHERE (cve_ent = "'.$edo1.'" OR cve_ent = "'.$edo2.'" OR cve_ent = "'.$edo3.'" OR cve_ent = "'.$edo4.'")';
                        break;
                    }
                    if($cve_2regiones[$x]==3)
                    {
                        $edo1 = substr($cve_3regiones[$x],0,2);
                        $edo2 = substr($cve_3regiones[$x],2,2);
                        $edo3 = substr($cve_3regiones[$x],4,2); 
                                                    
                        //Se hace la consulta en caso de que el usuario sea de esta regional para mostrarle los combobox
                        $entidades = 'SELECT * FROM entidad WHERE (cve_ent = "'.$edo1.'" OR cve_ent = "'.$edo2.'" OR cve_ent = "'.$edo3.'")'; 
                        $municipios = 'SELECT * FROM municipio WHERE (cve_ent = "'.$edo1.'" OR cve_ent = "'.$edo2.'" OR cve_ent = "'.$edo3.'")'; 
                        $localidades = 'SELECT * FROM localidad WHERE (cve_ent = "'.$edo1.'" OR cve_ent = "'.$edo2.'" OR cve_ent = "'.$edo3.'")'; 
                        break;
                    }
                    if($cve_2regiones[$x] == 1)
                    {
                        $edo1 = substr($cve_3regiones[$x],2);
                        
                        //Se hace la consulta en caso de que el usuario sea de esta regional para mostrarle los combobox
                        $entidades = 'SELECT * FROM entidad WHERE (cve_ent = "'.$edo1.'")'; 
                        $municipios = 'SELECT * FROM municipio WHERE (cve_ent = "'.$edo1.'")'; 
                        $localidades = 'SELECT * FROM localidad WHERE (cve_ent = "'.$edo1.'")'; 
                        break;
                    }
                }
            }
        }
        //Validamos la informacion para mostrar en los combobox en caso de que el usuario no sea regional
        if(($regionusuario != "00")AND($estadousuario != "00"))
           {    
            //Hacemos las consultas de combobox
            $entidades='SELECT * FROM entidad WHERE cve_ent ="'.$estadousuario.'"';
            $municipios='SELECT * FROM municipio WHERE cve_ent = "'.$estadousuario.'"';
            $localidades='SELECT * FROM localidad WHERE cve_ent = "'.$estadousuario.'"';
           }
        
        //QUERYS GENERALES
        //Query de recursos, solo mostramos los que los usuarios deben ver
        if($recursousuario == 'AA')
        {
            $recursos = 'SELECT * FROM recurso ';    
        }
        else
        {
            $recursos = 'SELECT * FROM recurso WHERE cve_recurso = "'.$recursousuario.'"';
        }
        //Creamos las Querys generales para todos                                
        $terminosgenericos = 'SELECT * FROM termino_generico';
        $regiones = 'SELECT * FROM region';
        //CONSULTAS
        //Genera las consultas a la base de datos.
        $consultaentidades = mysqli_query($dbc,$entidades) or die ("Error: " .mysqli_error($dbc)); 
        $consultamunicipios = mysqli_query($dbc,$municipios) or die ("Error: " .mysqli_error($dbc)); 
        $consultalocalidades = mysqli_query($dbc,$localidades) or die ("Error: " .mysqli_error($dbc)); 
        $consultaterminosgenericos = mysqli_query($dbc,$terminosgenericos) or die ("Error: " .mysqli_error($dbc)); 
        $consultapendientes = mysqli_query($dbc,$pendientes) or die ("Error: " .mysqli_error($dbc)); echo $pendientes;
        $consultaliberados = mysqli_query($dbc,$liberados) or die ("Error: " .mysqli_error($dbc)); echo $liberados;
        $consultarecursos = mysqli_query($dbc,$recursos) or die ("Error: ".mysqli_error($dbc)); 
        $consultaregiones = mysqli_query($dbc,$regiones) or die ("Error: ".mysqli_error($dbc)); 
        global $consultaentidades ; $_SESSION['consultaentidades'] = $consultaentidades;
        global $consultamunicipios  ; $_SESSION['consultamunicipios'] = $consultamunicipios ;
        global $consultalocalidades ; $_SESSION['consultalocalidades'] = $consultalocalidades;
        global $consultaterminosgenericos ; $_SESSION['consultaterminosgenericos'] = $consultaterminosgenericos;
        global $consultapendientes ; $_SESSION['consultapendientes'] = $consultapendientes;
        global $consultaliberados; $_SESSION['consultaliberados'] = $consultaliberados;
        global $consultausuarios; $_SESSION['consultausuarios'] = $consultausuarios;
        global $consultarecursos; $_SESSION['consultarecursos'] = $consultarecursos;
        echo '</p>';
        //Se cierra la conexión
        mysqli_close($dbc);
        $_SESSION['creando'] = 0;
        ?>

<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->