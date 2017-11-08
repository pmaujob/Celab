<?php

@session_start();
$pRootC = $_SESSION['pRootC'];

require_once $pRootC . '/Libraries/ConnectionDB.php';
require_once $pRootC . '/Libraries/HostData.php';

class MSearchUser {

    public static function searchContractor($fill) {

        $consult = 'select id,'//0
                . 'nom,'//1
                . 'idtip,'//2
                . 'doc,'//3
                . 'email,'//4
                . 'dv '//5
                . 'from get_contratista(\'' . $fill . '\') as ("id" integer, "nom" varchar, "idtip" integer, "doc" varchar, "email" varchar, "dv" integer)';
    
        return ConnectionDB::consult(new HostData(), $consult);
        
    }

}

?>
