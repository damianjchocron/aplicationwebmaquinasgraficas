<?php

class baseController
{
    public static function connect()
    {

        $dbPwd = "3xPoeJ8pSI";
        $dbUser = "damian";
        $dbServer = "54.36.98.69";
        $dbName = "damian_noticias";

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
