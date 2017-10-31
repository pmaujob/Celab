<?php
@session_start();

$pRootC = $_SESSION['pRootC'];
$pRootHtmlC = $_SESSION['pRootHtmlC'];

require_once $pRootC . '/Libraries/SessionVars.php';

$sess = new SessionVars();

if ($sess->exist() && $sess->varExist('user')) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Celab</title>
            <?php include_once $pRootC . '/Admin/Views/header.php'; ?>
        </head>
        <body>

            <?php include_once $pRootC . '/Admin/Views/menu.php'; ?>

        </body>
    </html>

    <?php
} else {
    header("Location: $pRootHtmlC");
}
?>