<?php

@session_start();
$pRootC = $_SESSION['pRootC'];

require_once $pRootC . '/Libraries/HostData.php';
require_once $pRootC . '/Libraries/ConnectionDB.php';

class MGetContractAdditions {

    public static function getAdditions($numContract, $bd) {

        $sql = '';

        return ConnectionDB::consult(new HostData(), $sql);
    }

}

?>
