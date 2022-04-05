function register() {

    if (validate_register() != 0) {
        var data = $('#register__form').serialize();
        $.ajax({
            url: "module/login/controller/controller_login.php?op=register&" + data,
            type: "POST",
            dataType: "JSON",
            data: data,
        }).done(function (result) {
            console.log(result);
            if (result == "error") {
                $("#error_password").html('El email ya esta registrado');
            } else {
                setTimeout(' window.location.href = "index.php?page=controller_login&op=login"; ', 1000);
            }
        }).fail(function (textStatus) {
            if (console && console.log) {
                console.log("La solicitud ha fallado: " + textStatus);
            }
        });
    }

}

function key_register() {
    $("#register__form").keypress(function (e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
            e.preventDefault();
            register();
        }
    });
}

function button_register() {
    $('#register').on('click', function (e) {
        e.preventDefault();
        register();
    });
}

function validate_register() {
    var mail_exp = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var error = false;

    if (document.getElementById('username').value.length === 0) {
        document.getElementById('error_username').innerHTML = "Tienes que escribir el usuario";
        error = true;
    } else {
        if (document.getElementById('username').value.length < 8) {
            document.getElementById('error_username').innerHTML = "El username tiene que tener 8 caracteres como minimo";
            error = true;
        } else {
            document.getElementById('error_username').innerHTML = "";
        }
    }

    if (document.getElementById('email').value.length === 0) {
        document.getElementById('error_email').innerHTML = "Tienes que escribir un correo";
        error = true;
    } else {
        if (!mail_exp.test(document.getElementById('email').value)) {
            document.getElementById('error_email').innerHTML = "El formato del mail es invalido";
            error = true;
        } else {
            document.getElementById('error_email').innerHTML = "";
        }
    }

    if (document.getElementById('password').value.length === 0) {
        document.getElementById('error_password').innerHTML = "Tienes que escribir la contraseña";
        error = true;
    } else {
        if (document.getElementById('username').value.length < 8) {
            document.getElementById('error_password').innerHTML = "La password tiene que tener 8 caracteres como minimo";
            error = true;
        } else {
            document.getElementById('error_password').innerHTML = "";
        }
    }

    if (error == true) {
        return 0;
    }
}

$(document).ready(function () {
    key_register();
    button_register();
});