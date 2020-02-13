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

            $idParalelo = 0;
            $estado = "";

            if(
                isset($_POST['id']) && !empty($_POST['id'])
            ){
                $idParalelo = $_POST['id'];
            }

            if(
                isset($_POST['estado']) && !empty($_POST['estado'])
            ){
                $estado = ucfirst( addslashes( $_POST['estado'] ) );
            }
            
            if(
                empty($idParalelo) ||
                empty($estado)
            ){
                print_r(Funciones::json(2,"Parámetros Vacios"));
            }else{
                $sql = $conexion->DBConsulta("CALL updateParalelos('$idParalelo','$estado','Desarrollador',@respuesta)");
                $sql = explode(",",$sql[0]['respuesta']);
                print_r(Funciones::json($sql[0],$sql[1]));
            }
        }else{
            Funciones::json(3,"Debe Iniciar Session.");
        }
    }catch(Exception $e){
        Funciones::logs(1,"Error de sistema",$e->getMessage());
    }
?>