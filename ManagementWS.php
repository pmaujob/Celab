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
        echo json_encode(MGetVinculationType::getTypes());
        break;

    case MOD_SEARCH_DOCUMENT:
        $document = $_POST['document'];
        echo MSearchDocument::documentExists($document);
        break;

    default:
        echo MOD_ERROR;
        break;
}

$sess = new SessionVars();
$sess->destroy();
?>