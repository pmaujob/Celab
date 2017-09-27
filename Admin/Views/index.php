<?php
@session_start();

$pRoot = $_SESSION['pRoot'];
$pRootHtml = $_SESSION['pRootHtml'];

require_once $pRoot . '/Libraries/SessionVars.php';

$sess = new SessionVars();

if ($sess->exist() && $sess->varExist('user')) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Scorpio</title>
            <?php include_once $pRoot . '/Admin/Views/header.php'; ?>
        </head>
        <body>

            <?php include_once $pRoot . '/Admin/Views/menu.php'; ?>

        </body>
    </html>

    <?php
} else {

    header("Location: $pRootHtml");
}
?>