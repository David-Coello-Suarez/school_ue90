<?
    try {
        include_once("../system/session.php");
        include_once("../config/ue9o.php");
        $session=new Session();
        if(!$session->checkSession()){
            include_once("../system/DBconexion.php");
            include_once("../system/funciones.php");
            $conexion=new DBConexion();
            $conexion->DBConexion();

            $parametro_sql = $conexion->DBConsulta("SELECT * FROM `lista_parametro`");
            $parametro=array();
            foreach($parametro_sql as $fila){
                $parametro[trim($fila['nombre'])] = trim($fila['valor']);
            }
            $encrip_clave=str_replace(".","",strtolower($parametro['nameMini']."$"));

            $existe=0;
            $cedula="";
            $nombres="";
            $apellidos="";
            $estado="i";
            $movil="";
            $fijo="";
            $mail="";
            $imagenUSuario="";

            if(
                (isset($_POST['existe'])) && !empty($_POST['existe'])
            ){
                $existe = (int) $_POST['existe'];
            }

            if(
                isset($_POST['cedula']) && !empty($_POST['cedula'])
            ){
                $cedula = addslashes( $_POST['cedula'] );
            }

            print_r(Funciones::json(2,$cedula));
        }else{
            print_r(Funciones::json(2,"Debe Iniciar Session."));
        }
    } catch (Exception $th) {
        Funciones::logs(1,$th->getMessage());
    }
?>