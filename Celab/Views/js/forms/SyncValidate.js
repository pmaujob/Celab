function onLoadBody() {

    $(document).ready(function () {
        $('.modal').modal();
    });

}

function openModal() {
    $('#modalBottom').modal('open');
}

function closeModal() {
    $('#modalBottom').modal('close');
}

function findUsers(e) {

    if (e.keyCode === 13) {

        var searchValue = document.getElementById("txtSearchUsers").value;
        if (searchValue == '') {
            return;
        }

        jQuery.ajax({
            type: 'POST',
            url: '../Views/dinamicForms/frmConsultSync.php',
            async: true,
            timeout: 0,
            data: {searchValue: searchValue},
            success: function (respuesta) {

                var userList = document.getElementById('userList');
                userList.style.display = "";
                userList.innerHTML = respuesta;

            }, error: function () {
                alert('Unexpected Error');
            }
        });

    }

}

function createTable(userId) {

    jQuery.ajax({
        type: 'POST',
        url: '../Views/dinamicForms/createUserTable.php',
        async: true,
        timeout: 0,
        data: {userId: userId},
        success: function (respuesta) {

            document.getElementById('userData').innerHTML = respuesta;
            document.getElementById('iconSearch').style.width = "30%";
            document.getElementById('iconSearch').style.height = "30%";

            closeModal();

        }, error: function () {
            alert('Unexpected Error');
        }
    });

}

function openDirectories(userId) {

    $('#modalDirs').modal('open');

    jQuery.ajax({
        type: 'POST',
        url: '../Views/dinamicForms/frmDirectories.php',
        async: true,
        timeout: 0,
        data: {userId: userId},
        success: function (respuesta) {

            var userList = document.getElementById('dirList');
            userList.style.display = "";
            userList.innerHTML = respuesta;

        }, error: function () {
            alert('Unexpected Error');
        }
    });


}