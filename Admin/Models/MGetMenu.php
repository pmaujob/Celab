<?php

@session_start();

$pRoot = $_SESSION['pRoot'];

require_once $pRoot.'/libraries/ConnectionDB.php';
require_once $pRoot.'/libraries/SessionVars.php';

class MGetMenu{
    
    public static function getMenu($op,$idApp){
        
        $sess = new SessionVars();
        $user = $sess->getValue('idUser');
        
        $sql = "";
        
        if($op == 1)
            $sql = 'select id, mod, fun, url from seguridad.get_menu('.$user.','.$op.','.$idApp.') as ("id" integer, "mod" varchar, "fun" varchar, "url" varchar);';
        else if($op == 2)
            $sql = 'select id, mod from seguridad.get_menu('.$user.','.$op.') as ("id" integer, "mod" varchar);';
        
        $con = new ConnectionDB();        
        return $con->consult(ConnectionDB::$MNG_PG,$sql);
        
    }
    
}

?>
