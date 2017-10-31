<?php

@session_start();
$pRootC = $_SESSION['pRootC'];

require_once $pRootC . '/Libraries/ConnectionDB.php';

class MRegistContractorData {

    public static function registContractor($nombre, $apellido, $idDocTipo, $documento, $dv, $email, $idConTipo, $numContrato, $fechaSuscripcion, $fechaTerminacion, $valor, $objeto) {

        $consult = 'select id from ins_contractor(' . $nombre . ','
                . $apellido . ','
                . $idDocTipo . ','
                . $documento . ','
                . ($dv == "" ? "NULL" : $dv) . ','
                . $email . ','
                . $idConTipo . ','
                . $numContrato . ','
                . $fechaSuscripcion . ','
                . $fechaTerminacion . ','
                . $valor . ','
                . $objeto . ') as ("id" integer);';

        return ConnectionDB::consult(new HostData(), $consult);
    }

}
?>

