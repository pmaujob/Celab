<?php

@session_start();
$_SESSION['pRootC'] = dirname(__FILE__);
$pRootC = $_SESSION['pRootC'];

require_once $pRootC . '/CelabServices/Models/MGetTipoVinculacion.php';
require_once $pRootC . '/Libraries/SessionVars.php';

const MOD_VINCULATION_TYPE = "MOD_VINCULATION_TYPE";
const MOD_SEARCH_DOCUMENT = "MOD_SEARCH_DOCUMENT";
const MOD_ERROR = "MOD_ERROR";

$opModel = $_POST['opModel'];

switch ($opModel) {

    case MOD_VINCULATION_TYPE://Traer tipos vinculacion
        echo json_encode(MGetVinculationType::getTypes()->fetchAll(PDO::FETCH_OBJ));
        break;

    case MOD_SEARCH_DOCUMENT://Consultar si el documento existe
        $document = $_POST['document'];
        $docType = $_POST['docType'];
        echo MSearchDocument::documentExists($document,$docType);
        break;

    default:
        echo MOD_ERROR;
        break;
}

$sess = new SessionVars();
$sess->destroy();
?>