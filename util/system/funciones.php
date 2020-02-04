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
        public static function json($estado=3,$data=array(),$mensaje=NULL)
        {
            $repuesta = new stdClass();
            $repuesta->estado=$estado;
            $repuesta->mensaje=$mensaje;
            $repuesta->data=$data;
            return $repuesta;
        }
    }
?>