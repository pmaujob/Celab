<?php

date_default_timezone_set('America/Bogota');
session_start();

$pRootC = $_SESSION['pRootC'];

require_once $pRootC . '/Libraries/fpdf/fpdf.php';
require_once $pRootC . '/Libraries/fpdf/PDF.php';
?>
