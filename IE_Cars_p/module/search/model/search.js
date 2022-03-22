function load_type() {

    ajaxPromise('module/search/controller/controller_search.php?op=type',
        'GET', 'JSON')
        .then(function (data) {
            for (row in data) {
                $('#type').append('<option value = "' + data[row].type + '">' + data[row].type + '</option>');
            }
        }).catch(function () {
            console.log("Fail load type");
        });

}

function load_city(data = undefined) {

    ajaxPromise('module/search/controller/controller_search.php?op=city',
        'POST', 'JSON', data)
        .then(function (data) {
/*             console.log(data);
 */         $('#city').empty();
            $('#city').append('<option value = "0">city</option>');
            for (row in data) {
                $('#city').append('<option value = "' + data[row].city + '">' + data[row].city + '</option>');
            }
        }).catch(function () {
            console.log('Fail load city');
        });
}

function launch_search() {
    load_type();
    load_city();
    $('#type').on('change', function () {
        let type = $(this).val();
        if (type === 0) {
            load_city();
        } else {
            load_city({ type: type });
        }
    });
}

function autocomplete() {

    $("#autocom").on("keyup", function () {

        let sdata = { complete: $(this).val() };
        if (($('#type').val() != 0)) {
            sdata.type = $('#type').val();
            if (($('#type').val() != 0) && ($('#city').val() != 0)) {
                sdata.city = $('#city').val();
            }
        }
        if (($('#type').val() == 0) && ($('#city').val() != 0)) {
            sdata.city = $('#city').val();
        }

        $.ajax({
            url: 'module/search/controller/controller_search.php?op=autocomplete',
            type: 'POST',
            data: sdata,
            dataType: 'JSON'
        }).done(function (data) {

            $('#searchAuto').empty();
            $('#searchAuto').fadeIn(10000000);
            for (row in data) {
                $('<div></div>').appendTo('#search_auto').html(data[row].brand).attr({ 'class': 'searchElement', 'id': data[row].brand });
            }
            $(document).on('click', '.searchElement', function () {
                $('#autocom').val(this.getAttribute('id'));
                $('#search_auto').fadeOut(1000);
            });
            $(document).on('click scroll', function (event) {
                if (event.target.id !== 'autocom') {
                    $('#search_auto').fadeOut(1000);
                }
            });
        }).fail(function () {
            $('#search_auto').fadeOut(500);
        });

    });

}

function btn_search() {
    $('#search-btn').on('click', function () {

        console.log("click");

        var search = [];

        if (($('#type').val() == 0) && ($('#city').val() == 0)) {

            if ($('#autocom').val() != "") {

                search.push({ "brand": [$('#autocom').val()] });
                console.log("autocom");
            }

        } else if (($('#type').val() != 0) && ($('#city').val() == 0)) {

            if ($('#autocom').val() != "") {

                search.push({ "brand": [$('#autocom').val()] });
            }
            search.push({ "type": [$('#type').val()] });

            console.log("segon if");
        } else if (($('#type').val() == 0) && ($('#city').val() != 0)) {

            if ($('#autocom').val() != "") {

                search.push({ "brand": [$('#autocom').val()] });
            }

            search.push({ "city": [$('#city').val()] });

            console.log("tercer if");
        } else {

            if ($('#autocom').val() != "") {

                search.push({ "brand": [$('#autocom').val()] });
            }

            search.push({ "type": [$('#type').val()] });
            search.push({ "city": [$('#city').val()] });
        }

        console.log(search);
        localStorage.removeItem('filters');
        if (search.length != 0) {
            localStorage.setItem('filters', JSON.stringify(search));
        }
        window.location.href = 'index.php?page=shop&op=view';

    });
}

$(document).ready(function () {
    /* console.log("document ready search"); */
    launch_search();
    autocomplete();
    btn_search();
});