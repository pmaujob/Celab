<?php

@session_start();
$pRootC = $_SESSION['pRootC'];

require_once $pRootC . '/Libraries/ConnectionDB.php';

class MGetVinculationType {

    public static function getTypes() {

        $sql = 'select id, '
                . 'des '
                . 'from get_tipo_vinculacion() '
                . 'as ("id" smallint, "des" varchar);';

        $con = new ConnectionDB();
        return $con->consult("PG", $sql);
    }
}

?>