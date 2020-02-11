<?
    include_once("../system/DBconexion.php");
    include_once("../system/funciones.php");
    include_once("../system/session.php");
    include_once("../config/ue9o.php");

    $conexion = new DBConexion();
    $conexion->DBConexion();

    $session = new Session();

    try{
        if(!$session->checkSession()){

            $repuesta = new stdClass();
            $repuesta->estado=1;
            $repuesta->mensaje="";
            $repuesta->data=array();

            $peticion=$conexion->DBConsulta("SELECT * FROM lista_menu");
            foreach($peticion as $fila){
                $subString = !empty($fila['libreria']) || strlen($fila['libreria'])>10 ? substr($fila['libreria'],0,11).' .....':'';
                $repuesta->data[]=array(
                    'idmenu'=>intval($fila['idmenu']),
                    'orden'=>intval($fila['orden']),
                    'idpadre'=>intval($fila['idpadre']),
                    'librerias'=>$subString,
                    'libreria'=>$fila['libreria'],
                    'nombre'=>$fila['nombre'],
                    'estado'=>$fila['estado']=='A'?'Activo':'Inactivo',
                    'ventana'=>$fila['ventana'],
                    'icono'=>'<i class="'.$fila['icono'].' fa-2x"></i>',
                    'listIcon'=>$fila['icono'],
                    'es_menu'=>$fila['es_menu']=='S'?'SI':'NO'
                );
            }
        }else{
            throw new Exception("Debe Iniciar Session.",3);
        }
    }catch(Exception $e){
        print_r("Error: ".$e->getMessage());
    }
    print_r(json_encode($repuesta));
?>