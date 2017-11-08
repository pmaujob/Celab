contRegex = /^\d{4,4}-\d{2,2}$/;
valueRegex = /^\d{0,}\.{0,1}\d{1,}$/;
contractArray = new Array();

function onLoadRegistContract() {

    $(document).ready(function () {
        $('select').material_select();
        $('.modal').modal();
        $(".onlyNumbers").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl+A, Command+A
                            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                            // Allow: home, end, left, right, down, up
                                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
    });

    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 16, // Creates a dropdown of 15 years to control year,
        today: 'Hoy',
        labelMonthNext: 'Mes Siguiente',
        labelMonthPrev: 'Mes Anterior',
        labelMonthSelect: 'Selecciona un mes',
        labelYearSelect: 'Selecciona un año',
        monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        weekdaysLetter: ['D', 'L', 'M', 'X', 'J', 'V', 'S'],
        clear: 'Limpiar',
        close: 'Cerrar',
        closeOnSelect: false // Close upon selecting a date,
    });

    jQuery.ajax({
        type: 'POST',
        url: 'http://localhost/Celab/Celab/Controllers/GetContIdentType.php',
        async: true,
        data: {op: 2},
        timeout: 0,
        success: function (respuesta) {

            var vitypes = JSON.parse(respuesta);
            for (var i = 0; i < vitypes.length; i++) {

                var vitype = vitypes[i];
                var option = document.createElement('option');
                option.id = "typeContractItem" + vitype.id;
                option.value = vitype.id;
                option.innerHTML = vitype.des;

                $('#listContrato').append(option);
            }
            $("#listContrato").material_select('update');

        }, error: function () {
            alert('Unexpected Error');
        }
    });

}

function searchContractor(event) {

    if (searchContractor != null && event.keyCode != 13) {
        return;
    }

    var inputContractor = document.getElementById('inputContractor');
    if (inputContractor.value.toString().trim().length == 0) {
        alert('Debe digitar un nombre o número de documento para realizar la búsqueda.');
        return;
    }

    jQuery.ajax({
        type: 'POST',
        url: 'http://localhost/Celab/Celab/Views/dinamicForms/frmSearchContractor.php',
        async: true,
        data: {op: 1, fill: inputContractor.value},
        timeout: 0,
        success: function (respuesta) {

            document.getElementById('tblContractor').innerHTML = respuesta;

        }, error: function () {
            alert('Unexpected Error');
        }
    });

}

function selectContractor(name, doc, email) {

    document.getElementById("tblContractorInfo").classList.remove("hideControl");
    document.getElementById("btnAddContract").classList.remove("hideControl");

    document.getElementById("tdName").innerHTML = name;
    document.getElementById("tdDoc").innerHTML = doc;
    document.getElementById("tdEmail").innerHTML = email;

    document.getElementById("tblContractor").style.display = "none";

}

function openModal() {
    $('#contractModal').modal('open');
}

function closeModal() {
    $('#contractModal').modal('close');
}

function validateChars(event) {
    var contId = document.getElementById('contId');

    if (event.keyCode == 8 && contId.value.toString().length == 6) {
        contId.value = contId.value.toString().substring(0, 5);
    } else if (event.keyCode != 8 && contId.value.toString().length == 4) {
        contId.value += "-";
    }
}

function remove() {

}

function edit() {

}

function validateContractData() {

    var listContrato = document.getElementById('listContrato');
    var contId = document.getElementById('contId');
    var idDateSus = document.getElementById('idDateSus');
    var idDateFin = document.getElementById('idDateFin');
    var valueId = document.getElementById('valueId');
    var objectId = document.getElementById('objectId');

    var susYear = $('#idDateSus').pickadate('picker').get('highlight', 'yyyy');
    var susMonth = $('#idDateSus').pickadate('picker').get('highlight', 'mm');
    var susDay = $('#idDateSus').pickadate('picker').get('highlight', 'dd');

    var finYear = $('#idDateFin').pickadate('picker').get('highlight', 'yyyy');
    var finMonth = $('#idDateFin').pickadate('picker').get('highlight', 'mm');
    var finDay = $('#idDateFin').pickadate('picker').get('highlight', 'dd');

    if (listContrato.value == 0) {
        alert('Debe escoger un tipo de contrato.');
        listContrato.focus();
        return;
    }

    if (!contRegex.test(contId.value)) {
        alert('El número de contrato NO es válido.');
        contId.focus();
        return;
    }

    if (idDateSus.value.toString().length == 0) {
        alert('Debe escoger una Fecha de Suscripción.');
        idDateSus.focus();
        return;
    }

    if (idDateFin.value.toString().length == 0) {
        alert('Debe escoger una Fecha de Terminación.');
        idDateFin.focus();
        return;
    }

    if (!valueRegex.test(valueId.value)) {
        alert('El valor del contrato ingresado NO es válido.');
        valueId.focus();
        return;
    }

    if (objectId.value.toString().length == 0) {
        alert('Debe ingresar el Objeto del contrato.');
        objectId.focus();
        return;
    }

    var susDate = susYear + "-" + susMonth + "-" + susDay;
    var finDate = finYear + "-" + finMonth + "-" + finDay;

    if (susDate > finDate) {
        alert('La Fecha de Suscripción no puede ser mayor a la Fecha de Terminación.');
        idDateSus.focus();
        return;
    }

    var contractData = new Array();
    contractData.push(listContrato.value);
    contractData.push(susDate);
    contractData.push(finDate);
    contractData.push(valueId.value);
    contractData.push(objectId.value);
    contractData.push(contId.value);

    contractArray.push(contractData);

    var trContract = document.createElement('tr');
    trContract.id = "trContract" + contractArray.length;

    var tdNo = document.createElement('td');
    tdNo.innerHTML = "" + contractArray.length;
    trContract.appendChild(tdNo);

    var tdContractType = document.createElement('td');
    tdContractType.innerHTML = $("#typeContractItem" + listContrato.value).html();
    trContract.appendChild(tdContractType);

    var tdContractNum = document.createElement('td');
    tdContractNum.innerHTML = contId.value;
    trContract.appendChild(tdContractNum);

    var tdEdit = document.createElement('td');
    var aEditContract = document.createElement('a');
    aEditContract.class = "waves-effect waves-light";
    aEditContract.href = "#!";
    aEditContract.onclick = "edit(" + ");";
    var aEditIcon = document.createElement('img');
    aEditIcon.src = "../../Publics/images/ic_document_edit.png";
    aEditIcon.style = "width: 40%; height: 40%;";
    aEditContract.appendChild(aEditIcon);
    tdEdit.appendChild(aEditContract);
    trContract.appendChild(tdEdit);

    var tdRemove = document.createElement('td');
    var aRemoveContract = document.createElement('a');
    aRemoveContract.class = "waves-effect waves-light";
    aRemoveContract.href = "#!";
    aRemoveContract.onclick = "remove(this);";
    var aRemoveIcon = document.createElement('img');
    aRemoveIcon.src = "../../Publics/images/ic_document_remove.png";
    aRemoveIcon.style = "width: 40%; height: 40%;";
    aRemoveContract.appendChild(aRemoveIcon);
    tdRemove.appendChild(aRemoveContract);
    trContract.appendChild(tdRemove);

    document.getElementById('tableContracts').appendChild(trContract);

    $('#listContrato').val('0');
    $('#listContrato').material_select();
    contId.value = "";
    idDateSus.value = "";
    idDateFin.value = "";
    valueId.value = "";
    objectId.value = "";

    closeModal();
}
