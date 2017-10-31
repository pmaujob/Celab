<?php
@session_start();

$pRootC = $_SESSION['pRootC'];
$pRootHtmlC = $_SESSION['pRootHtmlC'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Registrar Contratista</title>
        <?php include_once $pRootC . '/Admin/Views/header.php'; ?>

        <script type="text/javascript" src="js/forms/RegistUser.js"></script>        
    </head>

    <body onload="onLoadBodyR();">
        <?php include $pRootC . '/Admin/Views/menu.php'; ?>
        <article>
            <section>
                <div class="row">                    
                    <div class="col s12 m12 l12 center-align">
                        <h1 class="titles">Datos del Contratista</h1>
                    </div>                    
                </div> 
                <div class="row">
                    <div class="col s2 m4 l4">
                    </div>
                    <div class="input-field col s4 m2 l2">
                        <input id="funFirstName" type="text" class="validate">
                        <label for="funFirstName">Nombre Funcionario</label>
                    </div>
                    <div class="input-field col s4 m2 l2">
                        <input id="funLastName" type="text" class="validate">
                        <label for="funLastName">Apellido Funcionario</label>
                    </div>
                    <div class="col s2 m4 l4">
                    </div>                        
                </div>                     
                <div class="row">
                    <div class="col s1 m4 l4">
                    </div>

                    <div class="input-field col s4 m2 l2">
                        <select id="listTipo" onchange="validateDV(this);">
                            <option value="0" disabled selected>Tipo de Identificación</option>
                        </select>
                    </div>  

                    <div class="input-field col s4 m2 l2">
                        <input id="funId" type="text" class="validate">
                        <label for="funId">No. Identificación</label>
                    </div> 

                    <div id="divDv" class="input-field col s1 m2 l2" style="display: none;">
                        <input id="dv" type="text" class="validate">
                        <label for="dv">Dígito Verificación</label>
                    </div>

                    <div class="col s1 m2 l2">
                    </div>
                </div>

                <div class="row">
                    <div class="col s2 m4 l4">
                    </div>
                    <div class="input-field col s8 m4 l4">
                        <input id="emailId" type="email" class="validate">
                        <label for="emailId">Correo Electrónico</label>
                    </div>     
                    <div class="col s2 m4 l4">
                    </div>                        
                </div>

                <div class="row">
                    <div class="col s12 m12 l12 center-align">
                        <a class="waves-effect waves-light" href="#!" onclick="openModal();">
                            <img id="iconContract" src="<?php echo "../../Publics/images/ic_document.png"; ?>" class="icon-contract">
                        </a>
                    </div>
                </div>

                <div id="contractModal" class="modal modal-fixed-footer">
                    <div class="modal-content">
                        <h1 class="titles">Datos del Contrato</h1>                        
                        <p>Ingrese los datos del contrato.</p>

                        <div class="row">
                            <div class="col s1 m2 l2">
                            </div>

                            <div class="col s10 m8 l8">
                                <select id="listContrato">
                                    <option value="0" disabled selected>Tipo de Contrato</option>
                                </select>
                            </div>

                            <div class="col s1 m2 l2">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s1 m2 l2">
                            </div>

                            <div class="input-field col s10 m8 l8">
                                <input id="contId" type="text" class="onlyNumbers validate" maxlength="7" placeholder="####-##" autocomplete="off" onkeypress="validateChars(event);">
                                <label for="contId">No. de Contrato</label>
                            </div>

                            <div class="col s1 m2 l2">
                            </div>
                        </div>                    

                        <div class="row">
                            <div class="col s1 m2 l2">
                            </div>

                            <div class="col s5 m4 l4">
                                <label>Fecha de Suscripción</label>
                                <input id="idDateSus" type="text" class="datepicker">
                            </div>  

                            <div class=" col s5 m4 l4">                            
                                <label>Fecha de Terminación</label>
                                <input id="idDateFin" type="text" class="datepicker">
                            </div> 

                            <div class="col s1 m2 l2">
                            </div>
                        </div>     

                        <div class="row">
                            <div class="col s1 m2 l2">
                            </div>

                            <div class="input-field col s10 m8 l8">
                                <input id="valueId" type="text" class="onlyNumbers validate">
                                <label for="valueId">Valor</label>
                            </div>

                            <div class="col s1 m2 l2">
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col s1 m2 l2">
                            </div>

                            <div class="input-field col s10 m8 l8">
                                <input id="objectId" type="text" class="validate">
                                <label for="objectId">Objeto</label>
                            </div>

                            <div class="col s1 m2 l2">
                            </div>
                        </div>

                    </div>                    
                    <div class="modal-footer">                                                      
                        <a id="modale" href="#!" class="modal-action waves-effect waves-green btn-flat " onclick="validateContractData();">Agregar Contrato</a>
                        <a id="modalg" href="#!" class="modal-action waves-effect waves-green btn-flat " onclick="">Cerrar</a>
                    </div>
                </div>

                <div class="row">
                    
                </div>
                
                <div class="row">
                    <div class="col s3 m5 l5">
                    </div>

                    <div class="col s6 m2 l2">
                        <button class="btn waves-effect waves-light" onclick="saveInfo();">Registrar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>

                    <div class="col s3 m5 l5">
                    </div>
                </div>

            </section>
        </article>
    </body>    

</html>