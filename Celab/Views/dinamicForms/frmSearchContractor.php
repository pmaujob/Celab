<?php
@session_start();

$pRootC = $_SESSION['pRootC'];
$op = $_POST['op'];
$fill = $_POST['fill'];

require_once $pRootC . '/Celab/Controllers/CSearchUser.php';

$contractors = CSearchUser::searchUser($op, $fill);
?>

<table>
    <thead>
        <tr>
            <th width="15%">No.</th>            
            <th width="35%">Nombre</th>
            <th width="35%">Documento</th>
            <th width="15%">Seleccionar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($contractors as $con) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $con[1]; ?></td>
                <td><?php echo $con[3]; ?></td>
                <td>
                    <a href="#" title="Seleccionar">
                        <div onclick="selectContractor('<?php echo $con[1]; ?>','<?php echo $con[3]; ?>','<?php echo $con[4]; ?>');">
                            <img src="../../Publics/images/ic_select.png" width="60%">
                        </div>
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
