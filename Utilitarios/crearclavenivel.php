<?php
$cve_regiones = array("","01","02","03","04","05","06","07","08","09","10");
$cve_2regiones = array(" ","4","3","3","4","4","3","4","3","3","1");
$cve_3regiones = array(" ","02032526","081032","051928","06141618","01112224","121517","13212930","072027","042331","09");
require_once("php/connect.php");
$sql = 'INSERT INTO nivel (cve_nivel, cve_region, cve_ent, cve_recurso) VALUES ';
for($c = 1; $c < 11; $c++)
{
    if($c != 1)
    {
        $sql = $sql . ',';
    }
    if($cve_2regiones[$c] == "4")
    {
        $v1 = substr($cve_3regiones[$c],0,2);
        $v2 = substr($cve_3regiones[$c],2,2);
        $v3 = substr($cve_3regiones[$c],4,2);
        $v4 = substr($cve_3regiones[$c],6,2);
        $sql = $sql.' ("'.$cve_regiones[$c].$v1.'CT","'.$cve_regiones[$c].'","'.$v1.'","CT"),'.' ("'.$cve_regiones[$c].$v1.'CV","'.$cve_regiones[$c].'","'.$v1.'","CV"),'.'("'.$cve_regiones[$c].$v1.'CA","'.$cve_regiones[$c].'","'.$v1.'","CA"),'.'("'.$cve_regiones[$c].$v1.'CL","'.$cve_regiones[$c].'","'.$v1.'","CL"),';
        $sql = $sql.' ("'.$cve_regiones[$c].$v2.'CT","'.$cve_regiones[$c].'","'.$v2.'","CT"),'.' ("'.$cve_regiones[$c].$v2.'CV","'.$cve_regiones[$c].'","'.$v2.'","CV"),'.'("'.$cve_regiones[$c].$v2.'CA","'.$cve_regiones[$c].'","'.$v2.'","CA"),'.'("'.$cve_regiones[$c].$v2.'CL","'.$cve_regiones[$c].'","'.$v2.'","CL"),';
        $sql = $sql.' ("'.$cve_regiones[$c].$v3.'CT","'.$cve_regiones[$c].'","'.$v3.'","CT"),'.' ("'.$cve_regiones[$c].$v3.'CV","'.$cve_regiones[$c].'","'.$v3.'","CV"),'.'("'.$cve_regiones[$c].$v3.'CA","'.$cve_regiones[$c].'","'.$v3.'","CA"),'.'("'.$cve_regiones[$c].$v3.'CL","'.$cve_regiones[$c].'","'.$v3.'","CL"),';
        $sql = $sql.' ("'.$cve_regiones[$c].$v4.'CT","'.$cve_regiones[$c].'","'.$v4.'","CT"),'.' ("'.$cve_regiones[$c].$v4.'CV","'.$cve_regiones[$c].'","'.$v4.'","CV"),'.'("'.$cve_regiones[$c].$v4.'CA","'.$cve_regiones[$c].'","'.$v4.'","CA"),'.'("'.$cve_regiones[$c].$v4.'CL","'.$cve_regiones[$c].'","'.$v4.'","CL")';
    }
    if($cve_2regiones[$c] == "3")
    {
        $v1 = substr($cve_3regiones[$c],0,2);
        $v2 = substr($cve_3regiones[$c],2,2);
        $v3 = substr($cve_3regiones[$c],4,2);
        $sql = $sql.' ("'.$cve_regiones[$c].$v1.'CT","'.$cve_regiones[$c].'","'.$v1.'","CT"),'.' ("'.$cve_regiones[$c].$v1.'CV","'.$cve_regiones[$c].'","'.$v1.'","CV"),'.'("'.$cve_regiones[$c].$v1.'CA","'.$cve_regiones[$c].'","'.$v1.'","CA"),'.'("'.$cve_regiones[$c].$v1.'CL","'.$cve_regiones[$c].'","'.$v1.'","CL"),';
        $sql = $sql.' ("'.$cve_regiones[$c].$v2.'CT","'.$cve_regiones[$c].'","'.$v2.'","CT"),'.' ("'.$cve_regiones[$c].$v2.'CV","'.$cve_regiones[$c].'","'.$v2.'","CV"),'.'("'.$cve_regiones[$c].$v2.'CA","'.$cve_regiones[$c].'","'.$v2.'","CA"),'.'("'.$cve_regiones[$c].$v2.'CL","'.$cve_regiones[$c].'","'.$v2.'","CL"),';
        $sql = $sql.' ("'.$cve_regiones[$c].$v3.'CT","'.$cve_regiones[$c].'","'.$v3.'","CT"),'.' ("'.$cve_regiones[$c].$v3.'CV","'.$cve_regiones[$c].'","'.$v3.'","CV"),'.'("'.$cve_regiones[$c].$v3.'CA","'.$cve_regiones[$c].'","'.$v3.'","CA"),'.'("'.$cve_regiones[$c].$v3.'CL","'.$cve_regiones[$c].'","'.$v3.'","CL")';
    }
     if($cve_2regiones[$c] == "1")
    {
        $v1 = substr($cve_3regiones[$c],0,2);
        $sql = $sql.' ("'.$cve_regiones[$c].$v1.'CT","'.$cve_regiones[$c].'","'.$v1.'","CT"),'.' ("'.$cve_regiones[$c].$v1.'CV","'.$cve_regiones[$c].'","'.$v1.'","CV"),'.'("'.$cve_regiones[$c].$v1.'CA","'.$cve_regiones[$c].'","'.$v1.'","CA"),'.'("'.$cve_regiones[$c].$v1.'CL","'.$cve_regiones[$c].'","'.$v1.'","CL")';
    }
}
$consulta = mysqli_query($dbc, $sql) or die ("Error no se ejecuto la insersion. ".mysqli_error($dbc));
mysqli_close($dbc);
echo $sql."             <br> SE HAN INSERTADO TODAS LAS CLAVES DE NIVEL. ";
?>

<!-- 2018 Mariana Quezada Villar y Mauricio Eugenio Alcala Lopez (contacto preguntas.asi@gmail.com) //Departamento de Registro de Nombres Geograficos -->