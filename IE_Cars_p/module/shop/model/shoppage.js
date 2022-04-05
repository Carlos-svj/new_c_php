
function loadCars(items_page = 10, total_prod = 0) {

    /* console.log("items_page: " + items_page);
    console.log("total_prod: " + total_prod); */

    var filters = localStorage.getItem('filters') || false;

    console.log(filters);

    if (filters != false) {
        var url = "module/shop/controller/controller_shop.php?op=filters_search&filters=" + filters;
        if ($('#remove-filters').length == 0) {
            $('<button></button>').attr({ 'class': 'button', 'id': 'remove-filters' }).appendTo('.filter-content').html('Remove filters');
        }
    } else {
        $('#remove-filters').remove();
        var url = 'module/shop/controller/controller_shop.php?op=list_shop';
    }
    ajaxPromise(url,
        'GET', 'JSON', {items_page: items_page, total_prod: total_prod})
        .then(function (data) {

            console.log(url);

            for (row in data) {

                $('<div></div>').attr({ 'id': data[row].id, class: 'modaldet' }).appendTo('#list_cars').html(

                    "<div class='portfolio-item'>" +
                    "<div class='item-main'>" +
                    "<div class='portfolio-image'>" +
                    "<img src=" + data[row].img + ">" +
                    "</div >" +
                    "<ul>" + data[row].brand + "</ul>" +
                    "<ul>" + data[row].model + "</ul>" +
                    "<ul>" + data[row].type + "</ul>" +
                    "<ul>" + data[row].category + "</ul>" +
                    "<ul>" + data[row].KM + "</ul>" +
                    "<ul>" + data[row].price + "</ul>" +
                    "</div>" +
                    "</div>"

                );

            }
            maps(data);

        }).catch(function () {
            console.log("catch loadcars");
            /* window.location.href = "index.php?page=exception&op=503&read"; */
        });
}

function loadCar_details() {

    /* $(document).on('click', '.modaldet', function () { */

    $("#list_cars").empty();
    ajaxPromise('module/shop/controller/controller_shop.php?op=details_s&id=' + localStorage.getItem('id'),
        'GET', 'JSON')
        .then(function (data) {

            console.log('id');
            console.log(data);

            $('<div></div>')
                .attr('id', data[0].id)
                .appendTo('#details_cars')
                .html(

                    "<li class='portfolio-item_det_shop'>" +
                    "<div class='portfolio-item'>" +
                    "<h3>" + data[0].brand + "</h3>" +
                    "<h3>" + data[0].model + "</h3>" +
                    "<h3>" + data[0].type + "</h3>" +
                    "<h3>" + data[0].category + "</h3>" +
                    "<h3>" + data[0].KM + "</h3>" +
                    "<h3>" + data[0].price + "</h3>" +
                    "</div>" +
                    "</li>"
                );

            for (row in data[1][0]) {

                $('<div></div>')
                    .attr('id', data[1].img_car)
                    .appendTo('.single-item')
                    .html(

                        "<div class=>" +
                        "<img src=" + data[1][0][row].img_car + ">" +
                        "</div >"

                    );
            }

            $('.single-item').slick({
                arrows: true,
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                centerMode: true,
                variableWidth: true,
                draggable: true
            });

            $('<div></div>').attr('class', "back_list").appendTo("#details_cars").html(
                "<div><input class='list_button' name='Submit' type='button' id='list-filters' value='Back'/></div>"
            )
            load_map_details(data);
            
        }).catch(function () {
            console.log("catch shoppage.js");
/*          window.location.href = "index.php?page=exception&op=503&read";  */
        });
    /* }) */
}

