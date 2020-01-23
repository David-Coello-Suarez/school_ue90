<?
    include_once("util/system/DBconexion.php");
    include_once("util/system/funciones.php");
    include_once("util/system/session.php");
    include_once("util/config/ue9o.php");

    include_once("util/core/html.php");

    $session = new Session();

    $conexion = new DBConexion();
    $conexion->DBConexion();

    $sql = $conexion->DBConsulta("SELECT * FROM `lista_parametro`");
    $parametro = array();
    foreach($sql as $fila){
        $parametro[trim($fila["nombre"])] = trim($fila['valor']);
    }

        include_once("inc/cabpie/cab.php");
        include_once("inc/cabpie/pie.php");
?>