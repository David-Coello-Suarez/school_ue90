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

    if(!$session->checkSession()){

        $pagina=$parametro['paginaDefault'];
        if(isset($_GET['pagina']) && !empty($_GET['pagina'])){
            $pagina=$_GET['pagina'];
        }

        #Revisar el procedimiento almacenado en la base de datos
        $permisos=$conexion->DBConsulta("CALL permisos('Desarrollador','".$pagina."')");
        $varAcceso=array();
        foreach ($permisos as $fila) {
            $varAcceso['idacceso']=intval($fila['idacceso']);
            $varAcceso['nombre']=$fila['nombre'];
            $varAcceso['ventana']=$fila['ventana'];
            $varAcceso['libreria']=explode(",",$fila['libreria']);
        }
        if(count($varAcceso)==0){
            $flag=false;
            #bandera para revisar si el usuario tiene permisos en algun modulo del sistema.(Prodecimiento almacenado)
            $resultflag=$conexion->DBConsulta("CALL flag('Desarrollador')");
            foreach($resultflag as $fila){
                $pagina=$fila['ventana'];
                $flag=true;
            }
            if($flag==false){
                $session->endSession();
                echo 'Estimado, usted no tiene modulos asignados en el aplicativo.';
                header('Refresh:10');
                exit();
            }else{
                #Permisos por pagina
                $resultopt=$conexion->DBConsulta("CALL permisos('Desarrollador','".$pagina."')");
                $varAcceso=array();
                foreach ($permisos as $fila) {
                    $varAcceso['idacceso']=intval($fila['idacceso']);
                    $varAcceso['nombre']=$fila['nombre'];
                    $varAcceso['ventana']=$fila['ventana'];
                    $varAcceso['libreria']=explode(",",$fila['libreria']);
                }
            }
        }
        #carga las jerarquias para guardar en el menu de opciones.(prodecimiento almacenado)
        $resultsubmenu=$conexion->DBConsulta("CALL submenu('Desarrollador')");
        $vectormenu=array();
        $cont=0;
        foreach($resultsubmenu as $fila){
            $vectormenu[$cont]['idmenu']=intval($fila['idmenu']);
            $vectormenu[$cont]['idpadre']=intval($fila['idpadre']);
            $vectormenu[$cont]['nombre']=$fila['nombre'];
            $vectormenu[$cont]['ventana']=$fila['ventana'];
            $vectormenu[$cont]['es_menu']=$fila['es_menu'];
            $vectormenu[$cont]['icono']=$fila['icono'];
            $cont++;
        }
        $idpadreIn='';
        for ($i=0; $i<count($vectormenu); $i++) { 
            if($i==0){
                $idpadreIn.=$vectormenu[$i]['idpadre'];
            }else{
                $idpadreIn.=$vectormenu[$i]['idpadre'];
            }
        }
        if(!empty($idpadreIn)){
            $resultmenu=$conexion->DBConsulta("CALL menu('".(int)$idpadreIn."')");
            foreach($resultmenu as $fila){
                $vectormenu[$cont]['idmenu']=intval($fila['idmenu']);
                $vectormenu[$cont]['idpadre']=intval($fila['idpadre']);
                $vectormenu[$cont]['nombre']=$fila['nombre'];
                $vectormenu[$cont]['ventana']=$fila['ventana'];
                $vectormenu[$cont]['es_menu']=$fila['es_menu'];
                $vectormenu[$cont]['icono']=$fila['icono'];
                $cont++;
            }
        }

        include_once("inc/cabpie/cab.php");
        include_once("inc/$pagina/cuerpo.php");
        include_once("inc/cabpie/pie.php");
    }
?>