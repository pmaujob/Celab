<?php
@session_start();

$pRootC = $_SESSION['pRootC'];
$pRootHtmlC = $_SESSION['pRootHtmlC'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Registrar Contrato</title>
        <?php include_once $pRootC . '/Admin/Views/header.php'; ?>

        <script type="text/javascript" src="js/forms/frmRegistContract.js"></script>        
    </head>

    <body onload="onLoadRegistContract();">
        <?php include $pRootC . '/Admin/Views/menu.php'; ?>
        <article>
            <section>
                <div class="row">                    
                    <div class="col s12 m12 l12 center-align">
                        <h1 class="titles">Registrar Contrato</h1>
                    </div>                    
                </div> 
                <div class="row">
                    <div class="col s1 m2 l2">
                    </div>

                    <div class="input-field col s10 m8 l8">
                        <div class="opcionesbtn">
                            <div class="file-field input-field">
                                <div class="btn right" onclick="searchContractor();">
                                    <span>Buscar Contratista</span>
                                </div>
                                <div class="file-path-wrapper">
                                    <input id="inputContractor" class="file-path validate" type="text" placeholder="Realice la búsqueda por nombre o número de cédula..." onkeyup="searchContractor(event);">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col s1 m2 l2">
                    </div>                    
                </div>

                <div class="row">
                    <div class="col s1 m3 l3">
                    </div>
                    <div id="tblContractor" class="col s10 m6 l6">
                        
                    </div>
                    <div class="col s1 m3 l3">
                    </div>
                </div>
                
                <div id="tblContractorInfo" class="row hideControl">
                    <div class="col s1 m4 l4">
                    </div>
                    <div class="col s10 m4 l4 center-align">
                        <table>
                            <tbody>
                                <tr>
                                    <th>Nombre</th>
                                    <td id="tdName"></td>
                                </tr>
                                <tr>
                                    <th>Documento</th>
                                    <td id="tdDoc"></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td id="tdEmail"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col s1 m4 l4">
                    </div>
                </div>

                <div id="btnAddContract" class="row hideControl">
                    <div class="col s12 m12 l12 center-align">
                        <a class="waves-effect waves-light" href="#!" onclick="openModal();">
                            <img id="iconContract" src="<?php echo "../../Publics/images/ic_document.png"; ?>" class="icon-contract">
                        </a>
                    </div>  
                </div>

                <div id="divContracts" class="row hideControl">
                    <div class="col s1 m2 l2">
                    </div>

                    <div class="col s10 m8 l8">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 10%;">No.</th>
                                    <th style="width: 50%;">Tipo Contrato</th>
                                    <th style="width: 20%;">No. Contrato</th>
                                    <th style="width: 10%;">Modificar</th>
                                    <th style="width: 10%;">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="tableContracts">
                            </tbody>
                        </table>
                    </div>

                    <div class="col s1 m2 l2">
                    </div>
                </div>

                <div id="divButtonRegist" class="row hideControl">
                    <div class="col s3 m5 l5">
                    </div>

                    <div class="col s6 m2 l2">
                        <button class="btn waves-effect waves-light" onclick="saveContractInfo();">Registrar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>

                    <div class="col s3 m5 l5">
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

            </section>
        </article>
    </body>    
</html>