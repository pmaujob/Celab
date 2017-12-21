<?php

@session_start();
$_SESSION['pRootC'] = dirname(__FILE__);
$_SESSION['pRootHtml'] = 'http://' . $_SERVER['SERVER_NAME'] . '/Celab';
$pRootC = $_SESSION['pRootC'];
$pRootHtml = $_SESSION['pRootHtml'];

$opModel = $_POST['opModel'];

if ($opModel == "MOD_VINCULATION_TYPE") {

    header("Location:  $pRootHtml/CelabServices/Controllers/ManagementWS.php?opModel=" . $opModel);
} else if ($opModel == "MOD_SEARCH_CONTRACTOR") {

    $document = $_POST['document'];
    $docType = $_POST['docType'];
    header("Location:  $pRootHtml/CelabServices/Controllers/ManagementWS.php?opModel=" . $opModel . "&document=" . $document . "&docType=" . $docType);
}
?>