<?php

@session_start();

$pRootC = $_SESSION['pRootC'];

require_once $pRootC.'/libraries/ConnectionDB.php';
require_once $pRootC.'/libraries/SessionVars.php';

class MGetMenu{
    
    public static function getMenu($op,$idApp){
        
        $sess = new SessionVars();
        $user = $sess->getValue('idUser');
        
        $sql = "";
        
        if($op == 1)
            $sql = 'select id, mod, fun, url from seguridad.get_menu('.$user.','.$op.','.$idApp.') as ("id" integer, "mod" varchar, "fun" varchar, "url" varchar);';
        else if($op == 2)
            $sql = 'select id, mod from seguridad.get_menu('.$user.','.$op.') as ("id" integer, "mod" varchar);';
                
        return ConnectionDB::consult(new HostData(), $sql);
        
    }
    
}

?>