function load_pagination() {
    if (localStorage.getItem('filters')) {
        var url = "module/shop/controller/controller_shop.php?op=count_filters&filters=" + localStorage.getItem('filters');
    } else {
        var url = "module/shop/controller/controller_shop.php?op=count";
    }

    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
    }).done(function (data) {
        var total_pages = 0;
        var total_prod = data[0].n_cars;

        if (total_prod >= 3) {
            total_pages = total_prod % 10;
        } else {
            total_pages = 1;
        }

        console.log("total_prod: " + total_prod);
        console.log("total_pages: " + total_pages);

        $('#pagination').bootpag({
            total: total_pages,
            page: 1,
            maxVisible: total_pages
        }).on('page', function (event, num) {
            total_prod = 10 * (num - 1);
            load_list_products(total_prod, 12); // de 0 a ...
            $('html, body').animate({ scrollTop: $("#list_cars") });
        });
    }).fail(function () {
        console.log('Fail count');
    });
}


function load_map_details(data) {

    var mymap = L.map('mimapa').setView([38.819863, -0.607497], 5);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 25,
        attribution: 'Datos del mapa de &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' + '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' + 'Imágenes © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11'
    }).addTo(mymap);

    let location = { lat: parseFloat(data[0].Lat), lng: parseFloat(data[0].Lon) }
    /*        console.log(location + "location details");*/
    var marker = L.marker(location).addTo(mymap);
    console.log(data);
    marker.bindPopup(/* "<b>Aci estaria el coche</b><br><a href='#'>Details</a>" */
        "<div class='popup_details'>" +
        "<p>" + data[0].brand + "</p>" +
        "<p>" + data[0].model + "</p>" +
        "<p>" + data[0].type + "</p>" +
        "<p>" + data[0].category + "</p>" +
        "<p>" + data[0].KM + "</p>" +
        "<p>" + data[0].price + "</p>" +
        "<a href='#details_cars'>Details</a>" +
        "</div>");
}


function maps(data) {

    var mymap = L.map('mimapa').setView([38.819863, -0.607497], 6);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 25,
        attribution: 'Datos del mapa de &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' + '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' + 'Imágenes © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11'
    }).addTo(mymap);

    for (row in data) {

        let location = { lat: parseFloat(data[row].Lat), lng: parseFloat(data[row].Lon) }

        var marker = L.marker(location).addTo(mymap);

        marker.bindPopup(/* "<b>Aci estaria el coche</b><br><a href='#'>Details</a>" */
            "<div class='popup_details' id='" + data[row].id + "'>" +
            "<img src=" + data[row].img + ">" +
            "<p>" + data[row].brand + "</p>" +
            "<p>" + data[row].model + "</p>" +
            "<p>" + data[row].type + "</p>" +
            "<p>" + data[row].category + "</p>" +
            "<p>" + data[row].KM + "</p>" +
            "<p>" + data[row].price + "</p>" +
            "</div>");

    }

}

function load_filters() {

    $(document).on('click', '.filters__input', function () {

        console.log("click filer button");

    });

    ajaxPromise('module/shop/controller/controller_shop.php?op=filters',

        'GET', 'JSON')
        .then(function (data) {

            if (data.length == 0) {
                $(".details_cars").empty();
                $(".filters__container").append('<div><h3>Su búsqueda no dió resultados.</h3></div>');
            } else {
                $(".details_cars").empty();

                console.log(data);

                for (row in data) {

                    $('<label></label>').attr({ 'class': 'filters__title' }).appendTo('.filters__content')
                        .html(row.toUpperCase());

                    for (row_inner in data[row]) {

                        $('<div></div>').attr({ 'class': 'filters__input' }).appendTo('.filters__content')

                            .html(
                                "<input class='check' type='checkbox' id=" + row + " name=" + data[row][row_inner][row] + " value='" + data[row][row_inner][row] + "'/>"

                                + "<label for='' value='" + data[row][row_inner][row] + "'>" + data[row][row_inner][row] + "</label>");
                    }
                }
                $(".filters__container").append(
                    "<div class='filters__input'><input class='button' name='Submit' type='button' id='filter' value='Filtrar' onclick='filters()'/></div>" +
                    "</div></form>" 
                ),
                    $(".filters__container").append(
                        "<div class='remove-filters'><input class='button' name='pepino' type='button' id='remove-filters' value='Remove Filter' '/></div>" +
                        "</div></form>" /* renderitzar list altra vegada en un href */
                    )
            }
            highlightFilters();
            loadCars();
        })
        .catch(function (textStatus) {
            if (console && console.log) {
/*              window.location.href = "index.php?page=exception&op=503&read"*/
                console.log("filters error");
                console.log("La solicitud ha fallado: " + textStatus);
            }

        });

}

