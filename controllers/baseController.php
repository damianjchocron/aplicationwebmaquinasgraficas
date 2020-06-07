<?php

class baseController
{
    public static function connect()
    {

<<<<<<< HEAD
        $dbPwd = "3xPoeJ8pSI";
        $dbUser = "damian";
        $dbServer = "54.36.98.69";
        $dbName = "damian_noticias";
=======
        //Aca poner los datos

        $dbPwd = "";
        $dbUser = "";
        $dbServer = "";
        $dbName = "";
>>>>>>> 7d42d9d7e2e4da84747a38c540d55ebb47b116b8

        $connection = new PDO("mysql:host=$dbServer;dbname=$dbName", $dbUser, $dbPwd);

        return $connection;
    }
    public function ExecuteQuery($cadena)
    { //$cadena se puede llamar como sea,antes era $query
        $result = null;

        $cnn = $this->connect();
        $result = $cnn->query($cadena); //se tiene que llamar como el de arriba entre ().

        if (count($cnn->errorInfo()) > 0) {
            foreach ($cnn->errorInfo() as $val) {
                echo $val . "</br>";
            }
        }

        return $result;
    }
}
