<?
    include_once("util/system/DBconexion.php");
    include_once("util/system/funciones.php");
    include_once("util/system/session.php");
    include_once("util/config/ue9o.php");

    include_once("util/core/html.php");

    $session = new Session();

    $conexion = new DBConexion();
    $conexion->DBConexion();

    $sql = $conexion->DBConsulta("SELECT * FROM `lista_parametro`");
    $parametro = array();
    foreach($sql as $fila){
        $parametro[trim($fila["nombre"])] = trim($fila['valor']);
    }

    if(!$session->checkSession()){

        $usuario='Desarrollador';

        $pagina=$parametro['paginaDefault'];
        if(isset($_GET['pagina']) && !empty($_GET['pagina'])){
            $pagina=$_GET['pagina'];
        }

        #Revisar el procedimiento almacenado en la base de datos
        $permisos=$conexion->DBConsulta("CALL permisos('$usuario','".$pagina."')");
        $varAcceso=array();
        foreach ($permisos as $fila) {
            $varAcceso['idacceso']=intval($fila['idacceso']);
            $varAcceso['nombre']=$fila['nombre'];
            $varAcceso['ventana']=$fila['ventana'];
            $varAcceso['libreria']=explode(",",$fila['libreria']);
        }
        if(count($varAcceso)==0){
            $flag=false;
            #bandera para revisar si el usuario tiene permisos en algun modulo del sistema.(Prodecimiento almacenado)
            $resultflag=$conexion->DBConsulta("CALL flag('$usuario')");
            foreach($resultflag as $fila){
                $pagina=$fila['ventana'];
                $flag=true;
            }
            if($flag==false){
                $session->endSession();
                echo 'Estimado, usted no tiene modulos asignados en el aplicativo.';
                header('Refresh:10');
                exit();
            }else{
                #Permisos por pagina
                $resultopt=$conexion->DBConsulta("CALL permisos('$usuario','".$pagina."')");
                $varAcceso=array();
                foreach ($permisos as $fila) {
                    $varAcceso['idacceso']=intval($fila['idacceso']);
                    $varAcceso['nombre']=$fila['nombre'];
                    $varAcceso['ventana']=$fila['ventana'];
                    $varAcceso['libreria']=explode(",",$fila['libreria']);
                }
            }
        }
        #carga las jerarquias para guardar en el menu de opciones.(prodecimiento almacenado)
        $menu_principal=$conexion->DBConsulta("CALL menu('$usuario')");
        $vectorMenu=array();
        $cont=0;
        foreach($menu_principal as $fila){
            $vectorMenu[$cont]['idmenu']=intval($fila['idmenu']);
            $vectorMenu[$cont]['idpadre']=($fila['idpadre']!=NULL?intval($fila['idpadre']):'');
            $vectorMenu[$cont]['nombre']=$fila['nombre'];
            $vectorMenu[$cont]['ventana']=$fila['ventana'];
            $vectorMenu[$cont]['es_menu']=$fila['es_menu'];
            $vectorMenu[$cont]['icono']=$fila['icono'];
            $cont++;
        }
        if(
            'Desarrollador'!=$usuario ||
            'Administrador'!='Administrador'
        ){            
            $idpadre_int='';
            for($f=0; $f<count($vectorMenu); $f++){
                if($f==0){
                    $idpadre_int.=$vectorMenu[$f]['idpadre'];
                }else{                
                    $idpadre_int.=$vectorMenu[$f]['idpadre'];
                }
            } 
            if(!empty($idpadre_int)){
                $submenu=$conexion->DBConsulta("CALL submenu('$idpadre_int','$usuario')");
                foreach($submenu as $fila){
                    $vectorMenu[$cont]['idmenu']=intval($fila['idmenu']);
                    $vectorMenu[$cont]['idpadre']=intval($fila['idpadre']);
                    $vectorMenu[$cont]['nombre']=$fila['nombre'];
                    $vectorMenu[$cont]['ventana']=$fila['ventana'];
                    $vectorMenu[$cont]['es_menu']=$fila['es_menu'];
                    $vectorMenu[$cont]['icono']=$fila['icono'];
                    $cont++;
                }
            }
        }
        include_once("inc/cabpie/cab.php");
        include_once("inc/$pagina/cuerpo.php");
        include_once("inc/cabpie/pie.php");
    }
?>