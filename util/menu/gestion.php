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
                ( isset($_POST['idpadre']) && !empty($_POST['idpadre']) ) &&
                ( isset($_POST['nombre']) && !empty($_POST['nombre']) ) &&
                ( isset($_POST['orden']) && !empty($_POST['orden']) ) &&
                ( isset($_POST['es_menu']) && !empty($_POST['es_menu']) ) &&
                ( isset($_POST['estado']) && !empty($_POST['estado']) ) &&
                ( isset($_POST['listicons']) && !empty($_POST['listicons']) )
            ){
                $idmenu=(int)addslashes($_POST['idmenu']);
                $idpadre=(int)addslashes($_POST['idpadre']);
                $orden=(int)addslashes($_POST['orden']);
                $nombre=ucfirst(addslashes($_POST['nombre']));
                $es_menu=ucfirst(addslashes($_POST['es_menu']));
                $estado=ucfirst(addslashes($_POST['estado']));
                $listicons=strtolower(addslashes($_POST['listicons']));
            }

            if(
                ( isset($_POST['ventana']) ) &&
                ( isset($_POST['librerias']) )
            ){
                $ventana=ucfirst(addslashes($_POST['ventana']));
                $librerias=addslashes($_POST['librerias']);
            }    
            
            $librerias=str_replace(",,",",",strtolower($librerias));

            $sql=$conexion->DBConsulta("
                CALL school_ue9o.updateMenu($idmenu,'$nombre',@respuesta);
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