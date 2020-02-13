<?
    class DBConexion{
        private $server;
        private $dataBase;
        private $user;
        private $pass;
        private $motor;
        private $conexion;

        public function __construct()
        {
            $this->motor = DB_MOTOR;
            $this->server = DB_HOST;
            $this->user = DB_USER;
            $this->pass = DB_PASS;
            $this->dataBase = DB_BD;
        }

        public function DBConexion()
        {
            try{
                $pdo = new PDO($this->motor.':host='.$this->server.';dbname='.$this->dataBase.';',$this->user,$this->pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conexion = $pdo;
            }catch( PDOException $e ){
                Funciones::logs(2,"DBConexion.txt","Error de conexion => ".$e->getMessage());
                die("Error de conexión. ".$e->getMessage());
            }
        }

        public function DBConsulta($sql)
        {
            try {
                $sqli = $this->conexion->query($sql);
                $mysql=$sqli->fetchAll();
                return $mysql;
            } catch (Exception $e) {
                Funciones::logs(2,"DBConsulta.txt","( ".$sql." ) => ".$e->getMessage() );
                die("Error de petición. (".$sql.")");
            }
        }

        public function __destruct()
        {
            if($this->conexion){
                $this->conexion=null;

            }
        }
    }
?>