<?
    try{
        include_once("../system/DBconexion.php");
        include_once("../system/funciones.php");
        include_once("../system/session.php");
        include_once("../config/ue9o.php");

        $session=new Session();
        if(!$session->checkSession()){

            $conexion = new DBConexion();
            $conexion->DBConexion();
            
            $idCicloAcad=0;
            $nombre_lectivo='';
            $anio_lectivo='';
            $estado='';

            if(
                ( isset($_POST['idCicloAcad']) && !empty($_POST['idCicloAcad']) )
            ){
                $idCicloAcad = (int) $_POST['idCicloAcad'];
            }

            if(
                ( isset($_POST['nombre_lectivo']) && !empty($_POST['nombre_lectivo']) ) &&
                ( isset($_POST['anio_lectivo']) && !empty($_POST['anio_lectivo']) ) &&
                ( isset($_POST['estado']) && !empty($_POST['estado']) )
            ){
                $nombre_lectivo = ucfirst( addslashes( $_POST['nombre_lectivo'] ) );
                $anio_lectivo = (int) $_POST['anio_lectivo'] ;
                $estado = ucfirst( addslashes( $_POST['estado'] ) );
            }

            if(
                empty($nombre_lectivo) ||
                empty($anio_lectivo) ||
                empty($estado)
            ){
                print_r(Funciones::json(2,$estado));
            }else{
                $sql = $conexion->DBConsulta("CALL updatePeriodoAcademinco('$idCicloAcad','$nombre_lectivo','$anio_lectivo','$estado','Desarrollador',@respuesta)");
                $sql = explode(",",$sql[0]['respuesta']);
                print_r(Funciones::json($sql[0],$sql[1]));
            }
        }else{
            print_r(Funciones::json(3,"Debe Inicar Session"));
        }

    }catch(Exception $e){
        Funciones::logs(1,"Error_sistema",$e->getMessage());
    }
?>