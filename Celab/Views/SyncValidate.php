<?php
@session_start();

$pRoot = $_SESSION['pRoot'];
$pRootHtml = $_SESSION['pRootHtml'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Consulta de Actividades</title>
        <?php include_once $pRoot . '/Admin/Views/header.php'; ?>
        <?php include_once $pRoot . '/MlBackups/Views/headerp.php'; ?>
        <script type="text/javascript" src="js/forms/SyncValidate.js"></script>
    </head>
    <body onload="onLoadBody();">
        <?php include $pRoot . '/Admin/Views/menu.php'; ?>
        <div class="general-container">
            <form id='frmConsultSync' name='frmConsultSync' enctype="multipart/form-data">
                <div class="container-fluid">
                    <div class="col s12 m8 l12 center-align">
                        <div class="row">
                            <div class="col s12 m12 l12 center-align"><span class="lbl-style">Haga click en la lupa para ir al formulario de búsqueda</span></div>
                            <br>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="row">
                                    <a class="waves-effect waves-light" href="#!" onclick="openModal();">
                                        <img id="iconSearch" src="<?php echo $pRootHtml."/Publics/images/view.png"; ?>" class="icon-search">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m3 l3">
                            <!-- Espacio para centrar la tabla -->
                        </div>
                        <div id="userData" class="col s12 m6 l6 center-align">

                        </div>
                    </div>
                </div>
            </form>

            <div id="modalBottom" class="modal bottom-sheet">
                <div class="modal-content">
                    <h4>Lista de Usuarios</h4>
                    <div class="row">
                        <div class="col s12 m12 l12">

                            <div class="row">
                                <div class="col s12">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">search</i>
                                        <input id="txtSearchUsers" type="text" class="validate" onkeydown="findUsers(event);">
                                        <label for="txtSearchUsers">Realice la búsqueda por nombre o área.</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <ul id="userList" class="collection" style="display: none;">

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div id="modalDirs" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h4>Lista de Directorios</h4>
                    <div class="row">
                        <ul id="dirList" class="collection" style="display: none;">

                        </ul>
                    </div>               
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Aceptar</a>
                </div>
            </div>

        </div>
    </body>
</html>