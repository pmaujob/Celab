<?php

@session_start();
$pRootC = $_SESSION['pRootC'];

require_once $pRootC . '/Libraries/ConnectionDB.php';

class MSearchDocument {

    public static function documentExists() {

        $sql = 'select id, '
                . 'des '
                . 'from get_tipo_vinculacion() '
                . 'as ("id" smallint, "des" varchar);';

        $con = new ConnectionDB();
        return $con->consult("PG", $sql);
    }
}

?>

