<?
    include_once("../system/DBconexion.php");
    include_once("../system/funciones.php");
    include_once("../system/session.php");
    include_once("../config/ue9o.php");

    try{
        $session = new Session();

        if(!$session->checkSession()){

            $conexion = new DBConexion();
            $conexion->DBConexion();

            $idmenu=0;
            $idpadre=0;
            $orden=0;
            $nombre='';
            $ventana=''; #valor vacio
            $librerias=''; #valor vacio
            $es_menu='';
            $estado='';
            $listicons='';

            if(
                ( isset($_POST['idmenu']) && !empty($_POST['idmenu']) ) &&
                ( isset($_POST['orden']) && !empty($_POST['orden']) )
            ){
                $idmenu=(int) $_POST['idmenu'];
                $orden = (int) $_POST['orden'];
            }
            if( 
                ( isset($_POST['idpadre']) && !empty($_POST['idpadre']) )
            ){
                $idpadre = (int) $_POST['idpadre'];
            }

            if(
                ( isset($_POST['listicons']) && !empty($_POST['listicons']) ) &&
                ( isset($_POST['estado']) && !empty($_POST['estado']) ) &&
                ( isset($_POST['es_menu']) && !empty($_POST['es_menu']) ) &&
                ( isset($_POST['nombre']) && !empty($_POST['nombre']) )
            ){
                $es_menu = strtoupper( addslashes( $_POST['es_menu'] ) );
                $nombre = ucfirst( addslashes( $_POST['nombre'] ) );
                $estado = strtoupper( addslashes( $_POST['estado'] ) );
                $listicons = strtolower( addslashes( $_POST['listicons'] ) );
            }

            if(
                ( isset($_POST['ventana']) ) &&
                ( isset($_POST['librerias']) )
            ){
                $ventana=strtolower(addslashes($_POST['ventana']));
                $librerias=addslashes($_POST['librerias']);
            }    
            
            $librerias=str_replace(",,",",",strtolower($librerias));
            
                $sql=$conexion->DBConsulta("
                    CALL school_ue9o.updateMenu('$idmenu','$idpadre','$nombre','$ventana','$orden','$librerias','$es_menu','$estado','$listicons','Desarrollador',@respuesta);
                ");
                $sql=explode(",",$sql[0]['respuesta']);
                print_r(Funciones::json($sql[0],$sql[1]));
            
        }else{
            throw new Exception("",3);
        }


    }catch(Exception $e){
        if($e->getCode()==3){
            header('Location:../../');
        }
    }
?>