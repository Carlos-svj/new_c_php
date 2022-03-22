function loadTypes(loadeds = 0) {
    let items = 5;
    let loaded = loadeds;
    ajaxPromise('module/home/controller/controller_home.php?op=type',
        'GET', 'JSON', {items: items, loaded: loaded})
        .then(function (data) {

            for (row in data) {
                $('<div></div>').attr('class', 'type_elements').attr({ 'id': data[row].type }).appendTo('#types').html(
                    "<div class='portfolio-image'>" +
                    "<img src=" + data[row].img_type + ">" +
                    "</div>" +
                    "<h5>" + data[row].type + "</h5>"
                )
            }
        }).catch(function () {
            console.log("catch types homepage.js");
            /* window.location.href = "index.php?page=exception&op=503&read"; */
        });
}

function load_more() {
    ajaxPromise('module/home/controller/controller_home.php?op=count_type', 'POST', 'JSON')
    .then(function(data) {
        console.log(data);
      total_items = data[0].count;
      console.log("total items" + total_items);
       loadTypes();
       $(document).on("click",'button.load_more', function (){
          console.log("click load more");

        var items = $('.type_elements').length + 2;
        console.log(items);
        if (total_items <= items) {
          $('.types_button').empty();
        }
        loadTypes($('div.type_elements').length);
      });
    }).catch(function() {
      console.log('error total_items');
    }); 
}

function loadCategories() {

    ajaxPromise('module/home/controller/controller_home.php?op=categories',
        'GET', 'JSON')
        .then(function (data) {

/*             console.log(data)
 */
            for (row in data) {
                $('<div></div>').attr('class', 'category_elements').attr({ 'id': data[row].category }).appendTo('.pepino').html(

                    "<div class='portfolio-image'>" +
                    "<img src=" + data[row].img_category + ">" +
                    "</div>" +
                    "<h5>" + data[row].category + "</h5>"
                )
            }
        }).catch(function () {
            console.log("yeee");
            window.location.href = "index.php?page=exception&op=503&read";
        });
}

function loadBrands() {

    ajaxPromise('module/home/controller/controller_home.php?op=brand',
        'GET', 'JSON')
        .then(function (data) {

/*             console.log(data)
 */
            for (row in data) {

                /* attr de la class .attr id i li pose el nom mes controlat */
                $('<div></div>').attr('id', data[row].brand).appendTo(".carousel__list").html(
                    "<img src='view" + data[row].img_brand + "' alt='' style='width:200px'/>"
                )

            }

            new Glider(document.querySelector('.carousel__list'), {
                slidesToShow: 3,
                dots: '.carousel__indicator',
                draggable: true,
                arrows: {
                    prev: '.carousel__prev',
                    next: '.carousel__next'
                }
            });

        }).catch(function () {
            console.log("yeee");
            window.location.href = "index.php?page=exception&op=503&read";
        });
}

function click_to_shop() {

    $(document).on("click", '.glider-slide', function () {
        console.log("hola click ");
        var filters = [];
        
        filters.push({ "brand": [this.getAttribute('id')] });
        localStorage.removeItem('filters')
        localStorage.setItem('filters', JSON.stringify(filters));
        console.log(filters);
        setTimeout(function () {
            window.location.href = 'index.php?page=shop&op=view';
        }, 500);
    });

    $(document).on("click", '.type_elements', function () {
        console.log("hola click ");
        var filters = [];
        filters.push({ "type": [this.getAttribute('id')] });
        localStorage.removeItem('filters')
        localStorage.setItem('filters', JSON.stringify(filters));
        console.log(filters);
        setTimeout(function () {
            window.location.href = 'index.php?page=shop&op=view';
        }, 500);
    });

    $(document).on("click", '.category_elements', function () {
        console.log("hola click ");
        var filters = [];
        filters.push({ "category": [this.getAttribute('id')] });
        localStorage.removeItem('filters')
        localStorage.setItem('filters', JSON.stringify(filters));
        console.log(filters);
        setTimeout(function () {
            window.location.href = 'index.php?page=shop&op=view';
        }, 500);
    });

}

$(document).ready(function () {
    loadTypes();
    loadCategories();
    loadBrands();
    click_to_shop();
    load_more(); 
});
