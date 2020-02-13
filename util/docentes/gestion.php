<?
    try {
        include_once("../system/DBconexion.php");
        include_once("../system/funciones.php");
        include_once("../system/session.php");
        include_once("../config/ue9o.php");
        $session=new Session();
        if(!$session->checkSession()){
            $conexion=new DBConexion();
            $conexion->DBConexion();

            $idDocente=0;
            $estado="i";

            if(
                (isset($_POST['id']) && !empty($_POST['id'])) &&
                (isset($_POST['estado']) && !empty($_POST['estado']))
            ){
                $idDocente = (int) $_POST['id'];
                $estado = ucfirst( addslashes( $_POST['estado'] ) );
            }

            if(
                empty($idDocente) ||
                empty($estado)
            ){
                print_r(Funciones::json(2,"Parámetros Vacios"));
            }else{
                $sql=$conexion->DBConsulta("call school_ue9o.updateDocenteUsuario($idDocente, '$estado', @respuesta);");
                $sql=explode(",",$sql[0]['respuesta']);
                print_r(Funciones::json($sql[0],$sql[1]));
            }
        }else{
            print_r(Funciones::json(2,"Debe Iniciar Session."));
        }
    } catch (Exception $th) {
        Funciones::logs(1,$th->getMessage());
    }
?>