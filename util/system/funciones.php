<?
    class Funciones
    {
        public static function logs($ubi=1,$name=null,$desc=null)
        {
            $ubi_logs = "../logs/";
            if($ubi == 2)
            {
                $ubi_logs="util/logs/";
            }
            $file = $ubi_logs."/".date("Y")."/".date("m")."/".date("d")."/";
            if(!file_exists($ubi_logs."/".date("Y")."/".date("m")."/".date("d")))
            {
                mkdir($ubi_logs."/".date("Y")."/".date("m")."/".date("d"),0777,true);
            }
            $arch=fopen($file.$name,"a");
            fwrite($arch, date("Y-m-d H:i:s")." >>>> ".$desc."\r\n");
            fclose($arch);
        }

        public static function json($estado=3,$mensaje=NULL,$data=array())
        {
            $repuesta = new stdClass();
            $repuesta->estado=(int)$estado;
            $repuesta->mensaje=$mensaje;
            $repuesta->data=$data;
            return json_encode($repuesta);
        }

        public static function encrypt_descrypt($action="desencriptar",$string,$key_a,$key_b)
        {
            $method_encrypt="AES-128-CFB";
            if($action=='encriptar'){
                $salida_encriptada=base64_encode( openssl_encrypt($string, $method_encrypt, hash('sha256',strtolower(str_replace(".","",$key_a."$"))),0,substr(hash('sha256',$key_b),0,16)));
            }else{
                $salida_encriptada=openssl_decrypt(base64_decode($string), $method_encrypt, hash('sha256',strtolower(str_replace(".","",$key_a."$"))), 0, substr(hash('sha256',$key_b),0,16) );
            }
            return $salida_encriptada;
        }
    }
?>