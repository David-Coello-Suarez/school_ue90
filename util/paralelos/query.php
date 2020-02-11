<?
    try{
        include_once("../system/DBconexion.php");
        include_once("../system/funciones.php");
        include_once("../system/session.php");
        include_once("../config/ue9o.php");
        $session = new Session();
        if(!$session->checkSession()){
            $conexion = new DBConexion();
            $conexion->DBConexion();
            $sql = $conexion->DBConsulta("SELECT * FROM lista_paralelo");
            foreach($sql as $fila){
                $data[]=array(
                    'id'=>intval($fila['idParalelo']),
                    'paralelo'=>$fila['paralelo'],
                    'estado'=>$fila['estado']=="A"?'<button type="button" class="btn p-1 btn-outline-success"><i class="fa fa-check p-1 rounded-circle" aria-hidden="true"></i> <spna>Activo</span></button>':'<button type="button" class="btn p-1 btn-outline-danger"><i class=" fa  fa-times p-1 rounded-circle" aria-hidden="true"></i> <spna>Inactivo</span> </button> ',
                    'registro'=>date($fila['registro'])
                );
            }
            print_r(Funciones::json(1,"",$data));
        }else{
            throw new Exception("Debe Iniciar Session.",1);
            print_r(Funciones::json(3,"Debe Iniciar Session"));
        }
    }catch(Exception $e){
        Funciones::logs($e->getCode(),"Error de sistema.",$e->getMessage());
    }
?>