function highlightFilters() {
    $('.filter-col').removeClass('active-filter');
    if (localStorage.getItem('filters')) {

        const filters = JSON.parse(localStorage.getItem('filters'));

        for (row in filters) {
/*             console.log(filters[row]);
 */            for (row_inner in filters[row]) {
                console.log(filters[row][row_inner]);

                filters[row][row_inner].forEach(e => {
                    $('input[name=' + e + '][value=' + e + ']').attr('checked','checked');
/*                     console.log($('input[id="brand"][value="Honda"]'));
 */                });
                /*  let content = '#' + filters[row][row_inner].replace(/ /g, "_") + row + '-filter-div';
                 $(content).addClass('active-filter'); */
            }//row_inner_end
        }//row in filters_end
    }
}

function filters() {

    var brand = [];
    var hp = [];
    var km = [];
    var category = [];
    var type = [];
    var version = [];
    var price = [];
    var filters = [];

    localStorage.removeItem('filters');
    
    $.each($("input[id='brand']:checked"), function () {
        brand.push($(this).val());

    });
    if (brand.length != 0) {
        filters.push({ "brand": brand });
    }

    $.each($("input[id='hp']:checked"), function () {
        hp.push($(this).val());
    });
    if (hp.length != 0) {
        filters.push({ "hp": hp });
    }
    
    $.each($("input[id='km']:checked"), function () {
        km.push($(this).val());
    });
    if (km.length != 0) {
        filters.push({ "km": km });
    }

    $.each($("input[id='category']:checked"), function () {
        category.push($(this).val());
    });
    if (category.length != 0) {
        filters.push({ "category": category });
    }

    $.each($("input[id='type']:checked"), function () {
        type.push($(this).val());
    });
    if (type.length != 0) {
        filters.push({ "type": type });
    }

    $.each($("input[id='version']:checked"), function () {
        version.push($(this).val());
    });
    if (version.length != 0) {
        filters.push({ "version": version });
    }

    $.each($("input[id='price']:checked"), function () {
        price.push($(this).val());
    });
    if (price.length != 0) {
        filters.push({ "price": price });
    }

    if (filters.length != 0) {
        localStorage.setItem('filters', JSON.stringify(filters));
    }

    document.filter.submit();
    document.filter.action = "index.php?page=controller_shop.php?op=view";
}

function redirectDetails() {
    $(document).on("click", ".modaldet", function () {

        console.log("click_details");

        console.log(this.getAttribute('id'));
        localStorage.setItem('currentPage', 'shop-details');

        localStorage.setItem('id', $(this).attr('id'));
        location.reload();
    });
    $(document).on("click", ".popup_details", function () {

        console.log("click_details");

        console.log(this.getAttribute('id'));
        localStorage.setItem('currentPage', 'shop-details');

        localStorage.setItem('id', $(this).attr('id'));
        location.reload();
    });
}

function removeFilters() {
    $(document).on('click', '#remove-filters', function () {

        console.log("ye que si que els has borrat");
        localStorage.removeItem('filters');
        /*    highlightFilters();
           loadCars(); */
        location.reload();

    });
}

function loadContent() {
    if (localStorage.getItem('currentPage') == 'shop-details') {
        loadCar_details();
    } else {
        load_filters();
        load_pagination();
        redirectDetails();
        removeFilters();

    }
}

$(document).ready(function () {
    loadContent();
                     /* BACK BUTTON */
    $(document).on("click", ".list_button", function () {
        localStorage.setItem('currentPage', 'list-cars');
        location.reload();
    });
                    /* BACK BUTTON */
});