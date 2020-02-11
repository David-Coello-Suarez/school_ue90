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

            $sql=$conexion->DBConsulta("SELECT * FROM `lista_ciclo_academico`");
            $data = array();
            foreach($sql as $fila){
                $fecha = ( (int) intval($fila['anio_lectivo']) == (int)intval(date("Y")) ? '<i class="ml-2 text-success fa fa-circle" aria-hidden="true" style="font-size:.6rem"></i>':'');
                $data[]=array(
                    'idCicloAcad'=>intval($fila['idCicloAcad']),
                    'nombre_lectivo'=>$fila['nombre_lectivo'],
                    'anio_lectivo'=>intval($fila['anio_lectivo']),
                    'estado'=>substr($fila['estado'],0,1),
                    'estados'=>$fila['estado']=='A'?'<button type="button" class="btn p-1 btn-outline-success"><i class="fa fa-check p-1 rounded-circle" aria-hidden="true"></i> <spna>Activo</span> </button> '.$fecha:'<button type="button" class="btn p-1 btn-outline-danger"><i class=" fa  fa-times p-1 rounded-circle" aria-hidden="true"></i> <spna>Inactivo</span> </button> ',
                    'registro'=>date("d-m-Y", strtotime($fila['fecha_registro']))
                );
            }
            print_r(Funciones::json(1,'',$data));
        }else{
            print_r(Funciones::json(2,"Debe Iniciar Session."));
        }

    }catch(Exception $e){
        Funciones::logs(1,"Error de sistema.",$e->getMessage());
    }
?>