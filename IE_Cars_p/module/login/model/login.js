function login() {
    if (validate_login() != 0) {
        var data = $('#login__form').serialize();
        $.ajax({
            url: "module/login/controller/controller_login.php?op=login&" + data,
            dataType: "JSON",
            type: "POST",
            data: data,
        }).done(function (result) {
            if (result == "error") {
                $("#error_password").html('La contraseña no es correcta');
            } else {
                localStorage.setItem("token", result);
                setTimeout(' window.location.href = "index.php?page=controller_home&op=homepage"; ', 1000);
            }
        }).fail(function (textStatus) {
            if (console && console.log) {
                console.log("La solicitud ha fallado: " + textStatus);
            }
        });
    }
}

function key_login() {
    $("#login__form").keypress(function (e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
            e.preventDefault();
            login();
        }
    });
}

function button_login() {
    $('#login').on('click', function (e) {
        e.preventDefault();
        login();
    });
}

function validate_login() {
    var error = false;

    if (document.getElementById('username').value.length === 0) {
        document.getElementById('error_username').innerHTML = "Tienes que escribir el usuario";
        error = true;
    } else {
        document.getElementById('error_username').innerHTML = "";
    }

    if (document.getElementById('password').value.length === 0) {
        document.getElementById('error_password').innerHTML = "Tienes que escribir la contraseña";
        error = true;
    } else {
        document.getElementById('error_password').innerHTML = "";
    }

    if (error == true) {
        return 0;
    }
}

$(document).ready(function () {
    key_login();
    button_login();
});