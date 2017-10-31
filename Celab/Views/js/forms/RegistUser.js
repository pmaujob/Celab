emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
contRegex = /^\d{4,4}-\d{2,2}$/;
valueRegex = /^\d{0,}\.{0,1}\d{1,}$/;

function onLoadBodyR() {

    $(document).ready(function () {
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

    $(document).ready(function () {
        $('select').material_select();
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
        data: {op: 1},
        timeout: 0,
        success: function (respuesta) {

            var vitypes = JSON.parse(respuesta);
            for (var i = 0; i < vitypes.length; i++) {

                var vitype = vitypes[i];
                var option = document.createElement('option');
                option.value = vitype.id + "|" + vitype.dv;
                option.innerHTML = vitype.des;

                $('#listTipo').append(option);
            }
            $("#listTipo").material_select('update');

        }, error: function () {
            alert('Unexpected Error');
            return;
        }
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

function openModal() {
    $('#contractModal').modal('open');
}

function closeModal() {
    $('#contractModal').modal('close');
}

function validateDV(select) {
    var opValue = select.value.toString().split('|')[1];
    document.getElementById('divDv').style.display = opValue == 1 ? "" : "none";
}

function validateChars(event) {
    var contId = document.getElementById('contId');

    if (event.keyCode == 8 && contId.value.toString().length == 6) {
        contId.value = contId.value.toString().substring(0, 5);
    } else if (event.keyCode != 8 && contId.value.toString().length == 4) {
        contId.value += "-";
    }
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
        listTipo.focus();
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

}

function saveInfo() {

    var funFirstName = document.getElementById('funFirstName');
    var funLastName = document.getElementById('funLastName');
    var listTipo = document.getElementById('listTipo');
    var funId = document.getElementById('funId');
    var dv = document.getElementById('dv');
    var emailId = document.getElementById('emailId');
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


    if (funFirstName.value.toString().trim().length == 0) {
        alert('Debe ingresar su nombre.');
        funFirstName.focus();
        return;
    }

    if (funLastName.value.toString().trim().length == 0) {
        alert('Debe ingresar su apellido.');
        funLastName.focus();
        return;
    }

    if (listTipo.value == 0) {
        alert('Debe escoger un tipo de documento.');
        listTipo.focus();
        return;
    }

    if (funId.value.toString().trim().length == 0) {
        alert('Debe ingresar su documento de identidad.');
        funId.focus();
        return;
    }

    if (document.getElementById('divDv').style.display != "none" && dv.value.toString().trim().length == 0) {
        alert('Debe ingresar el dígito de verificación');
        dv.focus();
        return;
    }

    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (!emailRegex.test(emailId.value)) {
        alert('El email ingresado NO es válido.');
        emailId.focus();
        return;
    }
    
    var contractorData = new Array();
    contractorData.push(funFirstName.value);
    contractorData.push(funLastName.value);
    contractorData.push(listTipo.value.toString().split('|')[0]);
    contractorData.push(funId.value);
    contractorData.push(dv.value);
    contractorData.push(emailId.value);

    for (var i = 0; i < max; i++) {//hasta numero de contratos agregados
        
    }

    var susDate = susYear + "-" + susMonth + "-" + susDay;
    var finDate = finYear + "-" + finMonth + "-" + finDay;

    contractorData.push(listContrato.value);
    contractorData.push(contId.value);
    contractorData.push(susDate);
    contractorData.push(finDate);
    contractorData.push(valueId.value);
    contractorData.push(objectId.value);

    jQuery.ajax({
        type: 'POST',
        url: 'http://localhost/Celab/Celab/Controllers/CRegistContractor.php',
        async: true,
        data: {contractorData: contractorData},
        timeout: 0,
        success: function (respuesta) {


            switch (respuesta.toString().trim()) {

                case "1":
                    alert("Los datos fueron registrados satisfactoriamente.");
                    location.href = "";//llevar a generar el certificado
                    break;

                case "- 1":
                    alert("El documento de identidad ingresado ya existe.");
                    funId.focus();
                    break;

                default:
                    console.log("ERROR: " + respuesta);
                    alert("No se pudo realizar el registro de datos, por favor vuelva a intentarlo.");
                    break;

            }


        }, error: function () {
            alert('Unexpected Error');
            return;
        }
    });


}

