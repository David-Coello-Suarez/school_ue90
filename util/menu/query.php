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
                $repuesta->data[]=array(
                    'idmenu'=>intval($fila['idmenu']),
                    'orden'=>intval($fila['orden']),
                    'idpadre'=>$fila['orden']!=NULL?intval($fila['orden']):'',
                    'libreria'=>$fila['libreria'],
                    'nombre'=>$fila['nombre'],
                    'estado'=>$fila['estado']=='A'?'Activo':'Inactivo',
                    'ventana'=>$fila['ventana'],
                    'icono'=>$fila['icono']
                );
            }
        }else{
            $repuesta->estado=3;
            $repuesta->mensaje="Debe iniciar session.";
        }
    }catch(Exception $e){
        die("Error: "-$e->getMessage());
    }
    print_r(json_encode($repuesta));
?>