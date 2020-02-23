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

            $parametro=array();
            $sql=$conexion->DBConsulta("SELECT * FROM `lista_parametro`");
            foreach($sql as $fila){
                $parametro[trim($fila['nombre'])]=trim($fila['valor']);
            }
            #registrar cada uno de los usuario primero
            $existe=0;
            $cedula="";
            $nombres="";
            $apellidos="";
            $estado="i";
            $movil="";
            $fijo="";
            $mail="";
            $imagenUSuario="";
            $direccion='';

            if(
                (isset($_POST['existe'])) && !empty($_POST['existe'])
            ){
                $existe = (int) $_POST['existe'];
            }

            if(
                ( isset($_POST['cedula']) && !empty($_POST['cedula']) ) &&
                ( isset($_POST['apellido']) && !empty($_POST['apellido']) ) &&
                ( isset($_POST['nombre']) && !empty($_POST['nombre']) ) &&
                ( isset($_POST['movil']) && !empty($_POST['movil']) ) &&
                ( isset($_POST['mail']) && !empty($_POST['mail']) ) &&
                ( isset($_POST['direccion']) && !empty($_POST['direccion']) )
            ){
                $cedula = addslashes( $_POST['cedula'] );
                $apellidos = strtolower( addslashes( $_POST['apellido'] ) );
                $nombres = strtolower( addslashes( $_POST['nombre'] ) );
                $movil =  str_replace("-","",$_POST['movil']);
                $mail = strtolower( addslashes( $_POST['mail'] ) );
                $direccion = addslashes( $_POST['direccion'] );
            }

            if(
                isset($_POST['fijo'])
            ){
                $fijo = substr($_POST['fijo'],0,3).substr(str_replace("-","",$_POST['fijo']),2);
            }

            if(
                (isset($_POST['imageUsario']) && !empty($_POST['imageUsario']) ) 
            ){
                $imagenUSuario = addslashes( $_POST['imageUsario'] );
            }
            
            if(
                empty($cedula) ||
                empty($apellidos) ||
                empty($nombres) ||
                empty($movil) ||
                empty($mail) ||
                empty($direccion) ||
                empty($imagenUSuario)
            ){
                print_r(Funciones::json(2,"Parámetros Vacíos"));
            }
            else
            {
                $dni_cifrada = Funciones::encrypt_descrypt("encriptar",$cedula,$parametro['nameMini'],$parametro['nameEmpresa']);

                // $usuario = substr(explode(" ",$nombres)[0],0,1).substr(explode(" ",$nombres)[1],0,1).explode(" ",$apellidos)[0]."@".strtolower(str_replace(".","",$parametro['nameMini'])).".com";

                // $sql=$conexion->DBConsulta("
                //     CALL school_ue9o.docenteUsuario($existe,'".strtolower(str_replace(".","",$parametro['nameMini']."$"))."','".Funciones::encrypt_descrypt("encriptar",$cedula,$parametro['nameMini'],$parametro['nameEmpresa'])."','$nombres','$apellidos','".strtoupper($estado)."','$movil','$fijo','$direccion','$mail','$usuario','".urldecode($imagenUSuario)."','Desarrollador')
                // ");

                // $sql=explode(",",$sql[0][0]);
                $imgLimp= explode(",",urldecode($imagenUSuario));

                $archivo = fopen($_SERVER['DOCUMENT_ROOT'].'/UE90-2/img/docentes/'.$dni_cifrada.'.png',"a");
                $imgBit = fread($archivo,strlen($imgLimp[1]));
                fclose($archivo);
                print_r(Funciones::json(2,$imgLimp));
                #no rendirce asta grabar las imagenes de los usuarios en el sistema
            }
        }else{
            print_r(Funciones::json(2,"Debe Iniciar Session."));
        }
    } catch (Exception $th) {
        Funciones::logs(3,$th->getMessage());
    }
?>