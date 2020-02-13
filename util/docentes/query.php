<?
    try {
        include_once("../system/session.php");
        include_once("../config/ue9o.php");
        $session=new Session();
        if(!$session->checkSession()){
            include_once("../system/DBconexion.php");
            include_once("../system/funciones.php");
            include_once("../core/html.php");
            $conexion=new DBConexion();
            $conexion->DBConexion();
            $sql=$conexion->DBConsulta("SELECT * FROM school_ue9o.lista_docente");
            $btnEditar ='
                <button type="button" class="btn btn-sm p-1 btn-outline-info editar mr-2">
                    <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                </button>
            ';
            foreach ($sql as $fila) {
                $data[]=array(
                    'id'=>intval($fila['id']),
                    'dni'=>$fila['dni'],
                    'nombres'=>$fila['nombres'],
                    'apellidos'=>$fila['apellidos'],
                    'movil'=>$fila['movil'],
                    'fijo'=>$fila['fijo'],
                    'direcciones'=>strlen($fila['direccion'])>15?substr($fila['direccion'],0,10).".....":'',
                    'direccion'=>$fila['direccion'],
                    'mail'=>$fila['mail'],
                    'registro'=>$fila['registro'],
                    'estado'=>$fila['estado'],
                    'estados'=>$fila['estado']=="A"?
                        '<div class="d-flex">'.
                            html::estado("E")
                        .' '.
                            html::estado($fila['estado'])
                        .'</div>':'
                        <div class="d-flex">'.
                            html::estado("E")
                        .' '.
                            html::estado($fila["estado"])
                        .'</div>',
                    'usuario'=>$fila['usuario']
                );
            }
            print_r(Funciones::json(1,"",$data));
        }else{
            print_r(Funciones::json(3,"Debe Iniciar Session"));
        }

    } catch (Exception $th) {
        Funciones::logs(1,$th->getMessage());
    }
?>