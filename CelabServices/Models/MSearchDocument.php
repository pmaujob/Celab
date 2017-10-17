<?php

@session_start();
$pRootC = $_SESSION['pRootC'];

require_once $pRootC . '/Libraries/ConnectionDB.php';

class MSearchDocument {

    public static function getDataBase($docType) {

        $sql = "SELECT bd.id_bd,"//0
                . "bd.descripcion,"//1
                . "bd.motor,"//2
                . "bd.usuario,"//3
                . "bd.pass,"//4
                . "bd.nombre_bd,"//5
                . "bd.host "//6
                . "FROM base_datos AS bd "
                . "INNER JOIN base_vinculacion AS bv ON bd.id_bd = bv.id_bd "
                . "INNER JOIN tipo_vinculacion AS tv ON tv.id_vitipo = bv.id_vitipo "
                . "WHERE tv.id_vitipo = $docType "
                . "ORDER BY bv.bd_principal;";

        return ConnectionDB::consult(new HostData(), $sql);
    }

    public static function documentExists($document, $docType) {

        $bdRes = self::getDataBase($docType);
        $foundDoc = 0;
        $sql = '';

        foreach ($bdRes as $bd) {

            //Hacer SQL estático dado que los campos de cada BD podrían NO coincidir            
            switch ($bd[5]) {

                case "sysman":

                    break;

                case "talento":

                    break;

                case "pasyvocol":

                    break;

                case "siscontra":

                    break;

                case "msia":

                    break;

                default:
                    echo "Base de datos no reconocida: " . $bd[5] . ".";
                    break;
            }

            $foundDoc = ConnectionDB::consult(new HostData($bd[2], $bd[3], $bd[4], $bd[5], $bd[6]), $sql);
        }

        $con = new ConnectionDB();
        return $con->consult("PG", $sql);
    }

}
?>

