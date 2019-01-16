<?php include("seguridad.php"); ?>
<!DOCTYPE HTML>
<html>
    <head>
        <!-- Llamamos a los archivos JS y CSS para dar estilo y funcionalidad a nuestro codigo HTML -->
		<title>
            <?php include("titulo.php"); ?>
		</title>
		<meta charset="utf-8">
        <link rel="shortcut icon" href="../data/icono.ico">
		<link rel=StyleSheet href= "../css/est.css" type="text/css">
		<script type = "text/javascript" src="../js/funciones.js"></script>
        <script src="../js/jquery-3.3.1.min.js"></script>
		<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    </head>
    <body onload="nobackbutton();titulog()<?php if($_SESSION['creando'] == 1){echo ';crearacta()';} if($_SESSION['creando'] == 2){echo ';modiuser()'; } if($_SESSION['creando']== 3){ echo ';crearuser()';} ?>">
        <?php include("general.php"); ?>
        <!-- BARRA DE MENU LLAMADA "BANNER" QUE PERMITIRA NAVEGAR POR EL SISTEMA -->
        <header class="banner">
            <div class="rectangulo"></div>
			<nav class="navbar">
			  <ul class="main">
				<li class="title" id="titulo"> SEGUIMIENTO TC
				<a href="javascript:void(0);" class="icon" onclick="funcione()">&#9776;</a></li>
				<li id="pen" class="ocultar"><a href="javascript:void(0);" onCLick="titulop()" id="pen1">PENDIENTES</a></li>
				<li id="lib" class="ocultar"><a href="javascript:void(0)" onCLick="titulol()" id="lib1">LIBERADOS</a></li>
				<?php include("usuario.php"); ?>
				<li id="openMenu" class="ocultar"><a href="javascript:void(0);" onclick="expand()"><b id="useri"><i class="fas fa-user" ></i></b>
                    <?php include("usuarios.php"); ?>
                    <b class="triangulo"></b></a>
                    <ul class='dropDown' id="drop">
                        <li><a href="">Manual de Usuario</a></li>
                        <li><a href="close.php">Cerrar Sesión</a></li>
                    </ul>
				</li>
			  </ul>
			</nav>
        </header>
        
        <!-- MENU CONTEXTUAL PARA PENDIENTES  -->
        <div id="contextual" onClick="ocultarme()">
            <span>
                <p><a href="#"> OBSERVACIONES </a></p>
            </span>
            <span>
                <p><a href="consultaacta.php" id="iracta"> CREAR ACTA </a></p>
            </span>
        </div>
        <!-- MENU CONTEXTUAL PARA LIBERADOS -->
        <div id="contextual2" onClick="ocultarme()">
            <span>
                <p><a href="#" id=""> VER ACTA </a></p>
            </span>
        </div>
        <!-- MENU CONTEXTUAL PARA AGREGAR USUARIO -->
        <div id="contextual3" onClick="ocultarme()">
            <span>
                <p><a href="modificarusuarios.php?op=2"> AGREGAR NUEVO USUARIO </a></p>
            </span>
        </div>
        <!-- MENU CONTEXTUAL PARA MODIFICAR USUARIOS -->
        <div id="contextual4" onClick="ocultarme()">
            <span>
                <p><a href="#" id="borrado"> ELIMINAR </a></p>
            </span>
            <span>
                <p><a href="modificarusuarios.php" id="irusuarios"> EDITAR </a></p>
            </span>
        </div>
        
        <!-- TABLA Y CONTENIDO DIV UTIL PARA PENDIENTES  -->
        <div class="contenido" id="pendientes">
            <form name="ordenamiento" method="post" action="inicio.php"> <!-- FORM DE BUSQUEDA -->
                <div class="datagrid2">
                    <table>
                        <thead>
                            <tr>
                                <td id="button"><span> <button name="botonOrdenar" type="submit" class="botoncontenido" onClick="0"> BUSCAR </button></span></td>
                                <th>INSUMO</th>
                                <th>ENTIDAD</th>
                                <th>MUNICIPIO</th>
                                <th>LOCALIDAD</th>
                                <th>T.GENÉRICO</th>
                                <th>N.GEOGRÁFICO</th>
                                <th>N.CONOCIDO</th>
                                <th>CARTA 1:50 000</th>
                                <th>FECHA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="button"></td>
                                <td> 
                                    <select id="insumo" name="insumo" style="width:150px" class="texto">
                                        <option value = ""> </option>
                                        <?php include("mostrarrecursos.php"); ?>
                                    </select>
                                </td>
                                <td> 
                                    <select id="entidad" class="texto" datalist="entidad" style="width:150px" name="entidad">                                           <option value = ""> </option>
                                        <?php include("mostrarentidad.php"); ?>
                                    </select>
                                </td>
                                <td>
                                    <select id="municipio" class="texto" style="width:150px" name="municipio">
                                        <option value = ""> </option>
                                        <?php include("mostrarmunicipio.php"); ?>
                                    </select>
                                </td>
                                <td> 
                                    <select id="localidad"  style="width:150px" class="texto" name="localidad">
                                        <option value=""> </option>
                                        <?php include("mostrarlocalidad.php"); ?>
                                    </select>
                                </td>
                                <td> 
                                    <select type="text" name="terGen" style="width:150px" class="texto">
                                        <option value=""> </option>
                                        <?php include("mostrarterminosgenericos.php"); ?>
                                    </select>
                                </td>
                                <td> 
                                    <input type="text" name="nombreGeo" size="16" class="texto">
                                </td>
                                <td> 
                                    <input type="text" name="nombreCon" size="16" class="texto">
                                </td>
                                <td>
                                    <select type="text" name="cveCarta50m" list="cveCarta50m" style="width:150px" class="texto">
                                        <option value=""></option>
                                    </select>
                                </td>
                                <td>  
                                    <input type="date"name="fechatabla" class="texto" size="8">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
            <div class="datagrid2" id="registros" >
                <table >
                        <thead>
                            <tr>
                                <th>INSUMO</th>
                                <th>ENTIDAD</th>
                                <th>MUNICIPIO</th>
                                <th>LOCALIDAD</th>
                                <th>T.GENÉRICO</th>
                                <th>N.GEOGRÁFICO</th>
                                <th>N.CONOCIDO</th>
                                <th>CARTA 1:50 000</th>
                                <th>OPCIONES</th>
                                <th>FECHA</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php include("imprimirpendientes.php"); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- CREAMOS EL DIV PARA MOSTRAR LOS DATOS DE CONTENIDO, ESTE SE USARA EN Liberados-->
        <!-- TABLA Y CONTENIDO DIV UTIL PARA LIBERADOS  -->
        <div class="contenido" id="liberados">
            <form name="ordenamiento" method="post" action="inicio.php"> <!-- FORM DE BUSQUEDA -->
                <div class="datagrid2">
                    <table>
                        <thead>
                            <tr>
                                <td id="button"><span> <button name="botonOrdenar" class="botoncontenido" onClick="prueba(entidad.value)"> BUSCAR </button></span></td>
                                <th>INSUMO</th>
                                <th>ENTIDAD</th>
                                <th>MUNICIPIO</th>
                                <th>LOCALIDAD</th>
                                <th>T.GENÉRICO</th>
                                <th>N.GEOGRÁFICO</th>
                                <th>N.CONOCIDO</th>
                                <th>CARTA 1:50 000</th>
                                <th>FECHA</th>
                                <th>ESTADO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="button"></td>
                                <td> 
                                    <select id="insumo" name="insumo" style="width:150px" class="texto">
                                        <option value = ""> </option>
                                        <?php include("mostrarrecursos.php"); ?>
                                    </select>
                                </td>
                                <td> 
                                    <select id="entidad" class="texto" datalist="entidad" style="width:150px" name="entidad">                                           <option value = ""> </option>
                                        <?php include("mostrarentidad.php"); ?>
                                    </select>
                                </td>
                                <td>
                                    <select id="municipio" class="texto" style="width:150px" name="municipio">
                                        <option value = ""> </option>
                                        <?php include("mostrarmunicipio.php"); ?>
                                    </select>
                                </td>
                                 <td> 
                                    <select id="localidad"  style="width:150px" class="texto" name="localidad">
                                        <option value=""> </option>
                                        <?php include("mostrarlocalidad.php"); ?>
                                    </select>
                                </td>
                                <td> 
                                    <select type="text" name="terGen" style="width:150px" class="texto">
                                        <option value=""> </option>
                                        <?php include("mostrarterminosgenericos.php"); ?>
                                    </select>
                                </td>
                                <td> 
                                    <input type="text" name="nombreGeo" size="16" class="texto">
                                </td>
                                <td> 
                                    <input type="text" name="nombreCon" size="16" class="texto">
                                </td>
                                <td>
                                    <select type="text" name="cveCarta50m" list="cveCarta50m" style="width:150px" class="texto">
                                        <option value=""></option>
                                    </select>
                                </td>
                                <td>  
                                    <input type="date"name="fechatabla" class="texto" size="8">
                                </td>
                                <td>  
                                    <input type="text"name="estado" class="texto" size="8">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
            <!-- CREAMOS EL DIV PARA MOSTRAR LOS DATOS DE CONTENIDO, ESTE SE USARA EN LIBERADOS -->
            <div class="datagrid2" id="registros">
            <table >
                        <thead>
                            <tr>
                                <th>INSUMO</th>
                                <th>ENTIDAD</th>
                                <th>MUNICIPIO</th>
                                <th>LOCALIDAD</th>
                                <th>T.GENÉRICO</th>
                                <th>N.GEOGRÁFICO</th>
                                <th>N.CONOCIDO</th>
                                <th>CARTA 1:50 000</th>
                                <th>OPCIONES</th>
                                <th>FECHA</th>
                                <th>ESTADO</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php include("imprimirliberados.php"); ?>
                    </tbody>
                </table>
        </div>
        </div>
        
        <!-- TABLA Y CONTENIDO DIV UTIL PARA USUARIOS SE MANTIENE ORIGINALMENTE OCULTA -->
        <div class="contenido" id="usuarios">
            <form name="ordenamiento" method="post"action="inicio.php">
                	<div class="datagrid2">
					<table>
                    <thead> 
						<td id="button"><span> <button name="botonOrdenar" class="botoncontenido" onClick="prueba(entidad.value)"> BUSCAR </button></span></td>
                            <th> CLAVE DE NIVEL </th> 
                            <th> ENTIDAD </th>
                            <th> NOMBRE </th>
                            <th> EXTENCION </th>
                            <th> AGREGAR USUARIO </th>
						</thead>
						<tbody> 
                            <td id="button"></td>
                            <td>
                                <input type="text" name="uregionpais" size="12" class="texto">
                                   
                            </td>
                            <td> 
                                <select id="uentidad" class="texto" datalist="uentidad" style="width:150px" name="uentidad">                                   <option value = ""> </option>
                                    <?php include("mostrarentidad.php"); ?>
                                </select>
                            </td>
                            <td>
                                <input id="nombre" type="text" name="unombreusua"  size="18" class="texto">
                            </td>
                            <td> 
                                <input id="insumo" type="text" name="uinsumos"list="insumos" size="12" class="texto">
                                    
                            </td> 
                            <td>  
                                    <button type="button" name="botonObservacion" class="botonpb" id="botonmas" onClick="motrocul3(event)"> <img src="../data/mas.svg">  </button>
                            </td>
						</tbody>
                    </table>
				</div>
            </form>
            <!-- CREAMOS EL DIV PARA MOSTRAR LOS DATOS DE CONTENIDO, ESTE SE USARA EN USUARIOS -->
            <div class="datagrid2" id="registros">
            <table >
                <thead> 
                            <th> CLAVE DE NIVEL </th> 
                            <th> ENTIDAD </th>
                            <th> NOMBRE </th>
                            <th> EXTENCIÓN </th>
                            <th> OPCIONES </th>
				</thead>
                <tbody>
                <?php include("imprimirusuarios.php"); ?>
                </tbody>
            </table>
        </div>
        </div>
        
        
        <!-- FORMULARIO DE CREACION DE ACTA -->
        <div class="crearnuevaacta">
            <div class="navbarform">
                <div class="campo" id="active" href="javascript:void(0);" onclick="change(this.id)">
                    <span>REVISIÓN EN CAMPO</span>
                </div>
                <div class="gabinete" id="desactivado" href="javascript:void(0);" onclick="change(this.id)">
                    <span>REVISIÓN EN GABINETE</span>
                </div>
            </div>
            <div class="contform">
                <div class="info">
                    <a> Nombre Oficial: <?php echo $_SESSION['nombre_geo']; ?></a>
                    <a> Nombre Conocido: <?php echo $_SESSION['nombre_con']; ?></a>
                    <a>Termino Generico: <?php echo $_SESSION['cve_ter_gen']; ?></a>
                    <a>Entidad: <?php echo $_SESSION['cve_ent']; ?></a>
                    <a>Municipio: <?php echo $_SESSION['cve_mun']; ?></a>
                    <a>Localidad: <?php echo $_SESSION['cve_loc']; ?></a>
                    <a>Fecha de Inicio: <?php echo $_SESSION['fecha_val']; ?></a>
                    <a>Identificador: <?php echo $_SESSION['id_geo']; ?></a>
                </div>
                <br><br>
                <div id=formcens>
                    <form method="post" action="inicio.php">
                        Nombre Corregido:  <input required type="text" name="nombrec" width="300px"><br><br>
                        Fecha de Revision de Campo: <input required type="date" name="fecha_evento"><br><br>
                        Evento Censal: <input type="text" required name="nombreev"><br><br>
                        <textarea name="obs_regr" rows="6" required cols="40">Observación:</textarea><br><br>
                        <input type="checkbox" name="tipodeacta" id="tipodeacta" value="0" checked style="display:none">

                        <button class="botoncontenido">Guardar</button>
                    </form>
                        <a href="inicio.php"><button class="botoncontenido">Regresar</button></a>
                </div>
                <div id=formgab>
                    <form method="post" action="inicio.php">
                        Nombre Corregido:  <input required type="text" name="nombrec"><br><br>
                        Nombre del Documento Conusltado:<input required type="text" name="nombredoc"><br><br>
                        Anexar Archivo: <input type="file" name="doc_anexo"><br><br>
                        <textarea name="obs_regr" rows="6" required cols="40">Observación:</textarea><br><br>
                        <input type="checkbox" name="tipodeacta" id="tipodeacta" value="1" checked style="display:none">
                        <button class="botoncontenido">Guardar</button>
                    </form>
                        <a href="inicio.php" ><button class="botoncontenido">Regresar</button></a>
                </div>
            </div>
        </div>
        <div class="userform">
			<span ID="userhead"> MODIFICAR USUARIO </span>
			<form class="newuser" method="post" action="inicio.php">
                <span>Identificador: <input type="text" readonly="readonly" name = "idusua" value="<?php echo $_SESSION['id_usua']; ?>"><br></span>
				<span>Nombre: <input type="text" name ="nombreusu" required value="<?php echo $_SESSION['nombre']; ?>" ><br></span>
				<span >Contraseña: <input type="text" name="contraseña" required value="<?php echo $_SESSION['contra'];?>"><br></span>
				<span >Correo: <input type="email" required name = "correo" value="<?php echo $_SESSION['correo']; ?>"><br></span>
				<span >Extención: <input type="number" name="ext" required value="<?php echo $_SESSION['ext']; ?>"><br></span>
				<span>Región: <input type="text" required pattern="[0-9]{2}" name="region" value="<?php $reg = substr($_SESSION['cve_nivel'], 0, 2); echo $reg; ?>"><br></span>
                <span>Estado: <input type="text" required pattern="[0-9]{2}" name="estado" value="<?php $reg = substr($_SESSION['cve_nivel'], 2, 2); echo $reg; ?>"><br></span>
                <span>Recurso: <input type="text" required pattern="[C T V L A]{2}" name="recurso" value="<?php $reg = substr($_SESSION['cve_nivel'], 4, 2); echo $reg; ?>"><br></span>
				<span><input type="submit" value="MODIFICAR" id="userbuton"><br></span>
			</form>
            <span><a href="inicio.php"><button id="userbuton"> REGRESAR </button></a></span>
		</div>
        <div class="userform2">
			<span ID="userhead"> NUEVO USUARIO </span>
			<form class="newuser" method="post" action="inicio.php">
                <span>Identificador: <input type="text" readonly="readonly" name = "idusua" ><br></span>
				<span>Nombre: <input type="text" name ="nuevonombreusu" required ><br></span>
				<span >Contraseña: <input type="text" name="nuevocontraseña" required ><br></span>
				<span >Correo: <input type="email" required name = "nuevocorreo" ><br></span>
				<span >Extención: <input type="number" name="nuevoext" required ><br></span>
				<span>Región: <input type="text" required pattern="[0-9]{2}" name="nuevoregion"><br></span>
                <span>Estado: <input type="text" required pattern="[0-9]{2}" name="nuevoestado"><br></span>
                <span>Recurso: <input type="text" required pattern="[C T V L A]{2}" name="nuevorecurso"><br></span>
				<span><input type="submit" value="MODIFICAR" id="userbuton"><br></span>
			</form>
            <span><a href="inicio.php"><button id="userbuton"> REGRESAR </button></a></span>
		</div>
        <!-- PANEL DE BUSQUEDA, Y BOTON GUARDAR (DISPONIBLE DEPENDIENDO DE LA SITUACION)-->
        <div class="panelbusqueda">
            <form name="barrabusqueda">
                <table id="toolbox">
                    <tr>
                        <td>
                            <label name="numerodepagina" id="nudepa">Pagina 1 de 2</label>
                        </td>
                        <td>
                            <button name="regresar" class="botonpb" alt="Pagina anterior"><img src="../data/izquierda.svg"></button>
                        </td>
                        <td>
                            <input type="text" name="ira" id="ira" alt="Ir a ">
                            <button name="bira" class="botonpb"><img src="../data/busqueda.svg" ></button>
                        </td>
                        <td>
                            <button name="siguiente" class="botonpb"alt="Siguiente pagina"><img src="../data/derecha.svg"></button>
                        </td>
                        <td>
                            <button name="ultima"class="botonpb"alt="Ultima pagina"><img src="../data/last.svg"></button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- PIE DE PAGINA -->
        <footer class="piedepagina">
			<p>&copy; 2018 <a href="http://www.inegi.org.mx" target="_blank">inegi.org.mx</a></p>
		</footer> 
    </body>
</html>


<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->
