<?php
@session_start();

$pRoot = $_SESSION['pRoot'];
$pRootHtml = $_SESSION['pRootHtml'];

require_once $pRoot . '/Admin/Models/MGetMenu.php';
require_once $pRoot . '/Libraries/SessionVars.php';

$modules = MGetMenu::getMenu(2, null);
$functions = MGetMenu::getMenu(1, 1);

$sess = new SessionVars();
?>

<div class="fixed-action-btn">
    <a class="btn-floating btn-large" style="">
        <i class="large material-icons">apps</i>
    </a>
    <ul>
        <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
        <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
        <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
        <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
    </ul>
</div>

<div class="row">
    <div class="head-usuario col s12 m12 l12">
        <div class="col s6 m1 l1">
            <a href="#" data-activates="slide-out" class="button-collapse">
                <i class="icon-menu small material-icons">menu</i>
            </a>
        </div>
        <div class="col m10 l10">

        </div>
        <div class="col s6 m1 l1 right-align">
            <a id="btnUserMenu" href="#" class="dropdown-button" data-activates='dropdown1'>
                <i class="material-icons medium">person_pin</i>
            </a>
            <ul class='dropdown-content' id="dropdown1">
                <li><a href="#!" style="color: #03A9F4;"><i class="material-icons">vpn_key</i>Cambiar Contraseña</a></li>
                <li><a href="<?php echo $pRootHtml . '/Admin/Controllers/CLogout.php' ?>"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="row">

    <ul id="slide-out" class="side-nav">
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="<?php echo $pRootHtml . '/Publics/images/background-user.jpg'; ?>">
                </div>
                <a href="#!user"><img class="circle" src="<?php echo $pRootHtml . '/Publics/images/logoUser.png'; ?>"></a>
                <a href="#!name"><span class="name white-text"><?php echo $sess->getValue('user'); ?></span></a>
                <a href="#!email"><span class="email white-text"><?php echo $sess->getValue('email'); ?></span></a>
            </div>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <?php
                    if (count($modules) > 0) {
                        foreach ($modules as $row) {
                            ?>
                            <a class="collapsible-header"><?php echo $row[1]; ?><i class="material-icons">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                                <ul>
                                    <?php
                                    $functions = MGetMenu::getMenu(1, 1);

                                    foreach ($functions as $row2) {
                                        if ($row[0] == $row2[0]) {
                                            ?>

                                            <li><a onclick="location.href = '<?php echo 'http://' . $_SERVER['SERVER_NAME'] . $row2[3]; ?>'" href="<?php echo 'http://' . $_SERVER['SERVER_NAME'] . $row2[3]; ?>"><?php echo $row2[2]; ?></a></li>

                                            <?php
                                        }
                                    }
                                    ?>

                                </ul>
                            </div>
                        </li>  
                        <?php
                    }
                } else {

                    echo "Este usuario no tiene acceso a ningun modulo";
                }
                ?>
            </ul>
        </li>
    </ul>
</div>

<script>
    $(".button-collapse").sideNav();
</script>


