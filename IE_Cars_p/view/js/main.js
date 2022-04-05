function ajaxPromise(sUrl, sType, sTData, sData = undefined) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: sUrl,
            type: sType,
            dataType: sTData,
            data: sData
        }).done((data) => {
            resolve(data);
        }).fail((errorThrow) => {
            reject(errorThrow);
        }); 
    });
}

function click_logout() {
    $(document).on('click', '#logout', function() {
        logout();
    });
}

function logout() {
    $.ajax({
        url: 'module/login/controller/controller_login.php?op=logout',
        type: 'POST',
        dataType: 'JSON'
    }).done(function(data) {
        console.log(data);
        localStorage.removeItem('token');
        window.location.href = "index.php?page=controller_home&op=homepage";
    }).fail(function() {
        console.log('Something has occured');
    });
}

$(document).ready(function() {
    /* console.log("readylogout"); */
    click_logout();
});